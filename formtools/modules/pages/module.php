<?php

/**
 * Module file: Pages
 */

$MODULE["author"]          = "Encore Web Studios";
$MODULE["author_email"]    = "formtools@encorewebstudios.com";
$MODULE["author_link"]     = "http://www.encorewebstudios.com";
$MODULE["version"]         = "1.2.6";
$MODULE["date"]            = "2011-10-24";
$MODULE["origin_language"] = "en_us";


// define the module navigation - the keys are keys defined in the language file. This lets
// the navigation - like everything else - be customized to the users language
$MODULE["nav"] = array(
  "word_pages"      => array("index.php", false),
  "phrase_add_page" => array("add.php", true),
  "word_settings"   => array("settings.php", false),
  "word_help"       => array("help.php", false)
    );