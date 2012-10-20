<?php


/**
 * Returns the random numbers stored in the module_hello_database table.
 *
 * @return array
 */
function hd_get_rand_nums()
{
  global $g_table_prefix;

  $query = mysql_query("
    SELECT *
    FROM   {$g_table_prefix}module_hello_database
    ORDER by row_id
      ");

  $numbers = array();
  while ($row = mysql_fetch_assoc($query))
    $numbers[] = $row["random_number"];

  return $numbers;
}



/**
 * The "Hello Database!" installation function.
 */
function hello_database__install($module_id)
{
  global $g_table_prefix;

  mysql_query("
    CREATE TABLE {$g_table_prefix}module_hello_database (
      row_id smallint(5) unsigned NOT NULL auto_increment PRIMARY KEY,
      random_number smallint(5)
      ) TYPE=MyISAM
    ");

  // populate the database with some random numbers
  for ($i=1; $i<=10; $i++)
  {
    $random_number = mt_rand(1, 1000);

    mysql_query("
      INSERT INTO {$g_table_prefix}module_hello_database (random_number)
      VALUES ($random_number)
    ");
  }

  return array(true, "");
}


/**
 * The "Hello Database!" uninstallation function. This is automatically called by Form Tools when the
 * administrator de-installs the script.
 */
function hello_database__uninstall($module_id)
{
  global $g_table_prefix;

  mysql_query("DROP TABLE {$g_table_prefix}module_hello_database");
  mysql_query("DELETE FROM {$g_table_prefix}settings WHERE module = 'hello_database'");

  return array(true, "");
}
