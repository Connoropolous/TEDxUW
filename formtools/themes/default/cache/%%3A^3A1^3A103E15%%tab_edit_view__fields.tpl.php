<?php /* Smarty version 2.6.18, created on 2012-10-21 00:09:53
         compiled from C:%5CUsers%5CConnor%5CDocuments%5CCodeCraft%5CTEDxUW%5Cformtools/themes/default/admin/forms/tab_edit_view__fields.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', 'C:\\Users\\Connor\\Documents\\CodeCraft\\TEDxUW\\formtools/themes/default/admin/forms/tab_edit_view__fields.tpl', 5, false),array('function', 'eval', 'C:\\Users\\Connor\\Documents\\CodeCraft\\TEDxUW\\formtools/themes/default/admin/forms/tab_edit_view__fields.tpl', 34, false),)), $this); ?>
    <div class="hint margin_bottom">
      <?php echo $this->_tpl_vars['LANG']['text_view_fields_info']; ?>

    </div>

    <div id="no_view_fields_defined" class="margin_bottom" <?php if (count($this->_tpl_vars['grouped_fields']) > 0): ?>style="display:none"<?php endif; ?>>
      <div class="error">
        <div style="padding: 6px">
          <?php echo $this->_tpl_vars['LANG']['text_no_fields_in_view']; ?>

        </div>
      </div>
    </div>

    <div id="allow_editable_fields_toggle" class="margin_bottom_large" <?php if (count($this->_tpl_vars['grouped_fields']) == 0): ?>style="display:none"<?php endif; ?>>
      <input type="checkbox" name="may_edit_submissions" id="cmes" value="yes"
        onchange="view_ns.toggle_editable_fields(this.checked)" <?php if ($this->_tpl_vars['view_info']['may_edit_submissions'] == 'yes'): ?>checked<?php endif; ?> />
      <label for="cmes"><?php echo $this->_tpl_vars['LANG']['phrase_allow_fields_edited']; ?>
</label>
    </div>

    <div class="sortable_groups check_areas" id="<?php echo $this->_tpl_vars['view_fields_sortable_id']; ?>
">
	  <input type="hidden" class="sortable__add_group_handler" value="view_ns.add_field_group" />
	  <input type="hidden" class="sortable__delete_group_handler" value="view_ns.delete_field_group" />
	  <input type="hidden" class="sortable__class" value="groupable edit_view_fields" />
	  <input type="hidden" class="sortable__new_group_name" value="<?php echo $this->_tpl_vars['LANG']['phrase_view_field_group']; ?>
" />
	  <input type="hidden" name="deleted_groups" id="deleted_groups" value="" />

      <?php $_from = $this->_tpl_vars['grouped_fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['group'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['group']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['curr_group_info']):
        $this->_foreach['group']['iteration']++;
?>
        <?php $this->assign('group_info', $this->_tpl_vars['curr_group_info']['group']); ?>
        <?php $this->assign('view_fields', $this->_tpl_vars['curr_group_info']['fields']); ?>

          <div class="sortable_group">
            <div class="sortable_group_header">
              <div class="sort"></div>
              <label><?php echo $this->_tpl_vars['LANG']['phrase_view_field_group']; ?>
</label>
              <input type="text" name="group_name_<?php echo $this->_tpl_vars['group_info']['group_id']; ?>
" class="group_name" value="<?php echo smarty_function_eval(array('var' => $this->_tpl_vars['group_info']['group_name']), $this);?>
" />
              <select name="group_tab_<?php echo $this->_tpl_vars['group_info']['group_id']; ?>
" class="tabs_dropdown">
                <optgroup label="<?php echo $this->_tpl_vars['LANG']['phrase_available_tabs']; ?>
">
                <?php $this->assign('has_tabs', false); ?>
                <?php $_from = $this->_tpl_vars['view_tabs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['tab_row'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['tab_row']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['view_tab']):
        $this->_foreach['tab_row']['iteration']++;
?>
                  <?php $this->assign('counter', $this->_foreach['tab_row']['iteration']); ?>
                                    <?php if ($this->_tpl_vars['view_tab']['tab_label']): ?>
                    <?php $this->assign('has_tabs', true); ?>
                    <option value="<?php echo $this->_tpl_vars['counter']; ?>
"<?php if ($this->_tpl_vars['counter'] == $this->_tpl_vars['group_info']['custom_data']): ?> selected<?php endif; ?>><?php echo $this->_tpl_vars['view_tab']['tab_label']; ?>
</option>
                  <?php endif; ?>
                <?php endforeach; endif; unset($_from); ?>
                <?php if (! $this->_tpl_vars['has_tabs']): ?><option value=""><?php echo $this->_tpl_vars['LANG']['validation_no_tabs_defined']; ?>
</option><?php endif; ?>
                </optgroup>
              </select>
              <div class="delete_group"></div>
              <input type="hidden" class="group_order" value="<?php echo $this->_tpl_vars['group_info']['group_id']; ?>
" />
              <div class="clear"></div>
            </div>

            <div class="sortable groupable edit_view_fields">
              <ul class="header_row">
                <li class="col1"><?php echo $this->_tpl_vars['LANG']['word_order']; ?>
</li>
                <li class="col2"><?php echo $this->_tpl_vars['LANG']['word_field']; ?>
</li>
                <li class="col3"><?php echo $this->_tpl_vars['LANG']['phrase_field_type']; ?>
</li>
                <li class="col4"><?php echo $this->_tpl_vars['LANG']['word_editable']; ?>
</li>
                <li class="col5"><?php echo $this->_tpl_vars['LANG']['word_searchable']; ?>
</li>
                <li class="col6 colN del"></li>
              </ul>
              <div class="clear"></div>
              <ul class="rows connected_sortable">
              <li class="sortable_row empty_group<?php if (count($this->_tpl_vars['view_fields']) != 0): ?> hidden<?php endif; ?>"><div class="clear"></div></li>

              <?php $this->assign('previous_item', ""); ?>
              <?php $_from = $this->_tpl_vars['view_fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['row'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['row']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['field']):
        $this->_foreach['row']['iteration']++;
?>
                <?php $this->assign('field_id', $this->_tpl_vars['field']['field_id']); ?>
                <?php $this->assign('index', ($this->_foreach['row']['iteration']-1)); ?>
                <?php $this->assign('count', $this->_foreach['row']['iteration']); ?>

                <?php if ($this->_tpl_vars['field']['view_field_is_new_sort_group'] == 'yes'): ?>
                  <?php if ($this->_tpl_vars['previous_item'] != ""): ?>
                    </div>
                    <div class="clear"></div>
                  </li>
                  <?php endif; ?>
                  <li class="sortable_row<?php if (($this->_foreach['row']['iteration'] == $this->_foreach['row']['total'])): ?> rowN<?php endif; ?>">
                  <?php $this->assign('next_item_is_new_sort_group', $this->_tpl_vars['view_fields'][$this->_foreach['row']['iteration']]['view_field_is_new_sort_group']); ?>
                  <div class="row_content<?php if ($this->_tpl_vars['next_item_is_new_sort_group'] == 'no'): ?> grouped_row<?php endif; ?>">
                <?php endif; ?>

                <?php $this->assign('previous_item', $this->_tpl_vars['field']); ?>

                <div class="row_group">
                  <input type="hidden" class="sr_order" value="<?php echo $this->_tpl_vars['field_id']; ?>
" />
                  <ul>
                    <li class="col1 sort_col"><?php echo $this->_tpl_vars['field']['list_order']; ?>
</li>
                    <li class="col2"><?php echo $this->_tpl_vars['field']['field_title']; ?>
</li>
                    <li class="col3 medium_grey"><?php echo $this->_tpl_vars['field_types'][$this->_tpl_vars['field']['field_type_id']]; ?>
</li>
                    <li class="col4 <?php if ($this->_tpl_vars['field']['col_name'] != 'submission_id' && $this->_tpl_vars['field']['col_name'] != 'last_modified_date'): ?>check_area<?php endif; ?>">
                                            <?php if ($this->_tpl_vars['field']['col_name'] != 'submission_id' && $this->_tpl_vars['field']['col_name'] != 'last_modified_date'): ?>
                        <input type="checkbox" name="editable_fields[]" value="<?php echo $this->_tpl_vars['field_id']; ?>
" class="editable_fields" <?php if ($this->_tpl_vars['field']['is_editable'] == 'yes'): ?>checked<?php endif; ?>
                          <?php if ($this->_tpl_vars['view_info']['may_edit_submissions'] == 'no'): ?>disabled<?php endif; ?> />
                      <?php endif; ?>
                    </li>
                    <li class="col5 check_area">
                      <input type="checkbox" name="searchable_fields[]" value="<?php echo $this->_tpl_vars['field_id']; ?>
" <?php if ($this->_tpl_vars['field']['is_searchable'] == 'yes'): ?>checked<?php endif; ?> />
                    </li>
                    <li class="col6 colN del"><a href="#" onclick="return view_ns.remove_view_field(<?php echo $this->_tpl_vars['field_id']; ?>
)"></a></li>
                  </ul>
                  <div class="clear"></div>
                </div>

              <?php if (($this->_foreach['row']['iteration'] == $this->_foreach['row']['total'])): ?>
                </div>
                <div class="clear"></div>
              </li>
              <?php endif; ?>

            <?php endforeach; endif; unset($_from); ?>
          </ul>
        </div>
        <div class="clear"></div>
        <div class="sortable_group_footer">
          <a href="#" class="add_field_link"><?php echo $this->_tpl_vars['LANG']['phrase_add_fields_rightarrow']; ?>
</a>
        </div>
      </div>

      <div class="clear"></div>
      <?php endforeach; endif; unset($_from); ?>
    </div>

    <div>
      <a href="#" class="custom_add_group_link"><?php echo $this->_tpl_vars['LANG']['phrase_add_new_group_rightarrow']; ?>
</a>
    </div>

    <div class="hidden add_fields_popup" id="add_fields_popup">
      <div class="error margin_bottom_large hidden"><div style="padding: 6px"></div></div>
      <table cellspacing="1" cellpadding="3" width="100%" height="100%">
      <tr>
        <td width="140" valign="top"><?php echo $this->_tpl_vars['LANG']['phrase_available_fields']; ?>
</td>
        <td>
          <div class="view_fields_list" id="add_fields_popup_available_fields"></div>
          <div class="grey_box two_buttons">
            <input type="button" value="<?php echo $this->_tpl_vars['LANG']['phrase_select_all']; ?>
" onclick="view_ns.add_fields_select_all()" />
            <input type="button" value="<?php echo $this->_tpl_vars['LANG']['phrase_unselect_all']; ?>
" onclick="view_ns.add_fields_unselect_all()" />
          </div>
        </td>
      </tr>
      </table>
    </div>

    <div class="hidden add_view_group_popup" id="add_group_popup">
      <input type="hidden" class="add_group_popup_title" value="<?php echo $this->_tpl_vars['LANG']['phrase_create_new_view_group']; ?>
" />
      <div class="add_field_error hidden error"></div>

      <table cellspacing="1" cellpadding="3" width="100%" height="100%">
      <tr>
        <td width="140"><?php echo $this->_tpl_vars['LANG']['phrase_group_name']; ?>
</td>
        <td><input type="text" class="new_group_name" placeholder="(optional)" /></td>
      </tr>
      <tr>
        <td valign="top"><?php echo $this->_tpl_vars['LANG']['phrase_available_fields']; ?>
</td>
        <td>
          <div class="view_fields_list" id="add_group_popup_available_fields"></div>
          <div class="grey_box two_buttons">
            <input type="button" value="<?php echo $this->_tpl_vars['LANG']['phrase_select_all']; ?>
" onclick="view_ns.add_fields_select_all()" />
            <input type="button" value="<?php echo $this->_tpl_vars['LANG']['phrase_unselect_all']; ?>
" onclick="view_ns.add_fields_unselect_all()" />
          </div>
        </td>
      </tr>
      </table>
    </div>

    <!-- for the add group functionality -->
    <div id="sortable__new_group_header" class="hidden">
      <ul class="header_row">
        <li class="col1"><?php echo $this->_tpl_vars['LANG']['word_order']; ?>
</li>
        <li class="col2"><?php echo $this->_tpl_vars['LANG']['word_field']; ?>
</li>
        <li class="col3"><?php echo $this->_tpl_vars['LANG']['phrase_field_type']; ?>
</li>
        <li class="col4"><?php echo $this->_tpl_vars['LANG']['word_editable']; ?>
</li>
        <li class="col5"><?php echo $this->_tpl_vars['LANG']['word_searchable']; ?>
</li>
        <li class="col6 colN del"></li>
      </ul>
    </div>
    <div id="sortable__new_group_footer" class="hidden">
      <div class="sortable_group_footer">
        <a href="#" class="add_field_link"><?php echo $this->_tpl_vars['LANG']['phrase_add_fields_rightarrow']; ?>
</a>
      </div>
    </div>