<?php /* Smarty version 2.6.18, created on 2012-10-21 00:09:54
         compiled from C:%5CUsers%5CConnor%5CDocuments%5CCodeCraft%5CTEDxUW%5Cformtools/themes/default/admin/forms/tab_edit_view__filters.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'in_array', 'C:\\Users\\Connor\\Documents\\CodeCraft\\TEDxUW\\formtools/themes/default/admin/forms/tab_edit_view__filters.tpl', 35, false),array('modifier', 'escape', 'C:\\Users\\Connor\\Documents\\CodeCraft\\TEDxUW\\formtools/themes/default/admin/forms/tab_edit_view__filters.tpl', 63, false),array('modifier', 'upper', 'C:\\Users\\Connor\\Documents\\CodeCraft\\TEDxUW\\formtools/themes/default/admin/forms/tab_edit_view__filters.tpl', 85, false),array('function', 'template_hook', 'C:\\Users\\Connor\\Documents\\CodeCraft\\TEDxUW\\formtools/themes/default/admin/forms/tab_edit_view__filters.tpl', 148, false),)), $this); ?>
  <input type="hidden" name="num_standard_filters" id="num_standard_filters" value="<?php echo $this->_tpl_vars['num_standard_filters']; ?>
" />
  <input type="hidden" name="num_client_map_filters" id="num_client_map_filters" value="<?php echo $this->_tpl_vars['num_client_map_filters']; ?>
" />

  <div class="grey_box margin_bottom">
    <a href="#" onclick="return view_ns.toggle_filter_section('standard')"><?php echo $this->_tpl_vars['LANG']['phrase_standard_filters']; ?>
</a>

    <div id="standard_filters" <?php if ($this->_tpl_vars['view_info']['has_standard_filter'] == 'no'): ?>style="display:none"<?php endif; ?>>
      <div class="margin_top margin_bottom">
        <?php echo $this->_tpl_vars['LANG']['text_filters_page']; ?>

        <?php echo $this->_tpl_vars['text_filters_tips']; ?>

      </div>

      <table cellspacing="1" cellpadding="0" class="list_table" width="100%" id="standard_filters_table">
      <tbody><tr>
        <th><?php echo $this->_tpl_vars['LANG']['word_field']; ?>
</th>
        <th width="180"><?php echo $this->_tpl_vars['LANG']['word_operator']; ?>
</th>
        <th width="150"><?php echo $this->_tpl_vars['LANG']['word_value_sp']; ?>
</th>
        <th class="del"></th>
      </tr>
            <?php $_from = $this->_tpl_vars['standard_filters']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['row'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['row']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['filter']):
        $this->_foreach['row']['iteration']++;
?>
        <?php $this->assign('count', $this->_foreach['row']['iteration']); ?>
        <?php $this->assign('field_id', $this->_tpl_vars['filter']['field_id']); ?>
        <?php $this->assign('operator', $this->_tpl_vars['filter']['operator']); ?>
        <?php $this->assign('filter_values', $this->_tpl_vars['filter']['filter_values']); ?>
        <tr id="standard_row_<?php echo $this->_tpl_vars['count']; ?>
">
          <td>
            <select name="standard_filter_<?php echo $this->_tpl_vars['count']; ?>
_field_id" id="standard_filter_<?php echo $this->_tpl_vars['count']; ?>
_field_id"
              onchange="view_ns.change_standard_filter_field(<?php echo $this->_tpl_vars['count']; ?>
)">
              <?php $this->assign('selected_field_is_date_field', false); ?>
              <?php $_from = $this->_tpl_vars['form_fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['field_row'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['field_row']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['field']):
        $this->_foreach['field_row']['iteration']++;
?>
                <?php $this->assign('curr_field_id', $this->_tpl_vars['field']['field_id']); ?>
                <?php if ($this->_tpl_vars['field_id'] == $this->_tpl_vars['curr_field_id']): ?>
                  <?php $this->assign('selected', 'selected'); ?>
                  <?php if (((is_array($_tmp=$this->_tpl_vars['curr_field_id'])) ? $this->_run_mod_handler('in_array', true, $_tmp, $this->_tpl_vars['date_field_ids']) : in_array($_tmp, $this->_tpl_vars['date_field_ids']))): ?>
                    <?php $this->assign('selected_field_is_date_field', true); ?>
                  <?php endif; ?>
                <?php else: ?>
                  <?php $this->assign('selected', ""); ?>
                <?php endif; ?>
                <option value="<?php echo $this->_tpl_vars['curr_field_id']; ?>
" <?php echo $this->_tpl_vars['selected']; ?>
><?php echo $this->_tpl_vars['field']['field_title']; ?>
</option>
              <?php endforeach; endif; unset($_from); ?>
            </select>
          </td>
          <td>
            <div id="standard_filter_<?php echo $this->_tpl_vars['count']; ?>
_operators_dates_div" <?php if (! $this->_tpl_vars['selected_field_is_date_field']): ?>style="display:none"<?php endif; ?>>
              <select name="standard_filter_<?php echo $this->_tpl_vars['count']; ?>
_operator_date">
                <option value="before" <?php if ($this->_tpl_vars['operator'] == 'before'): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['LANG']['word_before']; ?>
</option>
                <option value="after"  <?php if ($this->_tpl_vars['operator'] == 'after'): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['LANG']['word_after']; ?>
</option>
              </select>
            </div>
            <div id="standard_filter_<?php echo $this->_tpl_vars['count']; ?>
_operators_div" <?php if ($this->_tpl_vars['selected_field_is_date_field']): ?>style="display:none"<?php endif; ?>>
              <select name="standard_filter_<?php echo $this->_tpl_vars['count']; ?>
_operator">
                <option value="equals"     <?php if ($this->_tpl_vars['operator'] == 'equals'): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['LANG']['word_equals']; ?>
</option>
                <option value="not_equals" <?php if ($this->_tpl_vars['operator'] == 'not_equals'): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['LANG']['phrase_not_equal']; ?>
</option>
                <option value="like"       <?php if ($this->_tpl_vars['operator'] == 'like'): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['LANG']['word_like']; ?>
</option>
                <option value="not_like"   <?php if ($this->_tpl_vars['operator'] == 'not_like'): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['LANG']['phrase_not_like']; ?>
</option>
              </select>
            </div>
          </td>
          <td>
            <div id="standard_filter_<?php echo $this->_tpl_vars['count']; ?>
_values_dates_div" <?php if (! $this->_tpl_vars['selected_field_is_date_field']): ?>style="display:none"<?php endif; ?> class="cf_date_group">
              <input type="text" name="standard_filter_<?php echo $this->_tpl_vars['count']; ?>
_filter_date_values" id="standard_date_<?php echo $this->_tpl_vars['count']; ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['filter_values'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" /><img
                src="<?php echo $this->_tpl_vars['g_root_url']; ?>
/global/images/calendar.png" id="standard_date_image_<?php echo $this->_tpl_vars['count']; ?>
" border="0" />
            </div>
            <script>
              $(function() <?php echo '{'; ?>
 $("#standard_date_<?php echo $this->_tpl_vars['count']; ?>
").datetimepicker(<?php echo '{'; ?>

                showSecond: true,
                timeFormat: "hh:mm:ss",
                dateFormat: "yy-mm-dd"
                <?php echo '}'; ?>
);
              <?php echo '}'; ?>
);
            </script>
            <div id="standard_filter_<?php echo $this->_tpl_vars['count']; ?>
_values_div" <?php if ($this->_tpl_vars['selected_field_is_date_field']): ?>style="display:none"<?php endif; ?>>
              <input type="text" name="standard_filter_<?php echo $this->_tpl_vars['count']; ?>
_filter_values" style="width: 144px;" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['filter_values'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
            </div>
          </td>
          <td class="del"><a href="#" onclick="return view_ns.delete_filter_row('standard', <?php echo $this->_tpl_vars['count']; ?>
)"></a></td>
        </tr>
        <?php endforeach; endif; unset($_from); ?>
      </tbody></table>

      <div class="margin_top">
        <?php echo $this->_tpl_vars['add_standard_filter_num_rows_input_field']; ?>

        <input type="button" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['LANG']['word_add'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
" onclick="view_ns.add_standard_filters($('#num_standard_filter_rows').val())" />
      </div>
    </div>
  </div>

  <div class="grey_box">
    <a href="#" onclick="return view_ns.toggle_filter_section('client_map')"><?php echo $this->_tpl_vars['LANG']['phrase_client_map_filters']; ?>
</a>
    <div id="client_map_filters" <?php if ($this->_tpl_vars['view_info']['has_client_map_filter'] == 'no'): ?>style="display:none"<?php endif; ?>>
      <div class="margin_top margin_bottom">
        <?php echo $this->_tpl_vars['LANG']['text_client_map_filters_desc1']; ?>

      </div>

      <table cellspacing="1" cellpadding="0" class="list_table" width="100%" id="client_map_filters_table">
      <tbody><tr>
        <th><?php echo $this->_tpl_vars['LANG']['word_field']; ?>
</th>
        <th><?php echo $this->_tpl_vars['LANG']['word_operator']; ?>
</th>
        <th><?php echo $this->_tpl_vars['LANG']['phrase_client_field']; ?>
</th>
        <th class="del"></th>
      </tr>

            <?php $_from = $this->_tpl_vars['client_map_filters']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['row'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['row']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['filter']):
        $this->_foreach['row']['iteration']++;
?>
        <?php $this->assign('count', $this->_foreach['row']['iteration']); ?>
        <?php $this->assign('field_id', $this->_tpl_vars['filter']['field_id']); ?>
        <?php $this->assign('operator', $this->_tpl_vars['filter']['operator']); ?>
        <?php $this->assign('filter_values', $this->_tpl_vars['filter']['filter_values']); ?>

        <tr id="client_map_row_<?php echo $this->_tpl_vars['count']; ?>
">
          <td>
            <select name="client_map_filter_<?php echo $this->_tpl_vars['count']; ?>
_field_id" id="client_map_filter_<?php echo $this->_tpl_vars['count']; ?>
_field_id">
              <?php $this->assign('selected_field_is_date_field', false); ?>
              <?php $_from = $this->_tpl_vars['form_fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['field_row'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['field_row']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['field']):
        $this->_foreach['field_row']['iteration']++;
?>
                <?php $this->assign('curr_field_id', $this->_tpl_vars['field']['field_id']); ?>
                <?php if ($this->_tpl_vars['field_id'] == $this->_tpl_vars['curr_field_id']): ?>
                  <?php $this->assign('selected', 'selected'); ?>
                <?php else: ?>
                  <?php $this->assign('selected', ""); ?>
                <?php endif; ?>
                <?php if ($this->_tpl_vars['selected'] && ( $this->_tpl_vars['field']['col_name'] == 'submission_date' || $this->_tpl_vars['field']['col_name'] == 'last_modified_date' )): ?>
                  <?php $this->assign('selected_field_is_date_field', true); ?>
                <?php endif; ?>
                <option value="<?php echo $this->_tpl_vars['curr_field_id']; ?>
" <?php echo $this->_tpl_vars['selected']; ?>
><?php echo $this->_tpl_vars['field']['field_title']; ?>
</option>
              <?php endforeach; endif; unset($_from); ?>
            </select>
          </td>
          <td>
            <select name="client_map_filter_<?php echo $this->_tpl_vars['count']; ?>
_operator">
              <option value="equals"     <?php if ($this->_tpl_vars['operator'] == 'equals'): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['LANG']['word_equals']; ?>
</option>
              <option value="not_equals" <?php if ($this->_tpl_vars['operator'] == 'not_equals'): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['LANG']['phrase_not_equal']; ?>
</option>
              <option value="like"       <?php if ($this->_tpl_vars['operator'] == 'like'): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['LANG']['word_like']; ?>
</option>
              <option value="not_like"   <?php if ($this->_tpl_vars['operator'] == 'not_like'): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['LANG']['phrase_not_like']; ?>
</option>
            </select>
          </td>
          <td>
            <select name="client_map_filter_<?php echo $this->_tpl_vars['count']; ?>
_client_field" style="width:160px">
              <option value=""><?php echo $this->_tpl_vars['LANG']['phrase_please_select']; ?>
</option>
              <optgroup label="<?php echo $this->_tpl_vars['LANG']['phrase_core_fields']; ?>
">
                <option value="account_id"              <?php if ($this->_tpl_vars['filter_values'] == 'account_id'): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['LANG']['word_id']; ?>
</option>
                <option value="first_name"              <?php if ($this->_tpl_vars['filter_values'] == 'first_name'): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['LANG']['phrase_first_name']; ?>
</option>
                <option value="last_name"               <?php if ($this->_tpl_vars['filter_values'] == 'last_name'): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['LANG']['phrase_last_name']; ?>
</option>
                <option value="email"                   <?php if ($this->_tpl_vars['filter_values'] == 'email'): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['LANG']['word_email']; ?>
</option>
                <option value="settings__company_name"  <?php if ($this->_tpl_vars['filter_values'] == 'settings__company_name'): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['LANG']['phrase_company_name']; ?>
</option>
              </optgroup>
              <?php echo smarty_function_template_hook(array('location' => 'admin_edit_view_client_map_filter_dropdown'), $this);?>

            </select>
          </td>
          <td class="del"><a href="#" onclick="return view_ns.delete_filter_row('client_map', <?php echo $this->_tpl_vars['count']; ?>
)"></a></td>
        </tr>
        <?php endforeach; endif; unset($_from); ?>
        </tbody>
      </table>

      <div class="margin_top">
        <?php echo $this->_tpl_vars['add_client_map_filter_num_rows_input_field']; ?>

        <input type="button" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['LANG']['word_add'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
" onclick="view_ns.add_client_map_filters($('#num_client_map_filter_rows').val())" />
      </div>
    </div>
  </div>