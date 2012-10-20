<?php

/*
 * Smarty plugin
 * -------------------------------------------------------------
 * File:     function.display_deleted_account_name
 * Type:     function
 * Purpose:  displays the name of a deleted account. Since it's deleted it doesn't exist in the accounts
 *           table anymore, so we pull it from the database logs instead.
 * -------------------------------------------------------------
 */
function smarty_function_display_deleted_account_name($params, &$smarty)
{
  global $g_table_prefix, $LANG;

  $account_id = (isset($params["account_id"])) ? $params["account_id"] : "";
  $format     = (isset($params["format"])) ? $params["format"] : "first_last";

  if (empty($account_id))
    return;

  $query = mysql_query("
    SELECT *
    FROM   {$g_table_prefix}module_client_audit_accounts mcaa, {$g_table_prefix}module_client_audit_changes mcac
    WHERE  mcac.change_id = mcaa.change_id AND
           mcac.change_type != 'account_deleted' AND
           mcac.change_type != 'login' AND
           mcac.change_type != 'logout' AND
           mcac.account_id = $account_id
    ORDER BY mcaa.change_id DESC
    LIMIT 1
  ");

  $account_info = mysql_fetch_assoc($query);

  // neat fringe case. If the user just installed the module then deleted an account, there won't be the
  // name of the account in the logs, so it won't return anything.
  if (empty($account_info))
  {
    $html = "Unknown";
  }
  else
  {
    if ($format == "first_last")
      $html = "{$account_info["first_name"]} {$account_info["last_name"]}";
    else
      $html = "{$account_info["last_name"]}, {$account_info["first_name"]}";
  }

  return $html;
}
