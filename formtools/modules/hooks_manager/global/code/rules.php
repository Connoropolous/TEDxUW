<?php


/**
 * Returns all information about a particular rule.
 *
 * @param integer $page_id
 * @return array
 */
function hm_get_rule($hook_id)
{
  global $g_table_prefix;

  $query = mysql_query("
    SELECT *
    FROM   {$g_table_prefix}module_hooks_manager_rules hmr, {$g_table_prefix}hook_calls hc
    WHERE  hc.hook_id = hmr.hook_id AND
           hc.hook_id = $hook_id
      ");

  return mysql_fetch_assoc($query);
}


/**
 * Returns a page worth of Hooks Manager rules for display purposes.
 *
 * @param mixed $num_per_page a number or "all"
 * @param integer $page_num
 * @return array
 */
function hm_get_rules($num_per_page, $page_num = 1)
{
  global $g_table_prefix;

  if ($num_per_page == "all")
  {
    $query = mysql_query("
      SELECT *
      FROM   {$g_table_prefix}module_hooks_manager_rules hmr, {$g_table_prefix}hook_calls hc
      WHERE  hc.hook_id = hmr.hook_id
      ORDER BY hmr.rule_name
        ");
  }
  else
  {
    // determine the query offset
    if (empty($page_num))
      $page_num = 1;

    $first_item = ($page_num - 1) * $num_per_page;

    $query = mysql_query("
      SELECT *
      FROM   {$g_table_prefix}module_hooks_manager_rules hmr, {$g_table_prefix}hook_calls hc
      WHERE  hc.hook_id = hmr.hook_id
      ORDER BY rule_name
      LIMIT $first_item, $num_per_page
        ") or ft_handle_error(mysql_error());
  }

  $count_query = mysql_query("SELECT count(*) as c FROM {$g_table_prefix}module_hooks_manager_rules");
  $count_hash = mysql_fetch_assoc($count_query);
  $num_results = $count_hash["c"];

  $infohash = array();
  while ($row = mysql_fetch_assoc($query))
    $infohash[] = $row;

  $return_hash = array(
    "results" => $infohash,
    "num_results" => $num_results
      );

  return $return_hash;
}


/**
 * Adds a new rule to the module_hooks_manager_rules table. Each rule is identified by its unique hook ID, from its
 * corresponding hook entry in the hooks table.
 *
 * @param array $info
 * @return array return array
 */
function hm_add_rule($info)
{
  global $g_table_prefix, $L;

  $info = ft_sanitize($info);
  $hook_type = $info["hook_type"];

  if ($hook_type == "code")
    list ($success, $message, $hook_id) = _hm_add_code_rule($info);
  if ($hook_type == "template")
    list ($success, $message, $hook_id) = _hm_add_template_rule($info);
  if ($hook_type == "custom")
    list ($success, $message, $hook_id) = _hm_add_custom_rule($info);

  return array($success, $message, $hook_id);
}


/**
 * This function registered the new rule for a code hook in the hooks table, and stores all custom Hook Manager data in the
 * hooks_manager_rules table.
 *
 * @param array $info
 */
function _hm_add_code_rule($info)
{
  global $g_table_prefix, $L;

  $status    = $info["status"];
  $rule_name = $info["rule_name"];
  $priority  = $info["priority"];
  $code      = $info["code_hook_code"];

  // the code hook dropdown contains the hook name, a comma, then the location where it's call (e.g. "start", "end" etc.)
  list($hook_name, $location) = split(",", $info["code_hook_dropdown"]);

  // register our new rule for this hook
  list($success, $hook_id) = ft_register_hook("code", "hooks_manager", $location, $hook_name, "hm_parse_code_hook", $priority, false);

  if (!$success)
    return array(false, $L["notify_rule_not_added"]);

  // now store the rest of the info in the module rules table
  $result = mysql_query("
    INSERT INTO {$g_table_prefix}module_hooks_manager_rules (hook_id, is_custom_hook, status, rule_name, code)
    VALUES ($hook_id, 'no', '$status', '$rule_name', '$code')
      ");

  if ($result)
    return array(true, $L["notify_rule_added"], $hook_id);
  else
    return array(false, $L["notify_rule_not_added"] . mysql_error(), "");
}


/**
 * This function registered the new rule for a template hook in the hooks table, and stores all custom Hook Manager data in the
 * hooks_manager_rules table.
 *
 * @param array $info
 */
function _hm_add_template_rule($info)
{
  global $g_table_prefix, $L;

  $status    = $info["status"];
  $rule_name = $info["rule_name"];
  $priority  = $info["priority"];
  $hook_name = $info["template_hook_dropdown"];
  $code      = $info["template_hook_code"];
  $hook_code_type = $info["template_hook_code_type"];

  list($success, $hook_id) = ft_register_hook("template", "hooks_manager", $hook_name, "", "hm_parse_template_hook", $priority, false);

  if (!$success)
    return array(false, $L["notify_rule_not_added"]);

  // now store the rest of the info in the module rules table
  $result = mysql_query("
    INSERT INTO {$g_table_prefix}module_hooks_manager_rules (hook_id, is_custom_hook, status, rule_name, code, hook_code_type)
    VALUES ($hook_id, 'no', '$status', '$rule_name', '$code', '$hook_code_type')
      ");

  if ($result)
    return array(true, $L["notify_rule_added"], $hook_id);
  else
    return array(false, $L["notify_rule_not_added"] . mysql_error(), "");
}


/**
 * This function registered the new rule for a custom hook in the hooks table, and stores all
 * custom Hook Manager data in the hooks_manager_rules table. A
 *
 * @param array $info
 */
function _hm_add_custom_rule($info)
{
  global $g_table_prefix, $L;

  $status    = $info["status"];
  $rule_name = $info["rule_name"];
  $priority  = $info["priority"];
  $hook_name = $info["custom_hook"];
  $code      = $info["custom_hook_code"];
  $hook_code_type = $info["custom_hook_code_type"];

  // custom rules are stored as template hooks in the main hooks table. Right now I don't see any point to a "code" custom hook...
  // at this stage, the only real use for custom hooks is in conjunction with the Pages module, which will be template hooks only
  list($success, $hook_id) = ft_register_hook("template", "hooks_manager", $hook_name, "", "hm_parse_template_hook", $priority, false);

  if (!$success)
    return array(false, $L["notify_rule_not_added"]);

  // now store the rest of the info in the module rules table
  $result = mysql_query("
    INSERT INTO {$g_table_prefix}module_hooks_manager_rules (hook_id, is_custom_hook, status, rule_name, code, hook_code_type)
    VALUES ($hook_id, 'yes', '$status', '$rule_name', '$code', '$hook_code_type')
      ");

  if ($result)
    return array(true, $L["notify_rule_added"], $hook_id);
  else
    return array(false, $L["notify_rule_not_added"] . mysql_error(), "");
}


/**
 * Deletes a rule.
 *
 * @param integer $page_id
 */
function hm_delete_rule($hook_id)
{
  global $g_table_prefix, $L;

  // delete the rule in the module and hooks table
  mysql_query("DELETE FROM {$g_table_prefix}hook_calls WHERE hook_id = $hook_id");
  mysql_query("DELETE FROM {$g_table_prefix}module_hooks_manager_rules WHERE hook_id = $hook_id");

  return array(true, $L["notify_rule_deleted"]);
}


/**
 * Updates the (one and only) setting on the Settings page.
 *
 * @param array $info
 * @return array [0] true/false
 *               [1] message
 */
function hm_update_settings($info)
{
  global $L;

  $settings = array("num_rules_per_page" => $info["num_rules_per_page"]);
  ft_set_module_settings($settings);

  return array(true, $L["notify_settings_updated"]);
}


/**
 * Updates a rule. This updates both the core hooks table and the Hooks Manager table. N.B. This
 * function and its template counterpart, works by delete the old hook then recreating a new one
 * in the main hooks table. This is simplest, given the available core functionality. I don't think
 * it's an issue that the hook ID will change when editing a hook; it's not used anywhere within
 * the UI and users won't need to pinpoint a rule by hook ID. We can always change it later, but
 * updating an existing hook in the hooks should really be handled by the core.
 *
 * @param integer $rule_id
 * @param array
 */
function hm_update_rule($hook_id, $info)
{
  global $g_table_prefix, $L;

  $info = ft_sanitize($info);
  $hook_type = $info["hook_type"];

  if ($hook_type == "code")
    list ($success, $message, $new_hook_id) = _hm_update_code_rule($hook_id, $info);
  if ($hook_type == "template")
    list ($success, $message, $new_hook_id) = _hm_update_template_rule($hook_id, $info);
  if ($hook_type == "custom")
    list ($success, $message, $new_hook_id) = _hm_update_custom_rule($hook_id, $info);

  return array($success, $message, $new_hook_id);
}


/**
 * Updates a code rule.
 *
 * @param integer $current_hook_id
 * @param array $info
 */
function _hm_update_code_rule($current_hook_id, $info)
{
  global $g_table_prefix, $L;

  $status      = $info["status"];
  $rule_name   = $info["rule_name"];
  $priority    = $info["priority"];
  $code        = $info["code_hook_code"];

  ft_delete_hook_call($current_hook_id);

  // the code hook dropdown contains the hook name, a comma, then the location where it's call (e.g. "start", "end" etc.)
  list($hook_name, $location) = explode(",", $info["code_hook_dropdown"]);
  list($success, $hook_id) = ft_register_hook("code", "hooks_manager", $location, $hook_name, "hm_parse_code_hook", $priority, false);

  $result = mysql_query("
    UPDATE {$g_table_prefix}module_hooks_manager_rules
    SET    hook_id = $hook_id,
           is_custom_hook = 'no',
           status = '$status',
           rule_name = '$rule_name',
           code = '$code'
    WHERE  hook_id = $current_hook_id
      ");

  if ($result)
    return array(true, $L["notify_rule_updated"], $hook_id);
  else
    return array(false, $L["notify_rule_not_updated"] . mysql_error(), "");
}


function _hm_update_template_rule($current_hook_id, $info)
{
  global $g_table_prefix, $L;

  $status         = $info["status"];
  $rule_name      = $info["rule_name"];
  $priority       = $info["priority"];
  $code           = $info["template_hook_code"];
  $hook_code_type = $info["template_hook_code_type"];

  ft_delete_hook_call($current_hook_id);

  // the code hook dropdown contains the hook name, a comma, then the location where it's call (e.g. "start", "end" etc.)
  $hook_name = $info["template_hook_dropdown"];
  list($success, $hook_id) = ft_register_hook("template", "hooks_manager", $hook_name, "", "hm_parse_template_hook", $priority, false);

  $result = mysql_query("
    UPDATE {$g_table_prefix}module_hooks_manager_rules
    SET    hook_id = $hook_id,
           is_custom_hook = 'no',
           status = '$status',
           rule_name = '$rule_name',
           code = '$code',
           hook_code_type = '$hook_code_type'
    WHERE  hook_id = $current_hook_id
      ");

  if ($result)
    return array(true, $L["notify_rule_updated"], $hook_id);
  else
    return array(false, $L["notify_rule_not_updated"] . mysql_error(), "");
}


function _hm_update_custom_rule($current_hook_id, $info)
{
  global $g_table_prefix, $L;

  $status      = $info["status"];
  $rule_name   = $info["rule_name"];
  $priority    = $info["priority"];
  $code        = $info["custom_hook_code"];
  $hook_name   = $info["custom_hook"];
  $hook_code_type = $info["custom_hook_code_type"];

  ft_delete_hook_call($current_hook_id);

  // the code hook dropdown contains the hook name, a comma, then the location where it's call (e.g. "start", "end" etc.)
  list($success, $hook_id) = ft_register_hook("template", "hooks_manager", $hook_name, "", "hm_parse_template_hook", $priority, false);

  $result = mysql_query("
    UPDATE {$g_table_prefix}module_hooks_manager_rules
    SET    hook_id = $hook_id,
           is_custom_hook = 'yes',
           status = '$status',
           rule_name = '$rule_name',
           code = '$code',
           hook_code_type = '$hook_code_type'
    WHERE  hook_id = $current_hook_id
      ");

  if ($result)
    return array(true, $L["notify_rule_updated"], $hook_id);
  else
    return array(false, $L["notify_rule_not_updated"] . mysql_error(), "");
}


/**
 * Returns all those rules that are applicable to a particular form.
 *
 * @param integer $form_id
 */
function hm_get_form_rules($rule_id)
{
  global $g_table_prefix;

  $query = mysql_query("
    SELECT *
    FROM   {$g_table_prefix}module_hooks_manager_rules
    WHERE  rule_id = $rule_id
      ");

  $info = array();
  while ($row = mysql_fetch_assoc($query))
    $info[] = $row;

  return $info;
}


/**
 * The parser function for template hooks. This is called whenever a page contains a hook
 * that has a rule (or rules) defined for it within the Hooks Manager.
 */
function hm_parse_template_hook($location, $template_vars)
{
  $hook_info = $template_vars["form_tools_hook_info"];
  $hook_id   = $hook_info["hook_id"];

  // now get the FULL hook info (i.e. with the Hook Manager info)
  $hook_info = hm_get_rule($hook_id);

  // if this hook is disabled, do nothing
  if ($hook_info["status"] != "enabled")
    return;

  switch ($hook_info["hook_code_type"])
  {
    case "html":
      echo $hook_info["code"];
      break;

    case "php":
      eval($hook_info["code"]);
      break;

    case "smarty":
      echo ft_eval_smarty_string($hook_info["code"]);
      break;
  }
}


/**
 * The parser function for code hooks. This is called whenever a page contains a hook
 * that has a rule (or rules) defined for it within the Hooks Manager.
 */
function hm_parse_code_hook($vars)
{
  // place all variables that have been explicitly passed to this hook as defined in this
  // scope (e.g. $vars["account_id"] becomes $account_id). This is for the sake of the
  // developer using the Hooks Manager UI
  $passed_vars = $vars;
  unset($passed_vars["form_tools_hook_info"]);
  unset($passed_vars["form_tools_overridable_vars"]);
  unset($passed_vars["form_tools_calling_function"]);

  // this stores the overridable variable names in a constant
  define("FORM_TOOLS_OVERRIDABLE_VARS", join(",", $vars["form_tools_overridable_vars"]));

  extract($passed_vars);
  $hook_info = hm_get_rule($vars["form_tools_hook_info"]["hook_id"]);

  eval($hook_info["code"]);

  // return the overridable values
  $form_tools_overridable_vars = explode(",", FORM_TOOLS_OVERRIDABLE_VARS);
  $return_hash = array();
  foreach ($form_tools_overridable_vars as $var)
  {
    $return_hash[$var] = $$var;
  }

  return $return_hash;
}


/**
 * This function retrieves and parses out all hook data from the hooks table.
 *
 * @return array a hash with keys "code_hooks" and "template_hooks"
 */
function hm_get_hooks()
{
  global $g_root_dir, $g_table_prefix;

  $query = mysql_query("SELECT * FROM {$g_table_prefix}hooks ORDER BY id");

  $code_hooks     = array();
  $template_hooks = array();
  while ($row = mysql_fetch_assoc($query))
  {
    if ($row["hook_type"] == "code")
      $code_hooks[$row["function_name"] . ", " . $row["action_location"]] = $row;
    else
      $template_hooks[$row["function_name"] . ", " . $row["action_location"]] = $row;
  }

  ksort($code_hooks);
  ksort($template_hooks);

  return array(
    "code_hooks"     => $code_hooks,
    "template_hooks" => $template_hooks
  );
}


function hm_convert_hook_info_to_json($js_var_name, $hook_info)
{
  $js_rows = array();
  $rows = array();

  // convert ALL form and View info into Javascript, for use in the page
  foreach ($hook_info as $hook_data)
  {
    $file = $hook_data["filepath"];
    $action_location = isset($hook_data["action_location"]) ? $hook_data["action_location"] : "";
    $name = $hook_data["function_name"] . "," . $action_location;

    $params = isset($hook_data["params"]) ? $hook_data["params"] : array();
    $params = explode(",", $params);

    $escaped_params = array();
    foreach ($params as $param)
      $escaped_params[] = "\"$param\"";
    $escaped_params_str = implode(", ", $escaped_params);

    $overridable = isset($hook_data["overridable"]) ? $hook_data["overridable"] : array();
    $overridable = explode(",", $overridable);

    $escaped_overridable = array();
    foreach ($overridable as $row)
      $escaped_overridable[] = "\"$row\"";
    $escaped_overridable_str = implode(", ", $escaped_overridable);

    $hook_js =<<< EOF
  "$name": {
    function_name: "$file",
    action_location: "$action_location",
    params: [ $escaped_params_str ],
    overridable: [ $escaped_overridable_str ]
  }
EOF;

    $rows[] = $hook_js;
  }

  $js_rows[] = "var $js_var_name = {" . join(",\n", $rows) . "}";
  $js = join(";\n", $js_rows);

  return $js;
}


