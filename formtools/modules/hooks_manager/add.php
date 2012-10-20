<?php

require("../../global/library.php");
ft_init_module_page();

$hook_info = hm_get_hooks();
$code_hooks = $hook_info["code_hooks"];
$js_code_hook_info = hm_convert_hook_info_to_json("code_hooks", $code_hooks);
$template_hooks = $hook_info["template_hooks"];
$js_template_hook_info = hm_convert_hook_info_to_json("template_hooks", $template_hooks);

$page_vars = array();
$page_vars["head_title"] = $L["phrase_add_rule"];
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

$(function() { hm.add_rule_init(); });
EOF;

$page_vars["head_string"] =<<< EOF
<script src="$g_root_url/modules/hooks_manager/global/hooks_manager.js"></script>
<script src="$g_root_url/global/codemirror/js/codemirror.js"></script>
<link type="text/css" rel="stylesheet" href="$g_root_url/modules/hooks_manager/global/styles.css">
EOF;

ft_display_module_page("templates/add.tpl", $page_vars);