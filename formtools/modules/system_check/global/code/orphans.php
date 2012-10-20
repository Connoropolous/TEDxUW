<?php

/**
 * Contains all functions relating to the Orphan Record Check page. This test has specific,
 * hardcoded tests to run on each table. The tests may vary depending on the current Core version.
 */


// ------------------------------------------------------------------------------------------------


/**
 * Called for each of the Core tables. The table structure changes over time, and each table
 * needs to have different tests performed on it.
 *
 * @param string $table_name
 */
function sc_find_table_orphans($table_name, $remove_orphans)
{
  global $g_table_prefix;

  $results = array(
    "table_name"        => $table_name,
    "num_tests"         => 0,
    "num_orphans"       => 0,
    "test_descriptions" => "",
    "problems"          => ""
  );

  $table_name_without_prefix = preg_replace("/^{$g_table_prefix}/", "", $table_name);

  $has_test = true;
  switch ($table_name_without_prefix)
  {
    case "accounts":
      $response = sc_orphan_test__accounts($remove_orphans);
      break;
    case "account_settings":
      $response = sc_orphan_test__account_settings($remove_orphans);
      break;
    case "client_forms":
      $response = sc_orphan_test__client_forms($remove_orphans);
      break;
    case "client_views":
      $response = sc_orphan_test__client_views($remove_orphans);
      break;
    case "email_templates":
      $response = sc_orphan_test__email_templates($remove_orphans);
      break;
    case "email_template_edit_submission_views":
      $response = sc_orphan_test__email_template_edit_submission_views($remove_orphans);
      break;
    case "email_template_recipients":
      $response = sc_orphan_test__email_template_recipients($remove_orphans);
      break;
    case "email_template_when_sent_views":
      $response = sc_orphan_test__email_template_when_sent_views($remove_orphans);
      break;
    case "field_options":
      $response = sc_orphan_test__field_options($remove_orphans);
      break;
    case "field_settings":
      $response = sc_orphan_test__field_settings($remove_orphans);
      break;
    case "field_type_settings":
      $response = sc_orphan_test__field_type_settings($remove_orphans);
      break;
    case "field_type_setting_options":
      $response = sc_orphan_test__field_type_setting_options($remove_orphans);
      break;
    case "field_type_validation_rules":
      $response = sc_orphan_test__field_type_validation_rules($remove_orphans);
      break;
    case "field_validation":
      $response = sc_orphan_test__field_validation($remove_orphans);
      break;
    case "form_email_fields":
      $response = sc_orphan_test__form_email_fields($remove_orphans);
      break;
    case "form_fields":
      $response = sc_orphan_test__form_fields($remove_orphans);
      break;
    case "menu_items":
      $response = sc_orphan_test__menu_items($remove_orphans);
      break;
    case "multi_page_form_urls":
      $response = sc_orphan_test__multi_page_form_urls($remove_orphans);
      break;
    case "new_view_submission_defaults":
      $response = sc_orphan_test__new_view_submission_defaults($remove_orphans);
      break;
    case "new_view_submission_defaults":
      $response = sc_orphan_test__new_view_submission_defaults($remove_orphans);
      break;
    case "public_form_omit_list":
      $response = sc_orphan_test__public_form_omit_list($remove_orphans);
      break;
    case "public_view_omit_list":
      $response = sc_orphan_test__public_view_omit_list($remove_orphans);
      break;
    case "views":
      $response = sc_orphan_test__views($remove_orphans);
      break;
    case "view_columns":
      $response = sc_orphan_test__view_columns($remove_orphans);
      break;
    case "view_fields":
      $response = sc_orphan_test__view_fields($remove_orphans);
      break;
    case "view_filters":
      $response = sc_orphan_test__view_filters($remove_orphans);
      break;
    case "view_tabs":
      $response = sc_orphan_test__view_tabs($remove_orphans);
      break;

    default:
      // no test: field_types, forms, hooks, hook_calls, list_groups, menus, modules, sessions, settings, themes

      $has_test = false;
      break;
  }

  $results["has_test"] = $has_test;
  if ($has_test)
  {
    $results["num_tests"] = $response["num_tests"];
    $results["num_orphans"] = $response["num_orphans"];
    $results["test_descriptions"] = $response["test_descriptions"];
    $results["problems"] = $response["problems"];
    $results["clean_up_problems"] = isset($response["clean_up_problems"]) ? $response["clean_up_problems"] : "";
  }

  return $results;
}


function sc_clean_orphans()
{
  global $g_root_dir;

  require_once("$g_root_dir/global/misc/config_core.php");
  $tables = sc_get_component_tables($STRUCTURE);

  $problems = array();
  foreach ($tables as $table_name)
  {
    $response = sc_find_table_orphans($table_name, true);
    if (!empty($response["clean_up_problems"]))
    {
      $problems[] = $response["clean_up_problems"];
    }
  }

  $message = "The orphaned records / references have been cleaned up.";
  if (!empty($problems))
  {
    $problem_list = array();
    foreach ($problems as $p)
    {
      foreach ($p as $p2)
      {
        $problem_list[] = "&bull; " . $p2;
      }
    }

    $message = "The orphaned results were cleaned up, however the following problems were encountered:<br />" . implode("<br />", $problem_list);
  }

  return array(true, $message);
}


// ----------------------------------------------------------------------------------------------
// INDIVIDUAL TABLE TESTS


/**
 * Tests: account_id
 */
function sc_orphan_test__account_settings($remove_orphans)
{
  global $g_table_prefix, $g_current_version, $g_cache;

  $response = array(
    "test_descriptions" => "Looks for settings associated with non-existent user accounts.",
    "problems"          => array()
  );

  $valid_account_ids = sc_get_account_ids();

  $settings_query = mysql_query("SELECT * FROM {$g_table_prefix}account_settings");
  $num_tests   = 0;
  $num_orphans = 0;
  while ($row = mysql_fetch_assoc($settings_query))
  {
    $curr_account_id = $row["account_id"];
    if (!in_array($curr_account_id, $valid_account_ids))
    {
      $response["problems"][] = "Invalid account ID: $curr_account_id";
      $num_orphans++;

      // clean-up code
      if ($remove_orphans)
      {
        @mysql_query("
          DELETE FROM {$g_table_prefix}account_settings
          WHERE  account_id = $curr_account_id AND
                 setting_name = '{$row["setting_name"]}'
          LIMIT 1
        ");
      }
    }
    $num_tests++;
  }

  $response["num_tests"] = $num_tests;
  $response["num_orphans"] = $num_orphans;

  return $response;
}


/**
 * Tests: theme, menu_id.
 */
function sc_orphan_test__accounts($remove_orphans)
{
  global $g_table_prefix, $g_current_version, $g_cache;

  $response = array(
    "test_descriptions" => "Checks theme associated with accounts is a valid, enabled theme, and checks the menu ID of accounts exists.",
    "problems"          => array(),
    "clean_up_problems" => array()
  );

  $query = mysql_query("
    SELECT account_id, account_type, theme, menu_id
    FROM   {$g_table_prefix}accounts
  ");

  $valid_menu_ids = sc_get_menu_ids();

  $first_client_menu_id = "";
  if ($remove_orphans)
  {
    $menu_query = mysql_query("SELECT menu_id FROM {$g_table_prefix}menus WHERE menu_type = 'client' LIMIT 1");
    $info = mysql_fetch_assoc($menu_query);
    if (!empty($info["menu_id"]))
    {
      $first_client_menu_id = $info["menu_id"];
    }
  }

  // get a list of valid theme folders
  $themes = ft_get_themes(true);
  $valid_theme_folders = array();
  foreach ($themes as $theme_info)
  {
    $valid_theme_folders[] = $theme_info["theme_folder"];
  }

  $num_tests = 0;
  while ($row = mysql_fetch_assoc($query))
  {
    if (!in_array($row["menu_id"], $valid_menu_ids))
    {
      $response["problems"][] = "Invalid menu ID: {$row["menu_id"]}";

      // clean-up code
      if ($remove_orphans)
      {
        $new_menu_id = 1;
        if ($row["account_type"] == "client")
        {
          $new_menu_id = $first_client_menu_id;
        }

        if (empty($new_menu_id))
        {
          $response["clean_up_problems"][] = "There's no client menu. Please create one, then re-run the test to fix all dud references.";
        }
        else
        {
          @mysql_query("
            UPDATE {$g_table_prefix}accounts
            SET    menu_id = $new_menu_id
            WHERE  account_id = {$row["account_id"]}
          ");
        }
      }
    }
    $num_tests++;

    if (!in_array($row["theme"], $valid_theme_folders))
    {
      $response["problems"][] = "Invalid theme: {$row["theme"]}";

      // clean-up code
      if ($remove_orphans)
      {
        @mysql_query("
          UPDATE {$g_table_prefix}accounts
          SET    theme = 'default',
                 swatch = 'green'
          WHERE  account_id = {$row["account_id"]}
        ");
      }
    }
    $num_tests++;
  }

  $response["num_tests"] = $num_tests;
  $response["num_orphans"] = count($response["problems"]);

  return $response;
}


function sc_orphan_test__client_forms($remove_orphans)
{
  global $g_table_prefix, $g_current_version, $g_cache;

  $response = array(
    "test_descriptions" => "Checks for invalid account IDs and invalid form IDs.",
    "problems"          => array()
  );

  $query = mysql_query("SELECT * FROM {$g_table_prefix}client_forms");

  $valid_account_ids = sc_get_account_ids();
  $valid_form_ids    = sc_get_form_ids();

  $num_tests = 0;
  while ($row = mysql_fetch_assoc($query))
  {
    if (!in_array($row["account_id"], $valid_account_ids))
    {
      $response["problems"][] = "Invalid account ID: {$row["account_id"]}";

      // clean-up code
      if ($remove_orphans)
      {
        @mysql_query("
          DELETE FROM {$g_table_prefix}client_forms
          WHERE  account_id = {$row["account_id"]} AND
                 form_id = {$row["form_id"]}
          LIMIT 1
        ");
      }
    }
    $num_tests++;

    if (!in_array($row["form_id"], $valid_form_ids))
    {
      $response["problems"][] = "Invalid form ID: {$row["form_id"]}";

      // clean-up code
      if ($remove_orphans)
      {
        @mysql_query("
          DELETE FROM {$g_table_prefix}client_forms
          WHERE  account_id = {$row["account_id"]} AND
                 form_id = {$row["form_id"]}
          LIMIT 1
        ");
      }
    }
    $num_tests++;
  }

  $response["num_tests"]   = $num_tests;
  $response["num_orphans"] = count($response["problems"]);

  return $response;
}


function sc_orphan_test__client_views($remove_orphans)
{
  global $g_table_prefix, $g_current_version, $g_cache;

  $response = array(
    "test_descriptions" => "Checks for invalid account IDs and invalid View IDs.",
    "problems"          => array()
  );

  $query = mysql_query("SELECT * FROM {$g_table_prefix}client_views");

  $valid_account_ids = sc_get_account_ids();
  $valid_view_ids    = sc_get_view_ids();

  $num_tests   = 0;
  while ($row = mysql_fetch_assoc($query))
  {
    if (!in_array($row["account_id"], $valid_account_ids))
    {
      $response["problems"][] = "Invalid account ID: {$row["account_id"]}";

      // clean-up code
      if ($remove_orphans)
      {
        @mysql_query("
          DELETE FROM {$g_table_prefix}client_views
          WHERE  account_id = {$row["account_id"]} AND
                 view_id = {$row["view_id"]}
          LIMIT 1
        ");
      }
    }
    $num_tests++;

    if (!in_array($row["view_id"], $valid_view_ids))
    {
      $response["problems"][] = "Invalid View ID: {$row["view_id"]}";

      // clean-up code
      if ($remove_orphans)
      {
        @mysql_query("
          DELETE FROM {$g_table_prefix}client_views
          WHERE  account_id = {$row["account_id"]} AND
                 view_id = {$row["view_id"]}
          LIMIT 1
        ");
      }
    }
    $num_tests++;
  }

  $response["num_tests"] = $num_tests;
  $response["num_orphans"] = count($response["problems"]);

  return $response;
}


/**
 * Tests: form_id, view_mapping_view_id, limit_email_content_to_fields_in_view, email_from_account_id,
 *        email_from_form_email_id, email_reply_to_account_id, email_reply_to_form_email_id,
 */
function sc_orphan_test__email_templates($remove_orphans)
{
  global $g_table_prefix;

  $response = array(
    "test_descriptions" => "Assorted tests for invalid form IDs, email configuration IDs, View IDs, Account IDs.",
    "problems"          => array()
  );

  $valid_account_ids = sc_get_account_ids();
  $valid_email_ids   = sc_get_email_ids();
  $valid_view_ids    = sc_get_view_ids();
  $valid_form_email_config_ids = sc_get_form_email_config_ids();

  $query = mysql_query("SELECT * FROM {$g_table_prefix}email_templates");

  $num_tests = 0;
  while ($row = mysql_fetch_assoc($query))
  {
    if (isset($row["view_mapping_view_id"]))
    {
      if (!in_array($row["view_mapping_view_id"], $valid_view_ids))
      {
        $response["problems"][] = "Invalid view_mapping_view_id: {$row["view_mapping_view_id"]} for email_id = {$row["email_id"]}";

        // clean-up code
        if ($remove_orphans)
        {
          @mysql_query("
            UPDATE {$g_table_prefix}email_templates
            SET    view_mapping_view_id = NULL
            WHERE  email_id = {$row["email_id"]}
          ");
        }
      }
      $num_tests++;
    }

    if (isset($row["limit_email_content_to_fields_in_view"]))
    {
      if (!in_array($row["limit_email_content_to_fields_in_view"], $valid_view_ids))
      {
        $response["problems"][] = "Invalid limit_email_content_to_fields_in_view: {$row["limit_email_content_to_fields_in_view"]} for email_id = {$row["email_id"]}";
        $num_orphans++;

        // clean-up code
        if ($remove_orphans)
        {
          @mysql_query("
            UPDATE {$g_table_prefix}email_templates
            SET    limit_email_content_to_fields_in_view = NULL
            WHERE  email_id = {$row["email_id"]}
          ");
        }
      }
      $num_tests++;
    }

    if (isset($row["email_from_account_id"]))
    {
      if (!in_array($row["email_from_account_id"], $valid_account_ids))
      {
        $response["problems"][] = "Invalid email_from_account_id: {$row["email_from_account_id"]} for email_id = {$row["email_id"]}";
        $num_orphans++;

        // clean-up code
        if ($remove_orphans)
        {
          @mysql_query("
            UPDATE {$g_table_prefix}email_templates
            SET    email_from_account_id = NULL
            WHERE  email_id = {$row["email_id"]}
          ");
        }
      }
      $num_tests++;
    }

    if (isset($row["email_from_form_email_id"]))
    {
      if (!in_array($row["email_from_form_email_id"], $valid_form_email_config_ids))
      {
        $response["problems"][] = "Invalid email_from_form_email_id: {$row["email_from_form_email_id"]} for email_id = {$row["email_id"]}";

        // clean-up code
        if ($remove_orphans)
        {
          @mysql_query("
            UPDATE {$g_table_prefix}email_templates
            SET    email_from_form_email_id = NULL
            WHERE  email_id = {$row["email_id"]}
          ");
        }
      }
      $num_tests++;
    }

    if (isset($row["email_reply_to_account_id"]))
    {
      if (!in_array($row["email_reply_to_account_id"], $valid_account_ids))
      {
        $response["problems"][] = "Invalid email_reply_to_account_id: {$row["email_reply_to_account_id"]} for email_id = {$row["email_id"]}";

        // clean-up code
        if ($remove_orphans)
        {
          @mysql_query("
            UPDATE {$g_table_prefix}email_templates
            SET    email_reply_to_account_id = NULL
            WHERE  email_id = {$row["email_id"]}
          ");
        }
      }
      $num_tests++;
    }

    if (isset($row["email_reply_to_form_email_id"]))
    {
      if (!in_array($row["email_reply_to_form_email_id"], $valid_form_email_config_ids))
      {
        $response["problems"][] = "Invalid email_reply_to_form_email_id: {$row["email_reply_to_form_email_id"]} for email_id = {$row["email_id"]}";

        // clean-up code
        if ($remove_orphans)
        {
          @mysql_query("
            UPDATE {$g_table_prefix}email_templates
            SET    email_reply_to_form_email_id = NULL
            WHERE  email_id = {$row["email_id"]}
          ");
        }
      }
      $num_tests++;
    }
  }

  $response["num_tests"] = $num_tests;
  $response["num_orphans"] = count($response["problems"]);

  return $response;
}


/**
 * This table is a pretty recent addition. If the current Core version doesn't have the table,
 * this test simply won't be called.
 */
function sc_orphan_test__email_template_edit_submission_views($remove_orphans)
{
  global $g_table_prefix;

  $response = array(
    "test_descriptions" => "Checks for invalid email template IDs and invalid View IDs.",
    "problems"          => array()
  );

  $valid_email_ids = sc_get_email_ids();
  $valid_view_ids  = sc_get_view_ids();

  $query = mysql_query("SELECT * FROM {$g_table_prefix}email_template_edit_submission_views");

  $num_tests = 0;
  while ($row = mysql_fetch_assoc($query))
  {
    if (!in_array($row["email_id"], $valid_email_ids))
    {
      $response["problems"][] = "Invalid email template ID: {$row["email_id"]}";

      // clean-up code
      if ($remove_orphans)
      {
        @mysql_query("
          DELETE FROM {$g_table_prefix}email_template_edit_submission_views
          WHERE  email_id = {$row["email_id"]} AND
                 view_id = {$row["view_id"]}
          LIMIT 1
        ");
      }
    }
    $num_tests++;

    if (!in_array($row["view_id"], $valid_view_ids))
    {
      $response["problems"][] = "Invalid View ID: {$row["view_id"]}";

      // clean-up code
      if ($remove_orphans)
      {
        @mysql_query("
          DELETE FROM {$g_table_prefix}email_template_edit_submission_views
          WHERE  email_id = {$row["email_id"]} AND
                 view_id = {$row["view_id"]}
          LIMIT 1
        ");
      }
    }
    $num_tests++;
  }

  $response["num_tests"] = $num_tests;
  $response["num_orphans"] = count($response["problems"]);

  return $response;
}


/**
 * This table is a pretty recent addition. If the current Core version doesn't have the table,
 * this test simply won't be called.
 */
function sc_orphan_test__email_template_recipients($remove_orphans)
{
  global $g_table_prefix;

  $response = array(
    "test_descriptions" => "Checks for records mapped to now-deleted email template IDs, deleted Account ID and email configuration ID references.",
    "problems"          => array()
  );

  $valid_email_ids   = sc_get_email_ids();
  $valid_account_ids = sc_get_account_ids();
  $valid_email_config_ids = sc_get_form_email_config_ids();

  $query = mysql_query("SELECT * FROM {$g_table_prefix}email_template_recipients");

  $num_tests = 0;
  while ($row = mysql_fetch_assoc($query))
  {
    if (!in_array($row["email_template_id"], $valid_email_ids))
    {
      $response["problems"][] = "invalid template ID {$row["email_template_id"]} being referenced by the table's Primary Key ID {$row["recipient_id"]}";

      // clean-up code
      if ($remove_orphans)
      {
        @mysql_query("
          DELETE FROM {$g_table_prefix}email_template_recipients
          WHERE  recipient_id = {$row["recipient_id"]}
          LIMIT 1
        ");
      }
    }
    $num_tests++;

    if (!empty($row["account_id"]) && !in_array($row["account_id"], $valid_account_ids))
    {
      $response["problems"][] = "invalid account ID {$row["account_id"]} being referenced by the table's Primary Key ID {$row["recipient_id"]}";

      // clean-up code
      if ($remove_orphans)
      {
        @mysql_query("
          UPDATE {$g_table_prefix}email_template_recipients
          SET    account_id = NULL
          WHERE  recipient_id = {$row["recipient_id"]}
          LIMIT 1
        ");
      }
    }
    $num_tests++;

    if (!empty($row["form_email_id"]) && !in_array($row["form_email_id"], $valid_email_config_ids))
    {
      $response["problems"][] = "invalid form email field configuration {$row["form_email_id"]} being referenced by the table's Primary Key ID {$row["recipient_id"]}";

      // clean-up code
      if ($remove_orphans)
      {
        @mysql_query("
          UPDATE {$g_table_prefix}email_template_recipients
          SET    form_email_id = NULL
          WHERE  recipient_id = {$row["recipient_id"]}
          LIMIT 1
        ");
      }
    }
    $num_tests++;
  }

  $response["num_tests"] = $num_tests;
  $response["num_orphans"] = count($response["problems"]);

  return $response;
}


function sc_orphan_test__email_template_when_sent_views($remove_orphans)
{
  global $g_table_prefix;

  $response = array(
    "test_descriptions" => "Checks for records mapped to now-deleted email templates and Views.",
    "problems"          => array()
  );

  $valid_email_ids = sc_get_email_ids();
  $valid_view_ids  = sc_get_view_ids();

  $query = mysql_query("SELECT * FROM {$g_table_prefix}email_template_when_sent_views");

  $num_tests = 0;
  while ($row = mysql_fetch_assoc($query))
  {
    if (!in_array($row["email_id"], $valid_email_ids))
    {
      $response["problems"][] = "invalid email template ID {$row["email_template_id"]}";

      // clean-up code
      if ($remove_orphans)
      {
        @mysql_query("
          DELETE FROM {$g_table_prefix}email_template_when_sent_views
          WHERE  email_id = {$row["email_id"]} AND
                 view_id = {$row["view_id"]}
        ");
      }
    }
    $num_tests++;

    if (!in_array($row["view_id"], $valid_view_ids))
    {
      $response["problems"][] = "invalid View ID {$row["view_id"]}";

      // clean-up code
      if ($remove_orphans)
      {
        @mysql_query("
          DELETE FROM {$g_table_prefix}email_template_when_sent_views
          WHERE  email_id = {$row["email_id"]} AND
                 view_id = {$row["view_id"]}
        ");
      }
    }
    $num_tests++;
  }

  $response["num_tests"] = $num_tests;
  $response["num_orphans"] = count($response["problems"]);

  return $response;
}


function sc_orphan_test__field_options($remove_orphans)
{
  global $g_table_prefix;

  $response = array(
    "test_descriptions" => "Checks each field option is attached to a valid list_group_id.",
    "problems"          => array()
  );

  $valid_list_group_ids = sc_get_list_group_ids();

  $query = mysql_query("SELECT * FROM {$g_table_prefix}field_options");
  $num_tests = 0;
  while ($row = mysql_fetch_assoc($query))
  {
    if (!in_array($row["list_group_id"], $valid_list_group_ids))
    {
      $response["problems"][] = "invalid list_group_id {$row["list_group_id"]}";

      // clean-up code
      if ($remove_orphans)
      {
        @mysql_query("
          DELETE FROM {$g_table_prefix}field_options
          WHERE  list_id = {$row["list_id"]}
        ");
      }
    }
    $num_tests++;
  }

  $response["num_tests"] = $num_tests;
  $response["num_orphans"] = count($response["problems"]);

  return $response;
}


function sc_orphan_test__field_settings($remove_orphans)
{
  global $g_table_prefix;

  $response = array(
    "test_descriptions" => "Checks for invalid references to deleted field IDs and settings IDs.",
    "problems"          => array()
  );

  $valid_field_ids              = sc_get_field_ids();
  $valid_field_type_setting_ids = sc_get_field_type_setting_ids();

  $query = mysql_query("SELECT * FROM {$g_table_prefix}field_settings");
  $num_tests = 0;
  while ($row = mysql_fetch_assoc($query))
  {
    if (!in_array($row["field_id"], $valid_field_ids))
    {
      $response["problems"][] = "invalid field_id: {$row["field_id"]}";

      // clean-up code
      if ($remove_orphans)
      {
        @mysql_query("
          DELETE FROM {$g_table_prefix}field_settings
          WHERE  field_id = {$row["field_id"]}
        ");
      }
    }
    if (!in_array($row["setting_id"], $valid_field_type_setting_ids))
    {
      $response["problems"][] = "invalid setting_id: {$row["setting_id"]}";

      // clean-up code
      if ($remove_orphans)
      {
        @mysql_query("
          DELETE FROM {$g_table_prefix}field_settings
          WHERE  setting_id = {$row["setting_id"]}
        ");
      }
    }
    $num_tests++;
  }

  $response["num_tests"] = $num_tests;
  $response["num_orphans"] = count($response["problems"]);

  return $response;
}


function sc_orphan_test__field_type_settings($remove_orphans)
{
  global $g_table_prefix;

  $response = array(
    "test_descriptions" => "Checks for invalid references to deleted field types.",
    "problems"          => array()
  );

  $valid_field_type_ids = sc_get_field_type_ids();

  $query = mysql_query("SELECT setting_id, field_type_id FROM {$g_table_prefix}field_type_settings");
  $num_tests = 0;
  while ($row = mysql_fetch_assoc($query))
  {
    if (!in_array($row["field_type_id"], $valid_field_type_ids))
    {
      $response["problems"][] = "setting_id: {$row["setting_id"]} references invalid field_type_id: {$row["field_type_id"]}";

      // clean-up code
      if ($remove_orphans)
      {
        @mysql_query("
          DELETE FROM {$g_table_prefix}field_type_settings
          WHERE  field_type_id = {$row["field_type_id"]}
        ");
      }
    }
    $num_tests++;
  }

  $response["num_tests"] = $num_tests;
  $response["num_orphans"] = count($response["problems"]);

  return $response;
}


function sc_orphan_test__field_type_setting_options($remove_orphans)
{
  global $g_table_prefix;

  $response = array(
    "test_descriptions" => "Checks for invalid references to deleted field type settings.",
    "problems"          => array()
  );

  $valid_field_type_setting_ids = sc_get_field_type_setting_ids();

  $query = mysql_query("SELECT setting_id, option_order FROM {$g_table_prefix}field_type_setting_options");
  $num_tests = 0;
  while ($row = mysql_fetch_assoc($query))
  {
    if (!in_array($row["setting_id"], $valid_field_type_setting_ids))
    {
      $response["problems"][] = "Invalid reference to setting_id: {$row["setting_id"]} for option_order: {$row["option_order"]}";

      // clean-up code
      if ($remove_orphans)
      {
        @mysql_query("
          DELETE FROM {$g_table_prefix}field_type_setting_options
          WHERE  setting_id = {$row["setting_id"]} AND
                 option_order = {$row["option_order"]}
        ");
      }
    }
    $num_tests++;
  }

  $response["num_tests"] = $num_tests;
  $response["num_orphans"] = count($response["problems"]);

  return $response;
}


function sc_orphan_test__field_type_validation_rules($remove_orphans)
{
  global $g_table_prefix;

  $response = array(
    "test_descriptions" => "Checks for references to non-existent field types.",
    "problems"          => array()
  );

  $valid_field_type_ids = sc_get_field_type_ids();

  $query = mysql_query("SELECT rule_id, field_type_id FROM {$g_table_prefix}field_type_validation_rules");
  $num_tests = 0;
  while ($row = mysql_fetch_assoc($query))
  {
    if (!in_array($row["field_type_id"], $valid_field_type_ids))
    {
      $response["problems"][] = "Invalid reference to field_type_id: {$row["field_type_id"]} for rule_id: {$row["rule_id"]}";

      // clean-up code
      if ($remove_orphans)
      {
        @mysql_query("
          DELETE FROM {$g_table_prefix}field_type_validation_rules
          WHERE  rule_id = {$row["rule_id"]}
        ");
      }
    }
    $num_tests++;
  }

  $response["num_tests"] = $num_tests;
  $response["num_orphans"] = count($response["problems"]);

  return $response;
}


function sc_orphan_test__field_validation($remove_orphans)
{
  global $g_table_prefix;

  $response = array(
    "test_descriptions" => "Checks for validation rules that are no longer mapped to valid fields or validation rules.",
    "problems"          => array()
  );

  $valid_field_ids = sc_get_field_ids();
  $valid_rule_ids  = sc_get_validation_rule_ids();

  $query = mysql_query("SELECT rule_id, field_id FROM {$g_table_prefix}field_validation");
  $num_tests = 0;
  while ($row = mysql_fetch_assoc($query))
  {
    if (!in_array($row["rule_id"], $valid_rule_ids))
    {
      $response["problems"][] = "Invalid reference to rule_id: {$row["rule_id"]} for field_id: {$row["field_id"]}";

      // clean-up code
      if ($remove_orphans)
      {
        @mysql_query("
          DELETE FROM {$g_table_prefix}field_validation
          WHERE  rule_id = {$row["rule_id"]}
        ");
      }
    }
    if (!in_array($row["field_id"], $valid_field_ids))
    {
      $response["problems"][] = "Invalid reference to field_id: {$row["field_id"]} for rule_id: {$row["rule_id"]}";

      // clean-up code
      if ($remove_orphans)
      {
        @mysql_query("
          DELETE FROM {$g_table_prefix}field_validation
          WHERE  rule_id = {$row["rule_id"]}
        ");
      }
    }
    $num_tests++;
  }

  $response["num_tests"] = $num_tests;
  $response["num_orphans"] = count($response["problems"]);

  return $response;
}


function sc_orphan_test__form_email_fields($remove_orphans)
{
  global $g_table_prefix;

  $response = array(
    "test_descriptions" => "Checks for records that map to invalid form_id and corresponding form fields",
    "problems"          => array()
  );

  $valid_form_ids = sc_get_form_ids();
  $query = mysql_query("SELECT * FROM {$g_table_prefix}form_email_fields");
  $num_tests = 0;
  while ($row = mysql_fetch_assoc($query))
  {
    if (!in_array($row["form_id"], $valid_form_ids))
    {
      $response["problems"][] = "Invalid reference to form_id {$row["form_id"]}";

      // clean-up code
      if ($remove_orphans)
      {
        @mysql_query("
          DELETE FROM {$g_table_prefix}form_email_fields
          WHERE  form_email_id = {$row["form_email_id"]}
        ");
      }
    }
    else
    {
      $form_field_ids = sc_get_form_field_ids($row["form_id"]);
      if (!in_array($row["email_field_id"], $form_field_ids))
      {
        $response["problems"][] = "form_email_id: {$row["form_email_id"]} contains invalid reference to field_id {$row["email_field_id"]} for the email_field_id field";

        // clean-up code
        if ($remove_orphans)
        {
          @mysql_query("
            DELETE FROM {$g_table_prefix}form_email_fields
            WHERE  form_email_id = {$row["form_email_id"]}
          ");
        }
      }
      if (!empty($row["first_name_field_id"]) && !in_array($row["first_name_field_id"], $form_field_ids))
      {
        $response["problems"][] = "form_email_id: {$row["form_email_id"]} contains invalid reference to field_id {$row["first_name_field_id"]} for the first_name_field_id field";

        // clean-up code
        if ($remove_orphans)
        {
          @mysql_query("
            UPDATE {$g_table_prefix}form_email_fields
            SET    first_name_field_id = NULL
            WHERE  form_email_id = {$row["form_email_id"]}
          ");
        }
      }
      if (!empty($row["last_name_field_id"]) && !in_array($row["last_name_field_id"], $form_field_ids))
      {
        $response["problems"][] = "form_email_id: {$row["form_email_id"]} contains invalid reference to field_id {$row["last_name_field_id"]} for the last_name_field_id field";

        // clean-up code
        if ($remove_orphans)
        {
          @mysql_query("
            UPDATE {$g_table_prefix}form_email_fields
            SET    last_name_field_id = NULL
            WHERE  form_email_id = {$row["form_email_id"]}
          ");
        }
      }
      $num_tests+=3;
    }
    $num_tests++;
  }

  $response["num_tests"] = $num_tests;
  $response["num_orphans"] = count($response["problems"]);

  return $response;
}


function sc_orphan_test__form_fields($remove_orphans)
{
  global $g_table_prefix;

  $response = array(
    "test_descriptions" => "Checks for records that map to invalid form_id and field_type_id records.",
    "problems"          => array()
  );

  $valid_form_ids = sc_get_form_ids();
  $valid_field_type_ids = sc_get_field_type_ids();

  $query = mysql_query("SELECT field_id, form_id, field_type_id FROM {$g_table_prefix}form_fields");

  $num_tests = 0;
  while ($row = mysql_fetch_assoc($query))
  {
    if (!in_array($row["form_id"], $valid_form_ids))
    {
      $response["problems"][] = "Invalid reference to form_id {$row["form_id"]} for field_id {$row["field_id"]}";

      // clean-up code
      if ($remove_orphans)
      {
        @mysql_query("
          DELETE FROM {$g_table_prefix}form_fields
          WHERE field_id = {$row["field_id"]}
          LIMIT 1
        ");
      }
    }
    $num_tests++;

    if (!in_array($row["field_type_id"], $valid_field_type_ids))
    {
      $response["problems"][] = "Invalid reference to field_type_id {$row["field_type_id"]} for field_id {$row["field_id"]}";

      // clean-up code
      if ($remove_orphans)
      {
      	$textbox_field_type_id = ft_get_field_type_id_by_identifier("textbox");
        @mysql_query("
          UPDATE {$g_table_prefix}form_fields
          SET    field_type_id = $textbox_field_type_id
          WHERE  field_id = {$row["field_id"]}
        ");
      }
    }
    $num_tests++;
  }

  $response["num_tests"] = $num_tests;
  $response["num_orphans"] = count($response["problems"]);

  return $response;
}


function sc_orphan_test__menu_items($remove_orphans)
{
  global $g_table_prefix;

  $response = array(
    "test_descriptions" => "Checks for menu item records that are mapped to invalid menus",
    "problems"          => array()
  );

  $valid_menu_ids = sc_get_menu_ids();

  $query = mysql_query("SELECT menu_id, menu_item_id FROM {$g_table_prefix}menu_items");
  $num_tests = 0;
  while ($row = mysql_fetch_assoc($query))
  {
    if (!in_array($row["menu_id"], $valid_menu_ids))
    {
      $response["problems"][] = "Invalid reference to menu_id {$row["menu_id"]} for menu_item_id {$row["menu_item_id"]}";

      // clean-up code
      if ($remove_orphans)
      {
        @mysql_query("
          DELETE FROM {$g_table_prefix}menu_items
          WHERE  menu_item_id = {$row["menu_item_id"]}
        ");
      }
    }
    $num_tests++;
  }

  $response["num_tests"]   = $num_tests;
  $response["num_orphans"] = count($response["problems"]);

  return $response;
}


function sc_orphan_test__multi_page_form_urls($remove_orphans)
{
  global $g_table_prefix;

  $response = array(
    "test_descriptions" => "Checks for records that are mapped to invalid form_ids",
    "problems"          => array()
  );

  $valid_form_ids = sc_get_form_ids();

  $query = mysql_query("SELECT form_id, page_num FROM {$g_table_prefix}multi_page_form_urls");
  $num_tests = 0;
  while ($row = mysql_fetch_assoc($query))
  {
    if (!in_array($row["form_id"], $valid_form_ids))
    {
      $response["problems"][] = "Invalid reference to form_id {$row["form_id"]} for page_num {$row["page_num"]}";

      // clean-up code
      if ($remove_orphans)
      {
        @mysql_query("
          DELETE FROM {$g_table_prefix}multi_page_form_urls
          WHERE  form_id = {$row["form_id"]}
        ");
      }
    }
    $num_tests++;
  }

  $response["num_tests"]   = $num_tests;
  $response["num_orphans"] = count($response["problems"]);

  return $response;
}


function sc_orphan_test__new_view_submission_defaults($remove_orphans)
{
  global $g_table_prefix;

  $response = array(
    "test_descriptions" => "Checks for records that are mapped to invalid view_ids and field_ids",
    "problems"          => array()
  );

  $valid_view_ids = sc_get_view_ids();
  $valid_field_ids = sc_get_field_ids();

  $query = mysql_query("SELECT view_id, field_id FROM {$g_table_prefix}new_view_submission_defaults");
  $num_tests = 0;
  while ($row = mysql_fetch_assoc($query))
  {
    if (!in_array($row["view_id"], $valid_view_ids))
    {
      $response["problems"][] = "Invalid reference to view_id {$row["view_id"]} for field_id {$row["field_id"]}";

      // clean-up code
      if ($remove_orphans)
      {
        @mysql_query("
          DELETE FROM {$g_table_prefix}new_view_submission_defaults
          WHERE  view_id = {$row["view_id"]}
        ");
      }
    }
    $num_tests++;

    if (!in_array($row["field_id"], $valid_field_ids))
    {
      $response["problems"][] = "Invalid reference to field_id {$row["field_id"]} for view_id {$row["view_id"]}";

      // clean-up code
      if ($remove_orphans)
      {
        @mysql_query("
          DELETE FROM {$g_table_prefix}new_view_submission_defaults
          WHERE  field_id = {$row["field_id"]}
        ");
      }
    }
    $num_tests++;
  }

  $response["num_tests"]   = $num_tests;
  $response["num_orphans"] = count($response["problems"]);

  return $response;
}


function sc_orphan_test__public_form_omit_list($remove_orphans)
{
  global $g_table_prefix;

  $response = array(
    "test_descriptions" => "Checks for references to non-existent form IDs or account IDs",
    "problems"          => array()
  );

  $valid_form_ids    = sc_get_form_ids();
  $valid_account_ids = sc_get_account_ids();

  $query = mysql_query("SELECT * FROM {$g_table_prefix}public_form_omit_list");
  $num_tests = 0;
  while ($row = mysql_fetch_assoc($query))
  {
    if (!in_array($row["form_id"], $valid_form_ids))
    {
      $response["problems"][] = "Invalid reference to form_id {$row["form_id"]} for account_id {$row["account_id"]}";

      // clean-up code
      if ($remove_orphans)
      {
        @mysql_query("
          DELETE FROM {$g_table_prefix}public_form_omit_list
          WHERE  form_id = {$row["form_id"]}
        ");
      }
    }
    $num_tests++;

    if (!in_array($row["account_id"], $valid_account_ids))
    {
      $response["problems"][] = "Invalid reference to account_id {$row["account_id"]} for form_id {$row["form_id"]}";

      // clean-up code
      if ($remove_orphans)
      {
        @mysql_query("
          DELETE FROM {$g_table_prefix}public_form_omit_list
          WHERE  account_id = {$row["account_id"]}
        ");
      }
    }
    $num_tests++;
  }

  $response["num_tests"]   = $num_tests;
  $response["num_orphans"] = count($response["problems"]);

  return $response;
}


function sc_orphan_test__public_view_omit_list($remove_orphans)
{
  global $g_table_prefix;

  $response = array(
    "test_descriptions" => "Checks for references to non-existent view IDs or account IDs",
    "problems"          => array()
  );

  $valid_view_ids    = sc_get_view_ids();
  $valid_account_ids = sc_get_account_ids();

  $query = mysql_query("SELECT * FROM {$g_table_prefix}public_view_omit_list");
  $num_tests = 0;
  while ($row = mysql_fetch_assoc($query))
  {
    if (!in_array($row["view_id"], $valid_view_ids))
    {
      $response["problems"][] = "Invalid reference to view_id {$row["view_id"]} for account_id {$row["account_id"]}";

      // clean-up code
      if ($remove_orphans)
      {
        @mysql_query("
          DELETE FROM {$g_table_prefix}public_view_omit_list
          WHERE  view_id = {$row["view_id"]}
        ");
      }
    }
    $num_tests++;

    if (!in_array($row["account_id"], $valid_account_ids))
    {
      $response["problems"][] = "Invalid reference to account_id {$row["account_id"]} for view_id {$row["view_id"]}";

      // clean-up code
      if ($remove_orphans)
      {
        @mysql_query("
          DELETE FROM {$g_table_prefix}public_view_omit_list
          WHERE  account_id = {$row["account_id"]}
        ");
      }
    }
    $num_tests++;
  }

  $response["num_tests"]   = $num_tests;
  $response["num_orphans"] = count($response["problems"]);

  return $response;
}


function sc_orphan_test__views($remove_orphans)
{
  global $g_table_prefix;

  $response = array(
    "test_descriptions" => "Checks for references to non-existent form IDs",
    "problems"          => array()
  );

  $valid_form_ids = sc_get_form_ids();

  $query = mysql_query("SELECT * FROM {$g_table_prefix}views");
  $num_tests = 0;
  while ($row = mysql_fetch_assoc($query))
  {
    if (!in_array($row["form_id"], $valid_form_ids))
    {
      $response["problems"][] = "Invalid reference to form_id {$row["form_id"]} for view_id {$row["view_id"]}";

      // clean-up code
      if ($remove_orphans)
      {
        @mysql_query("
          DELETE FROM {$g_table_prefix}views
          WHERE  form_id = {$row["form_id"]}
        ");
      }
    }
    $num_tests++;
  }

  $response["num_tests"]   = $num_tests;
  $response["num_orphans"] = count($response["problems"]);

  return $response;
}


function sc_orphan_test__view_columns($remove_orphans)
{
  global $g_table_prefix;

  $response = array(
    "test_descriptions" => "Checks for references to non-existent View IDs and field IDs",
    "problems"          => array()
  );

  $valid_view_ids  = sc_get_view_ids();
  $valid_field_ids = sc_get_field_ids();

  $query = mysql_query("SELECT * FROM {$g_table_prefix}view_columns");
  $num_tests = 0;
  while ($row = mysql_fetch_assoc($query))
  {
    if (!in_array($row["view_id"], $valid_view_ids))
    {
      $response["problems"][] = "Invalid reference to view_id {$row["view_id"]} for field_id {$row["field_id"]}";

      // clean-up code
      if ($remove_orphans)
      {
        @mysql_query("
          DELETE FROM {$g_table_prefix}view_columns
          WHERE  view_id = {$row["view_id"]}
        ");
      }
    }
    $num_tests++;

    if (!in_array($row["field_id"], $valid_field_ids))
    {
      $response["problems"][] = "Invalid reference to field_id {$row["field_id"]} for view_id {$row["view_id"]}";

      // clean-up code
      if ($remove_orphans)
      {
        @mysql_query("
          DELETE FROM {$g_table_prefix}view_columns
          WHERE  field_id = {$row["field_id"]}
        ");
      }
    }
    $num_tests++;
  }

  $response["num_tests"]   = $num_tests;
  $response["num_orphans"] = count($response["problems"]);

  return $response;
}


function sc_orphan_test__view_fields($remove_orphans)
{
  global $g_table_prefix;

  $response = array(
    "test_descriptions" => "Checks for references to non-existent View IDs and field IDs",
    "problems"          => array()
  );

  $valid_view_ids  = sc_get_view_ids();
  $valid_field_ids = sc_get_field_ids();

  $query = mysql_query("SELECT * FROM {$g_table_prefix}view_fields");
  $num_tests = 0;
  while ($row = mysql_fetch_assoc($query))
  {
    if (!in_array($row["view_id"], $valid_view_ids))
    {
      $response["problems"][] = "Invalid reference to view_id {$row["view_id"]} for field_id {$row["field_id"]}";

      // clean-up code
      if ($remove_orphans)
      {
        @mysql_query("
          DELETE FROM {$g_table_prefix}view_fields
          WHERE  view_id = {$row["view_id"]}
        ");
      }
    }
    $num_tests++;

    if (!in_array($row["field_id"], $valid_field_ids))
    {
      $response["problems"][] = "Invalid reference to field_id {$row["field_id"]} for view_id {$row["view_id"]}";

      // clean-up code
      if ($remove_orphans)
      {
        @mysql_query("
          DELETE FROM {$g_table_prefix}view_fields
          WHERE  field_id = {$row["field_id"]}
        ");
      }
    }
    $num_tests++;
  }

  $response["num_tests"]   = $num_tests;
  $response["num_orphans"] = count($response["problems"]);

  return $response;
}


function sc_orphan_test__view_filters($remove_orphans)
{
  global $g_table_prefix;

  $response = array(
    "test_descriptions" => "Checks for references to non-existent View IDs and field IDs",
    "problems"          => array()
  );

  $valid_view_ids  = sc_get_view_ids();
  $valid_field_ids = sc_get_field_ids();

  $query = mysql_query("SELECT * FROM {$g_table_prefix}view_filters");
  $num_tests = 0;
  while ($row = mysql_fetch_assoc($query))
  {
    if (!in_array($row["view_id"], $valid_view_ids))
    {
      $response["problems"][] = "Invalid reference to view_id {$row["view_id"]} for field_id {$row["field_id"]}";

      // clean-up code
      if ($remove_orphans)
      {
        @mysql_query("
          DELETE FROM {$g_table_prefix}view_filters
          WHERE  view_id = {$row["view_id"]}
        ");
      }
    }
    $num_tests++;

    if (!in_array($row["field_id"], $valid_field_ids))
    {
      $response["problems"][] = "Invalid reference to field_id {$row["field_id"]} for view_id {$row["view_id"]}";

      // clean-up code
      if ($remove_orphans)
      {
        @mysql_query("
          DELETE FROM {$g_table_prefix}view_filters
          WHERE  field_id = {$row["field_id"]}
        ");
      }
    }
    $num_tests++;
  }

  $response["num_tests"]   = $num_tests;
  $response["num_orphans"] = count($response["problems"]);

  return $response;
}


function sc_orphan_test__view_tabs($remove_orphans)
{
  global $g_table_prefix;

  $response = array(
    "test_descriptions" => "Checks for references to non-existent View IDs",
    "problems"          => array()
  );

  $valid_view_ids  = sc_get_view_ids();

  $query = mysql_query("SELECT * FROM {$g_table_prefix}view_tabs");
  $num_tests = 0;
  while ($row = mysql_fetch_assoc($query))
  {
    if (!in_array($row["view_id"], $valid_view_ids))
    {
      $response["problems"][] = "Invalid reference to view_id {$row["view_id"]} for tab_number {$row["tab_number"]}";

      // clean-up code
      if ($remove_orphans)
      {
        @mysql_query("
          DELETE FROM {$g_table_prefix}view_tabs
          WHERE  view_id = {$row["view_id"]}
        ");
      }
    }
    $num_tests++;
  }

  $response["num_tests"]   = $num_tests;
  $response["num_orphans"] = count($response["problems"]);

  return $response;
}
