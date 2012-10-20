<?php

if (!isset($request["export_type_id"]))
{
  session_write_close();
  header("location: edit.php?page=export_types");
  exit;
}
$export_type_id = $request["export_type_id"];

if (isset($request["update_export_type"]))
  list($g_success, $g_message) = exp_update_export_type($request);

$page_vars["page"] = "edit_export_type";
$page_vars["export_group_id"] = $export_group_id;
$page_vars["export_group_info"] = exp_get_export_group($export_group_id);
$page_vars["export_type"] = exp_get_export_type($export_type_id);
$page_vars["head_string"] .= "<script type=\"text/javascript\" src=\"$g_root_url/global/codemirror/js/codemirror.js\"></script>";
$page_vars["head_title"] = "{$L["module_name"]} - {$L["phrase_edit_export_type"]}";
$page_vars["head_js"] = "
var page_ns = {};
page_ns.rules = [];
page_ns.rules.push(\"required,export_type_name,Please enter the name of this export type.\");
page_ns.rules.push(\"required,filename,Please enter the filename structure for all generated content from this export type.\");
page_ns.rules.push(\"required,smarty_template,Please enter the Smarty content for this export type.\");
";

ft_display_module_page("templates/export_groups/edit.tpl", $page_vars);
