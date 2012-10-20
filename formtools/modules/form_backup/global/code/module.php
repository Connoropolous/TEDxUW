<?php


function form_backup__install()
{
  global $g_table_prefix;

  ft_register_hook("template", "form_backup", "admin_forms_list_bottom", "", "fb_display_create_form_backup_button", 50, true);
  mysql_query("INSERT INTO {$g_table_prefix}settings (setting_name, setting_value, module) VALUES ('show_backup_form_button', 'yes', 'form_backup')");

  return array(true, "");
}


function form_backup__upgrade($old_version, $new_version)
{
  global $g_table_prefix;

  $old_version_info = ft_get_version_info($old_version);

  if ($old_version_info["release_date"] < 20110708)
  {
    ft_register_hook("template", "form_backup", "admin_forms_list_bottom", "", "fb_display_create_form_backup_button", 50, true);
    mysql_query("INSERT INTO {$g_table_prefix}settings (setting_name, setting_value, module) VALUES ('show_backup_form_button', 'yes', 'form_backup')");
  }

  // there seems to have been a problem introduced in which there were two hooks registered, showing two "Form Backup" buttons.
  // this fixes it.
  if ($old_version_info["release_date"] < 20110828)
  {
    ft_unregister_module_hooks("form_backup");
    ft_register_hook("template", "form_backup", "admin_forms_list_bottom", "", "fb_display_create_form_backup_button", 50, true);
  }
}