<?php

require_once("../../global/library.php");
ft_init_module_page();

if (isset($_GET["clean"]))
{
	list($g_success, $g_message) = sc_clean_orphans();
}

$word_testing_uc = mb_strtoupper($L["word_untested"]);
$word_passed_uc  = mb_strtoupper($L["word_passed"]);
$word_failed_uc  = mb_strtoupper($L["word_failed"]);
$notify_hook_verification_complete_problems = ft_sanitize($L["notify_hook_verification_complete_problems"]);

$page_vars = array();
$page_vars["module_list"] = sc_get_compatible_modules("hooks");

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
g.messages["notify_hook_verification_complete_problems"] = "$notify_hook_verification_complete_problems";

var loading = new Image();
loading.src = "$g_root_url/modules/system_check/images/loading.gif";
$(function() {
  $("#repair_hooks").live("click", function() {
    window.location = "hooks.php?repair=" + sc_ns.hook_verification_failed_module_ids.toString();
  });
});
</script>
EOF;

ft_display_module_page("templates/orphans.tpl", $page_vars);