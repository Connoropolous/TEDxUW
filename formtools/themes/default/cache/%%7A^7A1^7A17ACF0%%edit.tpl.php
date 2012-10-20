<?php /* Smarty version 2.6.18, created on 2012-10-14 21:07:58
         compiled from C:%5CUsers%5CConnor%5CDocuments%5CCodeCraft%5CTEDxUW%5Cformtools/themes/default/admin/forms/edit.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ft_include', 'C:\\Users\\Connor\\Documents\\CodeCraft\\TEDxUW\\formtools/themes/default/admin/forms/edit.tpl', 1, false),array('function', 'template_hook', 'C:\\Users\\Connor\\Documents\\CodeCraft\\TEDxUW\\formtools/themes/default/admin/forms/edit.tpl', 49, false),array('modifier', 'hook_call_defined', 'C:\\Users\\Connor\\Documents\\CodeCraft\\TEDxUW\\formtools/themes/default/admin/forms/edit.tpl', 48, false),)), $this); ?>
<?php echo smarty_function_ft_include(array('file' => 'header.tpl'), $this);?>


  <table cellpadding="0" cellspacing="0" width="100%" class="margin_bottom_large">
  <tr>
    <td width="45"><a href="./"><img src="<?php echo $this->_tpl_vars['images_url']; ?>
/icon_forms.gif" border="0" width="34" height="34" /></a></td>
    <td class="title">
      <a href="./"><?php echo $this->_tpl_vars['LANG']['word_forms']; ?>
</a> <span class="joiner">&raquo;</span>
      <?php echo $this->_tpl_vars['form_info']['form_name']; ?>
 (<span class="identifier"><?php echo $this->_tpl_vars['form_id']; ?>
</span>)
    </td>
    <td align="right" valign="top">
      <div style="float:right; padding-left: 4px;">
	      <a href="<?php echo $this->_tpl_vars['view_submissions_link']; ?>
"><img src="<?php echo $this->_tpl_vars['images_url']; ?>
/admin_edit.png" border="0" alt="<?php echo $this->_tpl_vars['LANG']['phrase_view_submissions']; ?>
"
	        title="<?php echo $this->_tpl_vars['LANG']['phrase_view_submissions']; ?>
" /></a>
	    </div>
    </td>
  </tr>
  </table>

  <?php echo smarty_function_ft_include(array('file' => 'tabset_open.tpl'), $this);?>


  <?php if ($this->_tpl_vars['page'] == 'main'): ?>
    <?php echo smarty_function_ft_include(array('file' => 'admin/forms/tab_main.tpl'), $this);?>

  <?php elseif ($this->_tpl_vars['page'] == 'public_form_omit_list'): ?>
    <?php echo smarty_function_ft_include(array('file' => 'admin/forms/tab_public_form_omit_list.tpl'), $this);?>

  <?php elseif ($this->_tpl_vars['page'] == 'fields'): ?>
    <?php echo smarty_function_ft_include(array('file' => 'admin/forms/tab_fields.tpl'), $this);?>

  <?php elseif ($this->_tpl_vars['page'] == 'field_options'): ?>
    <?php echo smarty_function_ft_include(array('file' => 'admin/forms/tab_field_options.tpl'), $this);?>

  <?php elseif ($this->_tpl_vars['page'] == 'files'): ?>
    <?php echo smarty_function_ft_include(array('file' => 'admin/forms/tab_files.tpl'), $this);?>

  <?php elseif ($this->_tpl_vars['page'] == 'emails'): ?>
    <?php echo smarty_function_ft_include(array('file' => 'admin/forms/tab_emails.tpl'), $this);?>

  <?php elseif ($this->_tpl_vars['page'] == 'email_settings'): ?>
    <?php echo smarty_function_ft_include(array('file' => 'admin/forms/tab_email_settings.tpl'), $this);?>

  <?php elseif ($this->_tpl_vars['page'] == 'edit_email'): ?>
    <?php echo smarty_function_ft_include(array('file' => 'admin/forms/tab_edit_email.tpl'), $this);?>

  <?php elseif ($this->_tpl_vars['page'] == 'views'): ?>
    <?php echo smarty_function_ft_include(array('file' => 'admin/forms/tab_views.tpl'), $this);?>

  <?php elseif ($this->_tpl_vars['page'] == 'edit_view'): ?>
    <?php echo smarty_function_ft_include(array('file' => 'admin/forms/tab_edit_view.tpl'), $this);?>

  <?php elseif ($this->_tpl_vars['page'] == 'public_view_omit_list'): ?>
    <?php echo smarty_function_ft_include(array('file' => 'admin/forms/tab_public_view_omit_list.tpl'), $this);?>

  <?php elseif ($this->_tpl_vars['page'] == 'add_view'): ?>
    <?php echo smarty_function_ft_include(array('file' => 'admin/forms/tab_add_view.tpl'), $this);?>

  <?php elseif ($this->_tpl_vars['page'] == 'database'): ?>
    <?php echo smarty_function_ft_include(array('file' => 'admin/forms/tab_database.tpl'), $this);?>

  <?php else: ?>
    <?php if (((is_array($_tmp='admin_edit_form_content')) ? $this->_run_mod_handler('hook_call_defined', true, $_tmp) : smarty_modifier_hook_call_defined($_tmp))): ?>
      <?php echo smarty_function_template_hook(array('location' => 'admin_edit_form_content'), $this);?>

    <?php else: ?>
      <?php echo smarty_function_ft_include(array('file' => 'admin/forms/tab_main.tpl'), $this);?>

    <?php endif; ?>
  <?php endif; ?>

  <?php echo smarty_function_ft_include(array('file' => 'tabset_close.tpl'), $this);?>


<?php echo smarty_function_ft_include(array('file' => 'footer.tpl'), $this);?>