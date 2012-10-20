// Our Export Manager namespace
if (typeof em == 'undefined') {
  em = {};
}
em.error_dialog = $("<div></div>");

$(function() {
  $("body").append("<form action=\"" + g.root_url + "/modules/export_manager/export.php\" id=\"export_manager_form\" method=\"post\"></form>");
});


/**
 * This function is called whenever the user clicks on one of the "Display" / "Generate" (or whatever they've been
 * renamed to) buttons in the Export Manager section at the bottom of the submission listing page. It performs the
 * appropriate action to display / generate the content.
 *
 * @param integer export_group_id
 * @param string action "popup", "new_window", "file"
 */
em.export_submissions = function(export_group_id, action) {
  var result_type = $("input[name=export_group_" + export_group_id + "_results]:checked").val();

  // if the user is only requesting to export the selected rows, check there's at least one selected
  if (result_type == "selected") {
    var num_selected = ms.update_display_row_count();
    if (num_selected == 0) {
      ft.create_dialog({
        dialog:     em.error_dialog,
        popup_type: "warning",
        title:      "Error", // need to add way for on-demand translations for JS scripts
        content:    g.messages["validation_select_rows_to_export"],
        buttons: [{
          text: "Okay",
          click: function() {
            $(this).dialog("close");
          }
        }]
      });
      return;
    }
  }

  switch (action) {
    case "popup":
      var height = em["export_group_id_" + export_group_id + "_height"];
      var width  = em["export_group_id_" + export_group_id + "_width"];
      var url = em.export_page + "?export_group_id=" + export_group_id + "&export_group_" + export_group_id + "_results=" + result_type;
      if ($("#export_group_" + export_group_id + "_export_type").length) {
        url += "&export_type_id=" + $("#export_group_" + export_group_id + "_export_type").val();
      }
      window.open(url, "export_popup", "resizable=yes,scrollbars=yes,width=" + width + ",height=" + height);
      break;

    case "new_window":
      $("#export_manager_form").attr("target", "_blank");
      var html = "<input type=\"hidden\" name=\"export_group_id\" value=\"" + export_group_id + "\" />"
               + "<input type=\"hidden\" name=\"export_group_" + export_group_id + "_results\" value=\"" + result_type + "\" />";
      if ($("#export_group_" + export_group_id + "_export_type").length) {
        var export_type_id = $("#export_group_" + export_group_id + "_export_type").val();
        html += "<input type=\"hidden\" name=\"export_type_id\" value=\"" + export_type_id + "\" />";
      }
      $("#export_manager_form").html(html).submit();
      break;

    case "file":
      var url = em.export_page + "?export_group_id=" + export_group_id +
        "&export_group_" + export_group_id + "_results=" + result_type + "&target_message_id=ft_message";
      if ($("#export_group_" + export_group_id + "_export_type").length) {
        url += "&export_type_id=" + $("#export_group_" + export_group_id + "_export_type").val();
      }
      $.ajax({
        url:      url,
        type:     "POST",
        dataType: "json",
        success:  ft.response_handler,
        error:    ft.error_handler
      })
      break;
  }
}
