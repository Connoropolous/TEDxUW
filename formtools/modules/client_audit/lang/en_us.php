<?php

$L = array();

// required fields
$L["module_name"] = "Client Audit";
$L["module_description"] = "This module keeps a paper trail of changes to all client accounts, from the moment they were created until they were deleted. It tracks all logins, logout, permission changes and account updates, which can helpful for security auditing purposes. It also provides a simple UI to browse all changes.";


$L["word_help"] = "Help";
$L["word_events"] = "Events";
$L["word_dates"] = "Dates";
$L["word_range"] = "Range";
$L["word_to_c"] = "To:";
$L["word_event"] = "Event";
$L["word_details"] = "Details";
$L["word_changes"] = "Changes";

$L["phrase_all_change_types"] = "All change types";
$L["phrase_clear_logs"] = "Clear Logs";
$L["phrase_client_account"] = "Client account";
$L["phrase_current_clients"] = "Current clients";
$L["phrase_deleted_clients"] = "Deleted clients";
$L["phrase_account_created"] = "Account created";
$L["phrase_account_deleted"] = "Account deleted";
$L["phrase_permissions_updated"] = "Permissions updated";
$L["phrase_account_updated_by_client"] = "Account updated by client";
$L["phrase_account_updated_by_admin"] = "Account updated by admin";
$L["phrase_account_disabled_failed_logins"] = "Account disabled after failed logins";
$L["phrase_all_dates"] = "All dates";
$L["phrase_permissions_updated"] = "Permissions updated";
$L["phrase_updated_by_admin"] = "Updated by admin";
$L["phrase_updated_by_client"] = "Updated by client";
$L["phrase_account_created"] = "Account created";
$L["phrase_account_deleted"] = "Account deleted";
$L["phrase_delete_selected_rows"] = "Delete selected rows";
$L["phrase_all_views"] = "All views";
$L["phrase_other_changed_settings"] = "Other Changed Settings";
$L["phrase_account_status"] = "Account Status";
$L["phrase_change_date"] = "Change Date";
$L["phrase_change_type"] = "Change Type";
$L["phrase_delete_all_results"] = "Delete all results in current search";

$L["notify_no_activity"] = "There hasn't been any activity logged on any of the client accounts yet.";
$L["notify_changes_deleted"] = "The selected rows have been deleted.";
$L["notify_problem_installing"] = "There following error occurred when trying to create the database tables for this module: <b>{\$error}</b>";
$L["notify_no_results"] = "No results found. Try broadening your search criteria.";

$L["text_help1"] = "This module track a variety of activities on your client accounts. Even though it's not exhaustive, it can provide a useful paper trail for security purposes.";
$L["text_help2"] = "Here's the full list of events that are logged:";
$L["text_help3"] = "When the client logs in and out";
$L["text_help4"] = "When the account is created and deleted";
$L["text_help5"] = "When the account is automatically disabled after a series of failed login attempts";
$L["text_help6"] = "When the client and administrator updates the account information - and what information has changed between edits";
$L["text_help7"] = "For more in-depth information on this module, please see the online <a href=\"http://modules.formtools.org/client_audit/\">help documentation</a>.";

$L["text_details_desc"] = "The highlighted rows indicate that the value of that field was updated in this change.";
$L["text_permissions_desc"] = "Forms / Views highlighted in red indicate that this form / View is no longer accessible by this client. Form / Views highlighed in green indicate that they have been given permission to access.";

$L["confirm_delete_rows"] = "Are you sure you want to delete these rows?";

$L["validation_no_rows_selected"] = "Please select one or more rows to delete.";
