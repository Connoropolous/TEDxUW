<?php

require("../../global/library.php");
ft_init_module_page();
require_once("library.php");

$request = array_merge($_POST, $_GET);

if (isset($request["update"]))
  list ($g_success, $g_message) = exp_update_settings($request);

$module_settings = ft_get_module_settings();

$module_id = ft_get_module_id_from_module_folder("export_manager");
$module_info = ft_get_module($module_id);

// ------------------------------------------------------------------------------------------------

$page_vars = array();
$page_vars["head_title"] = "{$L["module_name"]} - {$LANG["word_settings"]}";
$page_vars["module_settings"] = $module_settings;
$page_vars["module_version"] = $module_info["version"];
$page_vars["allow_url_fopen"] = (ini_get("allow_url_fopen") == "1");

ft_display_module_page("templates/settings.tpl", $page_vars);