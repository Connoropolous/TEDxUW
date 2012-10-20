<?php

require("../../global/library.php");
ft_init_module_page();

$folder = dirname(__FILE__);
require_once("$folder/library.php");

$request = array_merge($_POST, $_GET);
$page_id = $request["page_id"];
$page_info = pg_get_page($page_id);

$content = $page_info["content"];
switch ($page_info["content_type"])
{
  case "php":
	  ob_start();
eval($page_info["content"]);
    $content = ob_get_contents();
    ob_end_clean();
    break;
  case "smarty":
    $content = ft_eval_smarty_string($page_info["content"]);
    break;
}

// ------------------------------------------------------------------------------------------------

$page_vars = array();
$page_vars["page_id"] = $page_id;
$page_vars["phrase_edit_page"] = $L["phrase_edit_page"];
$page_vars["head_title"] = "{$LANG["pages"]["word_page"]} - {$page_info["heading"]}";
$page_vars["page_info"] = $page_info;
$page_vars["content"] = $content;

ft_display_module_page("templates/view.tpl", $page_vars);