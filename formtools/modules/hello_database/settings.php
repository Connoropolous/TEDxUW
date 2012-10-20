<?php

require_once("../../global/library.php");
ft_init_module_page();

if (isset($_POST["update"]))
{
  $setting = isset($_POST["demo_setting"]) ? $_POST["demo_setting"] : "";
  $info = array("demo_setting" => $setting);

  ft_set_module_settings($info);

  $g_success = true;
  $g_message = $L["notify_setting_updated"];
}

// ------------------------------------------------------------------------------------------------

$page_vars = array();
$page_vars["demo_setting"] = ft_get_module_settings("demo_setting");
ft_display_module_page("templates/settings.tpl", $page_vars);
