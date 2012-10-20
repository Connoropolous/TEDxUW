<?php /* Smarty version 2.6.18, created on 2012-10-14 20:46:32
         compiled from C:%5CUsers%5CConnor%5CDocuments%5CCodeCraft%5CTEDxUW%5Cformtools/themes/default/admin/settings/tab_menus.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'upper', 'C:\\Users\\Connor\\Documents\\CodeCraft\\TEDxUW\\formtools/themes/default/admin/settings/tab_menus.tpl', 1, false),array('modifier', 'count', 'C:\\Users\\Connor\\Documents\\CodeCraft\\TEDxUW\\formtools/themes/default/admin/settings/tab_menus.tpl', 39, false),array('function', 'ft_include', 'C:\\Users\\Connor\\Documents\\CodeCraft\\TEDxUW\\formtools/themes/default/admin/settings/tab_menus.tpl', 3, false),array('function', 'template_hook', 'C:\\Users\\Connor\\Documents\\CodeCraft\\TEDxUW\\formtools/themes/default/admin/settings/tab_menus.tpl', 9, false),)), $this); ?>
    <div class="subtitle underline margin_top_large"><?php echo ((is_array($_tmp=$this->_tpl_vars['LANG']['word_menus'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
</div>

    <?php echo smarty_function_ft_include(array('file' => 'messages.tpl'), $this);?>


    <div class="pad_bottom_large">
      <?php echo $this->_tpl_vars['LANG']['text_edit_client_menu_page']; ?>

    </div>

    <?php echo smarty_function_template_hook(array('location' => 'admin_settings_menus_top'), $this);?>


    <?php echo $this->_tpl_vars['pagination']; ?>


    <table class="list_table" cellspacing="1" cellpadding="0">
    <tr>
      <th><?php echo $this->_tpl_vars['LANG']['word_menu']; ?>
</th>
      <th><?php echo $this->_tpl_vars['LANG']['phrase_menu_type']; ?>
</th>
      <th><?php echo $this->_tpl_vars['LANG']['word_account_sp']; ?>
</th>
      <th class="edit"></th>
      <th class="del"></th>
    </tr>

    <?php $_from = $this->_tpl_vars['menus']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['row'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['row']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['menu']):
        $this->_foreach['row']['iteration']++;
?>
      <?php $this->assign('index', ($this->_foreach['row']['iteration']-1)); ?>
      <?php $this->assign('menu_info', $this->_tpl_vars['menus'][$this->_tpl_vars['index']]); ?>
      <?php $this->assign('menu_id', $this->_tpl_vars['menu_info']['menu_id']); ?>
      <tr>
        <td class="pad_left_small"><?php echo $this->_tpl_vars['menu_info']['menu']; ?>
</td>
        <td class="pad_left_small">
          <?php if ($this->_tpl_vars['menu_info']['menu_type'] == 'admin'): ?>
            <span class="light_green"><?php echo $this->_tpl_vars['LANG']['phrase_admin_menu']; ?>
</span>
          <?php else: ?>
            <span class="blue"><?php echo $this->_tpl_vars['LANG']['phrase_client_menu']; ?>
</span>
          <?php endif; ?>
        </td>
        <td class="pad_left_small">
          <?php if ($this->_tpl_vars['menu_info']['menu_type'] == 'admin'): ?>
            <?php echo $this->_tpl_vars['LANG']['word_administrator']; ?>

          <?php else: ?>
            <?php if (count($this->_tpl_vars['menu_info']['account_info']) == 0): ?>
              <?php echo $this->_tpl_vars['LANG']['phrase_no_clients']; ?>

            <?php elseif (count($this->_tpl_vars['menu_info']['account_info']) == 1): ?>
              <?php echo $this->_tpl_vars['menu_info']['account_info'][0]['first_name']; ?>
 <?php echo $this->_tpl_vars['menu_info']['account_info'][0]['last_name']; ?>

            <?php else: ?>
              <select>
                <?php $_from = $this->_tpl_vars['menu_info']['account_info']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['account_row'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['account_row']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['account']):
        $this->_foreach['account_row']['iteration']++;
?>
                  <option><?php echo $this->_tpl_vars['account']['first_name']; ?>
 <?php echo $this->_tpl_vars['account']['last_name']; ?>
</option>
                <?php endforeach; endif; unset($_from); ?>
              </select>
            <?php endif; ?>
          <?php endif; ?>
        </td>
        <td class="edit">
          <?php if ($this->_tpl_vars['menu_info']['menu_type'] == 'admin'): ?>
            <a href="<?php echo $this->_tpl_vars['same_page']; ?>
?page=edit_admin_menu&menu_id=<?php echo $this->_tpl_vars['menu_id']; ?>
"></a>
          <?php else: ?>
            <a href="<?php echo $this->_tpl_vars['same_page']; ?>
?page=edit_client_menu&menu_id=<?php echo $this->_tpl_vars['menu_id']; ?>
"></a>
          <?php endif; ?>
        </td>
        <td<?php if ($this->_tpl_vars['menu_info']['menu_type'] != 'admin'): ?> class="del"<?php endif; ?>>
          <?php if ($this->_tpl_vars['menu']['menu_type'] == 'client'): ?>
            <a href="#" onclick="return page_ns.delete_menu(<?php echo $this->_tpl_vars['menu_id']; ?>
)"></a>
          <?php endif; ?>
        </td>
      </tr>
    <?php endforeach; endif; unset($_from); ?>
    </table>

    <form action="<?php echo $this->_tpl_vars['same_page']; ?>
" method="post">
      <input type="hidden" name="page" value="edit_client_menu" />
      <p>
        <input type="submit" name="create_new_menu" value="<?php echo $this->_tpl_vars['LANG']['phrase_create_new_menu']; ?>
" />
      </p>
    </form>