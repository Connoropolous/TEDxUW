<?php /* Smarty version 2.6.18, created on 2012-10-14 20:46:34
         compiled from C:%5CUsers%5CConnor%5CDocuments%5CCodeCraft%5CTEDxUW%5Cformtools/themes/default/admin/settings/tab_accounts.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'upper', 'C:\\Users\\Connor\\Documents\\CodeCraft\\TEDxUW\\formtools/themes/default/admin/settings/tab_accounts.tpl', 1, false),array('modifier', 'escape', 'C:\\Users\\Connor\\Documents\\CodeCraft\\TEDxUW\\formtools/themes/default/admin/settings/tab_accounts.tpl', 20, false),array('modifier', 'explode', 'C:\\Users\\Connor\\Documents\\CodeCraft\\TEDxUW\\formtools/themes/default/admin/settings/tab_accounts.tpl', 123, false),array('modifier', 'in_array', 'C:\\Users\\Connor\\Documents\\CodeCraft\\TEDxUW\\formtools/themes/default/admin/settings/tab_accounts.tpl', 125, false),array('function', 'ft_include', 'C:\\Users\\Connor\\Documents\\CodeCraft\\TEDxUW\\formtools/themes/default/admin/settings/tab_accounts.tpl', 3, false),array('function', 'themes_dropdown', 'C:\\Users\\Connor\\Documents\\CodeCraft\\TEDxUW\\formtools/themes/default/admin/settings/tab_accounts.tpl', 30, false),array('function', 'menus_dropdown', 'C:\\Users\\Connor\\Documents\\CodeCraft\\TEDxUW\\formtools/themes/default/admin/settings/tab_accounts.tpl', 35, false),array('function', 'pages_dropdown', 'C:\\Users\\Connor\\Documents\\CodeCraft\\TEDxUW\\formtools/themes/default/admin/settings/tab_accounts.tpl', 40, false),array('function', 'languages_dropdown', 'C:\\Users\\Connor\\Documents\\CodeCraft\\TEDxUW\\formtools/themes/default/admin/settings/tab_accounts.tpl', 51, false),array('function', 'timezone_offset_dropdown', 'C:\\Users\\Connor\\Documents\\CodeCraft\\TEDxUW\\formtools/themes/default/admin/settings/tab_accounts.tpl', 59, false),array('function', 'template_hook', 'C:\\Users\\Connor\\Documents\\CodeCraft\\TEDxUW\\formtools/themes/default/admin/settings/tab_accounts.tpl', 77, false),)), $this); ?>
    <div class="subtitle underline margin_top_large"><?php echo ((is_array($_tmp=$this->_tpl_vars['LANG']['phrase_client_account_settings'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
</div>

    <?php echo smarty_function_ft_include(array('file' => 'messages.tpl'), $this);?>


    <div class="margin_bottom_large">
      <?php echo $this->_tpl_vars['LANG']['text_account_settings_page']; ?>

    </div>

    <form action="<?php echo $this->_tpl_vars['same_page']; ?>
" method="post" onsubmit="return rsv.validate(this, rules)">
    <input type="hidden" name="page" value="accounts" />

    <table class="list_table check_areas" cellpadding="0" cellspacing="1">
    <tr>
      <th><?php echo $this->_tpl_vars['LANG']['word_setting']; ?>
</th>
      <th><?php echo $this->_tpl_vars['LANG']['phrase_setting_value']; ?>
</th>
      <th><?php echo $this->_tpl_vars['LANG']['phrase_clients_may_edit']; ?>
</th>
    </tr>
    <tr>
      <td class="pad_left_small" width="180"><?php echo $this->_tpl_vars['LANG']['phrase_page_titles']; ?>
</td>
      <td><input type="text" name="default_page_titles" style="width:98%" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['settings']['default_page_titles'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" /></td>
      <td class="check_area" align="center"><input type="checkbox" name="clients_may_edit_page_titles" <?php if ($this->_tpl_vars['settings']['clients_may_edit_page_titles'] == 'yes'): ?>checked="checked"<?php endif; ?> /></td>
    </tr>
    <tr>
      <td class="pad_left_small"><?php echo $this->_tpl_vars['LANG']['phrase_footer_text']; ?>
</td>
      <td><input type="text" name="default_footer_text" style="width:98%" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['settings']['default_footer_text'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" /></td>
      <td class="check_area" align="center"><input type="checkbox" name="clients_may_edit_footer_text" <?php if ($this->_tpl_vars['settings']['clients_may_edit_footer_text'] == 'yes'): ?>checked="checked"<?php endif; ?> /></td>
    </tr>
    <tr>
      <td class="pad_left_small"><?php echo $this->_tpl_vars['LANG']['phrase_default_theme']; ?>
</td>
      <td><?php echo smarty_function_themes_dropdown(array('name_id' => 'default_theme','default' => $this->_tpl_vars['settings']['default_theme'],'default_swatch' => $this->_tpl_vars['settings']['default_client_swatch']), $this);?>
</td>
      <td class="check_area" align="center"><input type="checkbox" name="clients_may_edit_theme" <?php if ($this->_tpl_vars['settings']['clients_may_edit_theme'] == 'yes'): ?>checked="checked"<?php endif; ?> /></td>
    </tr>
    <tr>
      <td class="pad_left_small"><?php echo $this->_tpl_vars['LANG']['phrase_default_menu']; ?>
</td>
      <td><?php echo smarty_function_menus_dropdown(array('name_id' => 'default_client_menu_id','type' => 'client','default' => $this->_tpl_vars['settings']['default_client_menu_id']), $this);?>
</td>
      <td align="center"> </td>
    </tr>
    <tr>
      <td class="pad_left_small"><?php echo $this->_tpl_vars['LANG']['phrase_login_page']; ?>
</td>
      <td><?php echo smarty_function_pages_dropdown(array('menu_type' => 'client','name_id' => 'default_login_page','default' => $this->_tpl_vars['settings']['default_login_page'],'omit_pages' => "logout,custom_url,client_form_submissions"), $this);?>
</td>
      <td align="center"> </td>
    </tr>
    <tr>
      <td class="pad_left_small"><?php echo $this->_tpl_vars['LANG']['phrase_logout_url']; ?>
</td>
      <td><input type="text" name="default_logout_url" value="<?php echo $this->_tpl_vars['settings']['default_logout_url']; ?>
" style="width: 98%" /></td>
      <td class="check_area" align="center"><input type="checkbox" name="clients_may_edit_logout_url" <?php if ($this->_tpl_vars['settings']['clients_may_edit_logout_url'] == 'yes'): ?>checked="checked"<?php endif; ?> /></td>
    </tr>
    <tr>
      <td class="pad_left_small"><?php echo $this->_tpl_vars['LANG']['phrase_default_language']; ?>
</td>
      <td>
        <?php echo smarty_function_languages_dropdown(array('name_id' => 'default_language','default' => $this->_tpl_vars['settings']['default_language']), $this);?>

        <input type="button" value="<?php echo $this->_tpl_vars['LANG']['phrase_refresh_list']; ?>
" onclick="window.location='index.php?page=accounts&refresh_lang_list'" />
        <a href="http://translations.formtools.org" target="_blank"><?php echo $this->_tpl_vars['LANG']['phrase_get_more']; ?>
</a>
      </td>
      <td align="center"><input type="checkbox" name="clients_may_edit_ui_language" <?php if ($this->_tpl_vars['settings']['clients_may_edit_ui_language'] == 'yes'): ?>checked="checked"<?php endif; ?> /></td>
    </tr>
    <tr>
      <td class="pad_left_small"><?php echo $this->_tpl_vars['LANG']['phrase_system_time_offset']; ?>
</td>
      <td><?php echo smarty_function_timezone_offset_dropdown(array('name_id' => 'default_timezone_offset','default' => $this->_tpl_vars['settings']['default_timezone_offset']), $this);?>
</td>
      <td class="check_area" align="center"><input type="checkbox" name="clients_may_edit_timezone_offset" <?php if ($this->_tpl_vars['settings']['clients_may_edit_timezone_offset'] == 'yes'): ?>checked="checked"<?php endif; ?> /></td>
    </tr>
    <tr>
      <td class="pad_left_small"><?php echo $this->_tpl_vars['LANG']['phrase_default_sessions_timeout']; ?>
</td>
      <td><input type="text" name="default_sessions_timeout" value="<?php echo $this->_tpl_vars['settings']['default_sessions_timeout']; ?>
" style="width: 30px" /> <?php echo $this->_tpl_vars['LANG']['word_minutes']; ?>
</td>
      <td class="check_area" align="center"><input type="checkbox" name="clients_may_edit_sessions_timeout" <?php if ($this->_tpl_vars['settings']['clients_may_edit_sessions_timeout'] == 'yes'): ?>checked="checked"<?php endif; ?> /></td>
    </tr>
    <tr>
      <td class="pad_left_small"><?php echo $this->_tpl_vars['LANG']['phrase_date_format']; ?>
</td>
      <td><input type="text" name="default_date_format" value="<?php echo $this->_tpl_vars['settings']['default_date_format']; ?>
" style="width: 80px" /> <span class="medium_grey"><?php echo $this->_tpl_vars['text_date_formatting_link']; ?>
</span></td>
      <td class="check_area" align="center"><input type="checkbox" name="clients_may_edit_date_format" <?php if ($this->_tpl_vars['settings']['clients_may_edit_date_format'] == 'yes'): ?>checked="checked"<?php endif; ?> /></td>
    </tr>
    <tr>
      <td class="pad_left_small"><?php echo $this->_tpl_vars['LANG']['phrase_forms_page_default_message']; ?>
</td>
      <td><textarea name="forms_page_default_message" style="width:98%"><?php echo $this->_tpl_vars['settings']['forms_page_default_message']; ?>
</textarea></td>
      <td align="center"></td>
    </tr>
    <?php echo smarty_function_template_hook(array('location' => 'admin_settings_client_settings_bottom'), $this);?>

    </table>

    <p class="subtitle"><?php echo $this->_tpl_vars['LANG']['phrase_security_settings']; ?>
</p>

    <table class="list_table check_areas" cellpadding="0" cellspacing="1">
    <tr>
      <th><?php echo $this->_tpl_vars['LANG']['word_setting']; ?>
</th>
      <th><?php echo $this->_tpl_vars['LANG']['phrase_setting_value']; ?>
</th>
      <th><?php echo $this->_tpl_vars['LANG']['phrase_clients_may_edit']; ?>
</th>
    </tr>
    <tr>
      <td width="290" class="pad_left_small"><?php echo $this->_tpl_vars['LANG']['phrase_auto_disable_account']; ?>
</td>
      <td>
        <select name="default_max_failed_login_attempts">
          <option value=""   <?php if ($this->_tpl_vars['settings']['default_max_failed_login_attempts'] == ""): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['LANG']['word_na']; ?>
</option>
          <option value="3"  <?php if ($this->_tpl_vars['settings']['default_max_failed_login_attempts'] == '3'): ?>selected<?php endif; ?>>3</option>
          <option value="4"  <?php if ($this->_tpl_vars['settings']['default_max_failed_login_attempts'] == '4'): ?>selected<?php endif; ?>>4</option>
          <option value="5"  <?php if ($this->_tpl_vars['settings']['default_max_failed_login_attempts'] == '5'): ?>selected<?php endif; ?>>5</option>
          <option value="6"  <?php if ($this->_tpl_vars['settings']['default_max_failed_login_attempts'] == '6'): ?>selected<?php endif; ?>>6</option>
          <option value="10" <?php if ($this->_tpl_vars['settings']['default_max_failed_login_attempts'] == '10'): ?>selected<?php endif; ?>>10</option>
        </select>
      </td>
      <td class="check_area" align="center"><input type="checkbox" name="clients_may_edit_max_failed_login_attempts"
        <?php if ($this->_tpl_vars['settings']['clients_may_edit_max_failed_login_attempts'] == 'yes'): ?>checked="checked"<?php endif; ?> /></td>
    </tr>
    <tr>
      <td class="pad_left_small"><?php echo $this->_tpl_vars['LANG']['phrase_min_password_length']; ?>
</td>
      <td>
        <select name="min_password_length">
          <option value=""   <?php if ($this->_tpl_vars['settings']['min_password_length'] == ""): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['LANG']['word_na']; ?>
</option>
          <option value="4"  <?php if ($this->_tpl_vars['settings']['min_password_length'] == '4'): ?>selected<?php endif; ?>>4</option>
          <option value="5"  <?php if ($this->_tpl_vars['settings']['min_password_length'] == '5'): ?>selected<?php endif; ?>>5</option>
          <option value="6"  <?php if ($this->_tpl_vars['settings']['min_password_length'] == '6'): ?>selected<?php endif; ?>>6</option>
          <option value="7"  <?php if ($this->_tpl_vars['settings']['min_password_length'] == '7'): ?>selected<?php endif; ?>>7</option>
          <option value="8"  <?php if ($this->_tpl_vars['settings']['min_password_length'] == '8'): ?>selected<?php endif; ?>>8</option>
          <option value="9"  <?php if ($this->_tpl_vars['settings']['min_password_length'] == '9'): ?>selected<?php endif; ?>>9</option>
          <option value="10" <?php if ($this->_tpl_vars['settings']['min_password_length'] == '10'): ?>selected<?php endif; ?>>10</option>
          <option value="12" <?php if ($this->_tpl_vars['settings']['min_password_length'] == '12'): ?>selected<?php endif; ?>>12</option>
        </select>
      </td>
      <td></td>
    </tr>
    <tr>
      <td class="pad_left_small"><?php echo $this->_tpl_vars['LANG']['phrase_required_password_chars']; ?>
</td>
      <td>
        <?php $this->assign('required_password_chars_arr', ((is_array($_tmp=",")) ? $this->_run_mod_handler('explode', true, $_tmp, $this->_tpl_vars['settings']['required_password_chars']) : explode($_tmp, $this->_tpl_vars['settings']['required_password_chars']))); ?>
        <div>
          <input type="checkbox" name="required_password_chars[]" value="uppercase" id="rpc1" <?php if (((is_array($_tmp='uppercase')) ? $this->_run_mod_handler('in_array', true, $_tmp, $this->_tpl_vars['required_password_chars_arr']) : in_array($_tmp, $this->_tpl_vars['required_password_chars_arr']))): ?>checked="checked"<?php endif; ?> />
            <label for="rpc1"><?php echo $this->_tpl_vars['LANG']['phrase_one_char_upper']; ?>
</label>
        </div>
        <div>
          <input type="checkbox" name="required_password_chars[]" value="number" id="rpc2" <?php if (((is_array($_tmp='number')) ? $this->_run_mod_handler('in_array', true, $_tmp, $this->_tpl_vars['required_password_chars_arr']) : in_array($_tmp, $this->_tpl_vars['required_password_chars_arr']))): ?>checked="checked"<?php endif; ?> />
            <label for="rpc2"><?php echo $this->_tpl_vars['LANG']['phrase_one_char_number']; ?>
</label>
        </div>
        <div>
          <input type="checkbox" name="required_password_chars[]" value="special_char" id="rpc3" <?php if (((is_array($_tmp='special_char')) ? $this->_run_mod_handler('in_array', true, $_tmp, $this->_tpl_vars['required_password_chars_arr']) : in_array($_tmp, $this->_tpl_vars['required_password_chars_arr']))): ?>checked="checked"<?php endif; ?> />
            <label for="rpc3"><?php echo $this->_tpl_vars['phrase_one_special_char']; ?>
</label>
        </div>
      </td>
      <td>
      </td>
    </tr>
    <tr>
      <td class="pad_left_small"><?php echo $this->_tpl_vars['LANG']['phrase_prevent_password_reuse']; ?>
</td>
      <td>
        <select name="num_password_history">
          <option value=""   <?php if ($this->_tpl_vars['settings']['num_password_history'] == ""): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['LANG']['word_na']; ?>
</option>
          <option value="1"  <?php if ($this->_tpl_vars['settings']['num_password_history'] == '1'): ?>selected<?php endif; ?>>1</option>
          <option value="2"  <?php if ($this->_tpl_vars['settings']['num_password_history'] == '2'): ?>selected<?php endif; ?>>2</option>
          <option value="3"  <?php if ($this->_tpl_vars['settings']['num_password_history'] == '3'): ?>selected<?php endif; ?>>3</option>
          <option value="4"  <?php if ($this->_tpl_vars['settings']['num_password_history'] == '4'): ?>selected<?php endif; ?>>4</option>
          <option value="5"  <?php if ($this->_tpl_vars['settings']['num_password_history'] == '5'): ?>selected<?php endif; ?>>5</option>
          <option value="6"  <?php if ($this->_tpl_vars['settings']['num_password_history'] == '6'): ?>selected<?php endif; ?>>6</option>
          <option value="7"  <?php if ($this->_tpl_vars['settings']['num_password_history'] == '7'): ?>selected<?php endif; ?>>7</option>
          <option value="8"  <?php if ($this->_tpl_vars['settings']['num_password_history'] == '8'): ?>selected<?php endif; ?>>8</option>
          <option value="9"  <?php if ($this->_tpl_vars['settings']['num_password_history'] == '9'): ?>selected<?php endif; ?>>9</option>
          <option value="10" <?php if ($this->_tpl_vars['settings']['num_password_history'] == '10'): ?>selected<?php endif; ?>>10</option>
        </select>
      </td>
      <td></td>
    </tr>
    </table>

    <p>
      <input type="submit" name="update_accounts" value="<?php echo $this->_tpl_vars['LANG']['word_update']; ?>
" />
    </p>

  </form>