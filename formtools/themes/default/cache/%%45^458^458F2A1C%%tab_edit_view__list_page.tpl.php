<?php /* Smarty version 2.6.18, created on 2012-10-21 00:09:53
         compiled from C:%5CUsers%5CConnor%5CDocuments%5CCodeCraft%5CTEDxUW%5Cformtools/themes/default/admin/forms/tab_edit_view__list_page.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', 'C:\\Users\\Connor\\Documents\\CodeCraft\\TEDxUW\\formtools/themes/default/admin/forms/tab_edit_view__list_page.tpl', 5, false),array('modifier', 'escape', 'C:\\Users\\Connor\\Documents\\CodeCraft\\TEDxUW\\formtools/themes/default/admin/forms/tab_edit_view__list_page.tpl', 63, false),)), $this); ?>
    <div class="hint margin_bottom_large">
      <?php echo $this->_tpl_vars['LANG']['text_edit_view_list_page']; ?>

    </div>

    <div id="no_view_columns_defined" class="margin_bottom" <?php if (count($this->_tpl_vars['view_info']['columns']) > 0): ?>style="display:none"<?php endif; ?>>
      <div class="error">
        <div style="padding: 6px">
          No columns defined! You won't be able to use this View until you choose some form fields to
          appear as columns. Click the Add Row link below.
        </div>
      </div>
    </div>

    <div class="sortable submission_list check_areas margin_bottom" id="<?php echo $this->_tpl_vars['submission_list_sortable_id']; ?>
" <?php if (count($this->_tpl_vars['view_info']['columns']) == 0): ?>style="display:none"<?php endif; ?>>
      <input type="hidden" class="sortable__custom_delete_handler" value="view_ns.delete_view_column" />

      <ul class="header_row">
        <li class="col1"><?php echo $this->_tpl_vars['LANG']['word_order']; ?>
</li>
        <li class="col2"><?php echo $this->_tpl_vars['LANG']['word_field']; ?>
</li>
        <li class="col3"><?php echo $this->_tpl_vars['LANG']['word_sortable']; ?>
</li>
        <li class="col4"><?php echo $this->_tpl_vars['LANG']['phrase_column_width']; ?>
</li>
        <li class="col5"><?php echo $this->_tpl_vars['LANG']['word_truncate_q']; ?>
</li>
        <li class="col6 colN del"></li>
      </ul>
      <div class="clear"></div>
      <ul class="rows" id="rows">

      <?php $this->assign('previous_item', ""); ?>
      <?php $_from = $this->_tpl_vars['view_info']['columns']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['view_columns'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['view_columns']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
        $this->_foreach['view_columns']['iteration']++;
?>
        <?php $this->assign('row_num', $this->_tpl_vars['i']['list_order']); ?>
        <?php if ($this->_tpl_vars['previous_item'] != ""): ?>
          </div>
          <div class="clear"></div>
        </li>
        <?php endif; ?>
        <li class="sortable_row">
          <div class="row_content">
            <?php $this->assign('previous_item', $this->_tpl_vars['i']); ?>
            <div class="row_group<?php if (($this->_foreach['view_columns']['iteration'] == $this->_foreach['view_columns']['total'])): ?> rowN<?php endif; ?>">
              <input type="hidden" class="sr_order" value="<?php echo $this->_tpl_vars['i']['list_order']; ?>
" />
              <ul>
                <li class="col1 sort_col"><?php echo $this->_tpl_vars['row_num']; ?>
</li>
                <li class="col2">
                  <select name="field_id_<?php echo $this->_tpl_vars['row_num']; ?>
">
                    <?php $_from = $this->_tpl_vars['form_fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['field_row'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['field_row']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['field']):
        $this->_foreach['field_row']['iteration']++;
?>
                      <?php $this->assign('curr_field_id', $this->_tpl_vars['field']['field_id']); ?>
                      <?php $this->assign('selected', ""); ?>
                      <?php if ($this->_tpl_vars['i']['field_id'] == $this->_tpl_vars['curr_field_id']): ?>
                        <?php $this->assign('selected', 'selected'); ?>
                      <?php endif; ?>
                      <option value="<?php echo $this->_tpl_vars['curr_field_id']; ?>
" <?php echo $this->_tpl_vars['selected']; ?>
><?php echo $this->_tpl_vars['field']['field_title']; ?>
</option>
                    <?php endforeach; endif; unset($_from); ?>
                  </select>
                </li>
                <li class="col3 check_area">
                  <input type="checkbox" name="is_sortable_<?php echo $this->_tpl_vars['row_num']; ?>
" <?php if ($this->_tpl_vars['i']['is_sortable'] == 'yes'): ?>checked<?php endif; ?> />
                </li>
                <li class="col4 <?php if ($this->_tpl_vars['i']['auto_size'] == 'yes'): ?>light_grey<?php endif; ?>">
                  <input type="checkbox" name="auto_size_<?php echo $this->_tpl_vars['row_num']; ?>
" id="auto_size_<?php echo $this->_tpl_vars['row_num']; ?>
"
                    <?php if ($this->_tpl_vars['i']['auto_size'] == 'yes'): ?>checked<?php endif; ?> class="auto_size" /><label for="auto_size_<?php echo $this->_tpl_vars['row_num']; ?>
"
                      class="<?php if ($this->_tpl_vars['i']['auto_size'] == 'yes'): ?>black<?php else: ?>light_grey<?php endif; ?>"><?php echo $this->_tpl_vars['LANG']['phrase_auto_size']; ?>
</label>
                  &#8212; <?php echo $this->_tpl_vars['LANG']['word_width_c']; ?>

                  <input type="text" name="custom_width_<?php echo $this->_tpl_vars['row_num']; ?>
" class="custom_width" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['i']['custom_width'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"
                    <?php if ($this->_tpl_vars['i']['auto_size'] == 'yes'): ?>disabled<?php endif; ?> />px
                </li>
                <li class="col5">
                  <select name="truncate_<?php echo $this->_tpl_vars['row_num']; ?>
">
                    <option value="truncate" <?php if ($this->_tpl_vars['i']['truncate'] == 'truncate'): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['LANG']['word_yes']; ?>
</option>
                    <option value="no_truncate" <?php if ($this->_tpl_vars['i']['truncate'] == 'no_truncate'): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['LANG']['word_no']; ?>
</option>
                  </select>
                </li>
                <li class="col6 colN del"></li>
              </ul>
              <div class="clear"></div>
            </div>

        <?php if (($this->_foreach['view_columns']['iteration'] == $this->_foreach['view_columns']['total'])): ?>
          </div>
          <div class="clear"></div>
        </li>
        <?php endif; ?>

      <?php endforeach; endif; unset($_from); ?>
      </ul>
    </div>

    <script>view_ns.num_view_columns = <?php echo count($this->_tpl_vars['view_info']['columns']); ?>
;</script>

    <div>
      <a href="#" onclick="return view_ns.add_view_column()"><?php echo $this->_tpl_vars['LANG']['phrase_add_row']; ?>
</a>
    </div>