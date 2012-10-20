<?php /* Smarty version 2.6.18, created on 2012-10-20 17:27:57
         compiled from /Users/lucaszw/Sites/TEDxUW/formtools/themes/default/header.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'template_hook', '/Users/lucaszw/Sites/TEDxUW/formtools/themes/default/header.tpl', 8, false),array('function', 'ft_include', '/Users/lucaszw/Sites/TEDxUW/formtools/themes/default/header.tpl', 68, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="<?php echo $this->_tpl_vars['LANG']['special_text_direction']; ?>
">
<head>
  <?php if (! $this->_tpl_vars['swatch']): ?><?php $this->assign('swatch', 'green'); ?><?php endif; ?>
  <title><?php echo $this->_tpl_vars['head_title']; ?>
</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <link rel="shortcut icon" href="<?php echo $this->_tpl_vars['theme_url']; ?>
/images/favicon.ico">
  <?php echo smarty_function_template_hook(array('location' => 'head_top'), $this);?>

  <script>
  //<![CDATA[
  var g = <?php echo '{'; ?>

    root_url:       "<?php echo $this->_tpl_vars['g_root_url']; ?>
",
    error_colours:  ["ffbfbf", "ffb5b5"],
    notify_colours: ["c6e2ff", "97c7ff"],
    js_debug:       <?php echo $this->_tpl_vars['g_js_debug']; ?>

  <?php echo '}'; ?>
;
  //]]>
  </script>
  <link type="text/css" rel="stylesheet" href="<?php echo $this->_tpl_vars['g_root_url']; ?>
/global/css/main.css?v=20110802">
  <link type="text/css" rel="stylesheet" href="<?php echo $this->_tpl_vars['theme_url']; ?>
/css/styles.css?v=20110802">
  <link type="text/css" rel="stylesheet" href="<?php echo $this->_tpl_vars['theme_url']; ?>
/css/swatch_<?php echo $this->_tpl_vars['swatch']; ?>
.css">
  <link href="<?php echo $this->_tpl_vars['theme_url']; ?>
/css/smoothness/jquery-ui-1.8.6.custom.css" rel="stylesheet" type="text/css"/>
  <script src="<?php echo $this->_tpl_vars['g_root_url']; ?>
/global/scripts/jquery.js"></script>
  <script src="<?php echo $this->_tpl_vars['theme_url']; ?>
/scripts/jquery-ui.js"></script>
  <script src="<?php echo $this->_tpl_vars['g_root_url']; ?>
/global/scripts/general.js?v=20110815"></script>
  <script src="<?php echo $this->_tpl_vars['g_root_url']; ?>
/global/scripts/rsv.js?v=20110802"></script>
  <?php echo $this->_tpl_vars['head_string']; ?>

  <?php echo $this->_tpl_vars['head_js']; ?>

  <?php echo $this->_tpl_vars['head_css']; ?>

  <?php echo smarty_function_template_hook(array('location' => 'head_bottom'), $this);?>

</head>
<body>
<div id="container">
  <div id="header">
    <?php if ($this->_tpl_vars['SESSION']['account']['is_logged_in'] && ! $this->_tpl_vars['g_omit_top_bar']): ?>
      <div style="float:right">
        <table cellspacing="0" cellpadding="0" height="25">
        <tr>
          <td><img src="<?php echo $this->_tpl_vars['theme_url']; ?>
/images/account_section_left_<?php echo $this->_tpl_vars['swatch']; ?>
.jpg" border="0" /></td>
          <td id="account_section">
            <?php if ($this->_tpl_vars['settings']['release_type'] == 'alpha'): ?>
              <b><?php echo $this->_tpl_vars['settings']['program_version']; ?>
-alpha-<?php echo $this->_tpl_vars['settings']['release_date']; ?>
</b>
            <?php elseif ($this->_tpl_vars['settings']['release_type'] == 'beta'): ?>
              <b><?php echo $this->_tpl_vars['settings']['program_version']; ?>
-beta-<?php echo $this->_tpl_vars['settings']['release_date']; ?>
</b>
            <?php else: ?>
              <b><?php echo $this->_tpl_vars['settings']['program_version']; ?>
</b>
            <?php endif; ?>
            <?php if ($this->_tpl_vars['SESSION']['account']['account_type'] == 'admin' && ! $this->_tpl_vars['g_hide_upgrade_link']): ?>
              |
              <a href="#" onclick="return ft.check_updates()" class="update_link"><?php echo $this->_tpl_vars['LANG']['word_update']; ?>
</a>
            <?php endif; ?>
          </td>
          <td><img src="<?php echo $this->_tpl_vars['theme_url']; ?>
/images/account_section_right_<?php echo $this->_tpl_vars['swatch']; ?>
.jpg" border="0" /></td>
        </tr>
        </table>
      </div>
    <?php endif; ?>

    <span style="float:left; padding-top: 8px; padding-right: 10px">
      <?php if ($this->_tpl_vars['settings']['logo_link']): ?><a href="<?php echo $this->_tpl_vars['settings']['logo_link']; ?>
"><?php endif; ?><img src="<?php echo $this->_tpl_vars['theme_url']; ?>
/images/logo_<?php echo $this->_tpl_vars['swatch']; ?>
.jpg" border="0" width="220" height="61" /><?php if ($this->_tpl_vars['settings']['logo_link']): ?></a><?php endif; ?>
    </span>
  </div>
  <div id="content">
    <table cellspacing="0" cellpadding="0" width="100%">
    <tr>
      <td width="180" valign="top">
        <div id="left_nav">
          <?php echo smarty_function_ft_include(array('file' => "menu.tpl"), $this);?>

        </div>
      </td>
      <td valign="top">
        <div style="width:740px">