<?php

/**
 * This file defines all general functions relating to the Export Manager module.
 *
 * @copyright Encore Web Studios 2011
 * @author Encore Web Studios <formtools@encorewebstudios.com>
 */


// -------------------------------------------------------------------------------------------------


/**
 * Returns a list of all export icons, found in the /modules/export_manager/images/icons/ folder.
 *
 * return array an array of image filenames.
 */
function exp_get_export_icons()
{
  global $g_root_dir;

  $icon_folder = "$g_root_dir/modules/export_manager/images/icons/";

  // store all the icon filenames in an array
  $filenames = array();
  if ($handle = opendir($icon_folder))
  {
    while (false !== ($file = readdir($handle)))
    {
      $extension = ft_get_filename_extension($file, true);

      if ($extension == "jpg" || $extension == "gif" || $extension == "bmp" || $extension == "png")
        $filenames[] = $file;
    }
  }

  return $filenames;
}


/**
 * Called on the Settings page. Updates the generated file folder information.
 *
 * @param array $info
 * @return array [0] T/F [1] Error / notification message
 */
function exp_update_settings($info)
{
  global $g_table_prefix, $L;

  $old_settings = ft_get_module_settings();

  $info = ft_sanitize($info);

  $settings = array();
  $settings["file_upload_dir"] = $info["file_upload_dir"];
  $settings["file_upload_url"] = $info["file_upload_url"];
  //$settings["cache_multi_select_fields"] = (isset($info["cache_multi_select_fields"]) && !empty($info["cache_multi_select_fields"])) ?
  //  $info["cache_multi_select_fields"] : "no";

  ft_set_module_settings($settings);

//  $_SESSION["ft"]["export_manager"]["cache_multi_select_fields"] = $settings["cache_multi_select_fields"];

  return array(true, $L["notify_settings_updated"]);
}


/**
 * Used in generating the filenames; this builds most of the placeholder values (the date-oriented ones)
 * to which the form and export-specific placeholders are added.
 *
 * @return array the placeholder array
 */
function exp_get_export_filename_placeholder_hash()
{
  $offset = ft_get_current_timezone_offset();
  $date_str = ft_get_date($offset, ft_get_current_datetime(), "Y|y|F|M|m|n|d|D|j|g|h|H|i|s|U|a|G|i");
  list($Y, $y, $F, $M, $m, $n, $d, $D, $j, $g, $h, $H, $i, $s, $U, $a, $G, $i) = explode("|", $date_str);

  $placeholders = array(
    "datetime" => "$Y-$m-$d.$H-$i-$s",
    "date" => "$Y-$m-$d",
    "time" => "$H-$i-$s",
    "Y" => $Y,
    "y" => $y,
    "F" => $F,
    "M" => $M,
    "m" => $m,
    "G" => $G,
    "i" => $i,
    "n" => $n,
    "d" => $d,
    "D" => $D,
    "j" => $j,
    "g" => $g,
    "h" => $h,
    "H" => $H,
    "s" => $s,
    "U" => $U,
    "a" => $a
  );

  return $placeholders;
}


/**
 * This hook function is what actually outputs the Export options at the bottom of the Submission Listing page.
 *
 * @param string $template_name
 * @param array $params
 */
function exp_display_export_options($template_name, $params)
{
  global $g_smarty, $g_root_url, $g_root_dir;

  $account_id = $params["SESSION"]["account"]["account_id"];
  $form_id    = $params["form_id"];
  $view_id    = $params["view_id"];

  $export_groups = array();
  $is_admin = false;
  if ($template_name == "admin_submission_listings_bottom")
    $is_admin = true;

  if ($is_admin)
  {
    $account_id = "admin";
  }

  // this does all the hard work of figuring out what groups & types should appear
  $export_groups = exp_get_assigned_export_types($account_id, $form_id, $view_id);

  // now for the fun stuff! We loop through all export groups and log all the settings for
  // each of the fields, based on incoming POST values
  $page_vars = array();
  foreach ($export_groups as $export_group)
  {
    $export_group_id = $export_group["export_group_id"];
    $page_vars["export_group_{$export_group_id}_results"]     = ft_load_module_field("export_manager", "export_group_{$export_group_id}_results", "export_group_{$export_group_id}_results");
    $page_vars["export_group_{$export_group_id}_export_type"] = ft_load_module_field("export_manager", "export_group_{$export_group_id}_export_type", "export_group_{$export_group_id}_export_type");
  }

  $params["LANG"]["export_manager"] = ft_get_module_lang_file_contents("export_manager");

  // now pass the information to the Smarty template to display
  $g_smarty->assign("export_groups", $export_groups);
  $g_smarty->assign("is_admin", $is_admin);
  $g_smarty->assign("page_vars", $page_vars);
  $g_smarty->assign("LANG", $params["LANG"]);
  $g_smarty->assign("export_icon_folder", "$g_root_url/modules/export_manager/images/icons");

  echo $g_smarty->fetch("../../modules/export_manager/templates/export_options_html.tpl");
}


/**
 * Called by the installation script and on the Reset to Defaults page. This cleans out any data already in the
 * tables and inserts the default values.
 */
function exp_insert_default_data()
{
  global $g_table_prefix, $g_root_dir, $g_root_url, $LANG;

  exp_clear_table_data();

  $queries = array();

  // add Export Groups
  $phrase_html_printer = ft_sanitize($LANG["export_manager"]["phrase_html_printer_friendly"]);
  $word_excel          = ft_sanitize($LANG["export_manager"]["word_excel"]);
  $word_xml            = ft_sanitize($LANG["export_manager"]["word_xml"]);
  $word_csv            = ft_sanitize($LANG["export_manager"]["word_csv"]);
  $word_display        = ft_sanitize($LANG["word_display"]);
  $word_generate       = ft_sanitize($LANG["export_manager"]["word_generate"]);
  $queries[] = "INSERT INTO {$g_table_prefix}module_export_groups VALUES (1, '$phrase_html_printer', 'public', 'all', NULL, 'show', 'printer.png', 'popup', '$word_display', '600', '800', '', '<html>\r\n<head>\r\n  <title>{\$export_group_name}</title>\r\n\r\n  {* escape the CSS so it doesn''t confuse Smarty *}\r\n  {literal}\r\n  <style type=\"text/css\">\r\n  body { margin: 0px; }\r\n  table, td, tr, div, span { \r\n    font-family: verdana; font-size: 8pt;\r\n  }\r\n  table { empty-cells: show }\r\n  #nav_row { background-color: #efefef; padding: 10px; }\r\n  #export_group_name { color: #336699; font-weight:bold }\r\n  .print_table { border: 1px solid #dddddd; }\r\n  .print_table th { \r\n    border: 1px solid #cccccc; \r\n    background-color: #efefef;\r\n    text-align: left;\r\n  }\r\n  .print_table td { border: 1px solid #cccccc; }\r\n  .one_item { margin-bottom: 15px; }\r\n  .page_break { page-break-after: always; }\r\n  </style>\r\n\r\n  <style type=\"text/css\" media=\"print\">\r\n  .no_print { display: none }\r\n  </style>\r\n  {/literal}\r\n\r\n</head>\r\n<body>\r\n\r\n<div id=\"nav_row\" class=\"no_print\">\r\n\r\n  <span style=\"float:right\">{if \$page_type != \"file\"}\r\n    {* if there''s more than one export type in this group, display the types in a dropdown *}\r\n    {if \$export_types|@count > 1}\r\n      <select name=\"export_type_id\" onchange=\"window.location=''{\$same_page}?export_group_id={\$export_group_id}&export_group_{\$export_group_id}_results={\$export_group_results}&export_type_id='' + this.value\">\r\n      {foreach from=\$export_types item=export_type}\r\n        <option value=\"{\$export_type.export_type_id}\" {if \$export_type.export_type_id == \$export_type_id}selected{/if}>{eval var=\$export_type.export_type_name}</option>\r\n      {/foreach}\r\n      </select>\r\n    {/if}\r\n    {/if}\r\n    <input type=\"button\" onclick=\"window.close()\" value=\"{\$LANG.word_close}\" />\r\n    <input type=\"button\" onclick=\"window.print()\" value=\"{\$LANG.word_print}\" />\r\n  </span>\r\n\r\n  <span id=\"export_group_name\">{eval var=\$export_group_name}</span>\r\n</div>\r\n\r\n<div style=\"padding: 15px\">\r\n  {\$export_type_smarty_template}\r\n</div>\r\n\r\n</body>\r\n</html>', 1)";
  $queries[] = "INSERT INTO {$g_table_prefix}module_export_groups VALUES (2, '$word_excel', 'public', 'all', NULL, 'show', 'xls.gif', 'new_window', '$word_generate', '', '', 'Pragma: public\nCache-Control: max-age=0\nContent-Type: application/vnd.ms-excel; charset=utf-8\nContent-Disposition: attachment; filename={\$filename}', '<html>\r\n<head>\r\n</head>\r\n<body>\r\n\r\n{\$export_type_smarty_template}\r\n\r\n</body>\r\n</html>', 2)";
  $queries[] = "INSERT INTO {$g_table_prefix}module_export_groups VALUES (3, '$word_xml', 'public', 'all', NULL, 'hide', 'xml.jpg', 'new_window', '$word_generate', '', '', '', '<?xml version=\"1.0\" encoding=\"utf-8\" ?>\r\n\r\n{\$export_type_smarty_template}', 4)";
  $queries[] = "INSERT INTO {$g_table_prefix}module_export_groups VALUES (4, '$word_csv', 'public', 'all', NULL, 'hide', 'csv.gif', 'new_window', '$word_generate', '', '', 'Content-type: application/xml; charset=\"octet-stream\"\r\nContent-Disposition: attachment; filename={\$filename}', '{\$export_type_smarty_template}', 3)";

  // add Export Types
  $table_format            = ft_sanitize($LANG["export_manager"]["phrase_table_format"]);
  $one_by_one              = ft_sanitize($LANG["export_manager"]["phrase_one_by_one"]);
  $one_submission_per_page = ft_sanitize($LANG["export_manager"]["phrase_one_submission_per_page"]);
  $all_submissions         = ft_sanitize($LANG["phrase_all_submissions"]);
  $queries[] = "INSERT INTO {$g_table_prefix}module_export_types VALUES (1, '$table_format', 'show', 'submissions-{\$M}.{\$j}.html', 1, '<h1>{\$form_name} - {\$view_name}</h1>\r\n\r\n<table cellpadding=\"2\" cellspacing=\"0\" width=\"100%\" class=\"print_table\">\r\n<tr>\r\n  {foreach from=\$display_fields item=column}\r\n    <th>{\$column.field_title}</th>\r\n  {/foreach}\r\n</tr>\r\n{strip}\r\n{foreach from=\$submissions item=submission}\r\n  {assign var=submission_id value=\$submission.submission_id}\r\n  <tr>\r\n    {foreach from=\$display_fields item=field_info}\r\n      {assign var=col_name value=\$field_info.col_name}\r\n      {assign var=value value=\$submission.\$col_name}\r\n      <td>\r\n        {smart_display_field form_id=\$form_id view_id=\$view_id\r\n          submission_id=\$submission_id field_info=\$field_info\r\n          field_types=\$field_types settings=\$settings value=\$value}\r\n      </td>\r\n    {/foreach}\r\n  </tr>\r\n{/foreach}\r\n{/strip}\r\n</table>', 1)";
  $queries[] = "INSERT INTO {$g_table_prefix}module_export_types VALUES (2, '$one_by_one', 'show', 'submissions-{\$M}.{\$j}.html', 1, '<h1>{\$form_name} - {\$view_name}</h1>\r\n\r\n{strip}\r\n{foreach from=\$submissions item=submission}\r\n  {assign var=submission_id value=\$submission.submission_id}\r\n  <table cellpadding=\"2\" cellspacing=\"0\" width=\"100%\" \r\n    class=\"print_table one_item\">\r\n    {foreach from=\$display_fields item=field_info}\r\n      {assign var=col_name value=\$field_info.col_name}\r\n      {assign var=value value=\$submission.\$col_name}\r\n      <tr>\r\n        <th width=\"140\">{\$field_info.field_title}</th>\r\n        <td>\r\n          {smart_display_field form_id=\$form_id view_id=\$view_id\r\n            submission_id=\$submission_id field_info=\$field_info\r\n            field_types=\$field_types settings=\$settings value=\$value}\r\n        </td>\r\n      </tr>\r\n    {/foreach}\r\n  </table>\r\n{/foreach}\r\n{/strip}', 2)";
  $queries[] = "INSERT INTO {$g_table_prefix}module_export_types VALUES (3, '$one_submission_per_page', 'show', 'submissions-{\$M}.{\$j}.html', 1, '<h1>{\$form_name} - {\$view_name}</h1>\r\n\r\n{foreach from=\$submissions item=submission name=row}\r\n  {assign var=submission_id value=\$submission.submission_id}\r\n  <table cellpadding=\"2\" cellspacing=\"0\" width=\"100%\" \r\n    class=\"print_table one_item\">\r\n    {foreach from=\$display_fields item=field_info}\r\n      {assign var=col_name value=\$field_info.col_name}\r\n      {assign var=value value=\$submission.\$col_name}\r\n      <tr>\r\n        <th width=\"140\">{\$field_info.field_title}</th>\r\n        <td>\r\n          {smart_display_field form_id=\$form_id view_id=\$view_id\r\n            submission_id=\$submission_id field_info=\$field_info\r\n            field_types=\$field_types settings=\$settings value=\$value}\r\n        </td>\r\n      </tr>\r\n    {/foreach}\r\n  </table>\r\n\r\n  {if !\$smarty.foreach.row.last}\r\n    <div class=\"no_print\"><i>- {\$LANG.phrase_new_page} -</i></div>\r\n    <br class=\"page_break\" />\r\n  {/if}\r\n \r\n{/foreach}\r\n', 3)";
  $queries[] = "INSERT INTO {$g_table_prefix}module_export_types VALUES (4, '$table_format', 'show', 'submissions-{\$M}.{\$j}.xls', 2, '<h1>{\$form_name} - {\$view_name}</h1>\r\n\r\n<table cellpadding=\"2\" cellspacing=\"0\" width=\"100%\" class=\"print_table\">\r\n<tr>\r\n  {foreach from=\$display_fields item=column}\r\n    <th>{\$column.field_title}</th>\r\n  {/foreach}\r\n</tr>\r\n{strip}\r\n{foreach from=\$submissions item=submission}\r\n  {assign var=submission_id value=\$submission.submission_id}\r\n  <tr>\r\n    {foreach from=\$display_fields item=field_info}\r\n      {assign var=col_name value=\$field_info.col_name}\r\n      {assign var=value value=\$submission.\$col_name}\r\n      <td>\r\n        {smart_display_field form_id=\$form_id view_id=\$view_id\r\n          submission_id=\$submission_id field_info=\$field_info\r\n          field_types=\$field_types settings=\$settings value=\$value\r\n          escape=\"excel\"}\r\n      </td>\r\n    {/foreach}\r\n  </tr>\r\n{/foreach}\r\n{/strip}\r\n</table>', 1)";
  $queries[] = "INSERT INTO {$g_table_prefix}module_export_types VALUES (5, '$all_submissions', 'show', 'form{\$form_id}_{\$datetime}.csv', 4, '{strip}\r\n  {foreach from=\$display_fields item=column name=row}\r\n    {* workaround for absurd Microsoft Excel problem, in which the first\r\n       two characters of a file cannot be ID; see:\r\n       http://support.microsoft.com /kb/323626 *}\r\n    {if \$smarty.foreach.row.first && \$column.field_title == \"ID\"}\r\n      .ID\r\n    {else}\r\n      {\$column.field_title|escape:''csv''}\r\n    {/if}\r\n    {if !\$smarty.foreach.row.last},{/if}\r\n  {/foreach}\r\n{/strip}\r\n{foreach from=\$submissions item=submission name=row}{strip}\r\n  {foreach from=\$display_fields item=field_info name=col_row}\r\n    {assign var=col_name value=\$field_info.col_name}\r\n    {assign var=value value=\$submission.\$col_name}\r\n    {smart_display_field form_id=\$form_id view_id=\$view_id\r\n      submission_id=\$submission.submission_id field_info=\$field_info\r\n      field_types=\$field_types settings=\$settings value=\$value\r\n      escape=\"csv\"}\r\n    {* if this wasn''t the last row, output a comma *}\r\n    {if !\$smarty.foreach.col_row.last},{/if}\r\n  {/foreach}\r\n{/strip}\r\n{if !\$smarty.foreach.row.last}\r\n{/if}\r\n{/foreach}', 1)";
  $queries[] = "INSERT INTO {$g_table_prefix}module_export_types VALUES (6, '$all_submissions', 'show', 'form{\$form_id}_{\$datetime}.xml', 3, '<export>\r\n  <export_datetime>{\$datetime}</export_datetime>\r\n  <export_unixtime>{\$U}</export_unixtime>\r\n  <form_info>\r\n    <form_id>{\$form_id}</form_id>\r\n    <form_name><![CDATA[{\$form_name}]]></form_name>\r\n    <form_url>{\$form_url}</form_url>\r\n  </form_info>\r\n  <view_info>\r\n    <view_id>{\$view_id}</view_id>\r\n    <view_name><![CDATA[{\$view_name}]]></view_name>\r\n  </view_info>\r\n  <submissions>\r\n    {foreach from=\$submissions item=submission name=row}      \r\n      <submission>\r\n       {foreach from=\$display_fields item=field_info name=col_row}\r\n         {assign var=col_name value=\$field_info.col_name}\r\n         {assign var=value value=\$submission.\$col_name}\r\n       <{\$col_name}><![CDATA[{smart_display_field form_id=\$form_id \r\n      view_id=\$view_id submission_id=\$submission.submission_id\r\n      field_info=\$field_info field_types=\$field_types \r\n      settings=\$settings value=\$value}]]></{\$col_name}>\r\n        {/foreach}\r\n       </submission>\r\n    {/foreach}\r\n  </submissions>\r\n</export>', 1)";

  // add the module settings
  $upload_dir = str_replace("\\", "\\\\", $g_root_dir);
  $separator = "/";
  if (strtoupper(substr(PHP_OS, 0, 3) == 'WIN'))
    $separator = "\\\\";

  $upload_dir .= "{$separator}upload";
  $queries[] = "INSERT INTO {$g_table_prefix}settings (setting_name, setting_value, module) VALUES ('file_upload_dir', '$upload_dir', 'export_manager')";
  $queries[] = "INSERT INTO {$g_table_prefix}settings (setting_name, setting_value, module) VALUES ('file_upload_url', '$g_root_url/upload', 'export_manager')";

  foreach ($queries as $query)
  {
    $result = mysql_query($query);
    if (!$result)
    {
      return array(false, $LANG["export_manager"]["notify_installation_problem_c"] . " <b>" . mysql_error() . "</b>");
    }
  }

  return array(true, $LANG["export_manager"]["notify_reset_to_default"]);
}


function exp_remove_tables()
{
  global $g_table_prefix;

  @mysql_query("DROP TABLE {$g_table_prefix}module_export_groups");
  @mysql_query("DROP TABLE {$g_table_prefix}module_export_group_clients");
  @mysql_query("DROP TABLE {$g_table_prefix}module_export_types");
}


function exp_clear_table_data()
{
  global $g_table_prefix;

  @mysql_query("TRUNCATE {$g_table_prefix}module_export_group_clients");
  @mysql_query("TRUNCATE {$g_table_prefix}module_export_groups");
  @mysql_query("TRUNCATE {$g_table_prefix}module_export_types");
  @mysql_query("DELETE FROM {$g_table_prefix}settings WHERE module = 'export_manager'");
}