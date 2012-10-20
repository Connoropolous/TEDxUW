<?php /* Smarty version 2.6.18, created on 2012-10-20 17:29:59
         compiled from /Users/lucaszw/Sites/TEDxUW/formtools/themes/default/admin/forms/tab_fields.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'upper', '/Users/lucaszw/Sites/TEDxUW/formtools/themes/default/admin/forms/tab_fields.tpl', 1, false),array('modifier', 'lower', '/Users/lucaszw/Sites/TEDxUW/formtools/themes/default/admin/forms/tab_fields.tpl', 14, false),array('modifier', 'escape', '/Users/lucaszw/Sites/TEDxUW/formtools/themes/default/admin/forms/tab_fields.tpl', 95, false),array('function', 'ft_include', '/Users/lucaszw/Sites/TEDxUW/formtools/themes/default/admin/forms/tab_fields.tpl', 3, false),array('function', 'display_field_types_dropdown', '/Users/lucaszw/Sites/TEDxUW/formtools/themes/default/admin/forms/tab_fields.tpl', 124, false),array('function', 'field_sizes_dropdown', '/Users/lucaszw/Sites/TEDxUW/formtools/themes/default/admin/forms/tab_fields.tpl', 137, false),array('function', 'template_hook', '/Users/lucaszw/Sites/TEDxUW/formtools/themes/default/admin/forms/tab_fields.tpl', 190, false),)), $this); ?>
  <div class="subtitle underline margin_top_large"><?php echo ((is_array($_tmp=$this->_tpl_vars['LANG']['word_fields'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
</div>

  <?php echo smarty_function_ft_include(array('file' => 'messages.tpl'), $this);?>


  <div class="margin_bottom_large">
    <?php echo $this->_tpl_vars['text_fields_tab_summary']; ?>

  </div>

  <form action="<?php echo $this->_tpl_vars['same_page']; ?>
" method="post">
    <div class="underline pad_bottom margin_bottom_large">
      <div style="float:right"><?php echo $this->_tpl_vars['pagination']; ?>
</div>
      <span class="margin_right_large medium_grey"><?php echo $this->_tpl_vars['LANG']['word_show']; ?>
</span>
      <select name="num_fields_per_page">
        <option value="all"<?php if ($this->_tpl_vars['num_fields_per_page'] == 'all'): ?> selected<?php endif; ?>><?php echo ((is_array($_tmp=$this->_tpl_vars['LANG']['phrase_all_fields'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)); ?>
</option>
        <option value="10"<?php if ($this->_tpl_vars['num_fields_per_page'] == '10'): ?> selected<?php endif; ?>><?php echo $this->_tpl_vars['LANG']['phrase_10_per_page']; ?>
</option>
        <option value="15"<?php if ($this->_tpl_vars['num_fields_per_page'] == '15'): ?> selected<?php endif; ?>><?php echo $this->_tpl_vars['LANG']['phrase_15_per_page']; ?>
</option>
        <option value="20"<?php if ($this->_tpl_vars['num_fields_per_page'] == '20'): ?> selected<?php endif; ?>><?php echo $this->_tpl_vars['LANG']['phrase_20_per_page']; ?>
</option>
        <option value="25"<?php if ($this->_tpl_vars['num_fields_per_page'] == '25'): ?> selected<?php endif; ?>><?php echo $this->_tpl_vars['LANG']['phrase_25_per_page']; ?>
</option>
        <option value="50"<?php if ($this->_tpl_vars['num_fields_per_page'] == '50'): ?> selected<?php endif; ?>><?php echo $this->_tpl_vars['LANG']['phrase_50_per_page']; ?>
</option>
        <option value="100"<?php if ($this->_tpl_vars['num_fields_per_page'] == '100'): ?> selected<?php endif; ?>><?php echo $this->_tpl_vars['LANG']['phrase_100_per_page']; ?>
</option>
      </select>
      <input type="submit" value="<?php echo $this->_tpl_vars['LANG']['word_update']; ?>
" />
    </div>
  </form>

  <form action="<?php echo $this->_tpl_vars['same_page']; ?>
" name="display_form" id="display_form" method="post">
    <input type="hidden" name="page" value="fields" />

    <div class="scroll-pane ui-corner-all" style="border: 0px; margin-left: 239px; margin-bottom: -2px">
      <div class="scroll-bar-wrap ui-widget-content ui-corner-top" style="border: 1px solid #aaaaaa; border-bottom: 1px solid white; margin: 0px">
        <div class="scroll-bar-top"></div>
      </div>
    </div>

    <div class="clear"></div>
    <?php echo '<div class="sortable groupable scrollable edit_fields" id="'; ?><?php echo $this->_tpl_vars['sortable_id']; ?><?php echo '">'; ?><?php echo '<input type="hidden" class="tabindex_col_selectors" value=".rows .col2 input|.rows .col3 .sub_col1 input|.rows .col3 .sub_col2 select|.rows .col3 .sub_col3 input|.rows .col3 .sub_col4 select|.rows .col3 .sub_col5 select|.rows .col3 .sub_col6 input" /><input type="hidden" class="sortable__edit_tooltip" value="'; ?><?php echo $this->_tpl_vars['LANG']['phrase_edit_field']; ?><?php echo '" /><input type="hidden" class="sortable__delete_tooltip" value="'; ?><?php echo $this->_tpl_vars['LANG']['phrase_delete_field']; ?><?php echo '" /><input type="hidden" class="sortable__custom_delete_handler" value="fields_ns.delete_field" /><input type="hidden" name="sortable_row_offset" class="sortable__row_offset" value="'; ?><?php echo $this->_tpl_vars['order_start_number']; ?><?php echo '" /><ul class="header_row"><li class="col1">'; ?><?php echo $this->_tpl_vars['LANG']['word_order']; ?><?php echo '</li><li class="col2">'; ?><?php echo $this->_tpl_vars['LANG']['phrase_display_text']; ?><?php echo '</li><li class="col3 scrollable"><ul><li class="splitter"></li><li class="subcol_header"><ul class="scroll-content"><li class="sub_col1">'; ?><?php echo $this->_tpl_vars['LANG']['phrase_form_field']; ?><?php echo '</li><li class="sub_col2">'; ?><?php echo $this->_tpl_vars['LANG']['phrase_field_type']; ?><?php echo '</li><li class="sub_col3">'; ?><?php echo $this->_tpl_vars['LANG']['phrase_pass_on']; ?><?php echo '</li><li class="sub_col4">'; ?><?php echo $this->_tpl_vars['LANG']['phrase_field_size']; ?><?php echo '</li><li class="sub_col5">'; ?><?php echo $this->_tpl_vars['LANG']['phrase_sort_as']; ?><?php echo '</li><li class="sub_col6">'; ?><?php echo $this->_tpl_vars['LANG']['phrase_db_column']; ?><?php echo '<span class="pad_right">&nbsp;</span><input type="button" value="'; ?><?php echo $this->_tpl_vars['LANG']['phrase_smart_fill']; ?><?php echo '"onclick="return fields_ns.smart_fill()" class="bold"/></li></ul></li><li class="splitter"></li></ul></li><li class="col4 edit"></li><li class="col5 colN '; ?><?php if ($this->_tpl_vars['field']['is_system_field'] == 'no'): ?><?php echo 'del'; ?><?php endif; ?><?php echo '"></li></ul><div class="clear"></div><ul class="rows check_areas" id="rows">'; ?><?php $this->assign('previous_item', ""); ?><?php echo ''; ?><?php $_from = $this->_tpl_vars['form_fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['row'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['row']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['field']):
        $this->_foreach['row']['iteration']++;
?><?php echo ''; ?><?php $this->assign('count', ($this->_foreach['row']['iteration']-1)); ?><?php echo ''; ?><?php $this->assign('field_id', $this->_tpl_vars['field']['field_id']); ?><?php echo ''; ?><?php if ($this->_tpl_vars['field']['is_new_sort_group'] == 'yes' || $this->_tpl_vars['count'] == 0): ?><?php echo ''; ?><?php if ($this->_tpl_vars['previous_item'] != ""): ?><?php echo '</div><div class="clear"></div></li>'; ?><?php endif; ?><?php echo '<li class="sortable_row">'; ?><?php $this->assign('next_item_is_new_sort_group', $this->_tpl_vars['form_fields'][$this->_foreach['row']['iteration']]['is_new_sort_group']); ?><?php echo '<div class="row_content'; ?><?php if ($this->_tpl_vars['next_item_is_new_sort_group'] == 'no'): ?><?php echo ' grouped_row'; ?><?php endif; ?><?php echo '">'; ?><?php endif; ?><?php echo ''; ?><?php $this->assign('previous_item', $this->_tpl_vars['field']); ?><?php echo '<div class="row_group'; ?><?php if ($this->_tpl_vars['field']['is_system_field'] == 'yes'): ?><?php echo ' system_field'; ?><?php endif; ?><?php echo ' '; ?><?php if (($this->_foreach['row']['iteration'] == $this->_foreach['row']['total'])): ?><?php echo ' rowN'; ?><?php endif; ?><?php echo '"><input type="hidden" class="sr_order" value="'; ?><?php echo $this->_tpl_vars['field_id']; ?><?php echo '" /><ul><li class="col1 sort_col">'; ?><?php echo $this->_tpl_vars['count']+$this->_tpl_vars['order_start_number']; ?><?php echo '</li><li class="col2"><input type="text" name="field_'; ?><?php echo $this->_tpl_vars['field_id']; ?><?php echo '_display_name" id="field_'; ?><?php echo $this->_tpl_vars['field_id']; ?><?php echo '_display_name"value="'; ?><?php echo ((is_array($_tmp=$this->_tpl_vars['field']['field_title'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?><?php echo '" class="display_text" /></li><li class="splitter"></li><li class="col3 scrollable"><ul class="scroll-content"><li class="sub_col1">'; ?><?php if ($this->_tpl_vars['field']['is_system_field'] == 'yes'): ?><?php echo '<span class="pad_left_small medium_grey">'; ?><?php echo $this->_tpl_vars['LANG']['word_na']; ?><?php echo '</span>'; ?><?php else: ?><?php echo '<input type="text" name="field_'; ?><?php echo $this->_tpl_vars['field_id']; ?><?php echo '_name" id="field_'; ?><?php echo $this->_tpl_vars['field_id']; ?><?php echo '_name" value="'; ?><?php echo $this->_tpl_vars['field']['field_name']; ?><?php echo '"class="field_names" />'; ?><?php endif; ?><?php echo '</li><li class="sub_col2"><input type="hidden" name="old_field_'; ?><?php echo $this->_tpl_vars['field_id']; ?><?php echo '_type_id" id="old_field_'; ?><?php echo $this->_tpl_vars['field_id']; ?><?php echo '_type_id" class="system_field_type_id" value="'; ?><?php echo $this->_tpl_vars['field']['field_type_id']; ?><?php echo '" />'; ?><?php if ($this->_tpl_vars['field']['is_system_field'] == 'yes'): ?><?php echo '<span class="pad_left_small medium_grey system_field_type_label">'; ?><?php if ($this->_tpl_vars['field']['col_name'] == 'ip_address'): ?><?php echo ''; ?><?php echo $this->_tpl_vars['LANG']['phrase_ip_address']; ?><?php echo ''; ?><?php elseif ($this->_tpl_vars['field']['col_name'] == 'submission_date'): ?><?php echo ''; ?><?php echo $this->_tpl_vars['LANG']['phrase_submission_date']; ?><?php echo ''; ?><?php elseif ($this->_tpl_vars['field']['col_name'] == 'last_modified_date'): ?><?php echo ''; ?><?php echo $this->_tpl_vars['LANG']['phrase_last_modified_date']; ?><?php echo ''; ?><?php elseif ($this->_tpl_vars['field']['col_name'] == 'submission_id'): ?><?php echo ''; ?><?php echo $this->_tpl_vars['LANG']['phrase_submission_id']; ?><?php echo ''; ?><?php endif; ?><?php echo '</span><input type="hidden" name="system_fields[]" value="'; ?><?php echo $this->_tpl_vars['field_id']; ?><?php echo '" />'; ?><?php else: ?><?php echo ''; ?><?php echo smarty_function_display_field_types_dropdown(array('name' => "field_".($this->_tpl_vars['field_id'])."_type_id",'id' => "field_".($this->_tpl_vars['field_id'])."_type_id",'default' => $this->_tpl_vars['field']['field_type_id'],'class' => 'field_types'), $this);?><?php echo ''; ?><?php endif; ?><?php echo '</li><li class="sub_col3 check_area"><input type="checkbox" name="field_'; ?><?php echo $this->_tpl_vars['field_id']; ?><?php echo '_include_on_redirect" id="field_'; ?><?php echo $this->_tpl_vars['field_id']; ?><?php echo '_include_on_redirect"'; ?><?php if ($this->_tpl_vars['field']['include_on_redirect'] == 'yes'): ?><?php echo 'checked="checked"'; ?><?php endif; ?><?php echo ' class="pass_on" /></li><li class="sub_col4">'; ?><?php if ($this->_tpl_vars['field']['is_system_field'] == 'yes'): ?><?php echo '<span class="pad_left_small medium_grey">'; ?><?php echo $this->_tpl_vars['LANG']['word_na']; ?><?php echo '</span>'; ?><?php else: ?><?php echo '<input type="hidden" name="old_field_'; ?><?php echo $this->_tpl_vars['field_id']; ?><?php echo '_size" id="old_field_'; ?><?php echo $this->_tpl_vars['field_id']; ?><?php echo '_size" value="'; ?><?php echo $this->_tpl_vars['field']['field_size']; ?><?php echo '" /><div class="field_sizes_div">'; ?><?php echo smarty_function_field_sizes_dropdown(array('name' => "field_".($this->_tpl_vars['field_id'])."_size",'id' => "field_".($this->_tpl_vars['field_id'])."_size",'default' => $this->_tpl_vars['field']['field_size'],'field_type_id' => $this->_tpl_vars['field']['field_type_id'],'class' => 'field_sizes'), $this);?><?php echo '</div>'; ?><?php endif; ?><?php echo '</li><li class="sub_col5">'; ?><?php if ($this->_tpl_vars['field']['is_system_field'] == 'yes'): ?><?php echo '<span class="pad_left_small medium_grey">'; ?><?php echo $this->_tpl_vars['LANG']['word_na']; ?><?php echo '</span>'; ?><?php else: ?><?php echo '<select name="field_'; ?><?php echo $this->_tpl_vars['field_id']; ?><?php echo '_data_type" id="field_'; ?><?php echo $this->_tpl_vars['field_id']; ?><?php echo '_data_type" class="data_types"><option '; ?><?php if ($this->_tpl_vars['field']['data_type'] == 'string'): ?><?php echo 'selected'; ?><?php endif; ?><?php echo ' value="string">'; ?><?php echo $this->_tpl_vars['LANG']['word_string']; ?><?php echo '</option><option '; ?><?php if ($this->_tpl_vars['field']['data_type'] == 'number'): ?><?php echo 'selected'; ?><?php endif; ?><?php echo ' value="number">'; ?><?php echo $this->_tpl_vars['LANG']['word_number']; ?><?php echo '</option></select>'; ?><?php endif; ?><?php echo '</li><li class="sub_col6">'; ?><?php if ($this->_tpl_vars['field']['is_system_field'] == 'yes'): ?><?php echo '<span class="pad_left_small medium_grey system_field_db_column">'; ?><?php echo $this->_tpl_vars['field']['col_name']; ?><?php echo '</span>'; ?><?php else: ?><?php echo '<input type="hidden" name="old_col_'; ?><?php echo $this->_tpl_vars['field_id']; ?><?php echo '_name" id="old_col_'; ?><?php echo $this->_tpl_vars['field_id']; ?><?php echo '_name" value="'; ?><?php echo $this->_tpl_vars['field']['col_name']; ?><?php echo '" /><input type="text" name="col_'; ?><?php echo $this->_tpl_vars['field_id']; ?><?php echo '_name" id="col_'; ?><?php echo $this->_tpl_vars['field_id']; ?><?php echo '_name" class="db_column" value="'; ?><?php echo $this->_tpl_vars['field']['col_name']; ?><?php echo '" maxlength="64" />'; ?><?php endif; ?><?php echo '</li></ul></li><li class="splitter"></li><li class="col4 edit"></li><li class="col5 colN '; ?><?php if ($this->_tpl_vars['field']['is_system_field'] == 'no'): ?><?php echo 'del'; ?><?php endif; ?><?php echo '"></li></ul><div class="clear"></div></div>'; ?><?php if (($this->_foreach['row']['iteration'] == $this->_foreach['row']['total'])): ?><?php echo '</div><div class="clear"></div></li>'; ?><?php endif; ?><?php echo ''; ?><?php endforeach; endif; unset($_from); ?><?php echo '</ul></div><div class="scroll-pane ui-corner-all" style="border: 0px; margin-left: 239px; margin-top: -2px"><div class="scroll-bar-wrap ui-widget-content ui-corner-bottom" style="border: 1px solid #aaaaaa; border-top: 0px; margin: 0px; height:20px"><div class="scroll-bar-bottom"></div></div></div>'; ?>


    <div class="clear"></div>

    <div class="margin_top_large">
      <input type="submit" name="update_fields" value="<?php echo $this->_tpl_vars['LANG']['word_update']; ?>
" />
      <?php echo smarty_function_template_hook(array('location' => 'admin_edit_form_fields_tab_button_row'), $this);?>

    </div>
  </form>

  <form onsubmit="return fields_ns.add_fields()">
    <table cellspacing="0" cellpadding="0" border="0" width="100%" style="margin-top: -23px">
    <tr>
      <td align="right">
        <?php echo $this->_tpl_vars['LANG']['word_add']; ?>
 <input type="text" id="add_num_fields" size="3" value="1" /> <?php echo $this->_tpl_vars['LANG']['word_field_sp']; ?>

        <select id="new_field_position">
          <option value="end"><?php echo $this->_tpl_vars['LANG']['phrase_at_end']; ?>
</option>
          <option value="start"><?php echo $this->_tpl_vars['LANG']['phrase_at_start']; ?>
</option>
          <optgroup label="<?php echo $this->_tpl_vars['LANG']['word_after']; ?>
" id="add_fields_list">
            <?php $_from = $this->_tpl_vars['form_fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['row'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['row']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['field']):
        $this->_foreach['row']['iteration']++;
?>
              <option value="<?php echo $this->_tpl_vars['field']['field_id']; ?>
"><?php echo $this->_tpl_vars['field']['field_title']; ?>
</option>
            <?php endforeach; endif; unset($_from); ?>
          </optgroup>
        </select>
        <input type="checkbox" id="group_new_fields" />
          <label for="group_new_fields"><?php echo $this->_tpl_vars['LANG']['phrase_group_rows']; ?>
</label>
        <input type="submit" name="add_field" id="add_field" value="<?php echo $this->_tpl_vars['LANG']['word_add']; ?>
" />
      </td>
    </tr>
    </table>
    <?php if ($this->_tpl_vars['limit_fields']): ?>
      <div class="right medium_grey italic"><?php echo $this->_tpl_vars['LANG']['text_limit_fields_info']; ?>
</div>
    <?php endif; ?>
    <div class="clear"></div>

  </form>

  <div class="hidden" id="new_row_template">
    <div class="row_group">
      <input type="hidden" class="sr_order" value="%%ROW%%" />
      <ul>
        <li class="col0"></li>
        <li class="col1 sort_col"></li>
        <li class="col2"><input type="text" name="field_%%ROW%%_display_name" id="field_%%ROW%%_display_name" value="" class="display_text" /></li>
        <li class="splitter"></li>
        <li class="col3 scrollable">
          <ul class="scroll-content">
            <li class="sub_col1">
              <input type="text" name="field_%%ROW%%_name" id="field_%%ROW%%_name" value="" class="field_names" />
            </li>
            <li class="sub_col2">
              <?php echo smarty_function_display_field_types_dropdown(array('name' => "field_%%ROW%%_type_id",'id' => "field_%%ROW%%_type_id",'class' => 'field_types'), $this);?>

            </li>
            <li class="sub_col3 check_area">
              <input type="checkbox" name="field_%%ROW%%_include_on_redirect" id="field_%%ROW%%_include_on_redirect" class="pass_on" />
            </li>
            <li class="sub_col4">
              <div class="field_sizes_div">
                <?php echo smarty_function_field_sizes_dropdown(array('name' => "field_%%ROW%%_size",'id' => "field_%%ROW%%_size",'field_type_id' => "",'default' => 'medium','class' => 'field_sizes'), $this);?>

              </div>
            </li>
            <li class="sub_col5">
              <select name="field_%%ROW%%_data_type" class="data_types">
                <option value="string"><?php echo $this->_tpl_vars['LANG']['word_string']; ?>
</option>
                <option value="number"><?php echo $this->_tpl_vars['LANG']['word_number']; ?>
</option>
              </select>
            </li>
            <li class="sub_col6">
              <input type="text" name="col_%%ROW%%_name" id="col_%%ROW%%_name" class="db_column" value="" maxlength="64" />
            </li>
          </ul>
        </li>
        <li class="splitter"></li>
        <li class="col4 edit"></li>
        <li class="col5 colN del"> </li>
      </ul>
      <div class="clear"></div>
    </div>
  </div>

  <div class="hidden tabbed_dialog" id="edit_field_template">
    <div id="edit_field_template_message" class="margin_bottom_small hidden"></div>
    <div id="edit_field_template_new_field" class="margin_bottom_small notify hidden">
      <div style="padding: 8px">
        <?php echo $this->_tpl_vars['LANG']['notify_edit_field_new_field']; ?>

      </div>
    </div>
    <div class="inner_tabset ft_dialog" id="edit_field">
      <div class="tab_row threeCols">
        <div class="inner_tab1 selected"><?php echo $this->_tpl_vars['LANG']['phrase_main_settings']; ?>
</div>
        <div class="inner_tab2"></div>
        <div class="inner_tab3">Validation</div>
      </div>
      <div class="inner_tab_content">
        <div class="inner_tab_content1">
          <form id="edit_field_form_tab1">
            <table cellspacing="0" cellpadding="0">
            <tr>
              <td width="180"><label for="edit_field__display_text"><?php echo $this->_tpl_vars['LANG']['phrase_display_text']; ?>
</label></td>
              <td>
                <input type="text" id="edit_field__display_text" name="edit_field__display_text" />
              </td>
            </tr>
            <tr>
              <td><label for="edit_field__field_name"><?php echo $this->_tpl_vars['LANG']['phrase_form_field']; ?>
</label></td>
              <td>
                <div class="edit_field__non_system"><input type="text" id="edit_field__field_name" name="edit_field__field_name" /></div>
                <div class="edit_field__system medium_grey"><?php echo $this->_tpl_vars['LANG']['word_na']; ?>
</div>
              </td>
            </tr>
            <tr>
              <td><label for="edit_field__field_type"><?php echo $this->_tpl_vars['LANG']['phrase_field_type']; ?>
</label></td>
              <td>
                <div class="edit_field__non_system">
                  <?php echo smarty_function_display_field_types_dropdown(array('id' => 'edit_field__field_type','name' => 'edit_field__field_type','default' => $this->_tpl_vars['field']['field_type_id']), $this);?>

                </div>
                <div id="edit_field__field_type_system" class="edit_field__system medium_grey"></div>
              </td>
            </tr>
            <tr>
              <td><label for="edit_field__pass_on"><?php echo $this->_tpl_vars['LANG']['phrase_pass_on']; ?>
</label></td>
              <td>
                <input type="checkbox" id="edit_field__pass_on" name="edit_field__pass_on" />
              </td>
            </tr>
            <tr>
              <td><?php echo $this->_tpl_vars['LANG']['phrase_field_size']; ?>
</td>
              <td>
                <div class="edit_field__non_system" id="edit_field__field_size_div"></div>
                <div class="edit_field__system medium_grey"><?php echo $this->_tpl_vars['LANG']['word_na']; ?>
</div>
              </td>
            </tr>
            <tr>
              <td><?php echo $this->_tpl_vars['LANG']['phrase_data_type']; ?>
</td>
              <td>
                <div class="edit_field__non_system">
                  <select id="edit_field__data_type" name="edit_field__data_type">
                    <option value="string"><?php echo $this->_tpl_vars['LANG']['word_string']; ?>
</option>
                    <option value="number"><?php echo $this->_tpl_vars['LANG']['word_number']; ?>
</option>
                  </select>
                </div>
                <div class="edit_field__system medium_grey"><?php echo $this->_tpl_vars['LANG']['word_na']; ?>
</div>
              </td>
            </tr>
            <tr>
              <td><label for="edit_field__db_column"><?php echo $this->_tpl_vars['LANG']['phrase_db_column']; ?>
</label></td>
              <td>
                <div class="edit_field__non_system" id="edit_field__db_column_div">
                  <input type="text" id="edit_field__db_column" name="edit_field__db_column" maxlength="64" />
                </div>
                <div id="edit_field__db_column_div_system" class="edit_field__system medium_grey"></div>
              </td>
            </tr>
            </table>
          </form>
        </div>
        <div class="inner_tab_content2" style="display:none">
          <form id="edit_field_form_tab2">
            <div id="edit_field__field_settings_loading" class="medium_grey"><?php echo $this->_tpl_vars['LANG']['phrase_loading_ellipsis']; ?>
</div>
            <div id="edit_field__field_settings"></div>
          </form>
        </div>
        <div class="inner_tab_content3" style="display:none">
          <form id="edit_field_form_tab3">
            <div class="edit_field__non_system" id="validation_table"></div>
	          <div class="edit_field__system medium_grey"><i><?php echo $this->_tpl_vars['LANG']['phrase_system_fields_no_validation']; ?>
</i></div>
          </form>
        </div>
      </div>
    </div>
    <a class="prev_field field_nav"><?php echo $this->_tpl_vars['LANG']['phrase_previous_field']; ?>
</a>
    <a class="next_field field_nav"><?php echo $this->_tpl_vars['LANG']['phrase_next_field']; ?>
</a>
  </div>