<?php


/**
 * Our installation function. This adds the required data to the field types and field settings tables for
 * the field to become immediately usable.
 *
 * @param integer $module_id
 */
function field_type_file__install($module_id)
{
  global $g_table_prefix, $LANG;

  // check it's not already installed (i.e. check for the unique field type identifier)
  $field_type_info = ft_get_field_type_by_identifier("file");
  if (!empty($field_type_info))
  {
    return array(false, $LANG["notify_module_already_installed"]);
  }

  // find the FIRST field type group. Most installations won't have the Custom Fields module installed so
  // the last group will always be "Special Fields". For installations that DO, and that it's been customized,
  // the user can always move this new field type to whatever group they want. Plus, this module will be
  // installed by default, so it's almost totally moot
  $query = mysql_query("
    SELECT group_id
    FROM   {$g_table_prefix}list_groups
    WHERE  group_type = 'field_types'
    ORDER BY list_order ASC
    LIMIT 1
  ");
  $result = mysql_fetch_assoc($query);
  $group_id = $result["group_id"]; // assumption: there's at least one field type group

  // now find out how many field types there are in the group so we can add the row with the correct list order
  $count_query = mysql_query("SELECT count(*) as c FROM {$g_table_prefix}field_types WHERE group_id = $group_id");
  $count_result = mysql_fetch_assoc($count_query);
  $next_list_order = $count_result["c"] + 1;

  $query = mysql_query("
    INSERT INTO {$g_table_prefix}field_types (is_editable, non_editable_info, managed_by_module_id, field_type_name,
      field_type_identifier, group_id, is_file_field, is_date_field, raw_field_type_map, raw_field_type_map_multi_select_id,
      list_order, compatible_field_sizes, view_field_rendering_type, view_field_php_function_source, view_field_php_function,
      view_field_smarty_markup, edit_field_smarty_markup, php_processing, resources_css, resources_js)
    VALUES ('no', 'This module may only be edited via the File Upload module.', $module_id, '{\$LANG.word_file}',
      'file', $group_id, 'yes', 'no', 'file', NULL, $next_list_order, 'large,very_large', 'smarty', 'core', '',
      '{if \$VALUE}\r\n  <a href=\"{\$folder_url}/{\$VALUE}\" \r\n    {if \$use_fancybox == \"yes\"}class=\"fancybox\"{/if}>{\$VALUE}</a>\r\n{/if}',
      '<div class=\"cf_file\">\r\n  <input type=\"hidden\" class=\"cf_file_field_id\" value=\"{\$FIELD_ID}\" />\r\n  <div id=\"cf_file_{\$FIELD_ID}_content\" {if !\$VALUE}style=\"display:none\"{/if}>\r\n    <a href=\"{\$folder_url}/{\$VALUE}\" \r\n      {if \$use_fancybox == \"yes\"}class=\"fancybox\"{/if}>{\$VALUE}</a>\r\n    <input type=\"button\" class=\"cf_delete_file\" \r\n      value=\"{\$LANG.phrase_delete_file|upper}\" />\r\n  </div>\r\n  <div id=\"cf_file_{\$FIELD_ID}_no_content\" {if \$VALUE}style=\"display:none\"{/if}>\r\n    <input type=\"file\" name=\"{\$NAME}\" />\r\n  </div>\r\n  <div id=\"file_field_{\$FIELD_ID}_message_id\" class=\"cf_file_message\"></div>\r\n</div>\r\n',
      '', '', '/* all JS for this module is found in /modules/field_type_file/scripts/edit_submission.js */')
    ") or die(mysql_error());

  $field_type_id = mysql_insert_id();

  // now insert the settings and their options
  $query = mysql_query("
    INSERT INTO {$g_table_prefix}field_type_settings (field_type_id, field_label, field_setting_identifier, field_type,
       field_orientation, default_value_type, default_value, list_order)
    VALUES ($field_type_id, 'Open link with Fancybox', 'use_fancybox', 'radios', 'horizontal', 'static', 'no', 1)
  ");
  $setting_id = mysql_insert_id();
  $query = mysql_query("
    INSERT INTO {$g_table_prefix}field_type_setting_options (setting_id, option_text, option_value, option_order, is_new_sort_group)
    VALUES
      ($setting_id, 'Yes', 'yes', 1, 'yes'),
      ($setting_id, 'No', 'no', 2, 'yes')
  ");

  $query = mysql_query("
    INSERT INTO {$g_table_prefix}field_type_settings (field_type_id, field_label, field_setting_identifier, field_type,
      field_orientation, default_value_type, default_value, list_order)
    VALUES ($field_type_id, 'Folder Path', 'folder_path', 'textbox', 'na', 'dynamic', 'file_upload_dir,core', 3)
  ");
  $query = mysql_query("
    INSERT INTO {$g_table_prefix}field_type_settings (field_type_id, field_label, field_setting_identifier, field_type,
      field_orientation, default_value_type, default_value, list_order)
    VALUES ($field_type_id, 'Folder URL', 'folder_url', 'textbox', 'na', 'dynamic', 'file_upload_url,core', 4)
  ");
  $query = mysql_query("
    INSERT INTO {$g_table_prefix}field_type_settings (field_type_id, field_label, field_setting_identifier, field_type,
      field_orientation, default_value_type, default_value, list_order)
    VALUES ($field_type_id, 'Permitted File Types', 'permitted_file_types', 'textbox', 'na', 'dynamic', 'file_upload_filetypes,core', 5)
  ");
  $query = mysql_query("
    INSERT INTO {$g_table_prefix}field_type_settings (field_type_id, field_label, field_setting_identifier, field_type,
      field_orientation, default_value_type, default_value, list_order)
    VALUES ($field_type_id, 'Max File Size (KB)', 'max_file_size', 'textbox', 'na', 'dynamic', 'file_upload_max_size,core', 6)
  ");
  $query = mysql_query("
    INSERT INTO {$g_table_prefix}field_type_settings (field_type_id, field_label, field_setting_identifier, field_type,
      field_orientation, default_value_type, default_value, list_order)
    VALUES ($field_type_id, 'Field Comments', 'comments', 'textarea', 'na', 'static', '', 7)
  ");

  mysql_query("
    INSERT INTO {$g_table_prefix}field_type_validation_rules (field_type_id, rsv_rule, rule_label, rsv_field_name,
      custom_function, custom_function_required, default_error_message, list_order)
  	VALUES ($field_type_id, 'function', '{\$LANG.word_required}', '', 'files_ns.check_required', 'yes',
  	  '{\$LANG.validation_default_rule_required}', 1)
   ");


  // lastly, add our hooks
  ft_file_reset_hooks();

  return array(true, "");
}


/**
 * Uninstallation completely removes the field type. It also changes the field type ID from any file fields
 * to a generic text field.
 *
 * @param integer $module_id
 */
function field_type_file__uninstall($module_id)
{
  global $g_table_prefix;

  $field_type_info = ft_get_field_type_by_identifier("file");

  if (!empty($field_type_info))
  {
    $field_type_id = $field_type_info["field_type_id"];
    mysql_query("DELETE FROM {$g_table_prefix}field_type_settings WHERE field_type_id = $field_type_id");
    mysql_query("DELETE FROM {$g_table_prefix}field_types WHERE field_type_id = $field_type_id");

    // now do cleanup on the fields: all file fields should now be textareas. Drop all custom settings
    $setting_ids = array();
    foreach ($field_type_info["settings"] as $setting_info)
      $setting_ids[] = $setting_info["setting_id"];

    $setting_id_str = implode(",", $setting_ids);
    mysql_query("DELETE FROM {$g_table_prefix}field_setting_options WHERE setting_id IN ($setting_id_str)");
    mysql_query("DELETE FROM {$g_table_prefix}field_settings WHERE setting_id IN ($setting_id_str)");

    // now set all fields to textboxes. If the administrator has gone wild with the Custom Fields module and deleted the
    // textarea field type, it falls back on the generic input field (which cannot be edited at all)
    $textarea_field_type_info = ft_get_field_type_by_identifier("textbox");
    $new_field_type_id = "";
    if (isset($textarea_field_type_info["field_type_id"]) && is_numeric($textarea_field_type_info["field_type_id"]))
      $new_field_type_id = $textarea_field_type_info["field_type_id"];

    mysql_query("UPDATE {$g_table_prefix}form_fields SET field_type_id = $new_field_type_id WHERE field_type_id = $field_type_id");
  }

  return array(true, "");
}


function field_type_file__upgrade($old_version, $new_version)
{
  global $g_table_prefix, $LANG;

  $old_version_info = ft_get_version_info($old_version);

  $field_type_id = ft_get_field_type_id_by_identifier("file");
  if ($old_version_info["release_date"] < 20110609)
  {
    mysql_query("
      UPDATE {$g_table_prefix}field_types
      SET    view_field_smarty_markup = '{if \$VALUE}\r\n  <a href=\"{\$folder_url}/{\$VALUE}\" \r\n    {if \$use_fancybox == \"yes\"}class=\"fancybox\"{/if}>{\$VALUE}</a>\r\n{/if}'
      WHERE  field_type_id = $field_type_id
    ");

    ft_register_hook("code", "field_type_file", "manage_files", "ft_process_form", "ft_file_process_form_hook", 50, true);
    ft_register_hook("code", "field_type_file", "manage_files", "ft_api_process_form", "ft_file_api_process_form_hook", 50, true);
  }

  if ($old_version_info["release_date"] < 20110612)
  {
    ft_register_hook("code", "field_type_file", "start", "ft_delete_submission_files", "ft_file_delete_submissions_hook", 50, true);
  }

  if ($old_version_info["release_date"] < 20110613)
  {
    ft_register_hook("code", "field_type_file", "start", "ft_get_uploaded_files", "ft_file_get_uploaded_files_hook", 50, true);
  }

  if ($old_version_info["release_date"] < 20111007)
  {
  	@mysql_query("
  	  INSERT INTO {$g_table_prefix}field_type_validation_rules (field_type_id, rsv_rule, rule_label, rsv_field_name,
  	    custom_function, custom_function_required, default_error_message, list_order)
  	  VALUES ($field_type_id, 'function', '{\$LANG.word_required}', '', 'files_ns.check_required', 'yes',
  	    '{\$LANG.validation_default_rule_required}', 1)
  	");
  }

  ft_file_reset_hooks();
}


/**
 * This hook is called by the ft_update_submission function. It handles all the actual work for uploading a file.
 *
 * @param array $params
 */
function ft_file_update_submission_hook($params)
{
  global $LANG;

  $file_fields = $params["file_fields"];

  // if there are no files being uploaded, do nuthin'
  if (empty($file_fields))
    return;

  $form_id       = $params["form_id"];
  $submission_id = $params["submission_id"];
  $module_field_type_id = ft_get_field_type_id_by_identifier("file");

  $problem_files = array();

  $return_info = array(
    "success" => true
  );

  foreach ($file_fields as $file_field_info)
  {
    $field_id      = $file_field_info["field_info"]["field_id"];
    $field_type_id = $file_field_info["field_info"]["field_type_id"];
    $field_name    = $file_field_info["field_info"]["field_name"];

    if ($field_type_id != $module_field_type_id)
      continue;

    // nothing was included in this field, just ignore it
    if (empty($_FILES[$field_name]["name"]))
      continue;

    list($success, $message) = ft_file_upload_submission_file($form_id, $submission_id, $file_field_info);
    if (!$success)
      $problem_files[] = array($_FILES[$field_name]["name"], $message);
    else
      $return_info["message"] = $message;
  }

  if (!empty($problem_files))
  {
    $message = $LANG["notify_submission_updated_file_problems"] . "<br /><br />";
    foreach ($problem_files as $problem)
      $message .= "&bull; <b>{$problem[0]}</b>: $problem[1]<br />\n";

    $return_info = array(
      "success" => false,
      "message" => $message
    );
  }

  return $return_info;
}


/**
 * Uploads a file for a particular form submission field. This is called AFTER the submission has already been
 * added to the database so there's an available, valid submission ID. It uploads the file to the appropriate
 * folder then updates the database record.
 *
 * Since any submission file field can only ever store a single file at once, this function automatically deletes
 * the old file in the event of the new file being successfully uploaded.
 *
 * @param integer $form_id the unique form ID
 * @param integer $submission_id a unique submission ID
 * @param array $file_field_info
 * @return array returns array with indexes:<br/>
 *               [0]: true/false (success / failure)<br/>
 *               [1]: message string<br/>
 *               [2]: If success, the filename of the uploaded file
 */
function ft_file_upload_submission_file($form_id, $submission_id, $file_field_info)
{
  global $g_table_prefix, $g_filename_char_whitelist, $LANG;

  // get the column name and upload folder for this field
  $field_id = $file_field_info["field_id"];
  $col_name = $file_field_info["field_info"]["col_name"];

  // if the column name wasn't found, the $field_id passed in was invalid. Somethin' aint right...
  if (empty($col_name))
    return array(false, $LANG["notify_submission_no_field_id"]);

  // clean up the filename according to the whitelist chars
  $field_name = $file_field_info["field_info"]["field_name"];
  $fileinfo = $_FILES[$field_name];

  $filename_parts = explode(".", $fileinfo["name"]);
  $extension = $filename_parts[count($filename_parts)-1];
  array_pop($filename_parts);
  $filename_without_extension = implode(".", $filename_parts);
  $valid_chars = preg_quote($g_filename_char_whitelist);
  $filename_without_ext_clean = preg_replace("/[^$valid_chars]/", "", $filename_without_extension);

  // unlikely, but...!
  if (empty($filename_without_ext_clean))
    $filename_without_ext_clean = "file";

  $filename = $filename_without_ext_clean . "." . $extension;

  $tmp_filename = $fileinfo["tmp_name"];
  $filesize     = $fileinfo["size"]; // always in BYTES
  $filesize_kb  = $filesize / 1000;

  // pull a couple of values out of the field's settings (these are custom to the field)
  $file_upload_max_size = $file_field_info["settings"]["max_file_size"];
  $file_upload_dir      = $file_field_info["settings"]["folder_path"];
  $permitted_file_types = $file_field_info["settings"]["permitted_file_types"];

  // check file size
  if ($filesize_kb > $file_upload_max_size)
  {
    $placeholders = array(
      "FILESIZE"    => round($filesize_kb, 1),
      "MAXFILESIZE" => $file_upload_max_size
    );
    $error = ft_eval_smarty_string($LANG["notify_file_too_large"], $placeholders);
    return array(false, $error);
  }

  // check upload folder is valid and writable
  if (!is_dir($file_upload_dir) || !is_writable($file_upload_dir))
    return array(false, $LANG["notify_invalid_field_upload_folder"]);

  // check file extension is valid. Note: this is "dumb" - it just tests for the file extension string, not
  // the actual file type based on it's header info [this is done because I want to allow users to permit
  // uploading of any file types, and I can't know about all header types]
  $is_valid_extension = true;
  if (!empty($permitted_file_types))
  {
    $is_valid_extension = false;
    $raw_extensions = explode(",", $permitted_file_types);

    foreach ($raw_extensions as $ext)
    {
      // remove whitespace and periods
      $clean_extension = str_replace(".", "", trim($ext));

      if (preg_match("/$clean_extension$/i", $filename))
        $is_valid_extension = true;
    }
  }

  // all checks out!
  if ($is_valid_extension)
  {
    // find out if there was already a file uploaded in this field. We make a note of this so that
    // in case the new file upload is successful, we automatically delete the old file
    $submission_info = ft_get_submission_info($form_id, $submission_id);
    $old_filename = (!empty($submission_info[$col_name])) ? $submission_info[$col_name] : "";

    // check for duplicate filenames and get a unique name
    $unique_filename = ft_get_unique_filename($file_upload_dir, $filename);

    // copy file to uploads folder and remove temporary file
    if (@rename($tmp_filename, "$file_upload_dir/$unique_filename"))
    {
      @chmod("$file_upload_dir/$unique_filename", 0777);

      // update the database
      $query = "
        UPDATE {$g_table_prefix}form_{$form_id}
        SET    $col_name = '$unique_filename'
        WHERE  submission_id = $submission_id
               ";

      $result = mysql_query($query);

      if ($result)
      {
        // if there was a file previously uploaded in this field, delete it!
        if (!empty($old_filename))
          @unlink("$file_upload_dir/$old_filename");

        return array(true, $LANG["notify_file_uploaded"], $unique_filename);
      }
      else
        return array(false, $LANG["notify_file_not_uploaded"]);
    }
    else
      return array(false, $LANG["notify_file_not_uploaded"]);
  }

  // not a valid extension. Inform the user
  else
    return array(false, $LANG["notify_unsupported_file_extension"]);
}



/**
 * Deletes a file that has been uploaded through a particular form submission file field.
 *
 * Now say that 10 times fast.
 *
 * @param integer $form_id the unique form ID
 * @param integer $submission_id a unique submission ID
 * @param integer $field_id a unique form field ID
 * @param boolean $force_delete this forces the file to be deleted from the database, even if the
 *                file itself doesn't exist or doesn't have the right permissions.
 * @return array Returns array with indexes:<br/>
 *               [0]: true/false (success / failure)<br/>
 *               [1]: message string<br/>
 */
function ft_file_delete_file_submission($form_id, $submission_id, $field_id, $force_delete = false)
{
  global $g_table_prefix, $LANG;

  // get the column name and upload folder for this field
  $field_info = ft_get_form_field($field_id);
  $col_name = $field_info["col_name"];

  // if the column name wasn't found, the $field_id passed in was invalid. Return false.
  if (empty($col_name))
    return array(false, $LANG["notify_submission_no_field_id"]);

  $field_settings = ft_get_field_settings($field_id);
  $file_folder = $field_settings["folder_path"];

  $query = "
    SELECT $col_name
    FROM   {$g_table_prefix}form_{$form_id}
    WHERE  submission_id = $submission_id
            ";

  $result = mysql_query($query);
  $file_info = mysql_fetch_row($result);
  $file = $file_info[0];

  $update_database_record = false;
  $success = true;
  $message = "";

  if (!empty($file))
  {
    if ($force_delete)
    {
      @unlink("$file_folder/$file");
      $message = $LANG["notify_file_deleted"];
      $update_database_record = true;
    }
    else
    {
      if (@unlink("$file_folder/$file"))
      {
        $success = true;
        $message = $LANG["notify_file_deleted"];
        $update_database_record = true;
      }
      else
      {
        if (!is_file("$file_folder/$file"))
        {
          $success = false;
          $update_database_record = false;
          $replacements = array("js_link" => "return files_ns.delete_submission_file($field_id, true)");
          $message = ft_eval_smarty_string($LANG["notify_file_not_deleted_no_exist"] . "($file_folder/$file)", $replacements);
        }
        else if (is_file("$file_folder/$file") && (!is_readable("$file_folder/$file") || !is_writable("$file_folder/$file")))
        {
          $success = false;
          $update_database_record = false;
          $replacements = array("js_link" => "return files_ns.delete_submission_file($field_id, true)");
          $message = ft_eval_smarty_string($LANG["notify_file_not_deleted_permissions"], $replacements);
        }
        else
        {
          $success = false;
          $update_database_record = false;
          $replacements = array("js_link" => "return files_ns.delete_submission_file($field_id, true)");
          $message = ft_eval_smarty_string($LANG["notify_file_not_deleted_unknown_error"], $replacements);
        }
      }
    }
  }

  // if need be, update the database record to remove the reference to the file in the database. Generally this
  // should always work, but in case something funky happened, like the permissions on the file were changed to
  // forbid deleting, I think it's best if the record doesn't get deleted to remind the admin/client it's still
  // there.
  if ($update_database_record)
  {
    $query = mysql_query("
      UPDATE {$g_table_prefix}form_{$form_id}
      SET    $col_name = ''
      WHERE  submission_id = $submission_id
             ");
  }

  extract(ft_process_hook_calls("end", compact("form_id", "submission_id", "field_id", "force_delete"),
    array("success", "message")), EXTR_OVERWRITE);

  return array($success, $message);
}


/**
 * Our template hook. This includes all required JS for the Edit Submission page.
 */
function ft_file_include_js($template, $page_data)
{
  global $g_root_url;

  $curr_page = $page_data["page"];
  if ($curr_page != "admin_edit_submission" && $curr_page != "client_edit_submission")
    return;

  echo "<script src=\"$g_root_url/modules/field_type_file/scripts/edit_submission.js?v=2\"></script>\n";
}


/**
 * Used for any module (e.g. Form Builder) that uses the form fields in a standalone context.
 */
function ft_file_include_standalone_js($template, $page_data)
{
  global $g_root_url, $LANG;

  // this includes the necessary JS for the file upload field type
  echo <<< END
  <script src="$g_root_url/modules/field_type_file/scripts/standalone.js"></script>
  <script>
  if (typeof g.messages == 'undefined')
    g.messages = {};

  g.messages["confirm_delete_submission_file"] = "{$LANG["confirm_delete_submission_file"]}";
  g.messages["phrase_please_confirm"] = "{$LANG["phrase_please_confirm"]}";
  g.messages["word_yes"] = "{$LANG["word_yes"]}";
  g.messages["word_no"] = "{$LANG["word_no"]}";
  </script>
END;
}


/**
 * This is called by the ft_process_form function. It handles the file upload for all "File" Field types.
 *
 * @param array $params
 */
function ft_file_process_form_hook($params)
{
  global $LANG, $g_query_str_multi_val_separator;

  $file_fields = $params["file_fields"];
  if (empty($file_fields))
    return;

  $form_id       = $params["form_id"];
  $submission_id = $params["submission_id"];

  $module_field_type_id = ft_get_field_type_id_by_identifier("file");
  $problem_files = array();
  $redirect_query_params = $params["redirect_query_params"];

  $return_info = array(
    "success" => true,
    "message" => "",
    "redirect_query_params" => $redirect_query_params
  );

  foreach ($file_fields as $file_field_info)
  {
    $field_id      = $file_field_info["field_info"]["field_id"];
    $field_type_id = $file_field_info["field_info"]["field_type_id"];
    $field_name    = $file_field_info["field_info"]["field_name"];
    $include_on_redirect = $file_field_info["field_info"]["include_on_redirect"];

    if ($module_field_type_id != $field_type_id)
      continue;

    $field_settings = ft_get_field_settings($field_id);
    $file_field_info["settings"] = $field_settings;

    // nothing was included in this field, just ignore it
    if (empty($_FILES[$field_name]["name"]))
      continue;

    list($success, $message, $filename) = ft_file_upload_submission_file($form_id, $submission_id, $file_field_info);
    if (!$success)
      $problem_files[] = array($_FILES[$field_name]["name"], $message);
    else
    {
      $return_info["message"] = $message;
      if ($include_on_redirect == "yes")
      {
        $redirect_query_params[] = "$field_name=" . rawurlencode($filename);
      }
    }
  }

  if (!empty($problem_files))
  {
    $message = $LANG["notify_submission_updated_file_problems"] . "<br /><br />";
    foreach ($problem_files as $problem)
      $message .= "&bull; <b>{$problem[0]}</b>: $problem[1]<br />\n";

    $return_info = array(
      "success" => false,
      "message" => $message,
      "redirect_query_params" => $redirect_query_params
    );
  }
  else
  {
    $return_info["redirect_query_params"] = $redirect_query_params;
  }

  return $return_info;
}


/**
 * This is called by the ft_process_form function. It handles the file upload for all "File" Field types.
 *
 * @param array $params
 */
function ft_file_api_process_form_hook($params)
{
  global $LANG, $g_query_str_multi_val_separator;

  $file_fields = $params["file_fields"];
  if (empty($file_fields))
    return;

  $form_id       = $params["form_id"];
  $submission_id = $params["submission_id"];
  $namespace     = $params["namespace"];

  $module_field_type_id = ft_get_field_type_id_by_identifier("file");
  $problem_files = array();

  $return_info = array(
    "success" => true,
    "message" => ""
  );

  foreach ($file_fields as $file_field_info)
  {
    $field_type_id = $file_field_info["field_info"]["field_type_id"];
    if ($module_field_type_id != $field_type_id)
      continue;

    $field_id      = $file_field_info["field_info"]["field_id"];
    $field_name    = $file_field_info["field_info"]["field_name"];
    $include_on_redirect = $file_field_info["field_info"]["include_on_redirect"];
    $field_settings = ft_get_field_settings($field_id);
    $file_field_info["settings"] = $field_settings;

    // nothing was included in this field, just ignore it
    if (empty($_FILES[$field_name]["name"]))
      continue;

    list($success, $message, $filename) = ft_file_upload_submission_file($form_id, $submission_id, $file_field_info);
    if (!$success)
      $problem_files[] = array($_FILES[$field_name]["name"], $message);
    else
    {
      $return_info["message"] = $message;
      $curr_file_info = array(
        "filename"        => $filename,
        "file_upload_dir" => $file_field_info["settings"]["folder_path"],
        "file_upload_url" => $file_field_info["settings"]["folder_url"]
      );
      $_SESSION[$namespace][$field_name] = $curr_file_info;
    }
  }

  if (!empty($problem_files))
  {
    $message = $LANG["notify_submission_updated_file_problems"] . "<br /><br />";
    foreach ($problem_files as $problem)
      $message .= "&bull; <b>{$problem[0]}</b>: $problem[1]<br />\n";

    $return_info = array(
      "success" => false,
      "message" => $message
    );
  }

  return $return_info;
}


/**
 * Called whenever a submission or submissions are deleted. It's the hook for the ft_delete_submission_files
 * Core function.
 *
 * @param array $params this contains all the details passed by the hook.
 */
function ft_file_delete_submissions_hook($params)
{
  $L = ft_get_module_lang_file_contents("field_type_file");

  $form_id         = $params["form_id"];
  $file_field_info = $params["file_field_info"];

  $module_field_type_id = ft_get_field_type_id_by_identifier("file");
  $problem_files = array();
  foreach ($file_field_info as $info)
  {
    if ($info["field_type_id"] != $module_field_type_id)
      continue;

    $field_id      = $info["field_id"];
    $submission_id = $info["submission_id"];
    $filename      = $info["filename"];

    $field_settings = ft_get_field_settings($field_id);
    $folder = $field_settings["folder_path"];

    if (!@unlink("$folder/$filename"))
    {
      if (!is_file("$folder/$filename"))
      {
        $problems[] = array(
          "filename" => $filename,
          "error"    => ft_eval_smarty_string($L["notify_file_not_deleted_no_exist"], array("folder" => $folder))
        );
      }
      else if (is_file("$folder/$file") && (!is_readable("$folder/$file") || !is_writable("$folder/$file")))
      {
        $problems[] = array(
          "filename" => $filename,
          "error"    => ft_eval_smarty_string($L["notify_file_not_deleted_permissions"], array("folder" => $folder))
        );
      }
      else
      {
        $problems[] = array(
          "filename" => $filename,
          "error"    => ft_eval_smarty_string($L["notify_file_not_deleted_unknown_error"], array("folder" => $folder))
        );
      }
    }
  }

  if (empty($problems))
    return array(true, "");
  else
    return array(false, $problems);
}


/**
 * This is the hook for the ft_get_uploaded_files core function. It returns an array of hashes;
 *
 * @param array $params
 */
function ft_file_get_uploaded_files_hook($params)
{
  global $g_table_prefix;

  $form_id   = $params["form_id"];
  $field_ids = (isset($params["field_ids"]) && is_array($params["field_ids"])) ? $params["field_ids"] : array();

  $module_field_type_id = ft_get_field_type_id_by_identifier("file");

  $data = array();
  foreach ($field_ids as $field_id)
  {
    $field_type_id = ft_get_field_type_id_by_field_id($field_id);
    if ($field_type_id != $module_field_type_id)
      continue;

    $result = ft_get_field_col_by_field_id($form_id, field_id);
    $col_name = $result[$field_id];
    if (empty($col_name))
      continue;

    $query = mysql_query("SELECT submission_id, $col_name FROM {$g_table_prefix}form_{$form_id}");
    if (!$query)
      continue;

    $field_settings = ft_get_field_settings($field_id);
    while ($row = mysql_fetch_assoc($query))
    {
      // here, nothing's been uploaded in the field
      if (empty($row[$col_name]))
        continue;

      $data[] = array(
        "submission_id" => $row["submission_id"],
        "field_id"      => $field_id,
        "field_type_id" => $module_field_type_id,
        "folder_path"   => $field_settings["folder_path"],
        "folder_url"    => $field_settings["folder_url"],
        "filename"      => $row[$col_name]
      );
    }
  }

  return array(
    "uploaded_files" => $data
  );
}


/**
 * Called on installation and upgrades.
 */
function ft_file_reset_hooks()
{
	ft_unregister_module_hooks("field_type_file");

  ft_register_hook("code", "field_type_file", "manage_files", "ft_update_submission", "ft_file_update_submission_hook", 50, true);
  ft_register_hook("code", "field_type_file", "manage_files", "ft_process_form", "ft_file_process_form_hook", 50, true);
  ft_register_hook("code", "field_type_file", "manage_files", "ft_api_process_form", "ft_file_api_process_form_hook", 50, true);
  ft_register_hook("code", "field_type_file", "start", "ft_delete_submission_files", "ft_file_delete_submissions_hook", 50, true);
  ft_register_hook("code", "field_type_file", "start", "ft_get_uploaded_files", "ft_file_get_uploaded_files_hook", 50, true);
  ft_register_hook("template", "field_type_file", "head_bottom", "", "ft_file_include_js");
  ft_register_hook("template", "field_type_file", "standalone_form_fields_head_bottom", "", "ft_file_include_standalone_js");
}
