<?php

require("../../global/library.php");
ft_init_module_page();
require_once("library.php");

$page_vars = array();
$page_vars["head_title"] = "{$L["module_name"]} - {$L["word_help"]}";

ft_display_module_page("templates/help.tpl", $page_vars);