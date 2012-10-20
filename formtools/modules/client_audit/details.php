<?php

require_once("../../global/library.php");
ft_init_module_page();
$request = array_merge($_POST, $_GET);

$change_id = $request["change_id"];
$change_info = ca_get_change($change_id);

$changes = array();
if (isset($change_info["account_info"]["changed_fields"]) && !empty($change_info["account_info"]["changed_fields"]))
  $changes = explode(",", $change_info["account_info"]["changed_fields"]);

$permissions = "";
$added_forms   = array();
$removed_forms = array();
$added_views   = array();
$removed_views = array();
$all_form_views = array();
if ($change_info["change_type"] == "permissions")
{
  $permissions = ca_deserialize_permission_string($change_info["permissions"]["permissions"]);

  $form_ids = array_keys($permissions);
  foreach ($form_ids as $form_id)
    $all_form_views[$form_id] = ft_get_form_views($form_id);

  if (!empty($change_info["permissions"]["added_forms"]))
    $added_forms   = explode(",", $change_info["permissions"]["added_forms"]);

  if (!empty($change_info["permissions"]["removed_forms"]))
    $removed_forms = explode(",", $change_info["permissions"]["removed_forms"]);

  if (!empty($change_info["permissions"]["added_views"]))
    $added_views   = explode(",", $change_info["permissions"]["added_views"]);

  if (!empty($change_info["permissions"]["removed_views"]))
    $removed_views = explode(",", $change_info["permissions"]["removed_views"]);
}

// now figure out which settings have actually changed since the last update
$changed_settings = array();
while (list($setting_name, $setting_value) = each($change_info["account_settings"]))
{
  if (in_array($setting_name, $changes))
    $changed_settings[$setting_name] = $setting_value;
}

$all_change_types = array("login", "logout", "account_created", "account_deleted", "admin_update",
  "client_update", "account_disabled_from_failed_logins", "permissions");

$client_id    = ft_load_module_field("client_audit", "client_id", "client_id");
$page         = ft_load_module_field("client_audit", "page", "page", 1);
$change_types = ft_load_module_field("client_audit", "change_types", "change_types", $all_change_types);
$date_range   = ft_load_module_field("client_audit", "date_range", "date_range", "all");
$date_from    = ft_load_module_field("client_audit", "date_from", "date_from");
$date_to      = ft_load_module_field("client_audit", "date_to", "date_to");

$search_criteria = array(
  "per_page"     => 20,
  "page"         => $page,
  "client_id"    => $client_id,
  "change_types" => $change_types,
  "date_range"   => $date_range,
  "date_from"    => $date_from,
  "date_to"      => $date_to
);

$nav_info = ca_get_details_page_nav_links($change_id, $search_criteria);

$settings_labels = array(
  "company_name" => $LANG["phrase_company_name"],
  "footer_text"  => $LANG["phrase_footer_text"],
  "max_failed_login_attempts" => $LANG["phrase_auto_disable_account"],
  "min_password_length" => $LANG["phrase_min_password_length"],
  "num_password_history" => $LANG["phrase_prevent_password_reuse"],
  "required_password_chars" => $LANG["phrase_required_password_chars"],
  "page_titles" => $LANG["phrase_page_titles"]
);

// ------------------------------------------------------------------------------------------------

$page_vars = array();
$page_vars["search_criteria"]  = $search_criteria;
$page_vars["change_info"]      = $change_info;
$page_vars["changes"]          = $changes;
$page_vars["changed_settings"] = $changed_settings;
$page_vars["nav_info"]         = $nav_info;
$page_vars["settings_labels"]  = $settings_labels;
$page_vars["permissions"]      = $permissions;
$page_vars["added_forms"]      = $added_forms;
$page_vars["removed_forms"]    = $removed_forms;
$page_vars["added_views"]      = $added_views;
$page_vars["removed_views"]    = $removed_views;
$page_vars["all_form_views"]   = $all_form_views;

$page_vars["head_string"] =<<< EOF
  <link type="text/css" rel="stylesheet" href="$g_root_url/modules/client_audit/global/styles.css">
EOF;

ft_display_module_page("templates/details.tpl", $page_vars);
