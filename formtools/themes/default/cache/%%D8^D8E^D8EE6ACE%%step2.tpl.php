<?php /* Smarty version 2.6.18, created on 2012-10-20 16:57:43
         compiled from /Users/lucaszw/Sites/TEDxUW/formtools/install/templates/step2.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'upper', '/Users/lucaszw/Sites/TEDxUW/formtools/install/templates/step2.tpl', 15, false),array('modifier', 'count', '/Users/lucaszw/Sites/TEDxUW/formtools/install/templates/step2.tpl', 120, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "../../install/templates/install_header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

  <h2><?php echo $this->_tpl_vars['LANG']['phrase_system_check']; ?>
</h2>

  <p>
    <?php echo $this->_tpl_vars['LANG']['text_install_system_check']; ?>

  </p>

  <table cellspacing="0" cellpadding="2" width="600" class="info">
  <tr>
    <td width="220"><?php echo $this->_tpl_vars['LANG']['phrase_php_version']; ?>
</td>
    <td class="bold"><?php echo $this->_tpl_vars['phpversion']; ?>
</td>
    <td width="100" align="center">
      <?php if ($this->_tpl_vars['valid_php_version']): ?>
        <span class="green"><?php echo ((is_array($_tmp=$this->_tpl_vars['LANG']['word_pass'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
</span>
      <?php else: ?>
        <span class="red"><?php echo ((is_array($_tmp=$this->_tpl_vars['LANG']['word_fail'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
</span>
      <?php endif; ?>
    </td>
  </tr>
  <?php if ($this->_tpl_vars['mysql_loaded']): ?>
  <tr>
    <td valign="top"><?php echo $this->_tpl_vars['LANG']['phrase_mysql_version']; ?>
</td>
    <td valign="top" class="bold"><?php echo $this->_tpl_vars['mysql_get_client_info']; ?>
</td>
    <td valign="top" align="center">
      <?php if ($this->_tpl_vars['overridden_invalid_db_version']): ?>
        <span class="orange"><?php echo ((is_array($_tmp=$this->_tpl_vars['LANG']['word_overridden'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
</span>
      <?php else: ?>
        <?php if ($this->_tpl_vars['valid_mysql_version']): ?>
          <span class="green"><?php echo ((is_array($_tmp=$this->_tpl_vars['LANG']['word_pass'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
</span>
        <?php else: ?>
          <span class="red"><?php echo ((is_array($_tmp=$this->_tpl_vars['LANG']['word_fail'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
</span>
          <form action="step2.php" method="post">
            <input type="submit" name="override_invalid_db_version" value="<?php echo $this->_tpl_vars['LANG']['word_ignore']; ?>
" />
          </form>
        <?php endif; ?>
      <?php endif; ?>
    </td>
  </tr>
  <?php else: ?>
  <tr>
    <td><?php echo $this->_tpl_vars['LANG']['phrase_mysql_version']; ?>
</td>
    <td class="bold red">MySQL extension not available</td>
    <td width="100" align="center">
      <span class="red"><?php echo ((is_array($_tmp=$this->_tpl_vars['LANG']['word_fail'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
</span>
    </td>
  </tr>
  <?php endif; ?>
  <tr>
    <td>PHP Sessions</td>
    <td class="bold">
      <?php if ($this->_tpl_vars['sessions_loaded'] == 1): ?>
        Available
      <?php else: ?>
        Not Available
      <?php endif; ?>
    </td>
    <td width="100" align="center"><?php echo $this->_tpl_vars['sessions_enabled']; ?>

      <?php if ($this->_tpl_vars['sessions_loaded'] == 1): ?>
        <span class="green"><?php echo ((is_array($_tmp=$this->_tpl_vars['LANG']['word_pass'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
</span>
      <?php else: ?>
        <span class="red"><?php echo ((is_array($_tmp=$this->_tpl_vars['LANG']['word_fail'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
</span>
      <?php endif; ?>
    </td>
  </tr>
  <tr>
    <td rowspan="2" valign="top"><?php echo $this->_tpl_vars['LANG']['phrase_write_permissions']; ?>
</td>
    <td class="bold">
      /upload/
    </td>
    <td align="center">
      <?php if ($this->_tpl_vars['upload_folder_writable']): ?>
        <span class="green"><?php echo ((is_array($_tmp=$this->_tpl_vars['LANG']['word_pass'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
</span>
      <?php else: ?>
        <span class="red"><?php echo ((is_array($_tmp=$this->_tpl_vars['LANG']['word_fail'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
</span>
      <?php endif; ?>
    </td>
  </tr>
  <tr>
    <td class="bold">
      /themes/<?php echo $this->_tpl_vars['g_default_theme']; ?>
/cache/
    </td>
    <td align="center">
      <?php if ($this->_tpl_vars['default_theme_cache_dir_writable']): ?>
        <span class="green"><?php echo ((is_array($_tmp=$this->_tpl_vars['LANG']['word_pass'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
</span>
      <?php else: ?>
        <span class="red"><?php echo ((is_array($_tmp=$this->_tpl_vars['LANG']['word_fail'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
</span>
      <?php endif; ?>
    </td>
  </tr>
  <tr>
    <td><a href="http://modules.formtools.org/core_field_types/" target="_blank"><?php echo $this->_tpl_vars['LANG']['phrase_core_field_types']; ?>
</a> module available?</td>
    <td class="bold">
      <?php if ($this->_tpl_vars['core_field_types_module_available']): ?>
        <?php echo $this->_tpl_vars['LANG']['word_yes']; ?>

      <?php else: ?>
        <?php echo $this->_tpl_vars['LANG']['word_no']; ?>

      <?php endif; ?>
    </td>
    <td align="center">
      <?php if ($this->_tpl_vars['core_field_types_module_available']): ?>
        <span class="green"><?php echo ((is_array($_tmp=$this->_tpl_vars['LANG']['word_pass'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
</span>
      <?php else: ?>
        <span class="red"><?php echo ((is_array($_tmp=$this->_tpl_vars['LANG']['word_fail'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
</span>
      <?php endif; ?>
    </td>
  </tr>
  </table>

  <?php if (! $this->_tpl_vars['valid_php_version'] || ! $this->_tpl_vars['mysql_loaded'] || ! $this->_tpl_vars['valid_mysql_version'] || ! $this->_tpl_vars['sessions_loaded'] || ! $this->_tpl_vars['core_field_types_module_available']): ?>

    <p class="error" style="padding: 6px">
      <?php echo $this->_tpl_vars['LANG']['text_install_form_tools_server_not_supported']; ?>

    </p>

  <?php else: ?>

    <form action="step3.php" method="post">

	  <?php if (count($this->_tpl_vars['premium_modules']) > 0): ?>
	    <div class="panel" id="premium_module_license_key_section">
	      <div id="verify_license_key_loading" style="float: right;"><img src="../global/images/loading.gif" /></div>
	      <h3><?php echo $this->_tpl_vars['LANG']['phrase_premium_module_license_keys']; ?>
</h3>
	      <p>
	        <?php echo $this->_tpl_vars['LANG']['text_enter_license_keys']; ?>

	      </p>
	      <table class="margin_bottom_large">
	      <?php $_from = $this->_tpl_vars['premium_modules']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['n'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['n']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['info']):
        $this->_foreach['n']['iteration']++;
?>
	        <?php $this->assign('i', $this->_foreach['n']['iteration']); ?>
		      <tr>
		        <td class="bold" width="180"><?php echo $this->_tpl_vars['info']['module_name']; ?>
</td>
		        <td>
		          <input type="hidden" name="module_folders[]" id="module_folder_<?php echo $this->_tpl_vars['i']; ?>
" value="<?php echo $this->_tpl_vars['info']['module_folder']; ?>
" />
		          <input type="hidden" id="k_<?php echo $this->_tpl_vars['i']; ?>
" name="<?php echo $this->_tpl_vars['info']['module_folder']; ?>
_k" value="" />
		          <input type="hidden" id="ek_<?php echo $this->_tpl_vars['i']; ?>
" name="<?php echo $this->_tpl_vars['info']['module_folder']; ?>
_ek" value="" />

		          <input type="text" id="key_section1_<?php echo $this->_tpl_vars['i']; ?>
" size="4" maxlength="4" value=""
		            />-<input type="text" id="key_section2_<?php echo $this->_tpl_vars['i']; ?>
" size="4" maxlength="4" value=""
		            />-<input type="text" id="key_section3_<?php echo $this->_tpl_vars['i']; ?>
" size="4" maxlength="4" value="" />
		          <span id="pmvr_<?php echo $this->_tpl_vars['i']; ?>
" class="premium_module_verification_response"></span>
		        </td>
		      </tr>
	      <?php endforeach; endif; unset($_from); ?>
	      </table>
	      <div>
	        <input type="hidden" id="num_premium_modules" value="<?php echo count($this->_tpl_vars['premium_modules']); ?>
" />
	        <input type="button" id="verify_license_keys" value="<?php echo $this->_tpl_vars['LANG']['phrase_verify_license_keys']; ?>
" />
	        <input type="submit" id="skip_step" value="<?php echo $this->_tpl_vars['LANG']['phrase_skip_step']; ?>
" name="next" />
	      </div>
	    </div>
	  <?php endif; ?>

    <?php if ($this->_tpl_vars['suhosin_loaded']): ?>
      <div class="warning">
        <?php echo $this->_tpl_vars['LANG']['notify_suhosin_installed']; ?>

      </div>
    <?php endif; ?>

      <div id="continue_block" <?php if (count($this->_tpl_vars['premium_modules']) > 0): ?>class="hidden"<?php endif; ?>>
	      <p>
	        <input type="submit" name="next" value="<?php echo $this->_tpl_vars['LANG']['word_continue_rightarrow']; ?>
" />
	      </p>
	    </div>

    </form>
  <?php endif; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "../../install/templates/install_footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>