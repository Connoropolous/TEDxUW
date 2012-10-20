<?php


/**
 * Our installation function. This adds the required data to the field types and field settings tables for
 * the field to become immediately usable.
 *
 * @param integer $module_id
 */
function field_type_tinymce__install($module_id)
{
  global $g_table_prefix, $LANG;

  // check it's not already installed (i.e. check for the unique field type identifier)
  $field_type_info = ft_get_field_type_by_identifier("tinymce");
  if (!empty($field_type_info))
  {
  	return array(false, $LANG["notify_module_already_installed"]);
  }

  // find the LAST field type group. Most installations won't have the Custom Fields module installed so
  // the last group will always be "Special Fields". For installations that DO, and that it's been customized,
  // the user can always move this new field type to whatever group they want. Plus, this module will be
  // installed by default, so it's almost totally moot
  $query = mysql_query("
    SELECT group_id
    FROM   {$g_table_prefix}list_groups
    WHERE  group_type = 'field_types'
    ORDER BY list_order DESC
    LIMIT 1
  ");
  $result = mysql_fetch_assoc($query);
  $group_id = $result["group_id"]; // assumption: there's at least one field type group

  // now find out how many field types there are in the group so we can add the row with the correct list order
  $count_query = mysql_query("SELECT count(*) as c FROM {$g_table_prefix}field_types WHERE group_id = $group_id");
  $count_result = mysql_fetch_assoc($count_query);
  $next_list_order = $count_result["c"] + 1;

  $query = mysql_query("
    INSERT INTO {$g_table_prefix}field_types (is_editable, non_editable_info,
      managed_by_module_id, field_type_name, field_type_identifier, group_id, is_file_field, is_date_field, raw_field_type_map,
      raw_field_type_map_multi_select_id, list_order, compatible_field_sizes,
      view_field_rendering_type, view_field_php_function_source, view_field_php_function,
      view_field_smarty_markup, edit_field_smarty_markup, php_processing, resources_css, resources_js)
    VALUES ('no', 'This module may only be edited via the tinyMCE module.', $module_id, '{\$LANG.word_wysiwyg}', 'tinymce', $group_id,
    'no', 'no', 'textarea', NULL, $next_list_order, 'large,very_large', 'smarty', 'core', '',
    '{if \$CONTEXTPAGE == \"edit_submission\"}\r\n  {\$VALUE}\r\n{elseif \$CONTEXTPAGE == \"submission_listing\"}\r\n  {\$VALUE|strip_tags}\r\n{else}\r\n  {\$VALUE|nl2br}\r\n{/if}',
    '<textarea name=\"{\$NAME}\" id=\"cf_{\$NAME}_id\" class=\"cf_tinymce\">{\$VALUE}</textarea>\r\n<script>\r\ncf_tinymce_settings[\"{\$NAME}\"] = {literal}{{/literal}\r\n{if \$toolbar == \"basic\"}\r\n  theme_advanced_buttons1: \"bold,italic,underline,strikethrough,|,bullist,numlist\",\r\n  theme_advanced_buttons2: \"\",\r\n{elseif \$toolbar == \"simple\"}\r\n  theme_advanced_buttons1: \"bold,italic,underline,strikethrough,|,bullist,numlist,|,outdent,indent,|,blockquote,hr,|,link,unlink,forecolorpicker,backcolorpicker\",\r\n  theme_advanced_buttons2: \"\",\r\n{elseif \$toolbar == \"advanced\"}\r\n  theme_advanced_buttons1: \"bold,italic,underline,strikethrough,|,bullist,numlist,|,outdent,indent,|,blockquote,hr,|,undo,redo,link,unlink,|,fontselect,fontsizeselect\",\r\n  theme_advanced_buttons2: \"forecolorpicker,backcolorpicker,|,sub,sup,code\",\r\n{elseif \$toolbar == \"expert\"}\r\n  theme_advanced_buttons1 : \"bold,italic,underline,strikethrough,|,bullist,numlist,|,outdent,indent,|,blockquote,hr,|,undo,redo,link,unlink,|,formatselect,fontselect,fontsizeselect\",\r\n  theme_advanced_buttons1 : \"bold,italic,underline,strikethrough,|,bullist,numlist,|,outdent,indent,|,blockquote,hr,|,undo,redo,link,unlink,|,formatselect,fontselect,fontsizeselect\",\r\n  theme_advanced_buttons2 : \"undo,redo,|,forecolorpicker,backcolorpicker,|,sub,sup,|,newdocument,blockquote,charmap,removeformat,cleanup,code\",\r\n{/if}\r\n  theme_advanced_buttons3: \"\",\r\n{if \$show_path == \"yes\"}\r\n  theme_advanced_path_location:     \"{\$path_info_location}\",\r\n  theme_advanced_resizing:          {\$resizing},\r\n{/if}\r\n  theme_advanced_resize_horizontal: false,\r\n  theme_advanced_toolbar_location:  \"{\$location}\",\r\n  theme_advanced_toolbar_align:     \"{\$alignment}\"  \r\n{literal}}{/literal}\r\n</script>\r\n{if \$comments}\r\n  <div class=\"cf_field_comments\">{\$comments}</div>\r\n{/if}\r\n',
    '', 'body .defaultSkin table.mceLayout { border-width: 0px }\r\nbody .defaultSkin table.mceLayout tr.mceFirst td { border-top: 0px; }\r\nbody .defaultSkin .mceToolbar { height: 21px; }\r\nbody .defaultSkin td.mceToolbar { padding-top: 0px; }',
    '// this is populated by each tinyMCE WYWISYG with their settings on page load\r\nvar cf_tinymce_settings = {};\r\n\r\n$(function() {\r\n  $(''textarea.cf_tinymce'').each(function() {\r\n    var field_name = $(this).attr(\"name\");\r\n    var settings   = cf_tinymce_settings[field_name];\r\n    settings.script_url = g.root_url + \"/modules/field_type_tinymce/tinymce/tiny_mce.js\";\r\n    settings.theme = \"advanced\",\r\n    $(this).tinymce(settings);\r\n  });\r\n});\r\n\r\ncf_tinymce_settings.check_required = function() {\r\n  var errors = [];\r\n  for (var i=0; i<rsv_custom_func_errors.length; i++) {\r\n    if (rsv_custom_func_errors[i].func != \"cf_tinymce_settings.check_required\") {\r\n      continue;\r\n    }\r\n    var field_name = rsv_custom_func_errors[i].field;\r\n    var val = $.trim(tinyMCE.get(\"cf_\" + field_name + \"_id\").getContent());\r\n    if (!val) {\r\n      var el = document.edit_submission_form[field_name];\r\n      errors.push([el, rsv_custom_func_errors[i].err]);\r\n    }\r\n  }\r\n  if (errors.length) {\r\n    return errors;\r\n  }\r\n  return true; \r\n}')
	") or die(mysql_error());

  $field_type_id = mysql_insert_id();


  // the validation rule
  mysql_query("
    INSERT INTO {$g_table_prefix}field_type_validation_rules (field_type_id, rsv_rule, rule_label, rsv_field_name,
  	  custom_function, custom_function_required, default_error_message, list_order)
  	VALUES ($field_type_id, 'function', '{\$LANG.word_required}', '', 'cf_tinymce_settings.check_required', 'yes',
  	  '{\$LANG.validation_default_rule_required}', 1)
  ");

  // now insert the settings and their options

  // 1. Toolbar type
  $query = mysql_query("
    INSERT INTO {$g_table_prefix}field_type_settings (field_type_id, field_label, field_setting_identifier, field_type,
      field_orientation, default_value, list_order)
    VALUES ($field_type_id, 'Toolbar', 'toolbar', 'select', 'na', 'simple', 1)
  ");
  $setting_id = mysql_insert_id();
  $query = mysql_query("
    INSERT INTO {$g_table_prefix}field_type_setting_options (setting_id, option_text, option_value, option_order, is_new_sort_group)
    VALUES
      ($setting_id, 'Basic', 'basic', 1, 'yes'),
      ($setting_id, 'Simple', 'simple', 2, 'yes'),
      ($setting_id, 'Advanced', 'advanced', 3, 'yes'),
      ($setting_id, 'Expert', 'expert', 4, 'yes')");

  // 2. Toolbar location
  $query = mysql_query("
    INSERT INTO {$g_table_prefix}field_type_settings (field_type_id, field_label, field_setting_identifier, field_type,
      field_orientation, default_value, list_order)
    VALUES ($field_type_id, 'Toolbar Location', 'location', 'radios', 'horizontal', 'top', 2)
  ");
  $setting_id = mysql_insert_id();
  $query = mysql_query("
    INSERT INTO {$g_table_prefix}field_type_setting_options (setting_id, option_text, option_value, option_order, is_new_sort_group)
    VALUES ($setting_id, 'Top', 'top', 1, 'yes'),
           ($setting_id, 'Bottom', 'bottom', 2, 'yes')
  ");

  // 3. Toolbar Alignment
  $query = mysql_query("
    INSERT INTO {$g_table_prefix}field_type_settings (field_type_id, field_label, field_setting_identifier, field_type,
      field_orientation, default_value, list_order)
    VALUES ($field_type_id, 'Toolbar Alignment', 'alignment', 'radios', 'horizontal', 'left', 3)
  ");
  $setting_id = mysql_insert_id();
  $query = mysql_query("
    INSERT INTO {$g_table_prefix}field_type_setting_options (setting_id, option_text, option_value, option_order, is_new_sort_group)
    VALUES
      ($setting_id, 'Right', 'right', 3, 'yes'),
      ($setting_id, 'Center', 'center', 2, 'yes'),
      ($setting_id, 'Left', 'left', 1, 'yes')
  ");

  // 4. Show Path Information
  $query = mysql_query("
    INSERT INTO {$g_table_prefix}field_type_settings (field_type_id, field_label, field_setting_identifier, field_type,
      field_orientation, default_value, list_order)
    VALUES ($field_type_id, 'Show Path Information', 'show_path', 'radios', 'horizontal', 'yes', 4)
  ");
  $setting_id = mysql_insert_id();
  $query = mysql_query("
    INSERT INTO {$g_table_prefix}field_type_setting_options (setting_id, option_text, option_value, option_order, is_new_sort_group)
    VALUES
      ($setting_id, 'Yes', 'yes', 1, 'yes'),
      ($setting_id, 'No', 'no', 2, 'yes')
  ");

  // 5. Path Information Location
  $query = mysql_query("
    INSERT INTO {$g_table_prefix}field_type_settings (field_type_id, field_label, field_setting_identifier, field_type,
      field_orientation, default_value, list_order)
    VALUES ($field_type_id, '- Path Information Location', 'path_info_location', 'radios', 'horizontal', 'bottom', 5)
  ");
  $setting_id = mysql_insert_id();
  $query = mysql_query("
    INSERT INTO {$g_table_prefix}field_type_setting_options (setting_id, option_text, option_value, option_order, is_new_sort_group)
    VALUES
      ($setting_id, 'Bottom', 'bottom', 2, 'yes'),
      ($setting_id, 'Top', 'top', 1, 'yes')
  ");

  // 6. Allow Toolbar Resizing
  $query = mysql_query("
    INSERT INTO {$g_table_prefix}field_type_settings (field_type_id, field_label, field_setting_identifier, field_type,
      field_orientation, default_value, list_order)
    VALUES ($field_type_id, '- Allow Toolbar Resizing', 'resizing', 'radios', 'horizontal', 'true', 6)
  ");
  $setting_id = mysql_insert_id();
  $query = mysql_query("
    INSERT INTO {$g_table_prefix}field_type_setting_options (setting_id, option_text, option_value, option_order, is_new_sort_group)
    VALUES ($setting_id, 'Yes', 'true', 1, 'yes')
  ");

  // 7. Field Comments
  $query = mysql_query("
    INSERT INTO {$g_table_prefix}field_type_settings (field_type_id, field_label, field_setting_identifier, field_type,
      field_orientation, default_value, list_order)
    VALUES ($field_type_id, 'Field Comments', 'comments', 'textarea', 'na', '', 7)
  ");

  field_type_tinymce_reset_hooks();

  return array(true, "");
}


/**
 * Uninstallation completely removes the field type. It also changes the field type ID from any WYSIWYG fields
 * to a generic textarea.
 *
 * @param integer $module_id
 */
function field_type_tinymce__uninstall($module_id)
{
  global $g_table_prefix;

  $field_type_info = ft_get_field_type_by_identifier("tinymce");

  if (!empty($field_type_info))
  {
    $field_type_id = $field_type_info["field_type_id"];
    mysql_query("DELETE FROM {$g_table_prefix}field_type_settings WHERE field_type_id = $field_type_id");
    mysql_query("DELETE FROM {$g_table_prefix}field_types WHERE field_type_id = $field_type_id");

    // now do cleanup on the fields: all tinyMCE fields should now be textareas. Drop all custom settings
    $setting_ids = array();
    foreach ($field_type_info["settings"] as $setting_info)
      $setting_ids[] = $setting_info["setting_id"];

    $setting_id_str = implode(",", $setting_ids);
    mysql_query("DELETE FROM {$g_table_prefix}field_setting_options WHERE setting_id IN ($setting_id_str)");
    mysql_query("DELETE FROM {$g_table_prefix}field_settings WHERE setting_id IN ($setting_id_str)");

    // now set all fields to textareas. If the administrator has gone wild with the Custom Fields module and deleted the
    // textarea field type, it falls back on the generic input field (which cannot be edited at all)
    $textarea_field_type_info = ft_get_field_type_by_identifier("textarea");
    $new_field_type_id = "";
    if (isset($textarea_field_type_info["field_type_id"]) && is_numeric($textarea_field_type_info["field_type_id"]))
      $new_field_type_id = $textarea_field_type_info["field_type_id"];
    else
    {
      $input_field_type_info = ft_get_field_type_by_identifier("textbox");
      $new_field_type_id = $input_field_type_info["field_type_id"];
    }

    mysql_query("UPDATE {$g_table_prefix}form_fields SET field_type_id = $new_field_type_id WHERE field_type_id = $field_type_id");
  }

  return array(true, "");
}


function field_type_tinymce__upgrade($old_version, $new_version)
{
  global $g_table_prefix;

  $old_version_info = ft_get_version_info($old_version);
  $new_version_info = ft_get_version_info($new_version);

  $field_type_id = ft_get_field_type_id_by_identifier("tinymce");

  if ($old_version_info["release_date"] < 20110526)
  {
    mysql_query("
      UPDATE {$g_table_prefix}field_types
      SET    view_field_smarty_markup =  '{if \$CONTEXTPAGE == \"edit_submission\"}\r\n  {\$VALUE}\r\n{elseif \$CONTEXTPAGE == \"submission_listing\"}\r\n  {\$VALUE|strip_tags}\r\n{else}\r\n  {\$VALUE|nl2br}\r\n{/if}'
      WHERE  field_type_identifier = 'tinymce'
    ");
  }

  if ($old_version_info["release_date"] < 2011107)
  {
    mysql_query("
      UPDATE {$g_table_prefix}field_types
      SET    edit_field_smarty_markup = '<textarea name=\"{\$NAME}\" id=\"cf_{\$NAME}_id\" class=\"cf_tinymce\">{\$VALUE}</textarea>\r\n<script>\r\ncf_tinymce_settings[\"{\$NAME}\"] = {literal}{{/literal}\r\n{if \$toolbar == \"basic\"}\r\n  theme_advanced_buttons1: \"bold,italic,underline,strikethrough,|,bullist,numlist\",\r\n  theme_advanced_buttons2: \"\",\r\n{elseif \$toolbar == \"simple\"}\r\n  theme_advanced_buttons1: \"bold,italic,underline,strikethrough,|,bullist,numlist,|,outdent,indent,|,blockquote,hr,|,link,unlink,forecolorpicker,backcolorpicker\",\r\n  theme_advanced_buttons2: \"\",\r\n{elseif \$toolbar == \"advanced\"}\r\n  theme_advanced_buttons1: \"bold,italic,underline,strikethrough,|,bullist,numlist,|,outdent,indent,|,blockquote,hr,|,undo,redo,link,unlink,|,fontselect,fontsizeselect\",\r\n  theme_advanced_buttons2: \"forecolorpicker,backcolorpicker,|,sub,sup,code\",\r\n{elseif \$toolbar == \"expert\"}\r\n  theme_advanced_buttons1 : \"bold,italic,underline,strikethrough,|,bullist,numlist,|,outdent,indent,|,blockquote,hr,|,undo,redo,link,unlink,|,formatselect,fontselect,fontsizeselect\",\r\n  theme_advanced_buttons1 : \"bold,italic,underline,strikethrough,|,bullist,numlist,|,outdent,indent,|,blockquote,hr,|,undo,redo,link,unlink,|,formatselect,fontselect,fontsizeselect\",\r\n  theme_advanced_buttons2 : \"undo,redo,|,forecolorpicker,backcolorpicker,|,sub,sup,|,newdocument,blockquote,charmap,removeformat,cleanup,code\",\r\n{/if}\r\n  theme_advanced_buttons3: \"\",\r\n{if \$show_path == \"yes\"}\r\n  theme_advanced_path_location:     \"{\$path_info_location}\",\r\n  theme_advanced_resizing:          {\$resizing},\r\n{/if}\r\n  theme_advanced_resize_horizontal: false,\r\n  theme_advanced_toolbar_location:  \"{\$location}\",\r\n  theme_advanced_toolbar_align:     \"{\$alignment}\"  \r\n{literal}}{/literal}\r\n</script>\r\n{if \$comments}\r\n  <div class=\"cf_field_comments\">{\$comments}</div>\r\n{/if}\r\n',
             resources_js = '// this is populated by each tinyMCE WYWISYG with their settings on page load\r\nvar cf_tinymce_settings = {};\r\n\r\n$(function() {\r\n  $(''textarea.cf_tinymce'').each(function() {\r\n    var field_name = $(this).attr(\"name\");\r\n    var settings   = cf_tinymce_settings[field_name];\r\n    settings.script_url = g.root_url + \"/modules/field_type_tinymce/tinymce/tiny_mce.js\";\r\n    settings.theme = \"advanced\",\r\n    $(this).tinymce(settings);\r\n  });\r\n});\r\n\r\ncf_tinymce_settings.check_required = function() {\r\n  var errors = [];\r\n  for (var i=0; i<rsv_custom_func_errors.length; i++) {\r\n    if (rsv_custom_func_errors[i].func != \"cf_tinymce_settings.check_required\") {\r\n      continue;\r\n    }\r\n    var field_name = rsv_custom_func_errors[i].field;\r\n    var val = $.trim(tinyMCE.get(\"cf_\" + field_name + \"_id\").getContent());\r\n    if (!val) {\r\n      var el = document.edit_submission_form[field_name];\r\n      errors.push([el, rsv_custom_func_errors[i].err]);\r\n    }\r\n  }\r\n  if (errors.length) {\r\n    return errors;\r\n  }\r\n  return true; \r\n}\r\n'
      WHERE  field_type_id = $field_type_id
    ");

  	mysql_query("
  	  INSERT INTO {$g_table_prefix}field_type_validation_rules (field_type_id, rsv_rule, rule_label, rsv_field_name,
  	    custom_function, custom_function_required, default_error_message, list_order)
  	  VALUES ($field_type_id, 'function', '{\$LANG.word_required}', '', 'cf_tinymce_settings.check_required', 'yes',
  	    '{\$LANG.validation_default_rule_required}', 1)
  	");
  }

  field_type_tinymce_reset_hooks();
}


/**
 * This includes the tinyMCE file on the Edit Submission pages.
 *
 * TODO: compatibility with Submission Accounts module?
 */
function tinymce_include_files($hook_name, $page_data)
{
  global $g_root_url;

  $curr_page = $page_data["page"];

  if ($curr_page != "admin_edit_submission" && $curr_page != "client_edit_submission")
    return;

  echo "<script src=\"$g_root_url/modules/field_type_tinymce/tinymce/jquery.tinymce.js\"></script>";
}


function tinymce_include_standalone_files($hook_name, $page_data)
{
  global $g_root_url;
  echo "<script src=\"$g_root_url/modules/field_type_tinymce/tinymce/jquery.tinymce.js\"></script>";
}


/**
 * Updates the default settings for the WYSIWYG field.
 *
 * @param array $info
 */
function tinymce_update_settings($info)
{
  global $g_table_prefix, $L;

  // to update them we need to know the field type ID - use the identifier to get it
  $field_type_info = ft_get_field_type_by_identifier("tinymce");
  $field_type_id = $field_type_info["field_type_id"];

  if (!isset($field_type_info["field_type_id"]) || !is_numeric($field_type_info["field_type_id"]))
    return array(false, $L["notify_update_settings_no_field_found"]);

  $field_type_id = $field_type_info["field_type_id"];

  // now update each of the settings. Klutzy!
  $identifiers = array("toolbar", "location", "alignment", "show_path", "path_info_location", "resizing");
  foreach ($identifiers as $identifier)
  {
  	$new_default_value = "";
  	switch ($identifier)
  	{
      case "resizing":
      	if (!isset($info[$identifier]))
      	  $new_default_value = "true";
      	else
      	  $new_default_value = ($info[$identifier] == "yes") ? "true" : "";
      	break;
      case "path_info_location":
        if (!isset($info[$identifier]))
      	  $new_default_value = "bottom";
      	else
      	  $new_default_value = $info[$identifier];
      	break;
      default:
      	$new_default_value = $info[$identifier];
      	break;
  	}

    mysql_query("
      UPDATE {$g_table_prefix}field_type_settings
      SET    default_value = '$new_default_value'
      WHERE  field_type_id = $field_type_id AND
             field_setting_identifier = '$identifier'
      LIMIT 1
    ");
  }

  return array(true, $L["notify_default_settings_updated"]);
}


function field_type_tinymce_reset_hooks()
{
  ft_unregister_module_hooks("field_type_tinymce");

  ft_register_hook("template", "field_type_tinymce", "head_bottom", "", "tinymce_include_files");
  ft_register_hook("template", "field_type_tinymce", "standalone_form_fields_head_bottom", "", "tinymce_include_standalone_files");
}

