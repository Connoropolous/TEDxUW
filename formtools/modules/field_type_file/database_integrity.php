<?php

$HOOKS = array();
$HOOKS["1.0.7"] = array(
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
  )
);