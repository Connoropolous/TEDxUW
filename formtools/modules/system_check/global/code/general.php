<?php


/**
 * Figures out which (if any) of the installed modules are available for a particular test.
 *
 * @param string $test "tables", "hooks" or "files"
 * @return array all compatible modules (not the module_config.php info).
 */
function sc_get_compatible_modules($test)
{
  global $g_root_dir;

  $module_list = ft_get_modules();

  $compatible_modules = array();
  foreach ($module_list as $module_info)
  {
    $module_folder = $module_info["module_folder"];
    if ($module_info["is_installed"] != "yes")
      continue;

    $module_config = sc_get_module_config_file_contents($module_folder);
    if (!$module_config["is_compatible"])
      continue;

    $relevant = false;
    switch ($test)
    {
    	case "tables":
    		if ($module_config["includes_table_info"])
    		  $relevant = true;
    		break;
      case "hooks":
        if ($module_config["includes_hook_info"])
          $relevant = true;
        break;
      case "files":
        if ($module_config["includes_file_info"])
          $relevant = true;
        break;
    }

    $module_info["module_config"] = $module_config;

    if ($relevant)
      $compatible_modules[] = $module_info;
  }

  return $compatible_modules;
}


/**
 * This is the one entry point for getting data from a module config file.
 *
 * This function returns all config info about a module that can be used by the System Check module.
 * It's compatible with the old Database Integrity module, which required a database_integrity.php file
 * defined in the module root. The new System Check module requires a module_config.php file to be
 * defined in the module root.
 *
 * The module_config.php can define any of the following globals:
 *   $STRUCTURE - which contains the database structure of all module tables. If there's no database,
 *                it (should) define an empty array.
 *   $FILES     - a list of files for this module
 *   $HOOKS     - the list of hook calls that the module uses - or an empty array if none.
 *
 * @param string $module_folder
 * @return array
 */
function sc_get_module_config_file_contents($module_folder)
{
  global $g_root_dir;

  // Database Integrity compatibility
  $is_compatible = false;

  // if the module is sporting compatibility with the new System Check module, use that file. Otherwise, use
  // the older Database Integrity module file
  if (is_file("$g_root_dir/modules/$module_folder/module_config.php"))
  {
    $is_compatible = true;
    require("$g_root_dir/modules/$module_folder/module_config.php");
  }

  else if (is_file("$g_root_dir/modules/$module_folder/database_integrity.php"))
  {
  	$is_compatible = true;
    require("$g_root_dir/modules/$module_folder/database_integrity.php");
  }

  $return_info = array(
    "is_compatible"       => $is_compatible,
    "includes_table_info" => false,
    "includes_hook_info"  => false,
    "includes_file_info"  => false
  );

  // if data is available for the module, tack it all together and return the result
  if ($is_compatible)
  {
  	$includes_table_info = isset($STRUCTURE) ? true : false;
  	$tables = array();
  	if ($includes_table_info)
  	{
  		$return_info["includes_table_info"] = $includes_table_info;
  		$return_info["tables"]              = $STRUCTURE;
  	}

    $includes_hook_info = isset($HOOKS) ? true : false;
    $hooks = array();
    if ($includes_hook_info)
    {
      $return_info["includes_hook_info"] = $includes_hook_info;
      $return_info["hooks"]              = $HOOKS;
    }

    $includes_file_info = isset($FILES) ? true : false;
    $files = array();
    if ($includes_file_info)
    {
      $return_info["includes_file_info"] = $includes_file_info;
      $return_info["files"]              = $FILES;
    }
  }

  return $return_info;
}


/** -------------- HELPERS: TODO Move these to Core and add wrapper function here.  ------------------ */

/**
 * Returns an array of valid account IDs. Used in the orphan record testing.
 *
 * @return array
 */
function sc_get_account_ids()
{
	global $g_table_prefix;

  $accounts_query = mysql_query("SELECT account_id FROM {$g_table_prefix}accounts");
  $valid_account_ids = array();
  while ($row = mysql_fetch_assoc($accounts_query))
  {
    $valid_account_ids[] = $row["account_id"];
  }

  return $valid_account_ids;
}


/**
 * Returns an array of valid form IDs. Used in the orphan record testing.
 *
 * @return array
 */
function sc_get_form_ids()
{
  global $g_table_prefix;

  $query = mysql_query("SELECT form_id FROM {$g_table_prefix}forms");
  $valid_form_ids = array();
  while ($row = mysql_fetch_assoc($query))
  {
    $valid_form_ids[] = $row["form_id"];
  }

  return $valid_form_ids;
}


/**
 * Returns an array of valid View IDs. Used in the orphan record testing.
 *
 * @return array
 */
function sc_get_view_ids()
{
  global $g_table_prefix;

  $query = mysql_query("SELECT view_id FROM {$g_table_prefix}views");
  $valid_view_ids = array();
  while ($row = mysql_fetch_assoc($query))
  {
    $valid_view_ids[] = $row["view_id"];
  }

  return $valid_view_ids;
}


/**
 * Returns an array of valid View IDs. Used in the orphan record testing.
 *
 * @return array
 */
function sc_get_email_ids()
{
  global $g_table_prefix;

  $query = mysql_query("SELECT email_id FROM {$g_table_prefix}email_templates");
  $valid_email_ids = array();
  while ($row = mysql_fetch_assoc($query))
  {
    $valid_email_ids[] = $row["email_id"];
  }

  return $valid_email_ids;
}


/**
 * Returns an array of valid View IDs. Used in the orphan record testing.
 *
 * @return array
 */
function sc_get_form_email_config_ids()
{
  global $g_table_prefix;

  $query = mysql_query("SELECT form_email_id FROM {$g_table_prefix}form_email_fields");
  $valid_email_ids = array();
  while ($row = mysql_fetch_assoc($query))
  {
    $valid_email_ids[] = $row["form_email_id"];
  }

  return $valid_email_ids;
}


function sc_get_list_group_ids()
{
  global $g_table_prefix;

  $query = mysql_query("SELECT group_id FROM {$g_table_prefix}list_groups");
  $valid_list_group_ids = array();
  while ($row = mysql_fetch_assoc($query))
  {
    $valid_list_group_ids[] = $row["group_id"];
  }

  return $valid_list_group_ids;
}


function sc_get_field_ids()
{
  global $g_table_prefix;

  $query = mysql_query("SELECT field_id FROM {$g_table_prefix}form_fields");
  $valid_field_ids = array();
  while ($row = mysql_fetch_assoc($query))
  {
    $valid_field_ids[] = $row["field_id"];
  }

  return $valid_field_ids;
}


function sc_get_field_type_ids()
{
  global $g_table_prefix;

  $query = mysql_query("SELECT field_type_id FROM {$g_table_prefix}field_types");
  $valid_field_type_ids = array();
  while ($row = mysql_fetch_assoc($query))
  {
    $valid_field_type_ids[] = $row["field_type_id"];
  }

  return $valid_field_type_ids;
}


function sc_get_field_type_setting_ids()
{
  global $g_table_prefix;

  $query = mysql_query("SELECT setting_id FROM {$g_table_prefix}field_type_settings");
  $valid_field_type_setting_ids = array();
  while ($row = mysql_fetch_assoc($query))
  {
    $valid_field_type_setting_ids[] = $row["setting_id"];
  }

  return $valid_field_type_setting_ids;
}


function sc_get_validation_rule_ids()
{
  global $g_table_prefix;

  $query = mysql_query("SELECT rule_id FROM {$g_table_prefix}field_type_validation_rules");
  $valid_validation_rule_ids = array();
  while ($row = mysql_fetch_assoc($query))
  {
    $valid_validation_rule_ids[] = $row["rule_id"];
  }

  return $valid_validation_rule_ids;
}


function sc_get_form_field_ids($form_id)
{
  $form_fields = ft_get_form_fields($form_id);
  $field_ids = array();
  foreach ($form_fields as $field_info)
  {
  	$field_ids[] = $field_info["field_id"];
  }

  return $field_ids;
}


function sc_get_menu_ids()
{
  $menus = ft_get_menu_list();
  $valid_menu_ids = array();
  foreach ($menus as $menu_info)
  {
    $valid_menu_ids[] = $menu_info["menu_id"];
  }

  return $valid_menu_ids;
}
