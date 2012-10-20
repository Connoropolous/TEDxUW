<?php

/*
 * Smarty plugin
 * -------------------------------------------------------------
 * File:     function.export_groups_dropdown
 * Type:     function
 * Name:     form_dropdown
 * Purpose:  generates a dropdown of all export types
 * -------------------------------------------------------------
 */
function smarty_function_export_groups_dropdown($params, &$smarty)
{
  global $LANG;

  if (empty($params["name_id"]))
  {
    $smarty->trigger_error("assign: missing 'name_id' parameter. This is used to give the select field a name and id value.");
    return;
  }
  $default_value = (isset($params["default"])) ? $params["default"] : "";

  $attributes = array(
    "id"   => $params["name_id"],
    "name" => $params["name_id"]
      );

  $attribute_str = "";
  while (list($key, $value) = each($attributes))
  {
    if (!empty($value))
      $attribute_str .= " $key=\"$value\"";
  }

  $export_groups = exp_get_export_groups();
  $rows = array();

  foreach ($export_groups as $group_info)
  {
    $export_group_id = $group_info["export_group_id"];
    $group_name      = $group_info["group_name"];
    $rows[] = "<option value=\"$export_group_id\" " . (($default_value == $export_group_id) ? "selected" : "") . ">$group_name</option>";
  }

  $dd = "<select $attribute_str>" . join("\n", $rows) . "</select>";

  return $dd;
}

