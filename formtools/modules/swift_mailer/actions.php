<?php

$folder = dirname(__FILE__);
require_once("$folder/../../global/session_start.php");

$request = array_merge($_GET, $_POST);
$action  = $request["action"];

switch ($action)
{
  case "remember_advanced_settings":
    ft_load_module_field("swift_mailer", "remember_advanced_settings", "remember_advanced_settings");
    break;
}
