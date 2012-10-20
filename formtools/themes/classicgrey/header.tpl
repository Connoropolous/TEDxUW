<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="{$LANG.special_text_direction}">
<head>
  <title>{$head_title}</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <link rel="shortcut icon" href="{$theme_url}/images/favicon.ico">
  {template_hook location="head_top"}
  <script>
  //<![CDATA[
  var g = {literal}{{/literal}
    root_url:       "{$g_root_url}",
    error_colours:  ["ffbfbf", "ffeded"],
    notify_colours: ["c6e2ff", "f2f8ff"],
    js_debug:       {$g_js_debug}
  {literal}}{/literal};
  //]]>
  </script>
  <link type="text/css" rel="stylesheet" href="{$g_root_url}/global/css/main.css?v=2_1_0">
  <link type="text/css" rel="stylesheet" href="{$theme_url}/css/styles.css?v=2_1_0">
  <link href="{$theme_url}/css/smoothness/jquery-ui-1.8.14.custom.css" rel="stylesheet" type="text/css"/>
  <script src="{$g_root_url}/global/scripts/jquery.js"></script>
  <script src="{$theme_url}/scripts/jquery-ui-1.8.14.custom.min.js"></script>
  <script src="{$g_root_url}/global/scripts/general.js?v=2_1_0"></script>
  <script src="{$g_root_url}/global/scripts/rsv.js?v=2_1_0"></script>
  {$head_string}
  {$head_js}
  {$head_css}

  {template_hook location="head_bottom"}
</head>
<body>

<div id="container">
  <div id="header">{if $settings.logo_link}<a href="{$settings.logo_link}">{/if}<img src="{$theme_url}/images/header_logo.jpg" width="392" height="60" border="0" />{if $settings.logo_link}</a>{/if}</div>
  <div id="header_row">
    <div id="left_nav_top">
      {if $SESSION.account.is_logged_in && !$g_omit_top_bar}
        {if $settings.release_type == "alpha"}
          <b>{$settings.program_version}-alpha-{$settings.release_date}</b>
        {elseif $settings.release_type == "beta"}
          <b>{$settings.program_version}-beta-{$settings.release_date}</b>
        {else}
          <b>{$settings.program_version}</b>
        {/if}
        {if $SESSION.account.account_type == "admin"}
          &nbsp;
          <a href="#" onclick="return ft.check_updates()" class="update_link">{$LANG.word_update}</a>
        {/if}
      {else}
        <div style="height: 20px"> </div>
      {/if}
    </div>
  </div>

  <div class="outer">
    <div class="inner">
      <div class="float-wrap">
      <div id="content">

        <div class="content_wrap">

          <div id="main_window">
            <div id="page_content">
