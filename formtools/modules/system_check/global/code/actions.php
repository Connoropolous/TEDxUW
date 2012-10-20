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
  // Stage 1 of the Table Verification test: returns a list of tables to test for a particular component
  case "get_component_tables":
    $component = $request["component"];

    // N.B. from 2.1.5 onwards, the Core stores its own DB structure
    if ($component == "core")
    {
      require_once("$g_root_dir/global/misc/config_core.php");
      $tables = array_merge(array("FORM TOOLS CORE", "core"), sc_get_component_tables($STRUCTURE));
    }
    else
    {
      $module_info = ft_get_module($request["component"]); // $request["component"] is just the module ID
      $module_config = sc_get_module_config_file_contents($module_info["module_folder"]);
      $tables = array_merge(array($module_info["module_name"], $request["component"]), sc_get_component_tables($module_config["tables"]));
    }
    echo "{ \"tables\": " . ft_convert_to_json($tables) . " }";
    break;

  // Stage 2 of the Table Verification test: verifies the table structure
  case "verify_table":
    $component = $request["component"];
    if ($component == "core")
    {
      require_once("$g_root_dir/global/misc/config_core.php");
      $info = sc_check_component_table($STRUCTURE, $request["table_name"]);
      $info["table_name"] = $request["table_name"];
      echo ft_convert_to_json($info);
    }
    else
    {
      $module_info = ft_get_module($request["component"]); // $request["component"] is just the module ID
      $module_config = sc_get_module_config_file_contents($module_info["module_folder"]);
      $info = sc_check_component_table($module_config["tables"], $request["table_name"]);
      $info["table_name"] = $request["table_name"];
      echo ft_convert_to_json($info);
    }
    break;

  // verifies the hooks for a particular module. This is much simpler than the table test. It just examines each module's hooks
  // in a single step and returns the result
  case "verify_module_hooks":
    $module_id = $request["module_id"];
    $module_info   = ft_get_module($module_id);
    $module_folder  = $module_info["module_folder"];
    $module_version = $module_info["version"];
    $result = sc_verify_module_hooks($module_folder, $module_version);

    echo "{ \"module_id\": $module_id, \"module_folder\": \"$module_folder\", \"module_name\": \"{$module_info["module_name"]}\", \"result\": \"$result\" }";
    break;

  case "verify_component_files":
  	$component = $request["component"];

  	$return_info = array("result" => "pass", "bah" => "stupid");
  	if ($component == "core")
  	{
      $missing_files = sc_check_core_files();
      $return_info["component_type"] = "core";
      $return_info["component_name"] = "Form Tools Core";
  	}
  	if (preg_match("/^module_/", $component))
  	{
  		$module_id = preg_replace("/^module_/", "", $component);
  		$module_info   = ft_get_module($module_id);
  	  $missing_files = sc_check_module_files($module_info["module_folder"]);
      $return_info["component_type"] = "module";
      $return_info["component_name"] = $module_info["module_name"];
  	}
  	if (preg_match("/^theme_/", $component))
  	{
  		$theme_id = preg_replace("/^theme_/", "", $component);
  		$theme_info   = ft_get_theme($theme_id);
  	  $missing_files = sc_check_theme_files($theme_info["theme_folder"]);
      $return_info["component_type"] = "theme";
      $return_info["component_name"] = $theme_info["theme_name"];
  	}

  	if (!empty($missing_files))
    {
    	$return_info["result"] = "fail";
    	$return_info["missing_files"] = $missing_files;
    }
    echo ft_convert_to_json($return_info);
  	break;

  case "find_table_orphans":
  	$remove_orphans = isset($request["remove_orphans"]) ? true : false;
    $results = sc_find_table_orphans($request["table_name"], $remove_orphans);
    echo ft_convert_to_json($results);
  	break;
}


