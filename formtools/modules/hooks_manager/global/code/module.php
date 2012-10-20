<?php


/**
 * The installation script for the Hooks Manager function.
 */
function hooks_manager__install($module_id)
{
  global $g_table_prefix, $L;

  $queries = array();
  $queries[] = "
    CREATE TABLE IF NOT EXISTS {$g_table_prefix}module_hooks_manager_rules (
      hook_id mediumint(9) NOT NULL,
      is_custom_hook enum('yes','no') NOT NULL default 'no',
      status enum('enabled', 'disabled') NOT NULL default 'enabled',
      rule_name varchar(255) NOT NULL,
      code mediumtext NOT NULL,
      hook_code_type enum('na', 'php', 'html', 'smarty') NOT NULL default 'na',
      PRIMARY KEY (hook_id)
    ) DEFAULT CHARSET=utf8
      ";

  $queries[] = "
    INSERT INTO {$g_table_prefix}settings (setting_name, setting_value, module)
    VALUES ('num_rules_per_page', '10', 'hooks_manager')
      ";

  foreach ($queries as $query)
  {
    $result = mysql_query($query);

    if (!$result)
      return array(false, "Failed query: " . mysql_error());
  }

  return array(true, "");
}


function hooks_manager__uninstall($module_id)
{
  global $g_table_prefix;

  @mysql_query("DROP TABLE {$g_table_prefix}module_hooks_manager_rules");

  return array(true, "");
}


function hooks_manager__upgrade($old_version, $new_version)
{
  global $g_table_prefix;

  $old_version_info = ft_get_version_info($old_version);

  if ($old_version_info["release_date"] < 20100911)
  {
    @mysql_query("ALTER TABLE {$g_table_prefix}module_hooks_manager_rules TYPE=MyISAM");
  }
}
