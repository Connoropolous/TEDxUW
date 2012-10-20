<?php

require("../../global/library.php");
ft_init_module_page();

// if the user has the tinyMCE field module installed, offer the option of editing the pages with it
$tinymce_available = ft_check_module_available("field_type_tinymce");

$page_vars = array();
$page_vars["head_title"] = $L["phrase_add_page"];
$page_vars["tinymce_available"] = ($tinymce_available ? "yes" : "no");
$page_vars["head_string"] =<<< EOF
  <script src="$g_root_url/global/codemirror/js/codemirror.js"></script>
  <script src="scripts/pages.js"></script>
EOF;

if ($tinymce_available)
{
  $page_vars["head_string"] .= "<script src=\"$g_root_url/modules/field_type_tinymce/tinymce/jquery.tinymce.js\"></script>";
}

$page_vars["head_js"] =<<< EOF
if (typeof pages_ns == undefined) {
  var pages_ns = {};
}

pages_ns.current_editor = "tinymce";

var rules = [];
rsv.onCompleteHandler = function() {
  $("#use_wysiwyg_hidden").val($("#uwe").attr("checked") ? "yes" : "no");
  ft.select_all("selected_client_ids[]");
  return true;
}

EOF;

ft_display_module_page("templates/add.tpl", $page_vars);
