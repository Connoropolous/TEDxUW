<?php /* Smarty version 2.6.18, created on 2012-10-20 16:57:39
         compiled from /Users/lucaszw/Sites/TEDxUW/formtools/install/templates/index.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "../../install/templates/install_header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

  <h2><?php echo $this->_tpl_vars['LANG']['word_welcome']; ?>
</h2>

  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'messages.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

  <div class="notify margin_bottom_large">
    <?php echo $this->_tpl_vars['LANG']['text_install_already_upgraded']; ?>

  </div>

  <form action="<?php echo $this->_tpl_vars['same_page']; ?>
" method="post">
    <table cellspacing="0" cellpadding="0">
    <tr>
      <td width="100" class="label"><?php echo $this->_tpl_vars['LANG']['word_language']; ?>
</td>
      <td>
        <select name="lang_file" class="margin_right">
          <?php $_from = $this->_tpl_vars['available_languages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
            <option value="<?php echo $this->_tpl_vars['k']; ?>
" <?php if ($this->_tpl_vars['lang_file'] == $this->_tpl_vars['k']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['v']; ?>
</option>
          <?php endforeach; endif; unset($_from); ?>
        </select>
      </td>
      <td>
        <input type="submit" name="select_language" value="<?php echo $this->_tpl_vars['LANG']['word_select']; ?>
" />
      </td>
    </tr>
    </table>

    <p>
      <input type="submit" name="next" value="<?php echo $this->_tpl_vars['LANG']['word_continue_rightarrow']; ?>
" />
    </p>

  </form>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "../../install/templates/install_footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>