var em_ns = {
  delete_export_type_dialog: $("<div></div>")
};

$(function() {
  $(".icon_list").bind("click", function(e) {
    em_ns.select_icon(e.target);
  });
});


// el is either the image or an li
em_ns.select_icon = function(el) {
  $(el).closest("ul").find("li").removeClass("selected");

  var li = $(el).closest("li");
  li.addClass("selected");

  if (li.hasClass("no_icon")) {
    $("#icon").val("");
  } else {
    var src = li.find("img").attr("src");
    var parts = src.split("/");
    var image = parts[parts.length-1];
    $("#icon").val(image);
  }
}


em_ns.delete_export_type = function(el) {
  var export_type_id = $(el).closest(".row_group").find(".sr_order").val();

  ft.create_dialog({
    dialog: em_ns.delete_export_type_dialog,
    title:  g.messages["phrase_please_confirm"],
    popup_type: "warning",
    content: g.messages["confirm_delete_export_type"],
    buttons: [{
      text:  g.messages["word_yes"],
      click: function() {
        window.location = "edit.php?page=export_types&delete=" + export_type_id;
      }
    },
    {
      text:  g.messages["word_no"],
      click: function() {
        $(this).dialog("close");
      }
    }]
  });
}