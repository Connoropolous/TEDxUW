<?php /* Smarty version 2.6.18, created on 2012-11-10 01:57:07
         compiled from /Users/lucaszw/Sites/TEDxUW/formtools/themes/default/forget_password.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ft_include', '/Users/lucaszw/Sites/TEDxUW/formtools/themes/default/forget_password.tpl', 1, false),array('modifier', 'upper', '/Users/lucaszw/Sites/TEDxUW/formtools/themes/default/forget_password.tpl', 20, false),)), $this); ?>
<?php echo smarty_function_ft_include(array('file' => "header.tpl"), $this);?>


  <div class="title"><?php echo $this->_tpl_vars['LANG']['phrase_forgot_password']; ?>
</div>

  <?php echo smarty_function_ft_include(array('file' => 'messages.tpl'), $this);?>


  <div class="margin_bottom_large" style="width: 540px">
    <?php echo $this->_tpl_vars['text_forgot_password']; ?>

  </div>

  <form name="forget_password" action="<?php echo $this->_tpl_vars['same_page']; ?>
<?php echo $this->_tpl_vars['g_query_params']; ?>
" method="post"
    onsubmit="return rsv.validate(this, rules)">

    <div class="login_panel">
      <div class="login_panel_inner">
        <table cellpadding="0" cellspacing="1">
        <tr>
          <td><?php echo $this->_tpl_vars['LANG']['word_username']; ?>
</td>
          <td><input type="text" name="username" value="<?php echo $this->_tpl_vars['username']; ?>
" /></td>
          <td><input type="submit" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['LANG']['word_email'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
" class="margin_left_large margin_right_large" /></td>
        </tr>
        </table>
        <div class="clear"></div>
      </div>
    </div>
  </form>

  <p>
    <a href="index.php<?php echo $this->_tpl_vars['query_params']; ?>
"><?php echo $this->_tpl_vars['LANG']['phrase_login_panel_leftarrows']; ?>
</a>
  </p>

  <noscript>
    <div class="error" style="padding:6px;">
      <?php echo $this->_tpl_vars['LANG']['text_js_required']; ?>

    </div>
  </noscript>

<?php echo smarty_function_ft_include(array('file' => "footer.tpl"), $this);?>