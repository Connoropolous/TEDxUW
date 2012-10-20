<?php


/**
 * Sends the test email using Swift for PHP5 installations.
 *
 * @param array $settings
 * @param array $info
 * @return array
 */
function swift_php_ver_send_test_email($settings, $info)
{
  global $L;

  $smtp_server = $settings["smtp_server"];
  $port        = $settings["port"];

  $success = true;
  $message = $L["notify_email_sent"];

  try {
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

    // now send the appropriate email
    switch ($info["test_email_format"])
    {
      case "text":
        $email =& new Swift_Message($L["phrase_test_plain_text_email"], $L["notify_plain_text_email_sent"]);
        break;
      case "html":
        $email =& new Swift_Message($L["phrase_test_html_email"], $L["notify_html_email_sent"], "text/html");
        break;
      case "multipart":
        $email =& new Swift_Message($L["phrase_test_multipart_email"]);
        $email->attach(new Swift_Message_Part($L["phrase_multipart_email_text"]));
        $email->attach(new Swift_Message_Part($L["phrase_multipart_email_html"], "text/html"));
        break;
    }

    $swift->send($email, $info["recipient_email"], $info["from_email"]);
  }
  catch (Swift_ConnectionException $e)
  {
    $success = false;
    $message = $L["notify_smtp_problem"] . " " . $e->getMessage();
  }
  catch (Swift_Message_MimeException $e)
  {
    $success = false;
    $message = $L["notify_problem_building_email"] . " " . $e->getMessage();
  }

  return array($success, $message);
}


/**
 * This makes the connection in the main send- email function (swift_send_email()). It creates the
 * SMTP connection based on the user settings: the port, encryption type and so on. This is handled
 * in the separate PHP version folder because it differs between version 4 and 5.
 */
function swift_make_smtp_connection($settings)
{
  $smtp_server = $settings["smtp_server"];
  $port        = $settings["port"];
  $use_encryption = (isset($settings["use_encryption"]) && $settings["use_encryption"] == "yes") ? true : false;
  $encryption_type = isset($settings["encryption_type"]) ? $settings["encryption_type"] : "";

  if (isset($port) && !empty($port))
  {
    if ($use_encryption)
    {
      if ($encryption_type == "SSL")
        $smtp =& new Swift_Connection_SMTP($smtp_server, $port, Swift_Connection_SMTP::ENC_SSL);
      else
        $smtp =& new Swift_Connection_SMTP($smtp_server, $port, Swift_Connection_SMTP::ENC_TLS);
    }
    else
      $smtp =& new Swift_Connection_SMTP($smtp_server, $port);
  }
  else
  {
    if ($use_encryption)
    {
      if ($encryption_type == "SSL")
        $smtp =& new Swift_Connection_SMTP($smtp_server, Swift_Connection_SMTP::PORT_SECURE, Swift_Connection_SMTP::ENC_SSL);
      else
        $smtp =& new Swift_Connection_SMTP($smtp_server, Swift_Connection_SMTP::PORT_SECURE, Swift_Connection_SMTP::ENC_TLS);
    }
    else
    {
      $smtp =& new Swift_Connection_SMTP($smtp_server);
    }
  }

  return $smtp;
}
