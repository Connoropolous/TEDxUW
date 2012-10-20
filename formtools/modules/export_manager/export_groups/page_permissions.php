<?php

if (isset($request["update_permissions"]))
  list ($g_success, $g_message) = exp_update_export_group_permissions($request);

$forms = ft_get_form_view_list();
$export_group_info = exp_get_export_group($export_group_id);
$mappings = exp_deserialized_export_group_mapping($export_group_info["forms_and_views"]);

$page_vars["page"] = "permissions";
$page_vars["forms"] = $forms;
$page_vars["selected_form_ids"] = $mappings["form_ids"];
$page_vars["selected_view_ids"] = $mappings["view_ids"];
$page_vars["export_group_id"] = $export_group_id;
$page_vars["export_group_info"] = $export_group_info;
$page_vars["head_title"] = "{$L["module_name"]} - {$LANG["word_permissions"]}";
$page_vars["head_js"] =<<< EOF

$(function() {
  $("input[name=access_type]").bind("click change", function() {
    var form_type = this.value;
    if (form_type == "private") {
      $("#custom_clients").show();
    } else {
      $("#custom_clients").hide();
    }
  });

  $("input[name=form_view_mapping]").bind("click change", function() {
    var form_type = this.value;
    if (form_type == "all") {
      $("#custom_forms").hide();
    } else {
      $("#custom_forms").show();
    }
  });

  $(".form_ids").bind("click", function() {
    var form_id = this.value;
    if (this.checked) {
      $("#f" + form_id + "_views").show();
    } else {
      $("#f" + form_id + "_views").hide();
    }
  });

  $(".view_ids").bind("click", function() {
    var view_id = this.value;
    if ($(this).hasClass("all_views")) {
      if (this.checked) {
        $(this).closest("ul").find(".view_ids").not(".all_views").attr({ checked: "", disabled: "disabled" });
      } else {
        $(this).closest("ul").find(".view_ids").not(".all_views").attr({ disabled: "" });
      }
    }
  });

  $("form").bind("submit", function() {
    ft.select_all("selected_client_ids[]");
  });
});

EOF;

ft_display_module_page("templates/export_groups/edit.tpl", $page_vars);
