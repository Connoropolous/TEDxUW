<?php /* Smarty version 2.6.18, created on 2012-10-14 20:21:50
         compiled from C:%5CUsers%5CConnor%5CDocuments%5CCodeCraft%5CTEDxUW%5Cformtools%5Cinstall/templates/step5.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "../../install/templates/install_header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

  <h2><?php echo $this->_tpl_vars['LANG']['phrase_create_admin_account']; ?>
</h2>

  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'messages.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

  <?php if (! $this->_tpl_vars['account_created']): ?>

    <form name="create_account_form" action="<?php echo $this->_tpl_vars['same_page']; ?>
" method="post" onsubmit="return rsv.validate(this, rules)">
	    <div class="margin_bottom_large">
	      <?php echo $this->_tpl_vars['LANG']['text_create_admin_account']; ?>

	    </div>

	    <table cellpadding="0">
	    <tr>
	      <td width="160"><?php echo $this->_tpl_vars['LANG']['phrase_first_name']; ?>
</td>
	      <td class="answer"><input type="text" name="first_name" value="" style="width:200px" /></td>
	    </tr>
	    <tr>
	      <td><?php echo $this->_tpl_vars['LANG']['phrase_last_name']; ?>
</td>
	      <td class="answer"><input type="text" name="last_name" value="" style="width:200px" /></td>
	    </tr>
	    <tr>
	      <td><?php echo $this->_tpl_vars['LANG']['word_email']; ?>
</td>
	      <td class="answer"><input type="text" name="email" value="" style="width:200px" /></td>
	    </tr>
	    <tr>
	      <td><?php echo $this->_tpl_vars['LANG']['phrase_login_username']; ?>
</td>
	      <td class="answer"><input type="text" name="username" value="" style="width:140px" /></td>
	    </tr>
	    <tr>
	      <td><?php echo $this->_tpl_vars['LANG']['phrase_login_password']; ?>
</td>
	      <td class="answer"><input type="password" name="password" value="" style="width:140px" /></td>
	    </tr>
	    <tr>
	      <td><?php echo $this->_tpl_vars['LANG']['phrase_re_enter_password']; ?>
</td>
	      <td class="answer"><input type="password" name="password_2" value="" style="width:140px" /></td>
	    </tr>
	    </table>

	    <p>
	      <input type="submit" name="add_account" value="<?php echo $this->_tpl_vars['LANG']['phrase_create_account']; ?>
" />
	    </p>

	  </form>

    <script>
    document.create_account_form.first_name.focus();
    </script>

	<?php endif; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "../../install/templates/install_footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>