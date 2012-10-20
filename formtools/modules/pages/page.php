<?php

require("../../global/session_start.php");

// this just checks that SOMEONE's logged in - even someone via the Submission Accounts module
ft_check_permission("user");
ft_include_module("pages");

$request = array_merge($_POST, $_GET);
$page_id = $request["id"];
$page_info = pg_get_page($page_id);

// check permissions! The above code handles booting a user out if they're not logged in,
// so the only case we're worried about
$account_type = isset($_SESSION["ft"]["account"]["account_type"]) ? $_SESSION["ft"]["account"]["account_type"] : "";
$account_id   = isset($_SESSION["ft"]["account"]["account_id"]) ? $_SESSION["ft"]["account"]["account_id"] : "";

if ($account_type == "client" && $page_info["access_type"] == "private")
{
  if (!in_array($account_id, $page_info["clients"]))
	{
	  ft_handle_error("Sorry, you do not have permissions to see this page.");
		exit;
	}
}

$content = $page_info["content"];
switch ($page_info["content_type"])
{
  case "php":
	  ob_start();
eval($page_info["content"]);
    $content = ob_get_contents();
    ob_end_clean();
    break;
  case "smarty":
    $content = ft_eval_smarty_string($page_info["content"]);
    break;
}

// ------------------------------------------------------------------------------------------------


$page_vars = array();
$page_vars["page"]         = "custom_page";
$page_vars["page_id"]      = $page_id;
$page_vars["phrase_edit_page"] = $LANG["pages"]["phrase_edit_page"];
$page_vars["account_type"] = $account_type;
$page_vars["page_url"]     = ft_get_page_url("custom_page");
$page_vars["head_title"]   = "{$LANG["pages"]["word_page"]} - {$page_info["heading"]}";
$page_vars["page_info"]    = $page_info;
$page_vars["content"]      = $content;

ft_display_page("../../modules/pages/templates/page.tpl", $page_vars);