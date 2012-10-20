<?php

require_once("../../global/library.php");
ft_init_module_page();

$folder = dirname(__FILE__);
require_once("$folder/library.php");

$request = array_merge($_POST, $_GET);
if (!isset($request["form_id"]))
{
  header("location: index.php");
  exit;
}
$form_id = $_POST["form_id"];
$form_info = ft_get_form($form_id);
$views  = ft_get_views($form_id);
$emails = ft_get_email_templates($form_id);

// ------------------------------------------------------------------------------------------------

$page_vars = array();
$page_vars["form_id"] = $form_id;
$page_vars["form_info"] = $form_info;
$page_vars["views"] = $views["results"];
$page_vars["emails"] = $emails["results"];
$page_vars["head_title"] = $L["module_name"];
$page_vars["head_string"] = "<link type=\"text/css\" rel=\"stylesheet\" href=\"$g_root_url/modules/form_backup/global/style.css\">";

ft_display_module_page("templates/step2.tpl", $page_vars);