<?php

$HOOKS = array();
$HOOKS["1.0.6"] = array(
  array(
    "hook_type"       => "template",
    "action_location" => "head_bottom",
    "function_name"   => "",
    "hook_function"   => "tinymce_include_files",
    "priority"        => "50"
  )
);