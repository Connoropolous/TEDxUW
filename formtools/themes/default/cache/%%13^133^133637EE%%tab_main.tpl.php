<?php /* Smarty version 2.6.18, created on 2012-10-20 17:33:43
         compiled from /Users/lucaszw/Sites/TEDxUW/formtools/themes/default/admin/settings/tab_main.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'upper', '/Users/lucaszw/Sites/TEDxUW/formtools/themes/default/admin/settings/tab_main.tpl', 1, false),array('modifier', 'default', '/Users/lucaszw/Sites/TEDxUW/formtools/themes/default/admin/settings/tab_main.tpl', 24, false),array('function', 'ft_include', '/Users/lucaszw/Sites/TEDxUW/formtools/themes/default/admin/settings/tab_main.tpl', 3, false),array('function', 'template_hook', '/Users/lucaszw/Sites/TEDxUW/formtools/themes/default/admin/settings/tab_main.tpl', 72, false),)), $this); ?>
  <div class="subtitle underline margin_top_large"><?php echo ((is_array($_tmp=$this->_tpl_vars['LANG']['word_settings'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
</div>

  <?php echo smarty_function_ft_include(array('file' => 'messages.tpl'), $this);?>


  <form action="<?php echo $this->_tpl_vars['same_page']; ?>
" method="post" onsubmit="return rsv.validate(this, rules)">
    <input type="hidden" name="page" value="main" />

    <table class="list_table" cellpadding="0" cellspacing="1">
    <tr>
      <td class="pad_left_small" width="200"><?php echo $this->_tpl_vars['LANG']['phrase_core_version']; ?>
</td>
      <td class="pad_left_small">
        <?php if ($this->_tpl_vars['settings']['release_type'] == 'alpha'): ?>
          <span><?php echo $this->_tpl_vars['settings']['program_version']; ?>
-alpha-<?php echo $this->_tpl_vars['settings']['release_date']; ?>
</span>
        <?php elseif ($this->_tpl_vars['settings']['release_type'] == 'beta'): ?>
          <span><?php echo $this->_tpl_vars['settings']['program_version']; ?>
-beta-<?php echo $this->_tpl_vars['settings']['release_date']; ?>
</span>
        <?php else: ?>
          <span><?php echo $this->_tpl_vars['settings']['program_version']; ?>
</span>
        <?php endif; ?>
      </td>
    </tr>
    <tr>
      <td class="pad_left_small"><?php echo $this->_tpl_vars['LANG']['phrase_api_version']; ?>
</td>
      <td class="pad_left_small">
        <?php echo ((is_array($_tmp=@$this->_tpl_vars['settings']['api_version'])) ? $this->_run_mod_handler('default', true, $_tmp, "<span class=\"light_grey\">".($this->_tpl_vars['LANG']['notify_no_api_installed'])."</span>") : smarty_modifier_default($_tmp, "<span class=\"light_grey\">".($this->_tpl_vars['LANG']['notify_no_api_installed'])."</span>")); ?>

      </td>
    </tr>
    <tr>
      <td class="pad_left_small"><?php echo $this->_tpl_vars['LANG']['phrase_program_name']; ?>
</td>
      <td><input type="text" name="program_name" value="<?php echo $this->_tpl_vars['settings']['program_name']; ?>
" style="width: 98%" /></td>
    </tr>
    <tr>
      <td class="pad_left_small"><?php echo $this->_tpl_vars['LANG']['phrase_logo_link_url']; ?>
</td>
      <td><input type="text" name="logo_link" value="<?php echo $this->_tpl_vars['settings']['logo_link']; ?>
" style="width: 98%" /></td>
    </tr>
    <tr>
      <td class="pad_left_small"><?php echo $this->_tpl_vars['LANG']['phrase_num_clients_per_page']; ?>
</td>
      <td><input type="text" name="num_clients_per_page" value="<?php echo $this->_tpl_vars['settings']['num_clients_per_page']; ?>
" style="width: 30px" /></td>
    </tr>
    <tr>
      <td class="pad_left_small"><?php echo $this->_tpl_vars['LANG']['phrase_num_emails_per_page']; ?>
</td>
      <td><input type="text" name="num_emails_per_page" value="<?php echo $this->_tpl_vars['settings']['num_emails_per_page']; ?>
" style="width: 30px" /></td>
    </tr>
    <tr>
      <td class="pad_left_small"><?php echo $this->_tpl_vars['LANG']['phrase_num_forms_per_page']; ?>
</td>
      <td><input type="text" name="num_forms_per_page" value="<?php echo $this->_tpl_vars['settings']['num_forms_per_page']; ?>
" style="width: 30px" /></td>
    </tr>
    <tr>
      <td class="pad_left_small"><?php echo $this->_tpl_vars['LANG']['phrase_num_option_lists_per_page']; ?>
</td>
      <td><input type="text" name="num_option_lists_per_page" value="<?php echo $this->_tpl_vars['settings']['num_option_lists_per_page']; ?>
" style="width: 30px" /></td>
    </tr>
    <tr>
      <td class="pad_left_small"><?php echo $this->_tpl_vars['LANG']['phrase_num_menus_per_page']; ?>
</td>
      <td><input type="text" name="num_menus_per_page" value="<?php echo $this->_tpl_vars['settings']['num_menus_per_page']; ?>
" style="width: 30px" /></td>
    </tr>
    <tr>
      <td class="pad_left_small"><?php echo $this->_tpl_vars['LANG']['phrase_num_modules_per_page']; ?>
</td>
      <td><input type="text" name="num_modules_per_page" value="<?php echo $this->_tpl_vars['settings']['num_modules_per_page']; ?>
" style="width: 30px" /></td>
    </tr>
    <tr>
      <td class="pad_left_small"><?php echo $this->_tpl_vars['LANG']['phrase_default_date_field_search_value']; ?>
</td>
      <td>
        <select name="default_date_field_search_value">
          <option value="none" <?php if ($this->_tpl_vars['settings']['default_date_field_search_value'] == 'none'): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['LANG']['word_none']; ?>
</option>
          <option value="today" <?php if ($this->_tpl_vars['settings']['default_date_field_search_value'] == 'today'): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['LANG']['word_today']; ?>
</option>
          <option value="last_7_days" <?php if ($this->_tpl_vars['settings']['default_date_field_search_value'] == 'last_7_days'): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['LANG']['phrase_last_7_days']; ?>
</option>
          <option value="month_to_date" <?php if ($this->_tpl_vars['settings']['default_date_field_search_value'] == 'month_to_date'): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['LANG']['phrase_month_to_date']; ?>
</option>
          <option value="year_to_date" <?php if ($this->_tpl_vars['settings']['default_date_field_search_value'] == 'year_to_date'): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['LANG']['phrase_year_to_date']; ?>
</option>
          <option value="previous_month" <?php if ($this->_tpl_vars['settings']['default_date_field_search_value'] == 'previous_month'): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['LANG']['phrase_the_previous_month']; ?>
</option>
        </select>
      </td>
    </tr>
    <?php echo smarty_function_template_hook(array('location' => 'admin_settings_main_tab_bottom'), $this);?>

    </table>

    <p>
      <input type="submit" name="update_main" value="<?php echo $this->_tpl_vars['LANG']['word_update']; ?>
" />
    </p>

  </form>
