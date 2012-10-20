<?php

require("../../global/library.php");
$folder = dirname(__FILE__);
require_once("$folder/library.php");
ft_init_module_page();


if (isset($_POST["update"]))
	list ($g_success, $g_message) = pg_update_settings($_POST);

$page_vars = array();
$page_vars["head_title"] = "{$L["word_pages"]} - {$LANG["word_settings"]}";
$page_vars["num_pages_per_page"] = ft_get_module_settings("num_pages_per_page");

ft_display_module_page("templates/settings.tpl", $page_vars);