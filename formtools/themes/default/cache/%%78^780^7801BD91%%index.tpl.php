<?php /* Smarty version 2.6.18, created on 2012-10-14 20:45:05
         compiled from C:%5CUsers%5CConnor%5CDocuments%5CCodeCraft%5CTEDxUW%5Cformtools/themes/default/admin/forms/option_lists/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ft_include', 'C:\\Users\\Connor\\Documents\\CodeCraft\\TEDxUW\\formtools/themes/default/admin/forms/option_lists/index.tpl', 1, false),array('function', 'template_hook', 'C:\\Users\\Connor\\Documents\\CodeCraft\\TEDxUW\\formtools/themes/default/admin/forms/option_lists/index.tpl', 113, false),array('modifier', 'upper', 'C:\\Users\\Connor\\Documents\\CodeCraft\\TEDxUW\\formtools/themes/default/admin/forms/option_lists/index.tpl', 40, false),array('modifier', 'lower', 'C:\\Users\\Connor\\Documents\\CodeCraft\\TEDxUW\\formtools/themes/default/admin/forms/option_lists/index.tpl', 77, false),)), $this); ?>
<?php echo smarty_function_ft_include(array('file' => 'header.tpl'), $this);?>


  <table cellpadding="0" cellspacing="0" class="margin_bottom_large">
  <tr>
    <td width="45"><img src="<?php echo $this->_tpl_vars['images_url']; ?>
/icon_option_lists.gif" width="34" height="34" /></td>
    <td class="title"><?php echo $this->_tpl_vars['LANG']['phrase_option_lists']; ?>
</td>
  </tr>
  </table>

  <div>
    <?php echo $this->_tpl_vars['text_option_list_page']; ?>

  </div>

  <?php echo smarty_function_ft_include(array('file' => 'messages.tpl'), $this);?>


  <form action="<?php echo $this->_tpl_vars['same_page']; ?>
" method="post">
    <input type="hidden" name="page" value="views" />

    <?php if ($this->_tpl_vars['num_option_lists'] == 0): ?>
      <div class="notify" class="margin_bottom_large">
        <div style="padding:8px">
          <?php echo $this->_tpl_vars['LANG']['notify_no_option_lists']; ?>

        </div>
      </div>
    <?php else: ?>
      <?php echo $this->_tpl_vars['pagination']; ?>

      <table class="list_table" cellspacing="1" cellpadding="0">
      <tr>
        <?php $this->assign('up_down', ""); ?>
        <?php if ($this->_tpl_vars['order'] == "list_id-DESC"): ?>
          <?php $this->assign('sort_order', "order=list_id-ASC"); ?>
          <?php $this->assign('up_down', "<img src=\"".($this->_tpl_vars['theme_url'])."/images/sort_down.gif\" />"); ?>
        <?php elseif ($this->_tpl_vars['order'] == "list_id-ASC"): ?>
          <?php $this->assign('sort_order', "order=list_id-DESC"); ?>
          <?php $this->assign('up_down', "<img src=\"".($this->_tpl_vars['theme_url'])."/images/sort_up.gif\" />"); ?>
        <?php else: ?>
          <?php $this->assign('sort_order', "order=list_id-DESC"); ?>
        <?php endif; ?>
        <th width="40" class="sortable_col<?php if ($this->_tpl_vars['up_down']): ?> over<?php endif; ?>">
          <a href="<?php echo $this->_tpl_vars['same_page']; ?>
?<?php echo $this->_tpl_vars['sort_order']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['LANG']['word_id'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
 <?php echo $this->_tpl_vars['up_down']; ?>
</a>
        </th>
        <?php $this->assign('up_down', ""); ?>
        <?php if ($this->_tpl_vars['order'] == "option_list_name-DESC"): ?>
          <?php $this->assign('sort_order', "order=option_list_name-ASC"); ?>
          <?php $this->assign('up_down', "<img src=\"".($this->_tpl_vars['theme_url'])."/images/sort_down.gif\" />"); ?>
        <?php elseif ($this->_tpl_vars['order'] == "option_list_name-ASC"): ?>
          <?php $this->assign('sort_order', "order=option_list_name-DESC"); ?>
          <?php $this->assign('up_down', "<img src=\"".($this->_tpl_vars['theme_url'])."/images/sort_up.gif\" />"); ?>
        <?php else: ?>
          <?php $this->assign('sort_order', "order=option_list_name-DESC"); ?>
        <?php endif; ?>
        <th class="sortable_col<?php if ($this->_tpl_vars['up_down']): ?> over<?php endif; ?>">
          <a href="<?php echo $this->_tpl_vars['same_page']; ?>
?<?php echo $this->_tpl_vars['sort_order']; ?>
"><?php echo $this->_tpl_vars['LANG']['phrase_option_list_name']; ?>
 <?php echo $this->_tpl_vars['up_down']; ?>
</a>
        </th>
        <th nowrap><?php echo $this->_tpl_vars['LANG']['phrase_num_options']; ?>
</th>
        <th width="220" nowrap><?php echo $this->_tpl_vars['LANG']['phrase_used_by_num_form_fields']; ?>
</th>
        <th class="edit"></th>
        <th class="del"></th>
      </tr>

      <?php $_from = $this->_tpl_vars['option_lists']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['row'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['row']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['list_info']):
        $this->_foreach['row']['iteration']++;
?>
        <?php $this->assign('index', ($this->_foreach['row']['iteration']-1)); ?>
        <?php $this->assign('count', $this->_foreach['row']['iteration']); ?>
        <?php $this->assign('list_id', $this->_tpl_vars['list_info']['list_id']); ?>
        <tr>
          <td class="medium_grey" align="center"><?php echo $this->_tpl_vars['list_info']['list_id']; ?>
</td>
          <td class="pad_left_small"><?php echo $this->_tpl_vars['list_info']['option_list_name']; ?>
</td>
          <td class="pad_left_small" align="center"><?php echo $this->_tpl_vars['list_info']['num_option_list_options']; ?>
</td>
          <td class="pad_left_small" align="center">
            <?php if ($this->_tpl_vars['list_info']['num_fields'] == 0): ?>
              <span class="light_grey"><?php echo $this->_tpl_vars['LANG']['word_none']; ?>
</span>
              <?php $this->assign('may_delete_list', 'true'); ?>
            <?php else: ?>
              <select style="width:100%">
                <option value="">
                  <?php if ($this->_tpl_vars['list_info']['num_fields'] == 1): ?>
                    1 <?php echo ((is_array($_tmp=$this->_tpl_vars['LANG']['word_field'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)); ?>

                  <?php else: ?>
                    <?php echo $this->_tpl_vars['list_info']['num_fields']; ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['LANG']['word_fields'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)); ?>

                  <?php endif; ?>
                </option>
                <?php $_from = $this->_tpl_vars['list_info']['fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['grouped_field']):
?>
                  <optgroup label="<?php echo $this->_tpl_vars['grouped_field']['form_name']; ?>
">
                    <?php $_from = $this->_tpl_vars['grouped_field']['fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['field']):
?>
                      <option value=""><?php echo $this->_tpl_vars['field']['field_title']; ?>
</option>
                    <?php endforeach; endif; unset($_from); ?>
                  </optgroup>
                <?php endforeach; endif; unset($_from); ?>
              </select>
              <?php $this->assign('may_delete_list', 'false'); ?>
            <?php endif; ?>
          </td>
          <td class="edit"><a href="edit.php?list_id=<?php echo $this->_tpl_vars['list_id']; ?>
"></a></td>
          <td class="del"><a href="#" onclick="return sf_ns.delete_option_list(<?php echo $this->_tpl_vars['list_id']; ?>
, <?php echo $this->_tpl_vars['may_delete_list']; ?>
)"></a></td>
        </tr>
      <?php endforeach; endif; unset($_from); ?>
      </table>

    <?php endif; ?>

    <p>
      <?php if ($this->_tpl_vars['num_option_lists'] > 0): ?>
        <select name="create_option_list_from_list_id">
          <option value=""><?php echo $this->_tpl_vars['LANG']['phrase_new_blank_option_list']; ?>
</option>
          <optgroup label="<?php echo $this->_tpl_vars['LANG']['phrase_copy_settings_from']; ?>
">
            <?php $_from = $this->_tpl_vars['all_option_lists']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list_info']):
?>
              <option value="<?php echo $this->_tpl_vars['list_info']['list_id']; ?>
"><?php echo $this->_tpl_vars['list_info']['option_list_name']; ?>
</option>
            <?php endforeach; endif; unset($_from); ?>
          </optgroup>
        </select>
      <?php endif; ?>
      <input type="submit" name="add_option_list" value="<?php echo $this->_tpl_vars['LANG']['phrase_create_new_option_list_rightarrow']; ?>
" />
      <?php echo smarty_function_template_hook(array('location' => 'option_list_button_row'), $this);?>

    </p>

  </form>

<?php echo smarty_function_ft_include(array('file' => 'footer.tpl'), $this);?>