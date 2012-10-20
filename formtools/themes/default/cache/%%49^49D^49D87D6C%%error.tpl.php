<?php /* Smarty version 2.6.18, created on 2012-10-14 20:26:31
         compiled from C:%5CUsers%5CConnor%5CDocuments%5CCodeCraft%5CTEDxUW%5Cformtools/themes/default/error.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'nl2br', 'C:\\Users\\Connor\\Documents\\CodeCraft\\TEDxUW\\formtools/themes/default/error.tpl', 18, false),array('modifier', 'upper', 'C:\\Users\\Connor\\Documents\\CodeCraft\\TEDxUW\\formtools/themes/default/error.tpl', 37, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

  <?php if ($this->_tpl_vars['context'] == 'error_page'): ?>

    <?php if ($this->_tpl_vars['message_type'] == 'error'): ?>
      <div class="error" style="padding: 8px">
        <span class="bold"><?php echo $this->_tpl_vars['LANG']['word_error_c']; ?>
</span>
    <?php else: ?>
      <div class="notify" style="padding:8px">
    <?php endif; ?>

      <div style="padding-top: 10px">
        <?php echo ((is_array($_tmp=$this->_tpl_vars['message'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>

      </div>

      <?php if ($this->_tpl_vars['g_debug']): ?>
        <?php if ($this->_tpl_vars['error_debug'] == ""): ?>
          <?php $this->assign('error_debug', "No further help available."); ?>
        <?php endif; ?>

        <p>Debug:</p>
        <p><?php echo $this->_tpl_vars['error_debug']; ?>
</p>
      <?php endif; ?>
    </div>

  <?php else: ?>

    <div class="title underline">
      <?php if ($this->_tpl_vars['message_type'] == 'error'): ?>
        <span class="red bold">
          <?php if ($this->_tpl_vars['title']): ?>
            <?php echo ((is_array($_tmp=$this->_tpl_vars['title'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>

          <?php else: ?>
            <?php echo ((is_array($_tmp=$this->_tpl_vars['LANG']['word_error'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>

          <?php endif; ?>
        </span>
      <?php else: ?>
        <span class="blue bold">
          <?php if ($this->_tpl_vars['title']): ?>
            <?php echo ((is_array($_tmp=$this->_tpl_vars['title'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>

          <?php else: ?>
          <?php endif; ?>
        </span>
      <?php endif; ?>
    </div>

    <?php if (isset ( $this->_tpl_vars['message'] )): ?>
      <p><?php echo $this->_tpl_vars['message']; ?>
</p>
    <?php endif; ?>

    <?php if (isset ( $this->_tpl_vars['error_code'] )): ?>
      <p>
        <b><?php echo $this->_tpl_vars['LANG']['phrase_type_c']; ?>

          <?php if ($this->_tpl_vars['error_type'] == 'system'): ?>
            <span class="red"><?php echo $this->_tpl_vars['LANG']['word_system']; ?>
</span>
          <?php else: ?>
            <span class="green"><?php echo $this->_tpl_vars['LANG']['word_user']; ?>
</span>
          <?php endif; ?><br />
        <b><?php echo $this->_tpl_vars['LANG']['phrase_code_c']; ?>
 #<?php echo $this->_tpl_vars['error_code']; ?>
</b> &#8212;
        <a href="http://docs.formtools.org/api/index.php?page=error_codes#<?php echo $this->_tpl_vars['error_code']; ?>
" target="_blank" /><?php echo $this->_tpl_vars['LANG']['phrase_error_learn_more']; ?>
</a>
      </p>
    <?php endif; ?>

    <?php if (isset ( $this->_tpl_vars['error_codes'] )): ?>
      <p>
        <div><?php echo $this->_tpl_vars['LANG']['phrase_errors_learn_more']; ?>
</div>

        <b><?php echo $this->_tpl_vars['LANG']['phrase_codes_c']; ?>
</b>

        <?php $_from = $this->_tpl_vars['error_codes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['row']):
?>
          <a href="http://docs.formtools.org/api/index.php?page=error_codes#<?php echo $this->_tpl_vars['row']; ?>
" target="_blank" /><?php echo $this->_tpl_vars['row']; ?>
</a>
        <?php endforeach; endif; unset($_from); ?>
      </p>
    <?php endif; ?>

    <?php if (isset ( $this->_tpl_vars['debugging'] )): ?>
      <h4><?php echo $this->_tpl_vars['LANG']['word_debugging_c']; ?>
</h4>
      <p>
        <?php echo $this->_tpl_vars['debugging']; ?>

      </p>
    <?php endif; ?>
  <?php endif; ?>

  <noscript>
    <br />
    <div class="error" style="padding:8px;">
      <?php echo $this->_tpl_vars['LANG']['text_js_required']; ?>

    </div>
  </noscript>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>