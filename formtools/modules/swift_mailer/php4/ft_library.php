<?php

$g_swift_error = "";


/**
 * Sends the test email using Swift for PHP4 installations.
 *
 * @param array $settings
 * @param array $info
 * @return array
 */
function swift_php_ver_send_test_email($settings, $info)
{
  global $L, $g_swift_error;

  $smtp_server = $settings["smtp_server"];
  $port        = $settings["port"];

  $success = true;
  $message = $L["notify_email_sent"];

  $old_error_handler = set_error_handler("swift_error_handler");

  if (empty($port))
    $smtp =& new Swift_Connection_SMTP($smtp_server);
  else
    $smtp =& new Swift_Connection_SMTP($smtp_server, $port);

  if ($settings["requires_authentication"] == "yes")
  {
    $smtp->setUsername($settings["username"]);
    $smtp->setPassword($settings["password"]);
  }

  // if required, set the server timeout (Swift Mailer default == 15 seconds)
  if (isset($settings["server_connection_timeout"]) && !empty($settings["server_connection_timeout"]))
    $smtp->setTimeout($settings["server_connection_timeout"]);

  $swift =& new Swift($smtp);

	if (!empty($g_swift_error))
	{
	  return array(false, $L["notify_problem_sending_test_email"] . " " . $g_swift_error);
	}

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

	if (!empty($g_swift_error))
	{
	  return array(false, $L["notify_problem_sending_test_email"] . " " . $g_swift_error);
	}

  restore_error_handler();

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
        $smtp =& new Swift_Connection_SMTP($smtp_server, $port, SWIFT_SMTP_ENC_SSL);
      else
        $smtp =& new Swift_Connection_SMTP($smtp_server, $port, SWIFT_SMTP_ENC_TLS);
    }
    else
      $smtp =& new Swift_Connection_SMTP($smtp_server, $port);
  }
  else
  {
    if ($use_encryption)
    {
      if ($encryption_type == "SSL")
        $smtp =& new Swift_Connection_SMTP($smtp_server, SWIFT_SMTP_PORT_SECURE, SWIFT_SMTP_ENC_SSL);
      else
        $smtp =& new Swift_Connection_SMTP($smtp_server, SWIFT_SMTP_PORT_SECURE, SWIFT_SMTP_ENC_TLS);
    }
    else
    {
      $smtp =& new Swift_Connection_SMTP($smtp_server);
    }
  }

  return $smtp;
}


function swift_error_handler($errno, $errstr, $errfile, $errline)
{
  global $g_swift_error;

  switch ($errno)
  {
    case E_USER_ERROR:
      $g_swift_error = "[$errno] $errstr<Br />
                        Fatal error on line $errline in file $errfile";
      break;
/*
    case E_USER_WARNING:
      $g_swift_error = "<b>WARNING</b> [$errno] $errstr";
      break;

    case E_USER_NOTICE:
      $g_swift_error = "<b>NOTICE</b> [$errno] $errstr";
      break;

    default:
      $g_swift_error = "[$errno] $errstr";
      break;
*/
  }

  // don't execute PHP internal error handler
  return true;
}
