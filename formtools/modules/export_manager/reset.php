<?php

require_once("../../global/library.php");
ft_init_module_page();
$request = array_merge($_POST, $_GET);

if (isset($request["reset"]))
{
  list($g_success, $g_message) = exp_insert_default_data();
}
// ------------------------------------------------------------------------------------------------

$page_vars = array();
$page_vars["head_title"] = "{$L["module_name"]} - {$L["phrase_reset_defaults"]}";
$page_vars["head_string"] =<<< END
<link type="text/css" rel="stylesheet" href="{$g_root_url}/modules/export_manager/global/css/styles.css">
END;

ft_display_module_page("templates/reset.tpl", $page_vars);
