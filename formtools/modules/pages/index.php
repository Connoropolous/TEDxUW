<?php

require_once("../../global/library.php");
ft_init_module_page();

$folder = dirname(__FILE__);
require_once("$folder/library.php");

if (isset($_GET["delete"]))
  list($g_success, $g_message) = pg_delete_page($_GET["delete"]);


$page = ft_load_module_field("pages", "page", "module_pages_page", 1);
$num_pages_per_page = ft_get_module_settings("num_pages_per_page");
$pages_info = pg_get_pages($num_pages_per_page, $page);

$results     = $pages_info["results"];
$num_results = $pages_info["num_results"];

$text_intro_para_2 = ft_eval_smarty_string($L["text_intro_para_2"], array("url" => "../../admin/settings/index.php?page=menus"));

// ------------------------------------------------------------------------------------------------

$page_vars = array();
$page_vars["pages"] = $results;
$page_vars["head_title"] = $L["module_name"];
$page_vars["pagination"] = ft_get_page_nav($num_results, $num_pages_per_page, $page, "");
$page_vars["js_messages"] = array("word_edit", "phrase_please_confirm", "word_yes", "word_no");
$page_vars["module_js_messages"] = array("confirm_delete_page");
$page_vars["text_intro_para_2"] = $text_intro_para_2;
$page_vars["head_string"] =<<< EOF
  <script type="text/javascript" src="scripts/pages.js"></script>
EOF;

ft_display_module_page("templates/index.tpl", $page_vars);