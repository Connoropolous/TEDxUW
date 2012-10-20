<?php

/**
 * Module file: Form Backup
 *
 * This module lets you backup an entire form, including individual components like Views, email templates and submission
 * data. It's also handy for making copies of forms if you want multiple, similar forms without having to add each
 * separately.
 */

$MODULE["author"]          = "Encore Web Studios";
$MODULE["author_email"]    = "formtools@encorewebstudios.com";
$MODULE["author_link"]     = "http://www.encorewebstudios.com";
$MODULE["version"]         = "1.1.1";
$MODULE["date"]            = "2011-08-28";
$MODULE["origin_language"] = "en_us";


// define the module navigation - the keys are keys defined in the language file. This lets
// the navigation - like everything else - be customized to the users language
$MODULE["nav"] = array(
  "module_name"     => array("index.php", false),
  "word_settings"   => array("settings.php", true),
  "word_help"       => array("help.php", true)
    );