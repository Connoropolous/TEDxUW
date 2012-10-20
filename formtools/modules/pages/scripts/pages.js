/**
 * Contains all the relevant JS for the Pages module admin section.
 */
var pages_ns = {};
pages_ns.current_editor = null; // this is overwritten by the page. Values: "codemirror", "tinymce"

$(function() {
  if ($("#wysiwyg_content").length && $("#tinymce_available").val() == "yes") {
    $("#wysiwyg_content").tinymce({
      script_url: g.root_url + "/modules/field_type_tinymce/tinymce/tiny_mce.js",
      theme:      "advanced",
      theme_advanced_toolbar_location: "top",
      theme_advanced_toolbar_align: "left",
      theme_advanced_buttons1: "bold,italic,underline,strikethrough,|,bullist,numlist,|,outdent,indent,|,blockquote,hr,|,undo,redo,link,unlink,|,fontselect,fontsizeselect",
      theme_advanced_buttons2: "forecolorpicker,backcolorpicker,|,sub,sup,code",
      theme_advanced_buttons3: "",
      theme_advanced_resize_horizontal: false,
      theme_advanced_path_location: "bottom"
    });
  }
});


pages_ns.toggle_access_type = function(form_type) {
  switch (form_type) {
    case "admin":
    case "public":
      $("#custom_clients").hide();
      break;
    case "private":
      $("#custom_clients").show();
      break;
  }
}

pages_ns.toggle_wysiwyg_field = function(is_checked) {
  if (is_checked) {
    pages_ns.enable_editor("tinymce");
  } else {
    pages_ns.enable_editor("codemirror");
  }
}


/**
 * Whenever the user changes the content type (HTML, PHP or Smarty), the appropriate editor - Code Mirror
 * or TinyMCE needs to be shown & the content copied over. Also, the "Use WYSIWYG Editor" button may
 * or may not be relevant.
 */
pages_ns.change_content_type = function(content_type) {
  var is_html = (content_type == "html") ? true : false;

  // the "Use WYSIWYG editor" checkbox is only enabled if the user is entering HTML
  $("#uwe").attr("disabled", !is_html);

  // if the user just switched to HTML and the "Use WYWIWYG" editor is checked, display tinyMCE
  if (is_html && $("#uwe").attr("checked") && pages_ns.current_editor != "tinymce") {
    pages_ns.enable_editor("tinymce");
  }
  if (!is_html && pages_ns.current_editor != "codemirror") {
    pages_ns.enable_editor("codemirror");
  }
}


/**
 * This function handles toggling between editors. Basically it checks that the latest content
 * is always inserted into the appropriate editor.
 *
 * @param string editor "tinymce" or "codemirror"
 */
pages_ns.enable_editor = function(editor) {
  if (editor == "tinymce") {
    $("#wysiwyg_div").show();
    $("#codemirror_div").hide();
    $("#wysiwyg_content").tinymce().setContent(html_editor.getCode());
  } else {
	  // update the CodeMirror content
	  html_editor.setCode($("#wysiwyg_content").tinymce().getContent());
    $("#wysiwyg_div").hide();
    $("#codemirror_div").show();
  }
  pages_ns.current_editor = editor;
}


pages_ns.delete_page = function(page_id) {
  ft.create_dialog({
    title: g.messages["phrase_please_confirm"],
    content: g.messages["confirm_delete_page"],
    popup_type: "warning",
    buttons: [
      {
        text:  g.messages["word_yes"],
        click: function() {
          window.location = 'index.php?delete=' + page_id;
        }
      },
      {
        text:  g.messages["word_no"],
        click: function() {
          $(this).dialog("close");
        }
      }
    ]
  });

  return false;
}
