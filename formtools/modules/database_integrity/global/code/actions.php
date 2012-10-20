<?php

/**
 * actions.php
 *
 * This file handles all server-side responses for Ajax requests. All information is returned in JSON
 * format.
 */

// -------------------------------------------------------------------------------------------------

$folder = dirname(__FILE__);
require_once(realpath("$folder/../../../../global/session_start.php"));
$folder = dirname(__FILE__);
require_once(realpath("$folder/../../library.php"));
ft_check_permission("user");

// the action to take and the ID of the page where it will be displayed (allows for
// multiple calls on same page to load content in unique areas)
$request = array_merge($_GET, $_POST);
$action  = $request["action"];
$settings = ft_get_settings();

switch ($action)
{
  // called for the start of each component (i.e. the core, each module). All it does
  // is return a list of tables to test.
  case "start_component_test":
    $component = $request["component"];

    if ($component == "core")
    {
      $core_version = $settings["program_version"];
      require_once("$g_root_dir/modules/database_integrity/core_structure.php");
      $tables = array_merge(array("FORM TOOLS CORE", "core"), di_get_component_tables($STRUCTURE[$core_version]));
    }
    else
    {
      $module_info = ft_get_module($request["component"]); // $request["component"] is just the module ID
      $module_folder = $module_info["module_folder"];
      require_once("$g_root_dir/modules/$module_folder/database_integrity.php");
      $tables = array_merge(array($module_info["module_name"], $request["component"]), di_get_component_tables($STRUCTURE));
    }
    echo "{ \"tables\": " . ft_convert_to_json($tables) . " }";
    break;

  case "process_table":
    $component = $request["component"];
    if ($component == "core")
    {
      $core_version = $settings["program_version"];
      require_once("$g_root_dir/modules/database_integrity/core_structure.php");
      $info = di_check_component_table($STRUCTURE[$core_version], $request["table_name"]);
      $info["table_name"] = $request["table_name"];
      echo ft_convert_to_json($info);
    }
    else
    {
      $module_info = ft_get_module($request["component"]); // $request["component"] is just the module ID
      $module_folder = $module_info["module_folder"];
      require_once("$g_root_dir/modules/$module_folder/database_integrity.php");
      $info = di_check_component_table($STRUCTURE, $request["table_name"]);
      $info["table_name"] = $request["table_name"];
      echo ft_convert_to_json($info);
    }
    break;
}


