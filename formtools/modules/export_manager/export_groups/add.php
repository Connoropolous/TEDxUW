<?php

require("../../../global/library.php");
ft_init_module_page();
require_once("../library.php");

$page_vars = array();
$page_vars["icons"] = exp_get_export_icons();
$page_vars["head_title"] = "{$L["module_name"]} - {$L["phrase_add_export_group"]}";
$page_vars["head_string"] =<<< END
  <link type="text/css" rel="stylesheet" href="$g_root_url/modules/export_manager/global/css/styles.css">
  <script src="$g_root_url/modules/export_manager/global/scripts/admin.js"></script>
END;

$page_vars["head_js"] =<<< END
var rules = [];
rules.push("required,group_name,{$L["validation_no_export_group_name"]}");
END;

ft_display_module_page("templates/export_groups/add.tpl", $page_vars);
