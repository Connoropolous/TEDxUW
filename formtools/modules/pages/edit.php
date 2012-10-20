<?php

require("../../global/library.php");
ft_init_module_page();
$folder = dirname(__FILE__);
require_once("$folder/library.php");

$tinymce_available = ft_check_module_available("field_type_tinymce");

$request = array_merge($_POST, $_GET);
$page_id = isset($request["page_id"]) ? $request["page_id"] : "";

if (isset($_POST["add_page"]))
  list($g_success, $g_message, $page_id) = pg_add_page($_POST);

if (empty($page_id))
{
  header("location: index.php");
  exit;
}

if (isset($_POST["update_page"]))
  list($g_success, $g_message) = pg_update_page($_POST["page_id"], $_POST);

$page_info = pg_get_page($page_id);


// this stores the default editor in the page. The values are either "codemirror", "tinymce": all
// code editing is done through one of those editors
$editor = ($page_info["content_type"] == "html" && $page_info["use_wysiwyg"] == "yes") ? "tinymce" : "codemirror";

// ------------------------------------------------------------------------------------------------

$page_vars = array();
$page_vars["head_title"] = $L["phrase_edit_page"];
$page_vars["page_id"] = $page_id;
$page_vars["page_info"] = $page_info;
$page_vars["tinymce_available"] = ($tinymce_available ? "yes" : "no");
$page_vars["head_string"] =<<<EOF
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

pages_ns.current_editor = "$editor";
var rules = [];
rsv.onCompleteHandler = function() {
  $("#use_wysiwyg_hidden").val($("#uwe").attr("checked") ? "yes" : "no");
  ft.select_all(document.pages_form["selected_client_ids[]"]);
  return true;
}
EOF;

ft_display_module_page("templates/edit.tpl", $page_vars);
