<?php


/**
 * Figures out which (if any) of the installed modules have a database_integrity.php file defined
 * in their root, for use by this module. As of 2.0.2, this only returns modules that are actually
 * installed.
 *
 * @return array all compatible module information
 */
function dbi_get_compatible_modules()
{
  global $g_root_dir;

  $module_list = ft_get_modules();

  $compatible_modules = array();
  foreach ($module_list as $module_info)
  {
    $module_folder = $module_info["module_folder"];
    if (!is_file("$g_root_dir/modules/$module_folder/database_integrity.php"))
      continue;

    if ($module_info["is_installed"] == "yes")
      $compatible_modules[] = $module_info;
  }

  return $compatible_modules;
}


/**
 * This is helper function to be used by developers who need to quickly generate the database_integrity.php
 * file for their module tables.
 *
 * @param array $tables
 * @param string $type "core" or "module" (fefault)
 * @param string $version (for core builds only)
 */
function dbi_generate_db_config_file($tables, $type = "module", $version = "")
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
 * This is called for each table. It returns an array with the following values. If the table doesn't
 * exist, it only returns the table
 *   "table_exists"    => true/false
 *   "missing_columns" => array of col names
 *   "invalid_columns" => hash of array of hashes (*sigh*).
 *                         "column_name" => array(
 *                                            "Type" => array(
 *                                               "should_be" => "whatever the type should be"
 *                                               "is"        => "whatever the type actually is"
 *                                            ),
 *                                            ...
 *                                          )
 *                        "Type" in the example above can be "Type", "Null", "Key" or "default", as per the
 *                        column data in the database_integrity.php files.
 *
 * @param array $component_info
 * @param string $table_name
 */
function di_check_component_table($component_info, $table_name)
{
  // first, check the table exists
  $results = array();
  $table_exists = di_test_component_table_exists($component_info, $table_name);
  $results["table_exists"] = $table_exists;

  // if the table exists, run tests on all the columns in the table
  if ($table_exists)
  {
    $info = di_check_component_table_columns($component_info, $table_name);
    $results["missing_columns"] = $info["missing_columns"];
    $results["invalid_columns"] = $info["invalid_columns"];
  }

  return $results;
}


/**
 * Called by di_check_component_table. See that function comments for a clear description of the
 * return values.
 *
 * @param array $component_info
 * @param string $table_name
 */
function di_check_component_table_columns($component_info, $table_name)
{
  global $g_table_prefix;

  $missing_columns = array();
  $invalid_columns = array();

  // get the actual content of the db table (should be moved to helper)
  $actual_column_info_query = mysql_query("SHOW COLUMNS FROM $table_name");
  $actual_column_info = array();
  while ($row = mysql_fetch_assoc($actual_column_info_query))
  {
    $default = preg_replace("/\\$/", "\\\\$", $row["Default"]);
    $actual_column_info[$row['Field']] = array(
      "Type" => $row['Type'],
      "Null" => $row['Null'],
      "Key"  => $row['Key'],
      "Default" => $default
    );
  }

  $table_name_without_prefix = preg_replace("/^{$g_table_prefix}/", "", $table_name);
  foreach ($component_info["tables"][$table_name_without_prefix] as $desired_column_info)
  {
    $curr_column_name = $desired_column_info["Field"];

    // if the curr column name from the structure file isn't found in the ACTUAL column info list,
    // it's missing!
    if (!array_key_exists($curr_column_name, $actual_column_info))
    {
      $missing_columns[] = $curr_column_name;
      continue;
    }

    // now check each of the values
    $invalid_values = array();
    if ($desired_column_info["Type"] != $actual_column_info[$curr_column_name]["Type"])
    {
      $invalid_values = array(
        "field"     => "Type",
        "should_be" => $desired_column_info["Type"],
        "is" =>        $actual_column_info[$curr_column_name]["Type"]
      );
    }

    if (!empty($invalid_values))
    {
      $invalid_columns[] = array(
        "column"         => $curr_column_name,
        "invalid_values" => $invalid_values
      );
    }
  }

  return array(
    "missing_columns" => $missing_columns,
    "invalid_columns" => $invalid_columns
  );
}

/**
 * Note that this function takes the FULL table name (including prefix).
 *
 * @param array $component_info
 * @param string $table_name
 */
function di_test_component_table_exists($component_info, $table_name)
{
  $exists = false;
  if (mysql_query("SELECT * FROM {$table_name}"))
    $exists = true;

  return $exists;
}


function di_get_component_tables($component_info)
{
  global $g_table_prefix;

  $tables = array();
  while (list($table_name, $table_info) = each($component_info["tables"]))
    $tables[] = "{$g_table_prefix}{$table_name}";

  return $tables;
}
