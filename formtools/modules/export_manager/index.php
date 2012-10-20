<?php

require_once("../../global/library.php");
ft_init_module_page();
$request = array_merge($_POST, $_GET);
$sortable_id = "export_group_list";

if (isset($request["add_export_group"]))
  list ($g_success, $g_message) = exp_add_export_group($request);
if (isset($request["delete"]))
  list ($g_success, $g_message) = exp_delete_export_group($request["delete"]);
if (isset($request["update"]))
{
  $request["sortable_id"] = $sortable_id;
  list ($g_success, $g_message) = exp_reorder_export_groups($request);
}

$export_groups = exp_get_export_groups();

// ------------------------------------------------------------------------------------------------

$page_vars = array();
$page_vars["export_groups"] = $export_groups;
$page_vars["sortable_id"] = $sortable_id;
$page_vars["head_string"] =<<< END
<link type="text/css" rel="stylesheet" href="{$g_root_url}/modules/export_manager/global/css/styles.css">
<script src="{$g_root_url}/global/scripts/sortable.js"></script>
END;

$page_vars["head_js"] =<<< EOF
var page_ns = {};
page_ns.dialog = $("<div></div>");

page_ns.delete_export_group = function(el) {
  ft.create_dialog({
    dialog:     page_ns.dialog,
    title:      "{$LANG["phrase_please_confirm"]}",
    content:    "{$L["confirm_delete_export_group"]}",
    popup_type: "warning",
    buttons: [{
      text: "{$LANG["word_yes"]}",
      click: function() {
        var export_group_id = $(el).closest(".row_group").find(".sr_order").val();
        window.location = "index.php?delete=" + export_group_id;
      }
    },
    {
      text: "{$LANG["word_no"]}",
      click: function() {
        $(this).dialog("close");
      }
    }]
  });
  return false;
}
EOF;

ft_display_module_page("templates/index.tpl", $page_vars);
