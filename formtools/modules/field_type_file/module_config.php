<?php

$STRUCTURE = array();
$HOOKS = array(
  array(
    "hook_type"       => "code",
    "action_location" => "manage_files",
    "function_name"   => "ft_update_submission",
    "hook_function"   => "ft_file_update_submission_hook",
    "priority"        => "50"
  ),
  array(
    "hook_type"       => "code",
    "action_location" => "manage_files",
    "function_name"   => "ft_process_form",
    "hook_function"   => "ft_file_process_form_hook",
    "priority"        => "50"
  ),
  array(
    "hook_type"       => "code",
    "action_location" => "manage_files",
    "function_name"   => "ft_api_process_form",
    "hook_function"   => "ft_file_api_process_form_hook",
    "priority"        => "50"
  ),
  array(
    "hook_type"       => "code",
    "action_location" => "start",
    "function_name"   => "ft_delete_submission_files",
    "hook_function"   => "ft_file_delete_submissions_hook",
    "priority"        => "50"
  ),
  array(
    "hook_type"       => "code",
    "action_location" => "start",
    "function_name"   => "ft_get_uploaded_files",
    "hook_function"   => "ft_file_get_uploaded_files_hook",
    "priority"        => "50"
  ),
  array(
    "hook_type"       => "template",
    "action_location" => "head_bottom",
    "function_name"   => "",
    "hook_function"   => "ft_file_include_js",
    "priority"        => "50"
  ),
  array(
    "hook_type"       => "template",
    "action_location" => "standalone_form_fields_head_bottom",
    "function_name"   => "",
    "hook_function"   => "ft_file_include_standalone_js",
    "priority"        => "50"
  )
);
$FILES = array(
  "actions.php",
  "database_integrity.php",
  "images/",
  "images/file_upload_icon.png",
  "images/index.html",
  "index.php",
  "lang/",
  "lang/en_us.php",
  "lang/index.html",
  "library.php",
  "module.php",
  "module_config.php",
  "scripts/",
  "scripts/edit_submission.js",
  "scripts/index.html",
  "scripts/standalone.js",
  "templates/",
  "templates/index.tpl",
  "templates/index.html"
);