<?php

require_once("../../global/library.php");
ft_init_module_page();

$folder = dirname(__FILE__);
require_once("$folder/library.php");

$page = ft_load_module_field("swift_mailer", "page", "tab", "settings");
$php_self = ft_get_clean_php_self();
$tabs = array(
  "settings" => array(
      "tab_label" => $LANG["word_settings"],
      "tab_link" => "$php_self?page=settings"
        ),
  "test" => array(
      "tab_label" => $L["word_test"],
      "tab_link" => "$php_self?page=test"
        ),
    );

// load the appropriate code page
switch ($page)
{
  case "settings":
    require("tab_settings.php");
    break;
  case "test":
    require("tab_test.php");
    break;
  default:
    require("tab_settings.php");
    break;
}
