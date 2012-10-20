<?php /* Smarty version 2.6.18, created on 2012-10-14 20:22:22
         compiled from C:%5CUsers%5CConnor%5CDocuments%5CCodeCraft%5CTEDxUW%5Cformtools%5Cinstall/templates/step6.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'ucwords', 'C:\\Users\\Connor\\Documents\\CodeCraft\\TEDxUW\\formtools\\install/templates/step6.tpl', 15, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "../../install/templates/install_header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

  <h2><?php echo $this->_tpl_vars['LANG']['phrase_clean_up']; ?>
</h2>

  <p class="notify">
    <?php echo $this->_tpl_vars['LANG']['text_ft_installed']; ?>
 <?php echo $this->_tpl_vars['LANG']['text_must_delete_install_folder']; ?>

  </p>

  <form action="<?php echo $this->_tpl_vars['g_root_url']; ?>
" method="post">
    <input type="submit" value="<?php echo $this->_tpl_vars['LANG']['text_log_in_to_ft']; ?>
" />
  </form>

  <div class="divider"></div>

  <p><b><?php echo ((is_array($_tmp=$this->_tpl_vars['LANG']['phrase_getting_started'])) ? $this->_run_mod_handler('ucwords', true, $_tmp) : ucwords($_tmp)); ?>
</b></p>
  <ul>
    <li><a href="http://docs.formtools.org/tutorials/adding_first_form/"><?php echo $this->_tpl_vars['LANG']['text_tutorial_adding_first_form']; ?>
</a></li>
    <li><a href="http://docs.formtools.org/userdoc2_1/"><?php echo $this->_tpl_vars['LANG']['text_review_user_doc']; ?>
</a></li>
  </ul>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "../../install/templates/install_footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>