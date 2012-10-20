<?php

require_once("../../global/library.php");
ft_init_module_page();

$page_vars = array();
$page_vars["head_string"] =<<< END
<link type="text/css" rel="stylesheet" href="{$g_root_url}/modules/system_check/global/css/styles.css?v=2">
END;

ft_display_module_page("templates/index.tpl", $page_vars);
