<?php

if (isset($request["create_export_type"]))
{
  header("location: edit.php?page=add_export_type");
  exit;
}

if (isset($request["delete"]))
  list ($g_success, $g_message) = exp_delete_export_type($request["delete"]);

if (isset($request["reorder_export_types"]))
{
  $request["sortable_id"] = $export_group_type_id;
  list ($g_success, $g_message) = exp_reorder_export_types($request);
}

$export_types = exp_get_export_types($export_group_id);

$page_vars["sortable_id"] = $export_group_type_id;
$page_vars["export_group_info"] = exp_get_export_group($export_group_id);
$page_vars["export_types"] = $export_types;
$page_vars["head_title"] = "{$L["module_name"]} - {$L["phrase_export_types"]}";
$page_vars["page"] = "export_types";
$page_vars["js_messages"] = array("phrase_please_confirm", "word_yes", "word_no");
$page_vars["module_js_messages"] = array("confirm_delete_export_type");

ft_display_module_page("templates/export_groups/edit.tpl", $page_vars);
