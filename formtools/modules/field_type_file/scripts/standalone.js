/**
 * Contains all JS for the file upload module when used in a standalone context, outside of Form Tools. Right now
 * this is pretty much just for the Form Builder.
 */

$(function() {
  $(".cf_delete_file").each(function() {
    var field_id = $(this).closest(".cf_file").find(".cf_file_field_id").val();
    $(this).bind("click", function() {
      return files_ns.delete_submission_file(field_id, false);
    });
  });
});


// ------------------------------------------------------------------------------------------------

var files_ns = {};
files_ns.confirm_delete_dialog = $("<div id=\"confirm_delete_dialog\"></div>");


/**
 * Checks the file field has a value in it. This is used instead of the default RSV "required" rule
 * because if a file's already uploaded, it needs to pass validation.
 */
files_ns.check_required = function() {
  var errors = [];
  for (var i=0; i<rsv_custom_func_errors.length; i++) {
    if (rsv_custom_func_errors[i].func == "files_ns.check_required") {
      var field    = document.edit_submission_form[rsv_custom_func_errors[i].field];
      var field_id = rsv_custom_func_errors[i].field_id;
      var has_file = ($("#cf_file_" + field_id + "_content").css("display") == "block" && $("#cf_file_" + field_id + "_content").html() != "");
      if (!has_file && !field.value) {
        errors.push([field, rsv_custom_func_errors[i].err]);
      }
    }
  }
  if (errors.length) {
    return errors;
  }
  return true;
}


/**
 * Deletes a submission file.
 *
 * @param field_id
 * @param force_delete boolean
 */
files_ns.delete_submission_file = function(field_id, force_delete) {
  var page_url = g.root_url + "/modules/field_type_file/actions.php";

  var data = {
    action:            "delete_submission_file_standalone",
    field_id:          field_id,
    published_form_id: $("#form_tools_published_form_id").val(),
    return_vars:       { target_message_id: "file_field_" + field_id + "_message_id", field_id: field_id },
    force_delete:      force_delete
  };

  var confirm_delete = true;
  if (!force_delete) {
    ft.create_dialog({
      dialog:     files_ns.confirm_delete_dialog,
      popup_type: "warning",
      title:      g.messages["phrase_please_confirm"],
      content:    g.messages["confirm_delete_submission_file"],
      buttons: [{
        "text":  g.messages["word_yes"],
        "click": function() {
        ft.dialog_activity_icon($("#confirm_delete_dialog"), "show");
          $.ajax({
            url:      page_url,
            data:     data,
            type:     "GET",
            dataType: "json",
            success:  files_ns.delete_submission_file_response,
            error:    ft.error_handler
          });
        }
      },
      {
        "text":  g.messages["word_no"],
        "click": function() {
          $(this).dialog("close");
        }
      }]
    });
  } else {
    $.ajax({
      url:      page_url,
      data:     data,
      type:     "GET",
      dataType: "json",
      success:  files_ns.delete_submission_file_response,
      error:    ft.error_handler
    });
  }

  return false;
}


/**
 * Handles the successful responses for the delete file feature. Whether or not the file was *actually*
 * deleted is a separate matter. If the file couldn't be deleted, the user is provided the option of updating
 * the database record to just remove the reference.
 */
files_ns.delete_submission_file_response = function(data) {
  ft.dialog_activity_icon($("#confirm_delete_dialog"), "hide");
  $("#confirm_delete_dialog").dialog("close");

  // if it was a success, remove the link from the page
  if (data.success == 1) {
    var field_id = data.field_id;
    $("#cf_file_" + field_id + "_content").html("");
    $("#cf_file_" + field_id + "_no_content").show();
  }

  ft.display_message(data.target_message_id, data.success, data.message);
}
