<?php

$STRUCTURE = array();
$STRUCTURE["tables"] = array();
$STRUCTURE["tables"]["module_swift_mailer_email_template_fields"] = array(
  array(
    "Field"   => "email_template_id",
    "Type"    => "mediumint(9)",
    "Null"    => "NO",
    "Key"     => "PRI",
    "Default" => ""
  ),
  array(
    "Field"   => "return_path",
    "Type"    => "varchar(255)",
    "Null"    => "NO",
    "Key"     => "",
    "Default" => ""
  )
);

$HOOKS = array();
$HOOKS["1.1.1"] = array(
  array(
    "hook_type"       => "template",
    "action_location" => "edit_template_tab2",
    "function_name"   => "",
    "hook_function"   => "swift_display_extra_fields_tab2",
    "priority"        => "50"
  ),
  array(
    "hook_type"       => "code",
    "action_location" => "end",
    "function_name"   => "ft_create_blank_email_template",
    "hook_function"   => "swift_map_email_template_field",
    "priority"        => "50"
  ),
  array(
    "hook_type"       => "code",
    "action_location" => "end",
    "function_name"   => "ft_delete_email_template",
    "hook_function"   => "swift_delete_email_template_field",
    "priority"        => "50"
  ),
  array(
    "hook_type"       => "code",
    "action_location" => "end",
    "function_name"   => "ft_update_email_template",
    "hook_function"   => "swift_update_email_template_append_extra_fields",
    "priority"        => "50"
  ),
  array(
    "hook_type"       => "code",
    "action_location" => "end",
    "function_name"   => "ft_get_email_template",
    "hook_function"   => "swift_get_email_template_append_extra_fields",
    "priority"        => "50"
  )
);