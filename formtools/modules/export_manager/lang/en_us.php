<?php

/*
 Form Tools - Module Language File
 ---------------------------------

 File created: Oct 24th, 2:46 AM

 If you would like to help translate this module, please visit:
 http://www.formtools.org/translations/
 */

$L = array();

// required fields
$L["module_name"] = "Export Manager";
$L["module_description"] = "Define your own ways of exporting form submission data for view / download. Excel, Printer-friendly HTML, XML and CSV are included by default.";

// custom fields
$L["word_help"] = "Help";
$L["word_filename"] = "Filename";
$L["word_icon"] = "Icon";
$L["word_none"] = "None";
$L["word_action"] = "Action";
$L["word_headers"] = "Headers";
$L["word_excel"] = "Excel";
$L["word_generate"] = "Generate";
$L["word_welcome"] = "Welcome!";
$L["word_csv"] = "CSV";
$L["word_xml"] = "XML";
$L["word_settings"] = "Settings";
$L["word_visibility"] = "Visibility";
$L["word_height_c"] = "Height";
$L["word_width_c"] = "Width";
$L["word_export"] = "Export";

$L["phrase_html_printer_friendly"] = "HTML / Printer-friendly";
$L["phrase_add_export_type"] = "Add Export Type";
$L["phrase_add_export_group"] = "Add Export Group";
$L["phrase_how_it_works"] = "How it Works";
$L["phrase_filename_placeholders"] = "Filename Placeholders";
$L["phrase_export_groups"] = "Export Groups";
$L["phrase_export_group"] = "Export Group";
$L["phrase_export_group_name"] = "Export Group Name";
$L["phrase_smarty_template"] = "Smarty Template";
$L["phrase_admin_export_only"] = "Only the administrator may use this export type";
$L["phrase_export_type_name"] = "Export type name";
$L["phrase_view_available_placeholders"] = "view available placeholders";
$L["phrase_generate_file"] = "Generate a file on the server";
$L["phrase_display_popup"] = "Display in popup";
$L["phrase_printer_friendly"] = "Printer-friendly";
$L["phrase_edit_export_group"] = "Edit Export Group";
$L["phrase_open_in_new_window"] = "Open in a new window";
$L["phrase_edit_export_type"] = "Edit Export Type";
$L["phrase_export_group"] = "Export Group";
$L["phrase_update_export_type"] = "Update Export Type";
$L["phrase_action_button_text"] = "Action Button Text";
$L["phrase_export_types"] = "Export Types";
$L["phrase_export_type"] = "Export Type";
$L["phrase_num_export_types"] = "Num Export Types";
$L["phrase_table_format"] = "Table format";
$L["phrase_one_by_one"] = "One by one";
$L["phrase_one_submission_per_page"] = "One submission per page";
$L["phrase_export_type_id"] = "Export Type ID";
$L["phrase_generate_files_folder_path"] = "Generated files folder path";
$L["phrase_generate_files_folder_url"] = "Generated files folder URL";
$L["phrase_cache_multi_select_fields"] = "Cache multi-select field values for duration of session";
$L["phrase_reset_defaults"] = "Reset to Defaults";

$L["notify_no_export_groups"] = "There are currently no export groups. Click the button below to add a new one.";
$L["notify_no_export_types"] = "There are currently no export types defined in the database. Click the button below to add a new one.";
$L["notify_export_group_added"] = "The export group has been added.";
$L["notify_export_group_updated"] = "The export group has been updated.";
$L["notify_export_group_deleted"] = "The export group has been deleted.";
$L["notify_export_type_deleted"] = "The export type has been deleted.";
$L["notify_export_type_updated"] = "The export type has been updated.";
$L["notify_export_type_added"] = "The export type has been added.";
$L["notify_export_group_reordered"] = "The export groups have been re-ordered.";
$L["notify_export_types_reordered"] = "The export types have been re-ordered.";
$L["notify_no_export_types"] = "This group doesn't have any export types. Click the button below to add one.";
$L["notify_settings_updated"] = "The settings have been updated.";
$L["notify_export_incomplete_fields"] = "Sorry, the export script didn't receive all the required fields and cannot proceed.";
$L["notify_export_type_visibility"] = "This export type will only be displayed if the export group is visible as well!";
$L["notify_filename_explanation"] = "This is only applicable for generated files, or export groups that define headers that prompt a file download. See the <a href=\"http://modules.formtools.org/export_manager/documentation.php?page=filename_placeholders\">user documentation</a> for a list of available placeholders.";
$L["notify_file_generated"] = "The file has been generated. <a href='{\$url}' target='_blank'>Click here</a> to view the file.";
$L["notify_file_not_generated"] = "We were unable to create a file at this location: <b>{\$url}</b> (folder: <b>{\$folder}</b>). The most likely cause for this is that the folder specified in the <a href='{\$export_manager_settings_link}'>Export Manager &raquo; Settings</a> page is incorrect or doesn't have write permissions.";
$L["notify_installation_problem_c"] = "There was a problem creating the tables/data for this module. Please report the following error in the forums: ";
$L["notify_reset_to_default"] = "Your Export Manager configuration has now been reset to the defaults.";

$L["confirm_delete_export_group"] = "Are you sure you want to delete this export group?";
$L["confirm_delete_export_type"] = "Are you sure you want to delete this export type?";

$L["text_export_group_summary"] = "Add the new export group below. After this step you will be able to edit all aspects of the new export group.";
$L["text_export_manager_intro"] = "Welcome to the Export Manager module! This module lets you control the various ways in which your form submissions can be viewed and downloaded.";
$L["text_help_link"] = "For help on how to use this module, please see the <a href=\"http://modules.formtools.org/export_manager/documentation.php\">module help documentation</a>.";
$L["text_reset_defaults"] = "This page lets you reset all the configurations for the Export Manager's export groups and types. This is convenient if you've accidentally broken something. If you're upgrading to 2.1.0, resetting to the defaults is <b>required</b> because earlier export type code is no longer compatible. Please note that any client permissions will be lost by resetting to the defaults here.";

$L["validation_select_rows_to_export"] = "Please select those rows you would like to export.";
$L["validation_no_export_group_name"] = "Please enter the export group name.";
