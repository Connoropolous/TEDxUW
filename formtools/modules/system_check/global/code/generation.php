<?php


/**
 * This is helper function to be used by developers who need to quickly generate the module_config.php
 * file for their module tables.
 *
 * @param array $tables
 * @param string $type "core" or "module" (fefault)
 * @param string $version (for core builds only)
 */
function sc_generate_db_config_file($tables, $type = "module", $version = "")
{
  global $g_table_prefix;

  $init_str = "";
  $version_str = "";
  if (!empty($version))
  {
    $init_str = "\$STRUCTURE = array();";
    $version_str = "[\"$version\"]";
  }

  $html =<<< EOF
$init_str
\$STRUCTURE$version_str = array();
\$STRUCTURE{$version_str}["tables"] = array();

EOF;

  foreach ($tables as $table_name)
  {
    $html .= '$STRUCTURE' . $version_str . '["tables"]["' . $table_name . '"] = array(' . "\n";

    $info = mysql_query("SHOW COLUMNS FROM {$g_table_prefix}$table_name");
    $rows = array();
    while ($row = mysql_fetch_assoc($info))
    {
      $default = preg_replace("/\\$/", "\\\\$", $row["Default"]);
      $str =<<< EOF
  array(
    "Field"   => "{$row['Field']}",
    "Type"    => "{$row['Type']}",
    "Null"    => "{$row['Null']}",
    "Key"     => "{$row['Key']}",
    "Default" => "{$default}"
  )
EOF;
      $rows[] = $str;
    }

    $html .= implode(",\n", $rows);
    $html .= "\n);\n";
  }

  return $html;
}


/**
 * Like the previous function, this for use by module developers. It parses the hook_calls table and
 * generates a PHP representation of the hooks calls being used by the module. That info is then
 * placed in the module_config.php file for use by this module.
 */
function sc_generate_module_hook_array($module_folder, $version)
{
  global $g_table_prefix;

  $query = @mysql_query("
    SELECT *
    FROM   {$g_table_prefix}hook_calls
    WHERE  module_folder = '$module_folder'
      ");

  $hooks = array();
  while ($row = mysql_fetch_assoc($query))
  {
    $hooks[] =<<< END
  array(
    "hook_type"       => "{$row["hook_type"]}",
    "action_location" => "{$row["action_location"]}",
    "function_name"   => "{$row["function_name"]}",
    "hook_function"   => "{$row["hook_function"]}",
    "priority"        => "{$row["priority"]}"
  )
END;
  }
  $hooks_str = implode(",\n", $hooks);

  $version_str = "[\"$version\"]";

  $php = "\$HOOKS = array();\n"
       . "\$HOOKS$version_str = array(\n"
       . $hooks_str
       . "\n);";

  echo $php;
}


