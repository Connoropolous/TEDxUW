<?php

require_once("../../global/library.php");
ft_init_module_page();
require_once(dirname(__FILE__) . "/library.php");

if (isset($_POST["update"]))
{
  list($g_success, $g_message) = fb_update_settings($_POST);
}

$module_settings = ft_get_module_settings();

$page_vars = array();
$page_vars["head_title"] = $L["module_name"];
$page_vars["head_string"] = "<link type=\"text/css\" rel=\"stylesheet\" href=\"$g_root_url/modules/form_backup/global/style.css\">";
$page_vars["module_settings"] = $module_settings;

ft_display_module_page("templates/settings.tpl", $page_vars);