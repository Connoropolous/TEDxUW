<?php


/**
 * The installation script for the module.
 */
function client_audit__install($module_id)
{
  global $g_table_prefix, $L, $g_root_dir, $g_root_url;

  $queries = array();
  $queries[] = "
    CREATE TABLE {$g_table_prefix}module_client_audit_accounts (
      change_id mediumint(8) unsigned NOT NULL,
      changed_fields mediumtext,
      account_status enum('active','disabled','pending') NOT NULL default 'disabled',
      ui_language varchar(50) NOT NULL default 'en_us',
      timezone_offset varchar(4) default NULL,
      sessions_timeout varchar(10) NOT NULL default '30',
      date_format varchar(50) NOT NULL default 'M jS, g:i A',
      login_page varchar(50) NOT NULL default 'client_forms',
      logout_url varchar(255) default NULL,
      theme varchar(50) NOT NULL default 'default',
      menu_id mediumint(8) unsigned NOT NULL,
      first_name varchar(100) default NULL,
      last_name varchar(100) default NULL,
      email varchar(200) default NULL,
      username varchar(50) default NULL,
      `password` varchar(50) default NULL,
      PRIMARY KEY  (change_id)
    ) DEFAULT CHARSET=utf8
      ";

  $queries[] = "
    CREATE TABLE {$g_table_prefix}module_client_audit_account_settings (
      change_id mediumint(9) NOT NULL,
      setting_name varchar(255) NOT NULL,
      setting_value mediumtext NOT NULL,
      PRIMARY KEY  (change_id,setting_name)
    ) DEFAULT CHARSET=utf8
      ";

  $queries[] = "
    CREATE TABLE {$g_table_prefix}module_client_audit_changes (
      change_id mediumint(8) unsigned NOT NULL auto_increment,
      change_date datetime NOT NULL,
      change_type enum('account_created','account_deleted','admin_update','client_update','account_disabled_from_failed_logins','permissions','login','logout') character set latin1 NOT NULL,
      `status` enum('hidden','visible') NOT NULL default 'visible',
      account_id mediumint(9) NOT NULL,
      PRIMARY KEY (change_id)
    ) DEFAULT CHARSET=utf8
      ";

  $queries[] = "
  CREATE TABLE {$g_table_prefix}module_client_audit_client_permissions (
    change_id mediumint(8) unsigned NOT NULL,
    added_views mediumtext,
    removed_views mediumtext,
    added_forms mediumtext,
    removed_forms mediumtext,
    permissions mediumtext NOT NULL,
    PRIMARY KEY (change_id)
  ) DEFAULT CHARSET=utf8
      ";

  $has_problem = false;
  foreach ($queries as $query)
  {
    $result = @mysql_query($query);
    if (!$result)
    {
      $has_problem = true;
      break;
    }
  }

  // if there was a problem, remove all the table and return an error
  $success = true;
  $message = "";
  if ($has_problem)
  {
    $success = false;
    @mysql_query("DROP TABLE {$g_table_prefix}module_client_audit_accounts");
    @mysql_query("DROP TABLE {$g_table_prefix}module_client_audit_account_settings");
    @mysql_query("DROP TABLE {$g_table_prefix}module_client_audit_changes");
    @mysql_query("DROP TABLE {$g_table_prefix}module_client_audit_client_permissions");

    $mysql_error = mysql_error();
    $message     = ft_eval_smarty_string($LANG["client_audit"]["notify_problem_installing"], array("error" => $mysql_error));
  }

  ft_register_hook("code", "client_audit", "main", "ft_login", "ca_log_change");
  ft_register_hook("code", "client_audit", "main", "ft_logout_user", "ca_log_change");
  ft_register_hook("code", "client_audit", "end", "ft_add_client", "ca_log_change");
  ft_register_hook("code", "client_audit", "end", "ft_admin_update_client", "ca_log_change");
  ft_register_hook("code", "client_audit", "end", "ft_update_client", "ca_log_change");
  ft_register_hook("code", "client_audit", "end", "ft_disable_client", "ca_log_change");
  ft_register_hook("code", "client_audit", "end", "ft_delete_client", "ca_log_change");

  // called when a form (main tab) or the View is updated
  ft_register_hook("code", "client_audit", "end", "ft_update_view", "ca_log_change");
  ft_register_hook("code", "client_audit", "end", "ft_update_form_main_tab", "ca_log_change");
  ft_register_hook("code", "client_audit", "start", "ft_delete_form", "ca_log_change");

  // lastly, create a default, hidden entry of all data - account contents, settings and permissions
  // for each client. This is used as a comparison for the NEXT time something changed
  $clients = ft_get_client_list();

  foreach ($clients as $client_info)
  {
    $account_id = $client_info["account_id"];

    $change_id = ca_insert_change_row("account_created", $account_id, true);
    ca_update_account_changelog($account_id, $change_id);

    $change_id = ca_insert_change_row("permissions", $account_id, true);
    ca_update_account_permissions($account_id, $change_id);
  }

  return array(true, "");
}


function client_audit__uninstall($module_id)
{
  global $g_table_prefix;

  @mysql_query("DROP TABLE {$g_table_prefix}module_client_audit_accounts");
  @mysql_query("DROP TABLE {$g_table_prefix}module_client_audit_account_settings");
  @mysql_query("DROP TABLE {$g_table_prefix}module_client_audit_changes");
  @mysql_query("DROP TABLE {$g_table_prefix}module_client_audit_client_permissions");

  return array(true, "");
}


function client_audit__upgrade($old_version, $new_version)
{
  global $g_table_prefix;

  $old_version_info = ft_get_version_info($old_version);
  $new_version_info = ft_get_version_info($new_version);

  if ($old_version_info["release_date"] < 20090908)
  {
    @mysql_query("ALTER TABLE {$g_table_prefix}module_client_audit_accounts TYPE=MyISAM");
    @mysql_query("ALTER TABLE {$g_table_prefix}module_client_audit_account_settings TYPE=MyISAM");
    @mysql_query("ALTER TABLE {$g_table_prefix}module_client_audit_changes TYPE=MyISAM");
    @mysql_query("ALTER TABLE {$g_table_prefix}module_client_audit_client_permissions TYPE=MyISAM");
  }
}


/**
 * Our one hook function to rule them all. This is executed for all registered code hooks for the
 * module: it
 *
 * @param $info
 */
function ca_log_change($info)
{
  $calling_function = $info["form_tools_calling_function"];

  switch ($calling_function)
  {
    case "ft_login":
      if ($info["account_info"]["account_type"] == "admin")
        return;
      ca_insert_change_row("login", $info["account_info"]["account_id"]);
      break;

    // bit hacky. The ft_logout_user hook doesn't pass the account ID, so we pull it from sessions
    case "ft_logout_user":
      if (!isset($_SESSION["ft"]["account"]))
        return;
      $account_id   = $_SESSION["ft"]["account"]["account_id"];
      $account_type = $_SESSION["ft"]["account"]["account_type"];
      if ($account_type == "admin")
        return;
      ca_insert_change_row("logout", $account_id);
      break;

    case "ft_add_client":
      $change_id = ca_insert_change_row("account_created", $info["new_user_id"]);
      ca_update_account_changelog($info["new_user_id"], $change_id);
      $change_id = ca_insert_change_row("permissions", $info["new_user_id"], true);
      ca_update_account_permissions($info["new_user_id"], $change_id);
      break;

    case "ft_admin_update_client":
      $client_id = $info["infohash"]["client_id"];
      if ($info["tab_num"] == 1 || $info["tab_num"] == 2)
      {
        $old_account_info = ca_get_last_account_state($client_id);
        if (ca_account_has_changed($client_id, $old_account_info))
        {
          $change_id = ca_insert_change_row("admin_update", $client_id);
          ca_update_account_changelog($client_id, $change_id, $old_account_info);
        }
      }
      if ($info["tab_num"] == 3)
      {
        // log the permissions change iff the content changed
        $new_permissions = ca_get_serialized_permission_string($client_id);
        $old_permissions = ca_get_last_account_permissions($client_id);

        if ($new_permissions != $old_permissions)
        {
          $change_id = ca_insert_change_row("permissions", $client_id);
          ca_update_account_permissions($client_id, $change_id);
        }
      }
      break;

    case "ft_update_client":
      $old_account_info = ca_get_last_account_state($info["account_id"]);
      $client_id = $info["account_id"];
      if (ca_account_has_changed($client_id, $old_account_info))
      {
        $change_id = ca_insert_change_row("client_update", $client_id);
        ca_update_account_changelog($client_id, $change_id, $old_account_info);
      }
      break;

    case "ft_disable_client":
      $old_account_info = ca_get_last_account_state($info["account_id"]);
      $change_id = ca_insert_change_row("account_disabled_from_failed_logins", $info["account_id"]);
      ca_update_account_changelog($info["account_id"], $change_id, $old_account_info);
      break;

    case "ft_delete_client":
      ca_insert_change_row("account_deleted", $info["account_id"]);
      break;

    // these are assorted events within FT that could change the permissions on any of the client accounts
    case "ft_delete_form":
    case "ft_update_view":
    case "ft_update_form_main_tab":
      $client_ids = ca_get_logged_client_accounts_with_permissions();
      foreach ($client_ids as $client_info)
      {
        $client_id = $client_info["account_id"];
        $old_permissions = ca_get_last_account_permissions($client_id);
        $new_permissions = ca_get_serialized_permission_string($client_id);
        if ($old_permissions != $new_permissions)
        {
          $change_id = ca_insert_change_row("permissions", $client_id);
          ca_update_account_permissions($client_id, $change_id);
        }
      }
      break;
  }
}


/**
 * This logs the change in the ft_module_client_audit_changes table and returns the change_id. Depending on
 * the change type, that value can then be used to populate the account change tables.
 *
 * @param string $change_type "account_created, "admin_update", "client_update", "account_disabled_from_failed_logins",
 *                            "account_deleted", "login", "logout"
 * @param unknown_type $account_id
 */
function ca_insert_change_row($change_type, $account_id, $hidden = false)
{
  global $g_table_prefix;

  $status = ($hidden) ? "hidden" : "visible";
  $now = ft_get_current_datetime();
  $query = mysql_query("
    INSERT INTO {$g_table_prefix}module_client_audit_changes (change_date, change_type, status, account_id)
    VALUES ('$now', '$change_type', '$status', $account_id)
      ");

  if ($query)
    return mysql_insert_id();

  return false;
}


/**
 * Called after an account is updated. Technically there could be some timing issues where this
 * function reads the DB values after they've already been re-written, but it's extremely unlikely
 * due to the low load on client account changes. So for this initial version, I'm going to regard
 * that as acceptable.
 *
 * @param integer $account_id
 * @param integer $change_id
 */
function ca_update_account_changelog($account_id, $change_id, $last_account_info = false)
{
  global $g_table_prefix;

  // get the client account
  $account_info = ft_get_account_info($account_id);

  // figure out which fields have changed. Note: this checks both the contents of the accounts table AND
  // the account_settings table
  $changed_fields = array();
  if ($last_account_info !== false)
  {
    // compare the current content of the user's account with the last state change and log the results
    $fields = array("account_status", "ui_language", "timezone_offset", "sessions_timeout", "date_format",
      "login_page", "logout_url", "theme", "menu_id", "first_name", "last_name", "email", "username",
      "password");

    foreach ($fields as $field)
    {
      if ($last_account_info[$field] != $account_info[$field])
        $changed_fields[] = $field;
    }

    // now compare the settings
    $diff1 = array_diff($account_info["settings"], $last_account_info["account_settings"]);
    $diff2 = array_diff($last_account_info["account_settings"], $account_info["settings"]);
    $diff = array_merge($diff1, $diff2);
    $changed_settings = array_keys($diff);
    $changed_fields = array_merge($changed_fields, $changed_settings);
  }

  $changed_fields_str = implode(",", $changed_fields);
  $account_info = ft_sanitize($account_info);


  // insert the new row, including the all-important changed_fields_str which logs what changed since
  // the last update
  $query = mysql_query("
    INSERT INTO {$g_table_prefix}module_client_audit_accounts (change_id, changed_fields,
      account_status, ui_language, timezone_offset, sessions_timeout, date_format, login_page,
      logout_url, theme, menu_id, first_name, last_name, email, username, password)
    VALUES ($change_id, '$changed_fields_str', '{$account_info["account_status"]}',
      '{$account_info["ui_language"]}', '{$account_info["timezone_offset"]}',
      '{$account_info["sessions_timeout"]}', '{$account_info["date_format"]}',
      '{$account_info["login_page"]}', '{$account_info["logout_url"]}',
      '{$account_info["theme"]}', '{$account_info["menu_id"]}', '{$account_info["first_name"]}',
      '{$account_info["last_name"]}', '{$account_info["email"]}', '{$account_info["username"]}',
      '{$account_info["password"]}')
      ");

  // if the main query was successful (it always SHOULD be) log the account settings. Note that we log ALL of them:
  // this is bad for space, but convenient. It lets us always be able to compare the last contents of the
  // settings table to figure out what's changed. Otherwise it would need to parse the entire history to determine
  // if and when a change has been made
  if ($query)
  {
    while (list($setting_name, $setting_value) = each($account_info["settings"]))
    {
      mysql_query("
        INSERT INTO {$g_table_prefix}module_client_audit_account_settings (change_id, setting_name, setting_value)
        VALUES ($change_id, '$setting_name', '$setting_value')
      ");
    }
  }
}


/**
 * Returns the last contents of the accounts and account_settings tables for a particular account. The
 * account_settings values are stored as a hash in the account_settings key.
 *
 * If there is no record, it just returns false.
 *
 * @param integer $account_id
 * @returm mixed false or a hash
 */
function ca_get_last_account_state($account_id)
{
  global $g_table_prefix;

  $query = mysql_query("
    SELECT *
    FROM   {$g_table_prefix}module_client_audit_accounts a, {$g_table_prefix}module_client_audit_changes c
    WHERE  a.change_id = c.change_id AND
           c.account_id = $account_id
    ORDER BY c.change_id DESC
    LIMIT 1
      ");
  $account_info = mysql_fetch_assoc($query);

  // if there's no account info, that's fine too. The client simply hasn't done anything that would cause their
  // account info changes to get logged (i.e. they've only logged in, for instance)
  if (empty($account_info))
    return false;

  $change_id = $account_info["change_id"];

  // now add the account settings
  $settings_query = mysql_query("
    SELECT *
    FROM   {$g_table_prefix}module_client_audit_account_settings
    WHERE  change_id = $change_id
      ");

  $account_settings = array();
  while ($row = mysql_fetch_assoc($settings_query))
    $account_settings[$row["setting_name"]] = $row["setting_value"];

  $account_info["account_settings"] = $account_settings;

  return $account_info;
}


/**
 * Returns a list of all client accounts for which we have logs. Note: this doesn't return
 * any accounts that have been deleted.
 */
function ca_get_logged_client_accounts()
{
  global $g_table_prefix;

  $query = mysql_query("
    SELECT account_id, a.first_name, a.last_name
    FROM   {$g_table_prefix}accounts a
    WHERE  account_id IN (
      SELECT account_id
      FROM   {$g_table_prefix}module_client_audit_changes mcac
      GROUP BY account_id
    )
    ORDER BY a.last_name
  ");

  $accounts = array();
  while ($row = mysql_fetch_assoc($query))
    $accounts[] = $row;

  return $accounts;
}


function ca_get_logged_client_accounts_with_permissions()
{
  global $g_table_prefix;

  $query = mysql_query("
    SELECT account_id, a.first_name, a.last_name
    FROM   {$g_table_prefix}accounts a
    WHERE  account_id IN (
      SELECT account_id
      FROM   {$g_table_prefix}module_client_audit_changes mcac
      WHERE  change_type = 'permissions'
      GROUP BY account_id
    )
    ORDER BY a.last_name
  ");

  $accounts = array();
  while ($row = mysql_fetch_assoc($query))
    $accounts[] = $row;

  return $accounts;
}


/**
 * Returns all deleted client accounts that have been logged in the system.
 */
function ca_get_deleted_logged_client_accounts()
{
  global $g_table_prefix;

  $deleted_accounts_query = mysql_query("
    SELECT account_id
    FROM   {$g_table_prefix}module_client_audit_changes
    WHERE  change_type = 'account_deleted'
  ");

  $accounts = array();
  while ($row = mysql_fetch_assoc($deleted_accounts_query))
  {
    $account_id = $row["account_id"];

    // now grab the LAST logged record for this deleted account
    $query = mysql_query("
      SELECT *
      FROM   {$g_table_prefix}module_client_audit_changes mcac, {$g_table_prefix}module_client_audit_accounts mcaa
      WHERE  mcac.change_id = mcaa.change_id AND
             mcac.account_id = $account_id
      ORDER BY mcac.change_id DESC
    ");

    $result = mysql_fetch_assoc($query);

    $accounts[] = $result;
  }

  return $accounts;
}


function ca_search_history($search_criteria)
{
  global $g_table_prefix;

  $search_criteria = ft_sanitize($search_criteria);

  $where_clauses = array("status = 'visible'");
  if (!empty($search_criteria["client_id"]))
    $where_clauses[] = "account_id = {$search_criteria["client_id"]}";

  // if the user didn't select any change types, they won't get any results
  $change_types_clause = "change_type = ''";
  if (isset($search_criteria["change_types"]) && !empty($search_criteria["change_types"]))
  {
    $change_types_clauses = array();
    foreach ($search_criteria["change_types"] as $change_type)
      $change_types_clauses[] = "change_type = '$change_type'";

    $change_types_clause = "(" . implode(" OR ", $change_types_clauses) . ")";
  }
  $where_clauses[] = $change_types_clause;

  if (!empty($search_criteria["date_from"]) && !empty($search_criteria["date_to"]))
    $where_clauses[] = "change_date >= '{$search_criteria["date_from"]} 00:00:00' AND change_date <= '{$search_criteria["date_to"]} 23:59:59'";

  if (empty($search_criteria["page_num"]))
    $page_num = 1;
  $first_item = ($page_num - 1) * $search_criteria["per_page"];
  $limit_clause = "LIMIT $first_item, {$search_criteria["per_page"]}";

  $where_clause_str = (!empty($where_clauses)) ? "WHERE " . join(" AND ", $where_clauses) : "";

  $query = mysql_query("
    SELECT *
    FROM   {$g_table_prefix}module_client_audit_changes
    $where_clause_str
    ORDER BY change_date DESC
    $limit_clause
  ");

  $results = array();
  while ($row = mysql_fetch_assoc($query))
    $results[] = $row;

  $search_results_query = mysql_query("
    SELECT count(*) as c
    FROM   {$g_table_prefix}module_client_audit_changes
    $where_clause_str
  ") or die(mysql_error());
  $search_results_result = mysql_fetch_assoc($search_results_query);

  $total_count_query = mysql_query("
    SELECT count(*) as c
    FROM   {$g_table_prefix}module_client_audit_changes
    WHERE  status = 'visible'
  ");
  $total_count_result = mysql_fetch_assoc($total_count_query);

  return array(
    "results"            => $results,
    "num_search_results" => $search_results_result["c"],
    "total_count"        => $total_count_result["c"]
  );
}


/**
 * This examines the current search and figures out what are the change IDs for the previous and
 * next links. This function is very similar to the ca_search_history function, except it only
 * looks at change types that have details - i.e. NOT logout or logins.
 *
 * @param integer $change_id
 * @param array $search_criteria
 * @return array
 */
function ca_get_details_page_nav_links($change_id, $search_criteria)
{
  global $g_table_prefix;

  $search_criteria = ft_sanitize($search_criteria);

  $where_clauses = array("status = 'visible'", "(change_type != 'login' AND change_type != 'logout')");

  if (!empty($search_criteria["client_id"]))
    $where_clauses[] = "account_id = {$search_criteria["client_id"]}";

  // this is a bit weird, but the original search query COULD have included login's and logouts. But the
  // former $where_clause states NOT to return those values. This is correct, albeit a bit weird if you
  // happen to be looking at the actual query being used
  $change_types_clause = "change_type = ''";
  if (isset($search_criteria["change_types"]) && !empty($search_criteria["change_types"]))
  {
    $change_types_clauses = array();
    foreach ($search_criteria["change_types"] as $change_type)
      $change_types_clauses[] = "change_type = '$change_type'";

    $change_types_clause = "(" . implode(" OR ", $change_types_clauses) . ")";
  }
  $where_clauses[] = $change_types_clause;

  if (!empty($search_criteria["date_from"]) && !empty($search_criteria["date_to"]))
    $where_clauses[] = "change_date >= '{$search_criteria["date_from"]} 00:00:00' AND change_date <= '{$search_criteria["date_to"]} 23:59:59'";

  $where_clause_str = (!empty($where_clauses)) ? "WHERE " . join(" AND ", $where_clauses) : "";

  $query = mysql_query("
    SELECT change_id
    FROM   {$g_table_prefix}module_client_audit_changes
    $where_clause_str
    ORDER BY change_date DESC
  ");

  $previous_change_id = "";
  $next_change_id     = "";

  $change_ids = array();
  while ($row = mysql_fetch_assoc($query))
    $change_ids[] = $row["change_id"];

  $index = array_search($change_id, $change_ids);

  if ($index > 0)
    $previous_change_id = $change_ids[$index-1];
  if ($index < count($change_ids)-1)
    $next_change_id = $change_ids[$index+1];

  return array(
    "previous_change_id" => $previous_change_id,
    "next_change_id"     => $next_change_id
  );
}


function ca_get_last_account_permissions($account_id)
{
  global $g_table_prefix;

  // get the latest permissions for this account
  $query = mysql_query("
    SELECT *
    FROM   {$g_table_prefix}module_client_audit_client_permissions p, {$g_table_prefix}module_client_audit_changes ch
    WHERE  p.change_id = ch.change_id AND
           ch.change_type = 'permissions'
    ORDER BY ch.change_id DESC
  ");

  $permissions_info = mysql_fetch_assoc($query);

  return isset($permissions_info["permissions"]) ? $permissions_info["permissions"] : "";
}


function ca_update_account_permissions($account_id, $change_id)
{
  global $g_table_prefix;

  $old_permissions_serialized = ca_get_last_account_permissions($account_id);
  $old_permissions            = ca_deserialize_permission_string($old_permissions_serialized);
  $new_permissions_serialized = ca_get_serialized_permission_string($account_id);
  $new_permissions            = ca_deserialize_permission_string($new_permissions_serialized);

  $new_forms = array_keys($new_permissions);
  $old_forms = array_keys($old_permissions);

  $added_forms   = array_diff($new_forms, $old_forms);
  $removed_forms = array_diff($old_forms, $new_forms);

  $same_forms    = array_intersect($new_forms, $old_forms);

  // loop through the
  $added_views   = array();
  $removed_views = array();
  while (list($form_id, $old_view_ids) = each($old_permissions))
  {
    if (!in_array($form_id, $same_forms))
      continue;

    $new_view_ids = $new_permissions[$form_id];
//    echo "(form $form_id) old view IDs: " . implode(",", $old_view_ids) . "\n";
//    echo "(form $form_id) new view IDs: " . implode(",", $new_view_ids) . "\n";

    $added_views   = array_merge($added_views, array_diff($new_view_ids, $old_view_ids));
    $removed_views = array_merge($removed_views, array_diff($old_view_ids, $new_view_ids));
  }

  $added_forms_str = implode(",", $added_forms);
  $removed_forms_str = implode(",", $removed_forms);
  $added_views_str = implode(",", $added_views);
  $removed_views_str = implode(",", $removed_views);

/*
  echo "added forms: $added_forms_str<Br />";
  echo "removed forms: $removed_forms_str<Br />";
  echo "added views: $added_views_str<Br />";
  echo "removed views: $removed_views_str<Br />";
*/

  mysql_query("
    INSERT INTO {$g_table_prefix}module_client_audit_client_permissions (change_id, added_views,
      removed_views, added_forms, removed_forms, permissions)
    VALUES ($change_id, '$added_views_str', '$removed_views_str', '$added_forms_str', '$removed_forms_str', '$new_permissions_serialized')
  ");
}


/**
 * This parses an account ID and serializes their permissions - form IDs and view IDs
 *
 * @param integer $account_id
 * @return string
 */
function ca_get_serialized_permission_string($account_id)
{
  $permissions = ft_get_client_form_views($account_id);
  asort($permissions, SORT_NUMERIC);

  $str = "";
  while (list($form_id, $view_ids) = each($permissions))
  {
    $str .= "$form_id:";
    sort($view_ids, SORT_NUMERIC);
    $str .= implode(",", $view_ids) . "|";
  }

  return $str;
}

/**
 * This examines a permission string and returns a hash of form IDs => (array) view IDs.
 *
 * @param string $permission_str
 */
function ca_deserialize_permission_string($permission_str)
{
  $forms_and_views = explode("|", $permission_str);

  $data = array();
  foreach ($forms_and_views as $form_info)
  {
    if (empty($form_info))
      continue;

    list($form_id, $view_str) = explode(":", $form_info);
    $view_ids = explode(",", $view_str);
    $data[$form_id] = $view_ids;
  }

  return $data;
}


function ca_delete_changes($change_ids = array())
{
  global $g_table_prefix, $L;

  $change_ids = ft_sanitize($change_ids);

  foreach ($change_ids as $change_id)
  {
    mysql_query("DELETE FROM {$g_table_prefix}module_client_audit_accounts WHERE change_id = $change_id");
    mysql_query("DELETE FROM {$g_table_prefix}module_client_audit_account_settings WHERE change_id = $change_id");
    mysql_query("DELETE FROM {$g_table_prefix}module_client_audit_changes WHERE change_id = $change_id");
    mysql_query("DELETE FROM {$g_table_prefix}module_client_audit_client_permissions WHERE change_id = $change_id");
  }

  return array(true, $L["notify_changes_deleted"]);
}


/**
 * Deletes everything in the current search.
 *
 * @param array $search_criteria
 */
function ca_delete_all_in_current_search($search_criteria)
{
  global $g_table_prefix;

  $search_criteria = ft_sanitize($search_criteria);

  $where_clauses = array("status = 'visible'");

  if (!empty($search_criteria["client_id"]))
    $where_clauses[] = "account_id = {$search_criteria["client_id"]}";

  // this is a bit weird, but the original search query COULD have included login's and logouts. But the
  // former $where_clause states NOT to return those values. This is correct, albeit a bit weird if you
  // happen to be looking at the actual query being used
  $change_types_clause = "change_type = ''";
  if (isset($search_criteria["change_types"]) && !empty($search_criteria["change_types"]))
  {
    $change_types_clauses = array();
    foreach ($search_criteria["change_types"] as $change_type)
      $change_types_clauses[] = "change_type = '$change_type'";

    $change_types_clause = "(" . implode(" OR ", $change_types_clauses) . ")";
  }
  $where_clauses[] = $change_types_clause;

  if (!empty($search_criteria["date_from"]) && !empty($search_criteria["date_to"]))
    $where_clauses[] = "change_date >= '{$search_criteria["date_from"]} 00:00:00' AND change_date <= '{$search_criteria["date_to"]} 23:59:59'";

  $where_clause_str = (!empty($where_clauses)) ? "WHERE " . join(" AND ", $where_clauses) : "";

  $query = mysql_query("
    SELECT change_id
    FROM   {$g_table_prefix}module_client_audit_changes
    $where_clause_str
    ORDER BY change_date DESC
  ");

  $change_ids = array();
  while ($row = mysql_fetch_assoc($query))
    $change_ids[] = $row["change_id"];

  return ca_delete_changes($change_ids);
}


/**
 * This returns the details of a particular change. It's only ever called on permissions and
 * details changes - i.e. changes that have other entries in the module_client_audit_accounts,
 * module_client_audit_account_settings and module_client_audit_permissions tables.
 *
 * @param integer $change_id
 * @return array
 */
function ca_get_change($change_id)
{
  global $g_table_prefix;

  $query = mysql_query("
    SELECT *
    FROM   {$g_table_prefix}module_client_audit_changes
    WHERE  change_id = $change_id
      ");
  $change_info = mysql_fetch_assoc($query);

  $change_type = $change_info["change_type"];
  if ($change_type == "permissions")
  {
    $details_query = mysql_query("
      SELECT *
      FROM   {$g_table_prefix}module_client_audit_client_permissions
      WHERE  change_id = $change_id
        ");
    $details = mysql_fetch_assoc($details_query);

    $change_info["permissions"] = $details;
  }
  else
  {
    $account_query = mysql_query("
      SELECT *
      FROM   {$g_table_prefix}module_client_audit_accounts
      WHERE  change_id = $change_id
        ");
    $account_info = mysql_fetch_assoc($account_query);
    $change_info["account_info"] = $account_info;

    $account_query = mysql_query("
      SELECT *
      FROM   {$g_table_prefix}module_client_audit_account_settings
      WHERE  change_id = $change_id
        ");

    $settings = array();
    while ($row = mysql_fetch_assoc($account_query))
      $settings[$row["setting_name"]] = $row["setting_value"];

    $change_info["account_settings"] = $settings;
  }

  return $change_info;
}


function ca_account_has_changed($account_id, $old_account_info)
{
  $account_info = ft_get_account_info($account_id);

  // figure out which fields have changed. Note: this checks both the contents of the accounts table AND
  // the account_settings table
  $changed_fields = array();
  $fields = array("account_status", "ui_language", "timezone_offset", "sessions_timeout", "date_format",
    "login_page", "logout_url", "theme", "menu_id", "first_name", "last_name", "email", "username",
    "password");

  foreach ($fields as $field)
  {
    if ($old_account_info[$field] != $account_info[$field])
      $changed_fields[] = $field;
  }

  // now compare the settings
  $diff1 = array_diff($account_info["settings"], $old_account_info["account_settings"]);
  $diff2 = array_diff($old_account_info["account_settings"], $account_info["settings"]);
  $diff = array_merge($diff1, $diff2);
  $changed_settings = array_keys($diff);
  $changed_fields = array_merge($changed_fields, $changed_settings);

  return !empty($changed_fields);
}

