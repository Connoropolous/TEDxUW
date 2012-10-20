<?php

require("../../global/library.php");
ft_init_module_page();

$folder = dirname(__FILE__);
require_once("$folder/library.php");

if (isset($_POST["add_rule"]))
{
  list($g_success, $g_message, $hook_id) = hm_add_rule($_POST);
  $_POST["hook_id"] = $hook_id;
}
// this updates a rule and returns the new hook ID
else if (isset($_POST["update_rule"]))
{
  list($g_success, $g_message, $new_hook_id) = hm_update_rule($_POST["hook_id"], $_POST);
  $_GET["hook_id"] = $new_hook_id;
}

$hook_id = ft_load_module_field("hooks_manager", "hook_id", "hook_id");
$rule_info = hm_get_rule($hook_id);
$hook_info = hm_get_hooks();
$code_hooks = $hook_info["code_hooks"];
$js_code_hook_info = hm_convert_hook_info_to_json("code_hooks", $code_hooks);
$template_hooks = $hook_info["template_hooks"];
$js_template_hook_info = hm_convert_hook_info_to_json("template_hooks", $template_hooks);

// ------------------------------------------------------------------------------------------------

$page_vars = array();
$page_vars["head_title"] = $L["phrase_edit_rule"];
$page_vars["rule_info"]  = $rule_info;
$page_vars["code_hooks"]     = $code_hooks;
$page_vars["template_hooks"] = $template_hooks;
$page_vars["head_js"] =<<< EOF
$js_code_hook_info
$js_template_hook_info
var rules = [];
rules.push("required,rule_name,{$L["validation_no_rule_name"]}");
rules.push("required,hook_type,{$L["validation_no_hook_type"]}");
rules.push("if:hook_type=code,required,code_hook_dropdown,{$L["validation_no_code_hook"]}");
rules.push("if:hook_type=template,required,template_hook_dropdown,{$L["validation_no_template_hook"]}");
rules.push("if:hook_type=template,required,template_hook_code_type,{$L["validation_no_content_type"]}");
rules.push("if:hook_type=custom,required,custom_hook,{$L["validation_no_custom_hook"]}");
rules.push("if:hook_type=custom,reg_exp,custom_hook,^[a-zA-Z0-9_]+$,{$L["validation_invalid_custom_hook_name"]}");
rules.push("if:hook_type=custom,required,custom_hook_code_type,{$L["validation_no_content_type"]}");

if (hm === undefined) {
  var hm = {};
}
hm.current_code_hook_type = "{$rule_info["hook_type"]}";

$(function() {
  hm.init_page();
  $("input[name=hook_type]").bind("change", function() { hm.select_hook_type(this.value); });
});
EOF;

$page_vars["head_string"] =<<< EOF
<script src="$g_root_url/modules/hooks_manager/global/hooks_manager.js"></script>
<script src="$g_root_url/global/codemirror/js/codemirror.js"></script>
<link type="text/css" rel="stylesheet" href="$g_root_url/modules/hooks_manager/global/styles.css">
EOF;

ft_display_module_page("templates/edit.tpl", $page_vars);