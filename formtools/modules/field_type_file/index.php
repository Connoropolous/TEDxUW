<?php

require_once("../../global/library.php");
ft_init_module_page();
$request = array_merge($_POST, $_GET);

$page_vars = array();
ft_display_module_page("templates/index.tpl", $page_vars);
