<?php

if (isset($request["update_export_group"]))
  list ($g_success, $g_message) = exp_update_export_group($request);

$export_group = exp_get_export_group($export_group_id);

$page_vars["export_group_info"] = $export_group;
$page_vars["page"] = "main";
$page_vars["icons"] = exp_get_export_icons();
$page_vars["head_title"] = "{$L["module_name"]} - {$L["phrase_edit_export_group"]}";
$page_vars["head_js"] =<<< END
var page_ns = {};
page_ns.change_action_type = function(action_type) {
  if (action_type == "file") {
    $("#headers").attr("disabled", "disabled");
  } else {
    $("#headers").attr("disabled", "");
  }
}

var rules = [];
rules.push("required,group_name,Please enter the export group name.");
rules.push("if:action=popup,required,popup_height,Please enter the popup height.");
rules.push("if:action=popup,required,popup_width,Please enter the popup width.");
END;

ft_display_module_page("templates/export_groups/edit.tpl", $page_vars);