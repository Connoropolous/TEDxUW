<?php

require_once("../../global/library.php");
ft_init_module_page();

$settings = ft_get_settings();
$core_version = ($settings["release_type"] == "beta") ? "{$settings["program_version"]}-beta-{$settings["release_date"]}" : $settings["program_version"];

$word_testing_uc = mb_strtoupper($L["word_untested"]);
$word_passed_uc  = mb_strtoupper($L["word_passed"]);
$word_failed_uc  = mb_strtoupper($L["word_failed"]);
$notify_file_verification_complete_problems = ft_sanitize($L["notify_file_verification_complete_problems"]);

$page_vars = array();
$page_vars["core_version"] = $core_version;
$page_vars["module_list"] = sc_get_compatible_modules("files");
$page_vars["theme_list"] = sc_get_compatible_themes();
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
g.messages["notify_file_verification_complete_problems"] = "$notify_file_verification_complete_problems";
var loading = new Image();
loading.src = "$g_root_url/modules/system_check/images/loading.gif";
</script>
EOF;

ft_display_module_page("templates/files.tpl", $page_vars);
