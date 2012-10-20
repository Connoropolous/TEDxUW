<?php

require_once("../../global/library.php");
ft_init_module_page();

$folder = dirname(__FILE__);
require_once("$folder/library.php");

// ------------------------------------------------------------------------------------------------

$page_vars = array();
$page_vars["head_title"] = $L["module_name"];
$page_vars["head_string"] = "<link type=\"text/css\" rel=\"stylesheet\" href=\"$g_root_url/modules/form_backup/global/style.css\">";

ft_display_module_page("templates/index.tpl", $page_vars);