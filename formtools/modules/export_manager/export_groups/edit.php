<?php

require("../../../global/library.php");
ft_init_module_page();
require_once("../library.php");
$request = array_merge($_POST, $_GET);

$export_group_type_id = "export_group_types";
$page            = ft_load_module_field("export_manager", "page", "export_manager_tab", "main");
$export_group_id = ft_load_module_field("export_manager", "export_group_id", "export_manager_export_group_id", "export_group_id");

if (isset($request["add_export_type"]))
  list ($g_success, $g_message) = exp_add_export_type($request);

$php_self = ft_get_clean_php_self();
$tabs = array(
  "main" => array(
      "tab_label" => "Main",
      "tab_link"  => "$php_self?page=main&export_group_id=$export_group_id"
        ),
  "permissions" => array(
      "tab_label" => $LANG["word_permissions"],
      "tab_link"  => "$php_self?page=permissions&export_group_id=$export_group_id"
        ),
  "export_types" => array(
      "tab_label" => "Export Types",
      "tab_link"  => "$php_self?page=export_types&export_group_id=$export_group_id",
      "pages" => array("export_types", "add_export_type", "edit_export_type")
        )
    );


$links = ft_get_export_group_prev_next_links($export_group_id);
$prev_tabset_link = (!empty($links["prev_id"])) ? "edit.php?page=$page&export_group_id={$links["prev_id"]}" : "";
$next_tabset_link = (!empty($links["next_id"])) ? "edit.php?page=$page&export_group_id={$links["next_id"]}" : "";

$page_vars = array();
$page_vars["tabs"] = $tabs;
$page_vars["show_tabset_nav_links"] = true;
$page_vars["prev_tabset_link"] = $prev_tabset_link;
$page_vars["next_tabset_link"] = $next_tabset_link;
$page_vars["head_string"] =<<< END
  <link type="text/css" rel="stylesheet" href="$g_root_url/modules/export_manager/global/css/styles.css?v=205">
  <script src="$g_root_url/global/scripts/sortable.js"></script>
  <script src="$g_root_url/modules/export_manager/global/scripts/admin.js"></script>
  <script src="$g_root_url/global/codemirror/js/codemirror.js"></script>
END;

// load the appropriate code pages
switch ($page)
{
  case "main":
    require("page_main.php");
    break;
  case "permissions":
    require("page_permissions.php");
    break;
  case "export_types":
    require("page_export_types.php");
    break;
  case "add_export_type":
    require("page_add_export_type.php");
    break;
  case "edit_export_type":
    require("page_edit_export_type.php");
    break;

  default:
    require("page_main.php");
    break;
}
