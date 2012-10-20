var hm = {};
hm.current_code_hook_type = "code"; // may be overridden by the page

hm.select_hook = function(func) {
  var paramsHTML = "";
  var valsHTML = "";
  if (func == "") {
    paramsHTML = "&#8212;";
    valsHTML   = "&#8212;";
  } else {
    var data = code_hooks[func];
    var params = code_hooks[func].params;
    for (var i=0; i<params.length; i++) {
      paramsHTML += "<div class=\"blue\">$" + params[i] + "</div>";
    }
    var vals = code_hooks[func].overridable;
    for (var i=0; i<vals.length; i++) {
      valsHTML += "<div class=\"blue\">$" + vals[i] + "</div>";
    }
  }

  $("#code_hook_params").html(paramsHTML);
  $("#code_hook_overridable_values").html(valsHTML);
}

hm.select_hook_type = function(hook_type) {
  if (hook_type == hm.current_code_hook_type) {
	  return;
  }
  $("#" + hm.current_code_hook_type + "_hook_fields").hide(300);
  setTimeout(function() { $("#" + hook_type + "_hook_fields").show(300); }, 300);
	hm.current_code_hook_type = hook_type;
}

hm.init_page = function() {
  if (hm.current_code_hook_type == "code") {
	  hm.select_hook($("#code_hook_dropdown").val());
	}
	hm.generate_custom_hook();
}

hm.add_rule_init = function() {
  if ($("#ht2").attr("checked")) {
	  hm.select_hook_type("template");
  }
  if ($("#ht3").attr("checked")) {
	  hm.select_hook_type("custom");
  }
  hm.generate_custom_hook();
}

hm.generate_custom_hook = function() {
  var custom_hook_name = $("#custom_hook").val();
	var str = "&#8212;";
	if (custom_hook_name) {
	  str = "{template_hook location=\"" + $("#custom_hook").val() + "\"}";
	}
	$("#custom_hook_smarty_code").html(str);
}
