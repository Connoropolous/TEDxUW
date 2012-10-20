<?php

/**
 * This file defines all functions relating to the Export Manager module' export types.
 *
 * @copyright Encore Web Studios 2008
 * @author Encore Web Studios <formtools@encorewebstudios.com>
 */


// -------------------------------------------------------------------------------------------------


/**
 * Deletes an export type.
 *
 * @param integer $export_type_id
 */
function exp_delete_export_type($export_type_id)
{
  global $g_table_prefix, $L;

  $export_type_info = exp_get_export_type($export_type_id);

  mysql_query("
    DELETE FROM {$g_table_prefix}module_export_types
    WHERE export_type_id = $export_type_id
      ");

  // now make sure there aren't any gaps in the
  exp_check_export_type_order($export_type_info["export_group_id"]);

  return array(true, $L["notify_export_type_deleted"]);
}


/**
 * Returns all information about a particular Export type.
 *
 * @param integer $export_type_id
 * @return array
 */
function exp_get_export_type($export_type_id)
{
  global $g_table_prefix;

  $query = mysql_query("
    SELECT *, met.smarty_template as export_type_smarty_template
    FROM   {$g_table_prefix}module_export_types met, {$g_table_prefix}module_export_groups metg
    WHERE  met.export_group_id = metg.export_group_id AND
           met.export_type_id = $export_type_id
        ");
  return mysql_fetch_assoc($query);
}


/**
 * Returns all available export types in the database.
 *
 * @param integer $export_group (optional)
 * @param boolean $only_return_visible (optional, defaulted to FALSE)
 * @return array
 */
function exp_get_export_types($export_group = "", $only_return_visible = false)
{
  global $g_table_prefix;

  $group_clause = (!empty($export_group)) ? "AND met.export_group_id = $export_group" : "";
  $visibility_clause = ($only_return_visible) ? "AND met.export_type_visibility = 'show'" : "";

  $query = mysql_query("
    SELECT *, met.list_order as export_type_list_order, met.smarty_template as export_type_smarty_template
    FROM   {$g_table_prefix}module_export_types met, {$g_table_prefix}module_export_groups metg
    WHERE  met.export_group_id = metg.export_group_id
        $group_clause
        $visibility_clause
    ORDER BY met.list_order
      ");

  $infohash = array();
  while ($field = mysql_fetch_assoc($query))
    $infohash[] = $field;

  return $infohash;
}


/**
 * Returns all available export types in the database.
 *
 * @param integer $export_group
 * @return array
 */
function exp_get_num_export_types($export_group_id)
{
  global $g_table_prefix;

  $query = mysql_query("
    SELECT count(*) as c
    FROM   {$g_table_prefix}module_export_types
    WHERE  export_group_id = $export_group_id
      ");

  $result = mysql_fetch_assoc($query);
  $num_export_types = $result["c"];

  return $num_export_types;
}


/**
 * Adds a new export type.
 *
 * @param array $info
 */
function exp_add_export_type($info)
{
  global $g_table_prefix, $L;

  $info = ft_sanitize($info);
  $export_type_name = $info["export_type_name"];
  $visibility = $info["visibility"];
  $filename  = $info["filename"];
  $export_group_id = $info["export_group_id"];
  $smarty_template = $info["smarty_template"];

  // get the next highest order count
  $query = mysql_query("SELECT count(*) as c FROM {$g_table_prefix}module_export_types WHERE export_group_id = $export_group_id");
  $result = mysql_fetch_assoc($query);
  $order = $result["c"] + 1;

  mysql_query("
    INSERT INTO {$g_table_prefix}module_export_types (export_type_name, export_type_visibility, filename,
        export_group_id, smarty_template, list_order)
    VALUES ('$export_type_name', '$visibility', '$filename', $export_group_id, '$smarty_template', $order)
      ");


  return array(true, $L["notify_export_type_added"]);
}


/**
 * Updates an export type.
 *
 * @param integer $export_type_id
 * @param array
 */
function exp_update_export_type($info)
{
  global $g_table_prefix, $L;

  $info = ft_sanitize($info);
  $export_type_id = $info["export_type_id"];
  $export_type_name = $info["export_type_name"];
  $visibility = $info["visibility"];
  $filename  = $info["filename"];
  $export_group_id = $info["export_group_id"];
  $smarty_template = $info["smarty_template"];

  mysql_query("
    UPDATE {$g_table_prefix}module_export_types
    SET    export_type_name = '$export_type_name',
           export_type_visibility = '$visibility',
           filename = '$filename',
           export_group_id = $export_group_id,
           smarty_template = '$smarty_template'
    WHERE  export_type_id = $export_type_id
      ");

  return array(true, $L["notify_export_type_updated"]);
}


/**
 * This can be called after deleting an export type, or whenever is needed to ensure that the
 * order of the export types are consistent, accurate & don't have any gaps.
 */
function exp_check_export_type_order($export_group_id)
{
  global $g_table_prefix;

  if (empty($export_group_id))
    return;

  $query = mysql_query("
    SELECT export_type_id
    FROM   {$g_table_prefix}module_export_types
    WHERE  export_group_id = $export_group_id
    ORDER BY list_order
      ");

  $ordered_types = array();
  while ($row = mysql_fetch_assoc($query))
    $ordered_types[] = $row["export_type_id"];

  $order = 1;
  foreach ($ordered_types as $export_type_id)
  {
    mysql_query("
      UPDATE {$g_table_prefix}module_export_types
      SET    list_order = $order
      WHERE  export_type_id = $export_type_id
        ");
    $order++;
  }
}


/**
 * Called by the administrator on the Export Types tab of the Edit Export Group page. It reorders the export
 * types within a particular export group.
 *
 * @param array $info
 */
function exp_reorder_export_types($info)
{
  global $g_table_prefix, $L;

  $export_group_id = $info["export_group_id"];
  $sortable_id = $info["sortable_id"];
  $export_type_ids = explode(",", $info["{$sortable_id}_sortable__rows"]);

  $order = 1;
  foreach ($export_type_ids as $export_type_id)
  {
    mysql_query("
      UPDATE {$g_table_prefix}module_export_types
      SET    list_order = $order
      WHERE  export_type_id = $export_type_id AND
             export_group_id = $export_group_id
    ");
    $order++;
  }

  return array(true, $L["notify_export_types_reordered"]);
}


/**
 * This function is used when drawing the visible export options to ths page. It determines which export groups &
 * types get displayed for a particular form, View and account.
 *
 * @param mixed $account_id - "admin" or the client ID
 * @param integer $form_id
 * @param integer $view_id
 * @return array an array of hashes
 */
function exp_get_assigned_export_types($account_id, $form_id, $view_id)
{
  global $g_table_prefix;

  $is_client = ($account_id == "admin") ? false : true;

  // Step 1: get all accessible export GROUPS
  $private_client_accessible_export_group_ids = array();
  if ($is_client)
  {
    $query = mysql_query("
      SELECT export_group_id
      FROM   {$g_table_prefix}module_export_group_clients
      WHERE  account_id = $account_id
        ");
    while ($row = mysql_fetch_assoc($query))
      $private_client_accessible_export_group_ids[] = $row["export_group_id"];
  }

  $export_groups = exp_get_export_groups();
  $accessible_export_groups = array();
  foreach ($export_groups as $group)
  {
    if ($group["visibility"] == "hide")
      continue;

    if ($group["access_type"] == "public")
      $accessible_export_groups[] = $group;
    else
    {
      if ($is_client)
      {
      	if ($group["access_type"] != "admin" && in_array($group["export_group_id"], $private_client_accessible_export_group_ids))
          $accessible_export_groups[] = $group;
      }
      else
      {
      	$accessible_export_groups[] = $group;
      }
    }
  }

  // so far so good. We now have a list of export groups that hav been filtered by visibility & whether
  // the client can see them. Next, factor in the current form ID and view ID
  $filtered_export_groups = array();
  foreach ($accessible_export_groups as $export_group)
  {
  	if ($export_group["form_view_mapping"] == "all")
  	  $filtered_export_groups[] = $export_group;
  	else if ($export_group["form_view_mapping"] == "only")
  	{
      $mapping = exp_deserialized_export_group_mapping($export_group["forms_and_views"]);
      if (!in_array($form_id, $mapping["form_ids"]))
        continue;

      if (in_array("form{$form_id}_all_views", $mapping["view_ids"]) || in_array($view_id, $mapping["view_ids"]))
        $filtered_export_groups[] = $export_group;
  	}
  	else if ($export_group["form_view_mapping"] == "except")
  	{
      $mapping = exp_deserialized_export_group_mapping($export_group["forms_and_views"]);
      if (in_array("form{$form_id}_all_views", $mapping["view_ids"]))
        continue;

      if (in_array($view_id, $mapping["view_ids"]))
        continue;

      $filtered_export_groups[] = $export_group;
  	}
  }


  // Step 2: alright! Now we get the list of export types for the accessible Views
  $export_groups_and_types = array();
  foreach ($filtered_export_groups as $export_group)
  {
    $export_types = exp_get_export_types($export_group["export_group_id"], true);
    if (count($export_types) == 0)
      continue;

    $export_group["export_types"] = $export_types;
    $export_groups_and_types[] = $export_group;
  }

  return $export_groups_and_types;
}

