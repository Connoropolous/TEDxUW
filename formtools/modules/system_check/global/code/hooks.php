<?php

/**
 * Contains all functions relating to the Hook Verification page.
 */


// ------------------------------------------------------------------------------------------------


/**
 * Verification of the module hooks is very basic, simply because there's always a single solution: resetting
 * them. This function returns a string with four possible values: "pass", "too_many_hooks", "missing_hooks"
 * or "invalid_hooks".
 *
 * If it's anything other than "pass", the user will have the option to reset the hooks for the module via the
 * interface.
 *
 * @param string $module_folder
 * @param string $module_version required for backward compatibility only.
 * @return string "pass", "too_many_hooks", "missing_hooks", "invalid_hooks"
 */
function sc_verify_module_hooks($module_folder, $module_version)
{
	global $g_root_dir, $g_table_prefix;

	$module_config = sc_get_module_config_file_contents($module_folder, $module_version);

	$hooks = array();
	if (isset($module_config["hooks"][$module_version]))
	  $hooks = $module_config["hooks"][$module_version];
	else
	  $hooks = $module_config["hooks"];

  $expected_num_hooks = count($hooks);

  $query = mysql_query("
    SELECT *
    FROM   {$g_table_prefix}hook_calls
    WHERE  module_folder = '$module_folder'
  ");
  $actual_num_hooks = mysql_num_rows($query);

  $result = "pass";
  if ($actual_num_hooks < $expected_num_hooks)
  {
  	$result = "missing_hooks";
  }
  else if ($actual_num_hooks > $expected_num_hooks)
  {
  	$result = "too_many_hooks";
  }
  else
  {
  	$actual_hooks = array();
  	while ($row = mysql_fetch_assoc($query))
  	{
  		$row["is_found"] = false;
  	  $actual_hooks[] = $row;
  	}

  	// loop through all expected hooks and confirm there's a (single) matching hook in the database
    foreach ($hooks as $hook_info)
    {
      $hook_type       = $hook_info["hook_type"];
      $action_location = $hook_info["action_location"];
      $function_name   = $hook_info["function_name"];
      $hook_function   = $hook_info["hook_function"];
      $priority        = $hook_info["priority"];

      $found = false;
      for ($i=0; $i<count($actual_hooks); $i++)
      {
      	$actual_hook_info = $actual_hooks[$i];
      	if ($actual_hook_info["is_found"])
      	  continue;

      	if (($hook_type       == $actual_hook_info["hook_type"]) &&
      	    ($action_location == $actual_hook_info["action_location"]) &&
      	    ($function_name   == $actual_hook_info["function_name"]) &&
      	    ($hook_function   == $actual_hook_info["hook_function"]) &&
      	    ($priority        == $actual_hook_info["priority"]))
      	{
      		$found = true;
          $actual_hooks[$i]["is_found"] = true;
      	  break;
      	}
      }

      if (!$found)
      {
      	$result = "invalid_hooks";
        break;
      }
    }
  }

  return $result;
}


/**
 * This explicitly empties and reloads any module's hook calls.
 *
 * @param array $module_ids
 */
function sc_reset_module_hook_calls($module_ids)
{
  global $g_table_prefix, $L;

  $problems = false;
  foreach ($module_ids as $module_id)
  {
    if (!is_numeric($module_id))
      continue;

    $module_info = ft_get_module($module_id);
    if (empty($module_info))
      continue;

    $module_folder  = $module_info["module_folder"];
    $module_version = $module_info["version"];

    $module_config = sc_get_module_config_file_contents($module_folder);
    $desired_hooks = isset($module_config["hooks"][$module_version]) ? $module_config["hooks"][$module_version] : $module_config["hooks"];
    if (empty($desired_hooks))
      continue;

    mysql_query("DELETE FROM {$g_table_prefix}hook_calls WHERE module_folder = '$module_folder'");

    foreach ($desired_hooks as $hook_info)
    {
    	$hook_type       = $hook_info["hook_type"];
    	$action_location = $hook_info["action_location"];
    	$function_name   = $hook_info["function_name"];
    	$hook_function   = $hook_info["hook_function"];
    	$priority        = $hook_info["priority"];

    	$query = mysql_query("
    	  INSERT INTO {$g_table_prefix}hook_calls (hook_type, action_location, module_folder, function_name, hook_function, priority)
    	  VALUES ('$hook_type', '$action_location', '$module_folder', '$function_name', '$hook_function', $priority)
    	");

    	if (!$query)
    	{
    		$problems = true;
    	}
    }
  }

  if ($problems)
  {
  	return array(true, $L["notify_problems_resetting_module_hooks"]);
  }
  else
  {
  	return array(true, $L["notify_module_hooks_reset"]);
  }
}

