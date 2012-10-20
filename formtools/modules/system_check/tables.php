<?php

require_once("../../global/library.php");
ft_init_module_page();

// ------------------------------------------------------------------------------------------------

$settings = ft_get_settings();
$core_version = ($settings["release_type"] == "beta") ? "{$settings["program_version"]}-beta-{$settings["release_date"]}" : $settings["program_version"];

// ---------------------------------------
// *** example for generating config file for a module. Make sure you omit the table prefixes! ***
/*$tables = array(
  "account_settings",
  "accounts",
  "client_forms",
  "client_views",
  "email_template_edit_submission_views",
  "email_template_recipients",
  "email_templates",
  "field_options",
  "field_settings",
  "field_type_setting_options",
  "field_type_settings",
  "field_types",
  "form_email_fields",
  "form_fields",
  "forms",
  "hooks",
  "list_groups",
  "menu_items",
  "menus",
  "module_js_error_logs",
  "module_menu_items",
  "modules",
  "multi_page_form_urls",
  "new_view_submission_defaults",
  "option_lists",
  "public_form_omit_list",
  "public_view_omit_list",
  "sessions",
  "settings",
  "themes",
  "view_columns",
  "view_fields",
  "view_filters",
  "view_tabs",
  "views"
);
*/
$tables = array("module_hooks_manager_rules");
//echo sc_generate_db_config_file($tables, "module");
//exit;

// ---------------------------------------

// example for the core
//echo sc_generate_db_config_file($tables, "core, "2.0.4");

$word_testing_uc = mb_strtoupper($L["word_untested"]);
$word_passed_uc  = mb_strtoupper($L["word_passed"]);
$word_failed_uc  = mb_strtoupper($L["word_failed"]);

$page_vars = array();
$page_vars["module_list"] = sc_get_compatible_modules("tables");
$page_vars["core_version"] = $core_version;
$page_vars["head_string"] =<<< EOF
<script src="{$g_root_url}/modules/system_check/global/scripts/tests.js"></script>
<link type="text/css" rel="stylesheet" href="{$g_root_url}/modules/system_check/global/css/styles.css">
<script>
g.messages = [];
g.messages["word_testing_c"] = "{$L["word_testing_c"]}";
g.messages["word_untested"] = "$word_testing_uc";
g.messages["word_passed"] = "$word_passed_uc";
g.messages["word_failed"] = "$word_failed_uc";
g.messages["phrase_missing_table_c"] = "{$L["phrase_missing_table_c"]}";
g.messages["phrase_missing_column_c"] = "{$L["phrase_missing_column_c"]}";
g.messages["phrase_table_looks_good_c"] = "{$L["phrase_table_looks_good_c"]}";
g.messages["phrase_invalid_column_c"] = "{$L["phrase_invalid_column_c"]}";
g.messages["text_tables_test"] = "{$L["text_tables_test"]}";
g.messages["notify_test_complete_problems"] = "{$L["notify_test_complete_problems"]}";
g.messages["notify_test_complete_no_problems"] = "{$L["notify_test_complete_no_problems"]}";
g.messages["validation_no_components_selected"] = "{$L["validation_no_components_selected"]}";

var loading = new Image();
loading.src = "$g_root_url/modules/system_check/images/loading.gif";
</script>
EOF;

ft_display_module_page("templates/tables.tpl", $page_vars);
