<?php

/*
Form Tools - Module Language File
---------------------------------

File created: Oct 24th, 2:46 AM

If you would like to help translate this module, please visit:
http://www.formtools.org/translations/
*/


$L = array();

// required
$L["module_name"] = "Swift Mailer";
$L["module_description"] = "This module lets your configure your server's SMTP settings for Swift Mailer, letting you override the default mail() functionality used to sent emails.";

$L["word_help"] = "Help";
$L["word_test"] = "Test";
$L["word_port"] = "Port";
$L["word_seconds"] = "seconds";

$L["phrase_use_authentication"] = "Use Authentication";
$L["phrase_send_test_email"] = "Send Test Email";
$L["phrase_enable_module"] = "Enable Module";
$L["phrase_smtp_server"] = "SMTP Server";
$L["phrase_test_plain_text_email"] = "Swift Mailer: Plain Test Email Test";
$L["phrase_test_html_email"] = "Swift Mailer: HTML Email Test";
$L["phrase_test_multipart_email"] = "Swift Mailer: Multi-part Email Test";
$L["phrase_undeliverable_email_recipient"] = "Undeliverable Email Recipient";
$L["phrase_authentication_procedure"] = "Authentication procedure";
$L["phrase_use_encryption"] = "Use Encryption";
$L["phrase_encryption_type"] = "Encryption Type";
$L["phrase_server_connection_timeout"] = "Server Connection Timeout";
$L["phrase_use_antiflooding"] = "Use anti-flooding";
$L["phrase_email_batch_size"] = "Email Batch Size";
$L["phrase_batch_wait_time"] = "Batch Wait Time";
$L["phrase_email_charset"] = "Email Charset";
$L["phrase_recipient_email"] = "Recipient Email";
$L["phrase_from_email"] = "From Email";
$L["phrase_plain_text_email"] = "Plain Text Email";
$L["phrase_html_email"] = "HTML Email";
$L["phrase_multipart_email"] = "Multipart (Text &amp; HTML) Email";

$L["phrase_multipart_email_text"] = "Multipart email (text portion)";
$L["phrase_multipart_email_html"] = "Multipart email (<b>HTML</b> portion)";

$L["notify_settings_updated"] = "The settings have been updated.";
$L["notify_php_version_not_found_or_invalid"] = "This module only supports PHP 4 and 5. We couldn't determine your PHP version using phpversion().";
$L["notify_email_sent"] = "The email was successfully sent.";
$L["notify_problem_sending_test_email"] = "There was a problem sending the test email:";
$L["notify_plain_text_email_sent"] = "Plain text email successfully sent.";
$L["notify_html_email_sent"] = "<b>HTML</b> email successfully sent.";
$L["notify_smtp_problem"] = "There was a problem communicating with SMTP:";
$L["notify_problem_building_email"] = "There was an unexpected problem building the email:";

$L["text_help"] = "Please see our <a href=\"http://modules.formtools.org/swift_mailer/documentation.php\" target=\"_blank\">online help documentation</a> for information on how to use this module.";
$L["text_settings_desc"] = "This module enables the <a href=\"http://swiftmailer.org/\" target=\"_blank\">Swift Mailer</a> script to send all Form Tools emails, instead of relying on the default PHP <b>mail()</b> function. Your PHP version is <b>{\$php_version}</b>.";
$L["text_test_desc"] = "Use the form below to confirm the emails are sent with the SMTP settings you have entered.";

$L["validation_no_recipient_email"] = "Please enter the recipient email address.";
$L["validation_no_sender_email"] = "Please enter the email address of the sender.";

$L["validation_no_smtp_server"] = "Please enter the SMTP server name.";
$L["validation_no_username"] = "Please enter the username.";
$L["validation_no_password"] = "Please enter the password.";
$L["validation_no_authentication_procedure"] = "Please indicate the authentication procedure.";
$L["validation_no_encryption_type"] = "Please select the encryption type.";

$L["validation_invalid_recipient_email"] = "Please enter a valid recipient email address.";
$L["validation_invalid_sender_email"] = "Please enter a valid sender email address.";

