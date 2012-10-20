<?php

/**
 * This file defines all functions for managing export groups within the Export Manager module.
 *
 * @copyright Encore Web Studios 2011
 * @author Encore Web Studios <formtools@encorewebstudios.com>
 */


// -------------------------------------------------------------------------------------------------


/**
 * Returns all information about an export type group.
 *
 * @param integer $export_group_id
 */
function exp_get_export_group($export_group_id)
{
  global $g_table_prefix;

  $query = mysql_query("
    SELECT *
    FROM   {$g_table_prefix}module_export_groups
    WHERE  export_group_id = $export_group_id
      ");

  $export_group_info = mysql_fetch_assoc($query);

  // get any custom list of clients, if this is a Private export type
  $query = mysql_query("
    SELECT account_id
    FROM   {$g_table_prefix}module_export_group_clients
    WHERE  export_group_id = $export_group_id
      ");

  $account_ids = array();
  while ($row = mysql_fetch_assoc($query))
    $account_ids[] = $row["account_id"];

  $export_group_info["client_ids"] = $account_ids;

  return $export_group_info;
}


/**
 * Returns an array of all export type groups in the database.
 *
 * @return array
 */
function exp_get_export_groups()
{
  global $g_table_prefix;

  $query = mysql_query("
    SELECT   *
    FROM     {$g_table_prefix}module_export_groups
    ORDER BY list_order
      ");

  $infohash = array();
  while ($field = mysql_fetch_assoc($query))
  {
    $export_group_id = $field["export_group_id"];
    $field["num_export_types"] = exp_get_num_export_types($export_group_id);
    $infohash[] = $field;
  }

  return $infohash;
}


/**
 * Adds a new export type group to the database.
 *
 * @param array $info
 */
function exp_add_export_group($info)
{
  global $g_table_prefix, $L;

  $info = ft_sanitize($info);
  $group_name = $info["group_name"];
  $icon       = $info["icon"];
  $visibility = $info["visibility"];

  // get the next highest order count
  $query = mysql_query("SELECT count(*) as c FROM {$g_table_prefix}module_export_groups");
  $result = mysql_fetch_assoc($query);
  $order = $result["c"] + 1;

  // define the default options
  $access_type = "admin";
  $action = "new_window";
  $action_button_text = "{\$LANG.word_display}";

  mysql_query("
    INSERT INTO {$g_table_prefix}module_export_groups (group_name, access_type, visibility,
      icon, action, action_button_text, list_order)
    VALUES ('$group_name', '$access_type', '$visibility', '$icon', '$action', '$action_button_text',
      $order)
      ");

  return array(true, $L["notify_export_group_added"]);
}


/**
 * Updates an export type group.
 *
 * @param array $info
 * @return array
 */
function exp_update_export_group($info)
{
  global $g_table_prefix, $L;

  $info = ft_sanitize($info);
  $export_group_id = $info["export_group_id"];
  $visibility   = $info["visibility"];
  $group_name   = $info["group_name"];
  $icon         = $info["icon"];
  $action       = $info["action"];
  $action_button_text = $info["action_button_text"];
  $popup_height = $info["popup_height"];
  $popup_width  = $info["popup_width"];
  $headers      = isset($info["headers"]) ? $info["headers"] : "";
  $smarty_template = $info["smarty_template"];

  mysql_query("
    UPDATE {$g_table_prefix}module_export_groups
    SET    visibility = '$visibility',
           group_name = '$group_name',
           icon = '$icon',
           action = '$action',
           action_button_text = '$action_button_text',
           popup_height = '$popup_height',
           popup_width = '$popup_width',
           headers = '$headers',
           smarty_template = '$smarty_template'
    WHERE  export_group_id = $export_group_id
      ");

  return array(true, $L["notify_export_group_updated"]);
}


function exp_update_export_group_permissions($info)
{
  global $g_table_prefix, $L;

  $export_group_id     = $info["export_group_id"];
  $access_type         = $info["access_type"];
  $form_view_mapping   = $info["form_view_mapping"];
  $selected_client_ids = (isset($info["selected_client_ids"])) ? $info["selected_client_ids"] : array();

  $forms_and_views = "";
  if ($form_view_mapping != "all") {
  	$form_ids = (isset($info["form_ids"])) ? $info["form_ids"] : array();
  	$view_ids = (isset($info["view_ids"])) ? $info["view_ids"] : array();
  	$forms_and_views = implode(",", $form_ids) . "|" . implode(",", $view_ids);
  }

  mysql_query("
    UPDATE {$g_table_prefix}module_export_groups
    SET    access_type = '$access_type',
           form_view_mapping = '$form_view_mapping',
           forms_and_views = '$forms_and_views'
    WHERE  export_group_id = $export_group_id
      ");

  // now update the list of clients that may have been manually assigned to this (private) export group. If
  // it private, that's cool! Just clear out the old dud data
  mysql_query("DELETE FROM {$g_table_prefix}module_export_group_clients WHERE export_group_id = $export_group_id");

  foreach ($selected_client_ids as $account_id)
  {
    mysql_query("
      INSERT INTO {$g_table_prefix}module_export_group_clients (export_group_id, account_id)
      VALUES ($export_group_id, $account_id)
        ");
  }

  return array(true, $L["notify_export_group_updated"]);
}


/**
 * Deletes an export group and any associated Export types.
 *
 * @param integer $export_group_id
 */
function exp_delete_export_group($export_group_id)
{
  global $g_table_prefix, $L;

  mysql_query("DELETE FROM {$g_table_prefix}module_export_groups WHERE export_group_id = $export_group_id");
  mysql_query("DELETE FROM {$g_table_prefix}module_export_types WHERE export_group_id = $export_group_id");
  mysql_query("DELETE FROM {$g_table_prefix}module_export_group_clients WHERE export_group_id = $export_group_id");

  // now make sure there aren't any gaps in the export group ordering
  exp_check_export_group_order();

  return array(true, $L["notify_export_group_deleted"]);
}


/**
 * This can be called after deleting an export group, or whenever is needed to ensure that the
 * order of the export groups are consistent, accurate & don't have any gaps.
 */
function exp_check_export_group_order()
{
  global $g_table_prefix;

  $query = mysql_query("
    SELECT export_group_id
    FROM   {$g_table_prefix}module_export_groups
    ORDER BY list_order ASC
      ");

  $ordered_groups = array();
  while ($row = mysql_fetch_assoc($query))
    $ordered_groups[] = $row["export_group_id"];

  $order = 1;
  foreach ($ordered_groups as $export_group_id)
  {
    mysql_query("
      UPDATE {$g_table_prefix}module_export_groups
      SET    list_order = $order
      WHERE  export_group_id = $export_group_id
        ");
    $order++;
  }
}


/**
 * Called by the administrator on the Export Type Groups page. It reorders the export groups, which determines
 * the order in which they appear in the client and admin pages.
 *
 * @param array $info
 */
function exp_reorder_export_groups($info)
{
  global $g_table_prefix, $L;

  $sortable_id = $info["sortable_id"];
  $export_group_ids = explode(",", $info["{$sortable_id}_sortable__rows"]);

  $order = 1;
  foreach ($export_group_ids as $export_group_id)
  {
    mysql_query("
      UPDATE {$g_table_prefix}module_export_groups
      SET    list_order = $order
      WHERE  export_group_id = $export_group_id
    ");
    $order++;
  }

  return array(true, $L["notify_export_group_reordered"]);
}


/**
 * This returns the IDs of the previous and next export groups, for the << prev, next >> navigation.
 *
 * @param integer $export_group_id
 * @return hash prev_id => the previous export group ID (or empty string)
 *              next_id => the next export group ID (or empty string)
 */
function ft_get_export_group_prev_next_links($export_group_id)
{
  global $g_table_prefix;

  $query = mysql_query("
    SELECT export_group_id
    FROM   {$g_table_prefix}module_export_groups
    ORDER BY list_order ASC
  ");

  $sorted_ids = array();
  while ($row = mysql_fetch_assoc($query))
  {
    $sorted_ids[] = $row["export_group_id"];
  }
  $current_index = array_search($export_group_id, $sorted_ids);

  $return_info = array("prev_id" => "", "next_id" => "");
  if ($current_index === 0)
  {
    if (count($sorted_ids) > 1)
      $return_info["next_id"] = $sorted_ids[$current_index+1];
  }
  else if ($current_index === count($sorted_ids)-1)
  {
    if (count($sorted_ids) > 1)
      $return_info["prev_id"] = $sorted_ids[$current_index-1];
  }
  else
  {
    $return_info["prev_id"] = $sorted_ids[$current_index-1];
    $return_info["next_id"] = $sorted_ids[$current_index+1];
  }

  return $return_info;
}


function exp_deserialized_export_group_mapping($str)
{
  $form_ids = array();
  $view_ids = array();
  if (!empty($str))
  {
    list($form_ids, $view_ids) = explode("|", $str);
    $form_ids = explode(",", $form_ids);
    $view_ids = explode(",", $view_ids);
  }

  return array(
    "form_ids" => $form_ids,
    "view_ids" => $view_ids
  );
}