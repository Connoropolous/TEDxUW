<?php

require_once("../../global/library.php");
ft_init_module_page();
$request = array_merge($_POST, $_GET);

if (isset($_POST["update"]))
{
  list($g_success, $g_message) = tinymce_update_settings($_POST);
}

$tinymce_field_type = ft_get_field_type_by_identifier("tinymce");

// convert the settings into a friendlier format for extraction by the page
$settings = array();
foreach ($tinymce_field_type["settings"] as $setting_info)
{
  $settings[$setting_info["field_setting_identifier"]] = $setting_info["default_value"];
}

$page_vars = array();
$page_vars["module_settings"] = $settings;
$page_vars["head_string"] = "<script type=\"text/javascript\" src=\"$g_root_url/modules/field_type_tinymce/tinymce/jquery.tinymce.js\"></script>";
$page_vars["head_js"] =<<< EOF
$(function() {
  $("input[name=show_path]").bind("change", function() {
    if (this.value == "yes") {
      $("input[name=path_info_location],input[name=resizing]").attr("disabled", "");
      $(".subelements label").removeClass("light_grey");
    } else {
      $("input[name=path_info_location],input[name=resizing]").attr("disabled", "disabled");
      $(".subelements label").addClass("light_grey");
    }
  });

  $("input, select").bind("change", update_editor);
  update_editor(true);

  // changes a toolbar for a particular textarea
  function update_editor(is_initializing) {
    var settings = {
      script_url: g.root_url + "/modules/field_type_tinymce/tinymce/tiny_mce.js",
      theme:      "advanced",
      theme_advanced_toolbar_location: $("input[name=location]:checked").val(),
      theme_advanced_toolbar_align: $("input[name=alignment]:checked").val(),
      theme_advanced_buttons1: "",
      theme_advanced_buttons2: "",
      theme_advanced_buttons3: "",
      theme_advanced_resize_horizontal: false,
      theme_advanced_path_location: ""
    };
    if ($("input[name=show_path]:checked").val() == "yes") {
      settings.theme_advanced_path_location = $("input[name=path_info_location]:checked").val(),
      settings.theme_advanced_resizing      = ($("input[name=resizing]:checked").val() == "yes") ? true : false
    }
    var toolbar = $("#toolbar").val();
    switch (toolbar) {
      case "basic":
        settings.theme_advanced_buttons1 = "bold,italic,underline,strikethrough,|,bullist,numlist";
        break;
      case "simple":
        settings.theme_advanced_buttons1 = "bold,italic,underline,strikethrough,|,bullist,numlist,|,outdent,indent,|,blockquote,hr,|,link,unlink,forecolorpicker,backcolorpicker";
        break;
      case "advanced":
        settings.theme_advanced_buttons1 = "bold,italic,underline,strikethrough,|,bullist,numlist,|,outdent,indent,|,blockquote,hr,|,undo,redo,link,unlink,|,fontselect,fontsizeselect";
        settings.theme_advanced_buttons2 = "forecolorpicker,backcolorpicker,|,sub,sup,code";
        break;
      case "expert":
        settings.theme_advanced_buttons1 = "bold,italic,underline,strikethrough,|,bullist,numlist,|,outdent,indent,|,blockquote,hr,|,undo,redo,link,unlink,|,formatselect,fontselect,fontsizeselect";
        settings.theme_advanced_buttons2 = "undo,redo,|,forecolorpicker,backcolorpicker,|,sub,sup,|,newdocument,blockquote,charmap,removeformat,cleanup,code";
        break;
    }

    if (is_initializing === true) {
      $("#example").tinymce(settings);
    } else {
      tinyMCE.execCommand("mceRemoveControl", false, "example");
      settings.mode = "exact";
      settings.elements = "example";
      tinyMCE.init(settings);
      tinyMCE.execCommand("addRemoveControl", false, "example");
    }
  }
});

EOF;

ft_display_module_page("templates/index.tpl", $page_vars);
