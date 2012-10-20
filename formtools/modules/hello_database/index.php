<?php

require_once("../../global/library.php");
ft_init_module_page();

$random_numbers = hd_get_rand_nums();

// ------------------------------------------------------------------------------------------------

$page_vars = array();
$page_vars["random_numbers"] = implode(", ", $random_numbers);

ft_display_module_page("templates/index.tpl", $page_vars);