<?php

if (isset($_POST["update"]))
  list ($g_success, $g_message) = swift_update_settings($_POST);

$settings = ft_get_module_settings();

$remember_advanced_settings = false;
if (isset($_SESSION["ft"]["swift_mailer"]["remember_advanced_settings"]))
  $remember_advanced_settings = $_SESSION["ft"]["swift_mailer"]["remember_advanced_settings"];

$page_vars = array();
$page_vars["page"] = $page;
$page_vars["tabs"] = $tabs;
$page_vars["remember_advanced_settings"] = $remember_advanced_settings;
$page_vars["sm_settings"] = $settings;
$page_vars["text_settings_desc"] = ft_eval_smarty_string($L["text_settings_desc"], array("php_version"=> phpversion()));
$page_vars["head_js"] =<<<EOF
var rules = [];
rules.push("if:swiftmailer_enabled=yes,required,smtp_server,{$L["validation_no_smtp_server"]}");
rules.push("if:requires_authentication=yes,required,username,{$L["validation_no_username"]}");
rules.push("if:requires_authentication=yes,required,password,{$L["validation_no_password"]}");
rules.push("if:requires_authentication=yes,required,authentication_procedure,{$L["validation_no_authentication_procedure"]}");
rules.push("if:use_encryption=yes,required,encryption_type,{$L["validation_no_encryption_type"]}");

var page_ns = {
  toggle_enabled_fields: function(is_checked) {
    $("#smtp_server,#port").attr("disabled", (is_checked) ? "" : "disabled");
  },
  toggle_authentication_fields: function(is_checked) {
    $("#username, #password, #ap1, #ap2, #ap3").attr("disabled", (is_checked) ? "" : "disabled");
  },
  toggle_encryption_fields: function(is_checked) {
    $("#et1, #et2").attr("disabled", (is_checked) ? "" : "disabled");
  },
  toggle_antiflooding_fields: function(is_checked) {
    $("#anti_flooding_email_batch_size, #anti_flooding_email_batch_wait_time").attr("disabled", (is_checked) ? "" : "disabled");
  },
  toggle_advanced_settings: function() {
    var display_setting = $("#advanced_settings").css("display");
    var is_visible = false;
    if (display_setting == "none") {
      $("#advanced_settings").show("slow");
      is_visible = true;
    } else {
      $("#advanced_settings").hide("slow");
    }

    $.ajax({
      url:  g.root_url + "/modules/swift_mailer/actions.php",
      data: { action: "remember_advanced_settings", remember_advanced_settings: is_visible },
      type: "POST"
    });

    return false;
  }
}
EOF;

ft_display_module_page("templates/index.tpl", $page_vars);