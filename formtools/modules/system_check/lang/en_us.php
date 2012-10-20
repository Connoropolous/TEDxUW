<?php

$L = array();
$L["module_name"] = "System Check";
$L["module_description"] = "This replaces the older Database Integrity module. It offers various tests to analyze and repair your Form Tools installation.";

$L["word_untested"] = "Untested";
$L["word_testing_c"] = "Testing: ";
$L["word_help"] = "Help";
$L["word_component"] = "Component";
$L["word_passed"] = "Passed";
$L["word_failed"] = "Failed";
$L["word_result"] = "Result";
$L["word_summary"] = "Summary";
$L["word_installed"] = "Installed";
$L["word_available"] = "Available";

$L["phrase_missing_table_c"] = "missing table: ";
$L["phrase_missing_column_c"] = "missing column: ";
$L["phrase_table_looks_good_c"] = "Table and columns look good: ";
$L["phrase_invalid_column_c"] = "Invalid column: ";
$L["phrase_full_logs"] = "Full Logs";
$L["phrase_error_logs"] = "Error Logs";
$L["phrase_hook_verification"] = "Hook Verification";
$L["phrase_table_verification"] = "Table Verification";
$L["phrase_test_selected_components"] = "Test Selected Components &raquo;";
$L["phrase_file_verification"] = "File Verification";
$L["phrase_component_type"] = "Component Type";
$L["phrase_uses_hooks_q"] = "Uses Hooks?";
$L["phrase_nothing_to_test"] = "nothing to test";
$L["phrase_has_tables_q"] = "Has Tables?";
$L["phrase_orphan_clean_up"] = "Orphan Clean-up";
$L["phrase_run_test"] = "Run Test";
$L["phrase_form_integrity_check"] = "Form Integrity Check";
$L["phrase_environment_info"] = "Environment Info";
$L["phrase_not_installed"] = "Not Installed";
$L["phrase_not_available"] = "Not Available";
$L["phrase_environment_overview"] = "Environment Overview";
$L["phrase_php_sessions"] = "PHP Sessions";
$L["phrase_suhosin_extension"] = "Suhosin Extension";
$L["phrase_curl_extension"] = "Curl Extension";
$L["phrase_simplexml_extension"] = "SimpleXML Extension";

$L["text_tables_test"] = "The following tables will be tested to confirm they exist, and that the column information is valid.";
$L["text_module_intro"] = "This module lets you run tests on your Form Tools installation to look for potential problems. Choose one of the tests below.";
$L["text_table_verification_intro"] = "This examines and verifies the existence and structure of your Core database tables and any compatible modules.";
$L["text_hook_verification_intro"] = "Modules interact with the Core script through <i>hooks</i>. They attach their own functionality to act at particular junctions in the code. If this gets corrupted, it can prevent the module from working properly. This test examines your database to confirm that the hooks for all your modules are configured properly.";
$L["text_problems_identified_and_fixed"] = "Problems are both identified and fixed.";
$L["text_problems_identified_not_fixed"] = "Problems are only identified, not fixed.";
$L["text_help"] = "For more information on this module, please see the <a href=\"http://modules.formtools.org/system_check/\" target=\"_blank\">help documentation</a> on the Form Tools site.";
$L["text_file_check"] = "This examines all compatible components (Core, modules and themes) to confirm that the component's files exist.";
$L["text_file_verification_intro"] = "This checks over your Core, modules and themes to confirm that all the necessary files have been uploaded properly. If any are missing, you will need to re-download the appropriate component and upload them to your server.";
$L["text_orphan_record_check_intro"] = "This is a house-keeping test to examine the Core database tables for any unwanted orphaned records and references. Orphaned records are database entries that are no longer needed and should have been deleted along with their \"parents\". For example, when you delete a form, any references to that form ID should also be deleted. Orphaned records shouldn't cause problems, but add unnecessary clutter to your database. <b>If this test finds anything, we'd appreciate it if you <a href=\"http://forums.formtools.org/\">report them in the forums</a>!</b>";
$L["text_orphan_desc_short"] = "A housekeeping test to identify and remove old database records and references that are no longer needed and should have been deleted.";
$L["text_environment_overview_summary"] = "This section below contains a report of key information about your Form Tools installation and environment, which can be helpful when reporting bugs.";

$L["notify_test_complete_problems"] = "The test is complete. We found a problem with one or more of your installed components.";
$L["notify_test_complete_no_problems"] = "The test is complete. No problems were found.";
$L["notify_hook_verification_no_supported_modules"] = "None of your modules currently support this feature.";
$L["notify_hook_verification_note"] = "Please note: if problems are found by this step, they can only be automatically repaired if there were no problems in the [prefix]hook_calls Core table. The <a href=\"tables.php\">Table Verification</a> test will tell you whether or not that table has problems.";
$L["notify_hook_verification_complete_problems"] = "The test is complete. We found a problem with one or more of your module hooks. <a href=\"#\" id=\"repair_hooks\">Click here</a> to repair the hooks for the affected modules.";
$L["notify_module_hooks_reset"] = "The modules have been repaired and their hook calls have been reset. Please re-run the test below to confirm there are no longer any problems.";
$L["notify_problems_resetting_module_hooks"] = "There was a problem resetting the module hooks. This is most likely caused by an error in the form of your hook_calls table. Please run the Table Verification step to check.";
$L["notify_file_verification_complete_problems"] = "One or more of your components is missing some files. You will need to download those version and FTP the missing files to your server.";

$L["validation_no_components_selected"] = "Please select one or more components to test.";