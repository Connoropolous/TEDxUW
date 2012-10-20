<?php /* Smarty version 2.6.18, created on 2012-10-14 20:46:00
         compiled from C:%5CUsers%5CConnor%5CDocuments%5CCodeCraft%5CTEDxUW%5Cformtools/themes/default/admin/account/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ft_include', 'C:\\Users\\Connor\\Documents\\CodeCraft\\TEDxUW\\formtools/themes/default/admin/account/index.tpl', 1, false),array('function', 'template_hook', 'C:\\Users\\Connor\\Documents\\CodeCraft\\TEDxUW\\formtools/themes/default/admin/account/index.tpl', 12, false),array('function', 'themes_dropdown', 'C:\\Users\\Connor\\Documents\\CodeCraft\\TEDxUW\\formtools/themes/default/admin/account/index.tpl', 31, false),array('function', 'pages_dropdown', 'C:\\Users\\Connor\\Documents\\CodeCraft\\TEDxUW\\formtools/themes/default/admin/account/index.tpl', 35, false),array('function', 'languages_dropdown', 'C:\\Users\\Connor\\Documents\\CodeCraft\\TEDxUW\\formtools/themes/default/admin/account/index.tpl', 44, false),array('function', 'timezone_offset_dropdown', 'C:\\Users\\Connor\\Documents\\CodeCraft\\TEDxUW\\formtools/themes/default/admin/account/index.tpl', 50, false),)), $this); ?>
<?php echo smarty_function_ft_include(array('file' => 'header.tpl'), $this);?>


  <table cellpadding="0" cellspacing="0" height="35">
  <tr>
    <td width="45"><img src="<?php echo $this->_tpl_vars['images_url']; ?>
/icon_login.gif" height="34" width="34" /></td>
    <td class="title"><?php echo $this->_tpl_vars['LANG']['phrase_your_account']; ?>
</td>
  </tr>
  </table>

  <?php echo smarty_function_ft_include(array('file' => 'messages.tpl'), $this);?>


  <?php echo smarty_function_template_hook(array('location' => 'admin_account_top'), $this);?>


  <form method="post" name="login_info" action="<?php echo $this->_tpl_vars['same_page']; ?>
" onsubmit="return rsv.validate(this, rules)">

    <table class="list_table" cellpadding="0" cellspacing="1">
    <tr>
      <td class="pad_left" width="180"><?php echo $this->_tpl_vars['LANG']['phrase_first_name']; ?>
</td>
      <td><input type="text" name="first_name" value="<?php echo $this->_tpl_vars['admin_info']['first_name']; ?>
" size="20" /></td>
    </tr>
    <tr>
      <td class="pad_left"><?php echo $this->_tpl_vars['LANG']['phrase_last_name']; ?>
</td>
      <td><input type="text" name="last_name" value="<?php echo $this->_tpl_vars['admin_info']['last_name']; ?>
" size="20" /></td>
    </tr>
    <tr>
      <td class="pad_left"><?php echo $this->_tpl_vars['LANG']['word_email']; ?>
</td>
      <td><input type="text" name="email" value="<?php echo $this->_tpl_vars['admin_info']['email']; ?>
" size="50" /></td>
    </tr>
    <tr>
      <td class="pad_left"><?php echo $this->_tpl_vars['LANG']['word_theme']; ?>
</td>
      <td><?php echo smarty_function_themes_dropdown(array('name_id' => 'theme','default' => $this->_tpl_vars['admin_info']['theme'],'default_swatch' => $this->_tpl_vars['admin_info']['swatch']), $this);?>
</td>
    </tr>
    <tr>
      <td class="pad_left"><?php echo $this->_tpl_vars['LANG']['phrase_login_page']; ?>
</td>
      <td><?php echo smarty_function_pages_dropdown(array('menu_type' => 'admin','name_id' => 'login_page','default' => $this->_tpl_vars['admin_info']['login_page'],'omit_pages' => "custom_url,logout"), $this);?>
</td>
    </tr>
    <tr>
      <td class="pad_left"><?php echo $this->_tpl_vars['LANG']['phrase_logout_url']; ?>
</td>
      <td><input type="text" name="logout_url" value="<?php echo $this->_tpl_vars['admin_info']['logout_url']; ?>
" style="width:98%" /></td>
    </tr>
    <tr>
      <td class="pad_left"><?php echo $this->_tpl_vars['LANG']['word_language']; ?>
</td>
      <td>
        <?php echo smarty_function_languages_dropdown(array('name_id' => 'ui_language','default' => $this->_tpl_vars['admin_info']['ui_language']), $this);?>

        <input type="hidden" name="old_ui_language" value="<?php echo $this->_tpl_vars['admin_info']['ui_language']; ?>
" />
      </td>
    </tr>
    <tr>
      <td class="pad_left"><?php echo $this->_tpl_vars['LANG']['phrase_system_time_offset']; ?>
</td>
      <td><?php echo smarty_function_timezone_offset_dropdown(array('name_id' => 'timezone_offset','default' => $this->_tpl_vars['admin_info']['timezone_offset']), $this);?>
</td>
    </tr>
    <tr>
      <td class="pad_left"><?php echo $this->_tpl_vars['LANG']['phrase_sessions_timeout']; ?>
</td>
      <td><input type="text" name="sessions_timeout" value="<?php echo $this->_tpl_vars['admin_info']['sessions_timeout']; ?>
" style="width: 30px" /> <?php echo $this->_tpl_vars['LANG']['word_minutes']; ?>
</td>
    </tr>
    <tr>
      <td class="pad_left"><?php echo $this->_tpl_vars['LANG']['phrase_date_format']; ?>
</td>
      <td>
        <input type="text" name="date_format" value="<?php echo $this->_tpl_vars['admin_info']['date_format']; ?>
" style="width: 80px" />
        <span class="medium_grey"><?php echo $this->_tpl_vars['text_date_formatting_link']; ?>
</span>
      </td>
    </tr>
    </table>

    <p class="subtitle"><?php echo $this->_tpl_vars['LANG']['phrase_change_login_info']; ?>
</p>

    <table class="list_table" cellpadding="0" cellspacing="1">
    <tr>
      <td class="pad_left" width="180"><?php echo $this->_tpl_vars['LANG']['word_username']; ?>
</td>
      <td><input type="text" name="username" value="<?php echo $this->_tpl_vars['admin_info']['username']; ?>
" size="20" /></td>
    </tr>
    <tr>
      <td class="pad_left"><?php echo $this->_tpl_vars['LANG']['phrase_new_password']; ?>
</td>
      <td><input type="password" name="password" value="" size="20" autocomplete="off" /></td>
    </tr>
    <tr>
      <td class="pad_left" width="180"><?php echo $this->_tpl_vars['LANG']['phrase_new_password_reenter']; ?>
</td>
      <td><input type="password" name="password_2" value="" size="20" autocomplete="off" /></td>
    </tr>
    </table>

    <?php echo smarty_function_template_hook(array('location' => 'admin_account_bottom'), $this);?>


    <p>
      <input type="submit" value="<?php echo $this->_tpl_vars['LANG']['word_update']; ?>
" />
    </p>

  </form>

<?php echo smarty_function_ft_include(array('file' => 'footer.tpl'), $this);?>
