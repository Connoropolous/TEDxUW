<?php /* Smarty version 2.6.18, created on 2012-10-14 20:22:59
         compiled from C:%5CUsers%5CConnor%5CDocuments%5CCodeCraft%5CTEDxUW%5Cformtools/themes/default/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ft_include', 'C:\\Users\\Connor\\Documents\\CodeCraft\\TEDxUW\\formtools/themes/default/index.tpl', 6, false),array('modifier', 'upper', 'C:\\Users\\Connor\\Documents\\CodeCraft\\TEDxUW\\formtools/themes/default/index.tpl', 40, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

  <div class="title"><?php echo $this->_tpl_vars['login_heading']; ?>
</div>

  <div style="width:600px">
    <?php echo smarty_function_ft_include(array('file' => "messages.tpl"), $this);?>

  </div>

  <div class="margin_bottom_large" style="width: 600px">
    <?php echo $this->_tpl_vars['text_login']; ?>

  </div>

  <form name="login" action="<?php echo $this->_tpl_vars['same_page']; ?>
<?php echo $this->_tpl_vars['query_params']; ?>
" method="post">

    <?php if ($this->_tpl_vars['upgrade_notification']): ?>
      <div class="notify" id="upgrade_notification">
        <div style="padding:8px">
          <span style="float: right; padding-left: 5px;"><a href="#" onclick="return ft.hide_message('upgrade_notification')">X</a></span>
          <?php echo $this->_tpl_vars['upgrade_notification']; ?>

        </div>
      </div>

      <br />
    <?php endif; ?>

    <div class="login_panel">
      <div class="login_panel_inner">
        <table cellpadding="0" cellspacing="1">
        <tr>
          <td><label for="username"><?php echo $this->_tpl_vars['LANG']['word_username']; ?>
</label></td>
          <td><input type="text" name="username" id="username" value="<?php echo $this->_tpl_vars['username']; ?>
" /></td>
        </tr>
        <tr>
          <td><label for="password"><?php echo $this->_tpl_vars['LANG']['word_password']; ?>
</label></td>
          <td><input type="password" name="password" id="password" value="" /></td>
        </tr>
        </table>

        <script>
        document.write('<input type="submit" class="login_submit" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['LANG']['phrase_log_in'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
">');
        </script>
        <div class="clear"></div>
      </div>

      <?php if ($this->_tpl_vars['error']): ?>
        <div>
          <div class="login_error pad_left"><?php echo $this->_tpl_vars['error']; ?>
</div>
        </div>
      <?php endif; ?>
    </div>
  </form>

  <noscript>
    <div class="error" style="padding:6px;">
      <?php echo $this->_tpl_vars['LANG']['text_js_required']; ?>

    </div>
  </noscript>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>