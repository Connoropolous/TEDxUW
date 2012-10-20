<?php

require("../../../global/library.php");
ft_init_module_page();
require_once("../library.php");

// ------------------------------------------------------------------------------------------------

$page_vars = array();
$page_vars["head_title"] = "{$L["module_name"]} - {$L["phrase_add_export_type"]}";
$page_vars["head_js"] = "
var page_ns = {};
page_ns.rules = [];
page_ns.rules.push(\"required,export_type_name,Please enter the name of this export type.\");
page_ns.rules.push(\"required,filename,Please enter the filename structure for all generated content from this export type.\");
page_ns.rules.push(\"required,smarty_template,Please enter the Smarty content for this export type.\");
";

ft_display_module_page("templates/export_types/add.tpl", $page_vars);