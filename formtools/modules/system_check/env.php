<?php

require_once("../../global/library.php");
ft_init_module_page();

$page = ft_load_module_field("system_check", "page", "page", "summary");

$page_vars = array();

$same_page = ft_get_clean_php_self();
$tabs = array(
  "summary" => array(
    "tab_label" => $L["word_summary"],
    "tab_link" => "{$same_page}?page=summary",
    "pages" => array("summary")
  ),
  "phpinfo" => array(
    "tab_label" => "phpinfo",
    "tab_link" => "{$same_page}?page=phpinfo",
    "pages" => array("phpinfo")
   )
);


$page_vars["page"] = $page;
$page_vars["tabs"] = $tabs;

switch ($page)
{
  case "summary":
    require_once("env_tab_summary.php");
    break;
  case "phpinfo":
    require_once("env_tab_phpinfo.php");
    break;
  default:
    require_once("env_tab_summary.php");
    break;
}