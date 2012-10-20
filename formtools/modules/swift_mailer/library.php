<?php


/**
 * Updates the Swift Mailer settings.
 *
 * @param array $info
 * @return array [0] T/F<br />
 *               [1] Success / error message
 */
function swift_update_settings($info)
{
  global $L;

  $settings = array(
    "swiftmailer_enabled"     => (isset($info["swiftmailer_enabled"]) ? "yes" : "no"),
    "requires_authentication" => (isset($info["requires_authentication"]) ? "yes" : "no"),
    "use_encryption"          => (isset($info["use_encryption"]) ? "yes" : "no")
      );

  // Enable module
  if (isset($info["swiftmailer_enabled"]))
  {
    $settings["smtp_server"] = $info["smtp_server"];
    if (isset($info["port"]))
      $settings["port"] = $info["port"];
  }

  // Use authentication
  if (isset($info["requires_authentication"]))
  {
    if (isset($info["username"]))
      $settings["username"] = $info["username"];
    if (isset($info["password"]))
      $settings["password"] = $info["password"];
    if (isset($info["authentication_procedure"]))
      $settings["authentication_procedure"] = $info["authentication_procedure"];
  }

  // Use encryption
  if (isset($info["use_encryption"]))
  {
    if (isset($info["encryption_type"]))
      $settings["encryption_type"] = $info["encryption_type"];
  }

  // Advanced
  if (isset($_SESSION["ft"]["swift_mailer"]["remember_advanced_settings"]) && $_SESSION["ft"]["swift_mailer"]["remember_advanced_settings"])
  {
    if (isset($info["server_connection_timeout"]))
      $settings["server_connection_timeout"] = $info["server_connection_timeout"];
    if (isset($info["charset"]))
      $settings["charset"] = $info["charset"];

    // Anti-flooding
    $settings["use_anti_flooding"] =  isset($info["use_anti_flooding"]) ? "yes" : "no";

    if (isset($info["anti_flooding_email_batch_size"]))
      $settings["anti_flooding_email_batch_size"] = $info["anti_flooding_email_batch_size"];
    if (isset($info["anti_flooding_email_batch_wait_time"]))
      $settings["anti_flooding_email_batch_wait_time"] = $info["anti_flooding_email_batch_wait_time"];
  }

  ft_set_module_settings($settings);

  return array(true, $L["notify_settings_updated"]);
}


/**
 * Called on the test tab. It sends one of the three test emails: plain text, HTML and multi-part
 * using the SMTP settings configured on the settings tab. This is NOT for the test email done on the
 * email templates "Test" tab; it uses the main swift_send_email function for that.
 *
 * @param array $info
 * @return array [0] T/F<br />
 *               [1] Success / error message
 */
function swift_send_test_email($info)
{
  global $L;

  // find out what version of PHP we're running
  $version = phpversion();
  $version_parts = explode(".", $version);
  $main_version = $version_parts[0];
  $current_folder = dirname(__FILE__);

  if ($main_version == "5")
    $php_version_folder = "php5";
  else if ($main_version == "4")
    $php_version_folder = "php4";
  else
    return array(false, $L["notify_php_version_not_found_or_invalid"]);

  require_once("$current_folder/$php_version_folder/ft_library.php");
  require_once("$current_folder/$php_version_folder/Swift.php");
  require_once("$current_folder/$php_version_folder/Swift/Connection/SMTP.php");

  $settings = ft_get_module_settings();

  // if we're requiring authentication, include the appropriate authenticator file
  if ($settings["requires_authentication"] == "yes")
  {
    switch ($settings["authentication_procedure"])
    {
      case "LOGIN":
        require_once("$current_folder/$php_version_folder/Swift/Authenticator/LOGIN.php");
        break;
      case "PLAIN":
        require_once("$current_folder/$php_version_folder/Swift/Authenticator/PLAIN.php");
        break;
      case "CRAMMD5":
        require_once("$current_folder/$php_version_folder/Swift/Authenticator/CRAMMD5.php");
        break;
    }
  }

  // this passes off the control flow to the swift_php_ver_send_test_email() function
  // which is defined in both the PHP 5 and PHP 4 ft_library.php file, but only one of
  // which was require()'d
  return swift_php_ver_send_test_email($settings, $info);
}


/**
 * Sends an email with the Swift Mailer module.
 *
 * @param array $email_components
 * @return array
 */
function swift_send_email($email_components)
{
  global $g_table_prefix;

  // find out what version of PHP we're running
  $version = phpversion();
  $version_parts = explode(".", $version);
  $main_version = $version_parts[0];

  if ($main_version == "5")
    $php_version_folder = "php5";
  else if ($main_version == "4")
    $php_version_folder = "php4";
  else
    return array(false, $L["notify_php_version_not_found_or_invalid"]);

  // include the main files
  $current_folder = dirname(__FILE__);
  require_once("$current_folder/$php_version_folder/ft_library.php");
  require_once("$current_folder/$php_version_folder/Swift.php");
  require_once("$current_folder/$php_version_folder/Swift/Connection/SMTP.php");

  $settings = ft_get_module_settings("", "swift_mailer");
  $use_anti_flooding = (isset($settings["use_anti_flooding"]) && $settings["use_anti_flooding"] == "yes");

  // if the user has requested anti-flooding, include the plugin
  if ($use_anti_flooding)
  {
    require_once("$current_folder/$php_version_folder/Swift/Plugin/AntiFlood.php");
  }

  // if we're requiring authentication, include the appropriate authenticator file
  if ($settings["requires_authentication"] == "yes")
  {
    switch ($settings["authentication_procedure"])
    {
      case "LOGIN":
        require_once("$current_folder/$php_version_folder/Swift/Authenticator/LOGIN.php");
        break;
      case "PLAIN":
        require_once("$current_folder/$php_version_folder/Swift/Authenticator/PLAIN.php");
        break;
      case "CRAMMD5":
        require_once("$current_folder/$php_version_folder/Swift/Authenticator/CRAMMD5.php");
        break;
    }
  }

  $success = true;
  $message = "The email was successfully sent.";

  // make the SMTP connection (this is PHP-version specific)
  $smtp = swift_make_smtp_connection($settings);

  // if required, set the server timeout (Swift Mailer default == 15 seconds)
  if (isset($settings["server_connection_timeout"]) && !empty($settings["server_connection_timeout"]))
    $smtp->setTimeout($settings["server_connection_timeout"]);

  if ($settings["requires_authentication"] == "yes")
  {
    $smtp->setUsername($settings["username"]);
    $smtp->setPassword($settings["password"]);
  }

  $swift =& new Swift($smtp);

  // apply the anti-flood settings
  if ($use_anti_flooding)
  {
    $anti_flooding_email_batch_size      = $settings["anti_flooding_email_batch_size"];
    $anti_flooding_email_batch_wait_time = $settings["anti_flooding_email_batch_wait_time"];

    if (is_numeric($anti_flooding_email_batch_size) && is_numeric($anti_flooding_email_batch_wait_time))
      $swift->attachPlugin(new Swift_Plugin_AntiFlood($anti_flooding_email_batch_size, $anti_flooding_email_batch_wait_time), "anti-flood");
  }

  // now send the appropriate email
  if (!empty($email_components["text_content"]) && !empty($email_components["html_content"]))
  {
    $email =& new Swift_Message($email_components["subject"]);
    $email->attach(new Swift_Message_Part($email_components["text_content"]));
    $email->attach(new Swift_Message_Part($email_components["html_content"], "text/html"));
  }
  else if (!empty($email_components["text_content"]))
  {
    $email =& new Swift_Message($email_components["subject"]);
    $email->attach(new Swift_Message_Part($email_components["text_content"]));
  }
  else if (!empty($email_components["html_content"]))
  {
    $email =& new Swift_Message($email_components["subject"]);
    $email->attach(new Swift_Message_Part($email_components["html_content"], "text/html"));
  }

  // add the return path, if it's defined
  if (isset($email_components["email_id"]))
  {
    $email_id = $email_components["email_id"];
    $query = mysql_query("SELECT * FROM {$g_table_prefix}module_swift_mailer_email_template_fields WHERE email_template_id = $email_id");
    $extended_field_info = mysql_fetch_assoc($query);
    if (isset($extended_field_info["return_path"]) && !empty($extended_field_info["return_path"]))
      $email->setReturnPath($extended_field_info["return_path"]);
  }

  if (isset($settings["charset"]) && !empty($settings["charset"]))
    $email->setCharset($settings["charset"]);


  // now compile the recipient list
  $recipients =& new Swift_RecipientList();

  foreach ($email_components["to"] as $to)
  {
    if (!empty($to["name"]) && !empty($to["email"]))
      $recipients->addTo($to["email"], $to["name"]);
    else if (!empty($to["email"]))
      $recipients->addTo($to["email"]);
  }

  if (!empty($email_components["cc"]) && is_array($email_components["cc"]))
  {
    foreach ($email_components["cc"] as $cc)
    {
      if (!empty($cc["name"]) && !empty($cc["email"]))
        $recipients->addCc($cc["email"], $cc["name"]);
      else if (!empty($cc["email"]))
        $recipients->addCc($cc["email"]);
    }
  }

  if (!empty($email_components["bcc"]) && is_array($email_components["bcc"]))
  {
    foreach ($email_components["bcc"] as $bcc)
    {
      if (!empty($bcc["name"]) && !empty($bcc["email"]))
        $recipients->addBcc($bcc["email"], $bcc["name"]);
      else if (!empty($bcc["email"]))
        $recipients->addBcc($bcc["email"]);
    }
  }

  if (!empty($email_components["reply_to"]["name"]) && !empty($email_components["reply_to"]["email"]))
    $email->setReplyTo($email_components["reply_to"]["name"] . "<" . $email_components["reply_to"]["email"] . ">");
  else if (!empty($email_components["reply_to"]["email"]))
    $email->setReplyTo($email_components["reply_to"]["email"]);

  if (!empty($email_components["from"]["name"]) && !empty($email_components["from"]["email"]))
    $from =	new Swift_Address($email_components["from"]["email"], $email_components["from"]["name"]);
  else if (!empty($email_components["from"]["email"]))
    $from =	new Swift_Address($email_components["from"]["email"]);

  // finally, if there are any attachments, attach 'em
  if (isset($email_components["attachments"]))
  {
    foreach ($email_components["attachments"] as $attachment_info)
    {
      $filename      = $attachment_info["filename"];
      $file_and_path = $attachment_info["file_and_path"];

      if (!empty($attachment_info["mimetype"]))
        $email->attach(new Swift_Message_Attachment(new Swift_File($file_and_path), $filename, $attachment_info["mimetype"]));
      else
        $email->attach(new Swift_Message_Attachment(new Swift_File($file_and_path), $filename));
    }
  }

  if ($use_anti_flooding)
    $swift->batchSend($email, $recipients, $from);
  else
    $swift->send($email, $recipients, $from);

  return array($success, $message);
}


/**
 * Displays the extra fields on the Edit Email template: tab 2. Currently, this is only set to
 */
function swift_display_extra_fields_tab2($location, $info)
{
  global $L;

  $return_path = htmlspecialchars($info["template_info"]["swift_mailer_settings"]["return_path"]);

  echo "<tr>
          <td valign=\"top\" class=\"red\"> </td>
          <td valign=\"top\">{$L["phrase_undeliverable_email_recipient"]}</td>
          <td valign=\"top\">
            <input type=\"text\" name=\"swift_mailer_return_path\" style=\"width: 300px\" value=\"$return_path\" />
          </td>
        </tr>";
}


/**
 * This is called by the ft_create_blank_email_template function.
 *
 * @param array $info
 */
function swift_map_email_template_field($info)
{
  global $g_table_prefix;

  $email_template_id = $info["email_id"];
  mysql_query("INSERT INTO {$g_table_prefix}module_swift_mailer_email_template_fields (email_template_id, return_path) VALUES ($email_template_id, '')");
}


/**
 * This is called by the ft_create_blank_email_template function.
 *
 * @param array $info
 */
function swift_delete_email_template_field($info)
{
  global $g_table_prefix;

  $email_template_id = $info["email_id"];
  mysql_query("DELETE FROM {$g_table_prefix}module_swift_mailer_email_template_fields WHERE email_template_id = $email_template_id");
}


/**
 * This extends the ft_get_email_template function, adding the additional Swift Mailer return_path variable within a "swift_mailer_settings"
 * key.
 */
function swift_get_email_template_append_extra_fields($info)
{
  global $g_table_prefix;

  $email_id = $info["email_template"]["email_id"];
  $query = mysql_query("SELECT * FROM {$g_table_prefix}module_swift_mailer_email_template_fields WHERE email_template_id = $email_id");
  $result = mysql_fetch_assoc($query);

  $info["email_template"]["swift_mailer_settings"]["return_path"] = $result["return_path"];

  return $info;
}


function swift_update_email_template_append_extra_fields($info)
{
  global $g_table_prefix;

  $email_template_id        = $info["email_id"];
  $swift_mailer_return_path = $info["info"]["swift_mailer_return_path"];

  mysql_query("
    UPDATE {$g_table_prefix}module_swift_mailer_email_template_fields
    SET    return_path = '$swift_mailer_return_path'
    WHERE  email_template_id = $email_template_id
      ");
}


/**
 * The Export Manager installation function. This is automatically called by Form Tools on installation.
 */
function swift_mailer__install($module_id)
{
  global $g_table_prefix;

  $queries = array();
  $queries[] = "INSERT INTO {$g_table_prefix}settings (setting_name, setting_value, module) VALUES ('swiftmailer_enabled', 'no', 'swift_mailer')";
  $queries[] = "INSERT INTO {$g_table_prefix}settings (setting_name, setting_value, module) VALUES ('smtp_server', '', 'swift_mailer')";
  $queries[] = "INSERT INTO {$g_table_prefix}settings (setting_name, setting_value, module) VALUES ('port', '', 'swift_mailer')";
  $queries[] = "INSERT INTO {$g_table_prefix}settings (setting_name, setting_value, module) VALUES ('requires_authentication', 'no', 'swift_mailer')";
  $queries[] = "INSERT INTO {$g_table_prefix}settings (setting_name, setting_value, module) VALUES ('username', '', 'swift_mailer')";
  $queries[] = "INSERT INTO {$g_table_prefix}settings (setting_name, setting_value, module) VALUES ('password', '', 'swift_mailer')";
  $queries[] = "INSERT INTO {$g_table_prefix}settings (setting_name, setting_value, module) VALUES ('authentication_procedure', '', 'swift_mailer')";
  $queries[] = "INSERT INTO {$g_table_prefix}settings (setting_name, setting_value, module) VALUES ('use_encryption', '', 'swift_mailer')";
  $queries[] = "INSERT INTO {$g_table_prefix}settings (setting_name, setting_value, module) VALUES ('encryption_type', '', 'swift_mailer')";
  $queries[] = "INSERT INTO {$g_table_prefix}settings (setting_name, setting_value, module) VALUES ('charset', 'UTF-8', 'swift_mailer')";
  $queries[] = "INSERT INTO {$g_table_prefix}settings (setting_name, setting_value, module) VALUES ('server_connection_timeout', '15', 'swift_mailer')";
  $queries[] = "INSERT INTO {$g_table_prefix}settings (setting_name, setting_value, module) VALUES ('use_anti_flooding', '', 'swift_mailer')";
  $queries[] = "INSERT INTO {$g_table_prefix}settings (setting_name, setting_value, module) VALUES ('anti_flooding_email_batch_size', '', 'swift_mailer')";
  $queries[] = "INSERT INTO {$g_table_prefix}settings (setting_name, setting_value, module) VALUES ('anti_flooding_email_batch_wait_time', '', 'swift_mailer')";

  $queries[] = "CREATE TABLE {$g_table_prefix}module_swift_mailer_email_template_fields (
    email_template_id MEDIUMINT NOT NULL,
    return_path VARCHAR(255) NOT NULL,
    PRIMARY KEY (email_template_id)
    )";

  foreach ($queries as $query)
  {
    $result = mysql_query($query);
  }

  ft_register_hook("template", "swift_mailer", "edit_template_tab2", "", "swift_display_extra_fields_tab2");
  ft_register_hook("code", "swift_mailer", "end", "ft_create_blank_email_template", "swift_map_email_template_field");
  ft_register_hook("code", "swift_mailer", "end", "ft_delete_email_template", "swift_delete_email_template_field");
  ft_register_hook("code", "swift_mailer", "end", "ft_update_email_template", "swift_update_email_template_append_extra_fields");
  ft_register_hook("code", "swift_mailer", "end", "ft_get_email_template", "swift_get_email_template_append_extra_fields");

  // now map all the email template IDs for the extra return path field
  $email_template_ids = array();
  $query = mysql_query("SELECT email_id FROM {$g_table_prefix}email_templates");
  while ($row = mysql_fetch_assoc($query))
  {
    $email_template_id = $row["email_id"];
     mysql_query("INSERT INTO {$g_table_prefix}module_swift_mailer_email_template_fields (email_template_id, return_path) VALUE ($email_template_id, '')");
  }

  return array(true, "");
}


/**
 * The Swift Mailer uninstall script. This is called by Form Tools when the user explicitly chooses to
 * uninstall the module. The hooks are automatically removed by the core script; settings needs to be explicitly
 * removed, since it's possible some modules would want to leave settings there in case they re-install it
 * later.
 */
function swift_mailer__uninstall($module_id)
{
  global $g_table_prefix;

  mysql_query("DROP TABLE {$g_table_prefix}module_swift_mailer_email_template_fields");
  mysql_query("DELETE FROM {$g_table_prefix}settings WHERE module = 'swift_mailer'");

  return array(true, "");
}


/**
 * The module update function.
 *
 * @param string $old_version
 * @param string $new_version
 */
function swift_mailer__upgrade($old_version, $new_version)
{
  global $g_table_prefix;

  $old_version_info = ft_get_version_info($old_version);
  $new_version_info = ft_get_version_info($new_version);

  if ($old_version_info["release_date"] < 20090409)
  {
    @mysql_query("CREATE TABLE {$g_table_prefix}module_swift_mailer_email_template_fields (
      email_template_id MEDIUMINT NOT NULL,
      return_path VARCHAR(255) NOT NULL,
      PRIMARY KEY (email_template_id)
      )");

    ft_register_hook("template", "swift_mailer", "edit_template_tab2", "", "swift_display_extra_fields_tab2");
    ft_register_hook("code", "swift_mailer", "end", "ft_create_blank_email_template", "swift_map_email_template_field");
    ft_register_hook("code", "swift_mailer", "end", "ft_delete_email_template", "swift_delete_email_template_field");
    ft_register_hook("code", "swift_mailer", "end", "ft_update_email_template", "swift_update_email_template_append_extra_fields");
    ft_register_hook("code", "swift_mailer", "end", "ft_get_email_template", "swift_get_email_template_append_extra_fields");

    // now map all the email template IDs for the extra return path field
    $email_template_ids = array();
    $query = mysql_query("SELECT email_id FROM {$g_table_prefix}email_templates");
    while ($row = mysql_fetch_assoc($query))
    {
      $email_template_id = $row["email_id"];
       mysql_query("INSERT INTO {$g_table_prefix}module_swift_mailer_email_template_fields (email_template_id, return_path) VALUE ($email_template_id, '')");
    }
  }

  if ($old_version_info["release_date"] < 20090711)
  {
    $queries = array();

    $queries[] = "INSERT INTO {$g_table_prefix}settings (setting_name, setting_value, module) VALUES ('use_encryption', '', 'swift_mailer')";
    $queries[] = "INSERT INTO {$g_table_prefix}settings (setting_name, setting_value, module) VALUES ('encryption_type', '', 'swift_mailer')";
    $queries[] = "INSERT INTO {$g_table_prefix}settings (setting_name, setting_value, module) VALUES ('charset', 'UTF-8', 'swift_mailer')";
    $queries[] = "INSERT INTO {$g_table_prefix}settings (setting_name, setting_value, module) VALUES ('server_connection_timeout', '15', 'swift_mailer')";
    $queries[] = "INSERT INTO {$g_table_prefix}settings (setting_name, setting_value, module) VALUES ('use_anti_flooding', '', 'swift_mailer')";
    $queries[] = "INSERT INTO {$g_table_prefix}settings (setting_name, setting_value, module) VALUES ('anti_flooding_email_batch_size', '', 'swift_mailer')";
    $queries[] = "INSERT INTO {$g_table_prefix}settings (setting_name, setting_value, module) VALUES ('anti_flooding_email_batch_wait_time', '', 'swift_mailer')";
    foreach ($queries as $query)
    {
      $result = mysql_query($query);
    }
  }

  if ($old_version_info["release_date"] < 20100911)
  {
    @mysql_query("ALTER TABLE {$g_table_prefix}module_swift_mailer_email_template_fields TYPE=MyISAM");
  }
}
