<?php /* Smarty version 2.6.18, created on 2012-10-14 21:10:53
         compiled from C:%5CUsers%5CConnor%5CDocuments%5CCodeCraft%5CTEDxUW%5Cformtools/themes/default/admin/forms/tab_views.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'upper', 'C:\\Users\\Connor\\Documents\\CodeCraft\\TEDxUW\\formtools/themes/default/admin/forms/tab_views.tpl', 2, false),array('modifier', 'count', 'C:\\Users\\Connor\\Documents\\CodeCraft\\TEDxUW\\formtools/themes/default/admin/forms/tab_views.tpl', 15, false),array('modifier', 'lower', 'C:\\Users\\Connor\\Documents\\CodeCraft\\TEDxUW\\formtools/themes/default/admin/forms/tab_views.tpl', 113, false),array('function', 'ft_include', 'C:\\Users\\Connor\\Documents\\CodeCraft\\TEDxUW\\formtools/themes/default/admin/forms/tab_views.tpl', 5, false),array('function', 'eval', 'C:\\Users\\Connor\\Documents\\CodeCraft\\TEDxUW\\formtools/themes/default/admin/forms/tab_views.tpl', 36, false),array('function', 'clients_dropdown', 'C:\\Users\\Connor\\Documents\\CodeCraft\\TEDxUW\\formtools/themes/default/admin/forms/tab_views.tpl', 94, false),array('function', 'template_hook', 'C:\\Users\\Connor\\Documents\\CodeCraft\\TEDxUW\\formtools/themes/default/admin/forms/tab_views.tpl', 147, false),array('function', 'views_dropdown', 'C:\\Users\\Connor\\Documents\\CodeCraft\\TEDxUW\\formtools/themes/default/admin/forms/tab_views.tpl', 165, false),)), $this); ?>
  <div class="subtitle underline margin_top_large">
    <?php echo ((is_array($_tmp=$this->_tpl_vars['LANG']['word_views'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>

  </div>

  <?php echo smarty_function_ft_include(array('file' => 'messages.tpl'), $this);?>


  <div class="margin_bottom_large">
    <?php echo $this->_tpl_vars['LANG']['text_view_tab_summary']; ?>

  </div>

  <form action="<?php echo $this->_tpl_vars['same_page']; ?>
" method="post" id="views_form">
    <input type="hidden" name="page" value="views" />
    <input type="hidden" id="form_id" value="<?php echo $this->_tpl_vars['form_id']; ?>
" />

    <?php if (count($this->_tpl_vars['grouped_views']) == 0): ?>
      <div class="error yellow_bg" class="margin_bottom_large">
        <div style="padding:8px">
          <?php echo $this->_tpl_vars['LANG']['notify_no_views_defined']; ?>

        </div>
      </div>
      <div class="margin_top_large">
        <input type="submit" name="recreate_initial_view" value="<?php echo $this->_tpl_vars['LANG']['phrase_create_default_view']; ?>
" />
      </div>
    <?php else: ?>
      <div class="sortable_groups" id="<?php echo $this->_tpl_vars['sortable_id']; ?>
">
        <input type="hidden" class="sortable__custom_delete_handler" value="view_ns.delete_view" />

      <?php $_from = $this->_tpl_vars['grouped_views']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['group'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['group']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['curr_group_info']):
        $this->_foreach['group']['iteration']++;
?>
        <?php $this->assign('group_info', $this->_tpl_vars['curr_group_info']['group']); ?>
        <?php $this->assign('views', $this->_tpl_vars['curr_group_info']['views']); ?>

        <div class="sortable_group">
          <div class="sortable_group_header">
            <div class="sort"></div>
            <label><?php echo $this->_tpl_vars['LANG']['phrase_view_group']; ?>
</label>
            <input type="text" name="group_name_<?php echo $this->_tpl_vars['group_info']['group_id']; ?>
" class="group_name" value="<?php echo smarty_function_eval(array('var' => $this->_tpl_vars['group_info']['group_name']), $this);?>
" />
            <div class="delete_group"></div>
            <input type="hidden" class="group_order" value="<?php echo $this->_tpl_vars['group_info']['group_id']; ?>
" />
            <div class="clear"></div>
          </div>

          <div class="sortable groupable view_list">
            <ul class="header_row">
              <li class="col0"> </li>
              <li class="col1"><?php echo $this->_tpl_vars['LANG']['word_order']; ?>
</li>
              <li class="col2"><?php echo $this->_tpl_vars['LANG']['phrase_view_id']; ?>
</li>
              <li class="col3"><?php echo $this->_tpl_vars['LANG']['phrase_view_name']; ?>
</li>
              <li class="col4"><?php echo $this->_tpl_vars['LANG']['phrase_who_can_access']; ?>
</li>
              <li class="col5"><div title="<?php echo $this->_tpl_vars['LANG']['word_columns_sp']; ?>
"></div></li>
              <li class="col6"><div title="<?php echo $this->_tpl_vars['LANG']['word_fields_sp']; ?>
"></div></li>
              <li class="col7"><div title="<?php echo $this->_tpl_vars['LANG']['word_tabs_sp']; ?>
"></div></li>
              <li class="col8"><div title="<?php echo $this->_tpl_vars['LANG']['word_filters_sp']; ?>
"></div></li>
              <li class="col9 edit"></li>
              <li class="col10 colN del"></li>
            </ul>
            <div class="clear"></div>
            <ul class="rows connected_sortable">
              <li class="sortable_row empty_group<?php if (count($this->_tpl_vars['views']) != 0): ?> hidden<?php endif; ?>"><div class="clear"></div></li>

            <?php $this->assign('previous_item', ""); ?>
            <?php $_from = $this->_tpl_vars['views']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['row'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['row']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['view']):
        $this->_foreach['row']['iteration']++;
?>

              <?php $this->assign('index', ($this->_foreach['row']['iteration']-1)); ?>
              <?php $this->assign('count', $this->_foreach['row']['iteration']); ?>
              <?php $this->assign('view_id', $this->_tpl_vars['view']['view_id']); ?>

              <?php if ($this->_tpl_vars['view']['is_new_sort_group'] == 'yes'): ?>
                <?php if ($this->_tpl_vars['previous_item'] != ""): ?>
                  </div>
                  <div class="clear"></div>
                </li>
                <?php endif; ?>
                <li class="sortable_row">
                <?php $this->assign('next_item_is_new_sort_group', $this->_tpl_vars['views'][$this->_foreach['row']['iteration']]['is_new_sort_group']); ?>
                <div class="row_content<?php if ($this->_tpl_vars['next_item_is_new_sort_group'] == 'no'): ?> grouped_row<?php endif; ?>">
              <?php endif; ?>

              <?php $this->assign('previous_item', $this->_tpl_vars['view']); ?>

                <div class="row_group<?php if (($this->_foreach['row']['iteration'] == $this->_foreach['row']['total'])): ?> rowN<?php endif; ?>">
                  <input type="hidden" class="sr_order" value="<?php echo $this->_tpl_vars['view']['view_id']; ?>
" />
                  <ul>
                    <li class="col0"></li>
                    <li class="col1 sort_col"><?php echo $this->_tpl_vars['count']; ?>
</li>
                    <li class="col2"><?php echo $this->_tpl_vars['view']['view_id']; ?>
</li>
                    <li class="col3"><?php echo $this->_tpl_vars['view']['view_name']; ?>
</li>
                    <li class="col4">
                      <?php if ($this->_tpl_vars['view']['access_type'] == 'admin'): ?>
                        <span class="pad_left_small medium_grey"><?php echo $this->_tpl_vars['LANG']['phrase_admin_only']; ?>
</span>
                      <?php elseif ($this->_tpl_vars['view']['access_type'] == 'public'): ?>
                        <?php if (count($this->_tpl_vars['view']['client_omit_list']) == 0): ?>
                          <span class="pad_left_small blue"><?php echo $this->_tpl_vars['LANG']['phrase_all_clients']; ?>
</span>
                        <?php else: ?>
                          <?php echo smarty_function_clients_dropdown(array('name_id' => "",'only_show_clients' => $this->_tpl_vars['view']['client_omit_list'],'include_blank_option' => true,'blank_option' => $this->_tpl_vars['LANG']['phrase_all_clients_except_c']), $this);?>

                        <?php endif; ?>
                      <?php elseif ($this->_tpl_vars['view']['access_type'] == 'hidden'): ?>
                        <span class="pad_left_small light_grey italic"><?php echo $this->_tpl_vars['LANG']['word_none']; ?>
 - <?php echo $this->_tpl_vars['LANG']['word_hidden']; ?>
</span>
                      <?php elseif (count($this->_tpl_vars['view']['client_info']) > 0): ?>
                        <?php if (count($this->_tpl_vars['view']['client_info']) == 1): ?>
                          <?php echo $this->_tpl_vars['view']['client_info'][0]['first_name']; ?>
 <?php echo $this->_tpl_vars['view']['client_info'][0]['last_name']; ?>

                        <?php else: ?>
                          <select>
                            <?php $_from = $this->_tpl_vars['view']['client_info']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['user_row'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['user_row']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['user']):
        $this->_foreach['user_row']['iteration']++;
?>
                              <option><?php echo $this->_tpl_vars['user']['first_name']; ?>
 <?php echo $this->_tpl_vars['user']['last_name']; ?>
</option>
                            <?php endforeach; endif; unset($_from); ?>
                          </select>
                        <?php endif; ?>
                      <?php else: ?>
                        <span class="pad_left_small light_grey"><?php echo $this->_tpl_vars['LANG']['phrase_no_clients']; ?>
</span>
                      <?php endif; ?>
                    </li>
                    <li class="col5"><a href="edit.php?page=edit_view&view_id=<?php echo $this->_tpl_vars['view_id']; ?>
&edit_view_tab=2" title="<?php echo count($this->_tpl_vars['view']['columns']); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['LANG']['word_columns_sp'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)); ?>
"><?php echo count($this->_tpl_vars['view']['columns']); ?>
</a></li>
                    <li class="col6"><a href="edit.php?page=edit_view&view_id=<?php echo $this->_tpl_vars['view_id']; ?>
&edit_view_tab=3" title="<?php echo count($this->_tpl_vars['view']['fields']); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['LANG']['word_fields_sp'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)); ?>
"><?php echo count($this->_tpl_vars['view']['fields']); ?>
</a></li>
                    <li class="col7"><a href="edit.php?page=edit_view&view_id=<?php echo $this->_tpl_vars['view_id']; ?>
&edit_view_tab=4" title="<?php echo count($this->_tpl_vars['view']['tabs']); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['LANG']['word_tabs_sp'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)); ?>
"><?php echo count($this->_tpl_vars['view']['tabs']); ?>
</a></li>
                    <li class="col8"><a href="edit.php?page=edit_view&view_id=<?php echo $this->_tpl_vars['view_id']; ?>
&edit_view_tab=5" title="<?php echo count($this->_tpl_vars['view']['filters']); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['LANG']['word_filters_sp'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)); ?>
"><?php echo count($this->_tpl_vars['view']['filters']); ?>
</a></li>
                    <li class="col9 edit"><a href="edit.php?page=edit_view&view_id=<?php echo $this->_tpl_vars['view_id']; ?>
"></a></li>
                    <li class="col10 colN del"> </li>
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
          <a href="#" class="add_field_link"><?php echo $this->_tpl_vars['LANG']['phrase_add_view_rightarrow']; ?>
</a>
        </div>
      </div>

      <div class="clear"></div>
      <?php endforeach; endif; unset($_from); ?>
    </div>

    <div class="margin_bottom_large">
      <a href="#" class="add_group_link"><?php echo $this->_tpl_vars['LANG']['phrase_add_new_group_rightarrow']; ?>
</a>
    </div>

    <p>
      <input type="submit" name="update_views" value="<?php echo $this->_tpl_vars['LANG']['word_update']; ?>
" />
      <?php echo smarty_function_template_hook(array('location' => 'admin_edit_form_views_tab_button_row'), $this);?>

    </p>

    <?php endif; ?>
  </form>

  <div id="new_view_dialog" class="ft_dialog hidden">
    <table>
    <tr>
      <td width="140"><?php echo $this->_tpl_vars['LANG']['phrase_view_name']; ?>
</td>
      <td>
        <input type="text" id="new_view_name" />
      </td>
    </tr>
    <?php if ($this->_tpl_vars['num_views'] > 0): ?>
      <tr>
        <td><?php echo $this->_tpl_vars['LANG']['phrase_base_view_on']; ?>
</td>
        <td>
          <?php echo smarty_function_views_dropdown(array('name_id' => 'create_view_from_view_id','show_empty_label' => false,'form_id' => $this->_tpl_vars['form_id'],'create_view_dropdown' => true), $this);?>

        </td>
      </tr>
    <?php endif; ?>
    </table>
  </div>

  <!-- for the add group functionality -->
  <input type="hidden" class="sortable__new_group_name" value="<?php echo $this->_tpl_vars['LANG']['phrase_view_group']; ?>
" />
  <input type="hidden" class="sortable__class" value="view_list" />
  <div id="sortable__new_group_header" class="hidden">
    <ul class="header_row">
      <li class="col0"> </li>
      <li class="col1"><?php echo $this->_tpl_vars['LANG']['word_order']; ?>
</li>
      <li class="col2"><?php echo $this->_tpl_vars['LANG']['phrase_view_id']; ?>
</li>
      <li class="col3"><?php echo $this->_tpl_vars['LANG']['phrase_view_name']; ?>
</li>
      <li class="col4"><?php echo $this->_tpl_vars['LANG']['phrase_who_can_access']; ?>
</li>
      <li class="col5"><div title="<?php echo $this->_tpl_vars['LANG']['word_columns_sp']; ?>
"></div></li>
      <li class="col6"><div title="<?php echo $this->_tpl_vars['LANG']['word_fields_sp']; ?>
"></div></li>
      <li class="col7"><div title="<?php echo $this->_tpl_vars['LANG']['word_tabs_sp']; ?>
"></div></li>
      <li class="col8"><div title="<?php echo $this->_tpl_vars['LANG']['word_filters_sp']; ?>
"></div></li>
      <li class="col9 edit"></li>
      <li class="col10 colN del"></li>
    </ul>
  </div>
  <div id="sortable__new_group_footer" class="hidden">
    <div class="sortable_group_footer">
      <a href="#" class="add_field_link"><?php echo $this->_tpl_vars['LANG']['phrase_add_view_rightarrow']; ?>
</a>
    </div>
  </div>

  <div class="hidden add_group_popup" id="add_group_popup">
    <input type="hidden" class="add_group_popup_title" value="<?php echo $this->_tpl_vars['LANG']['phrase_create_new_view_group']; ?>
" />
    <input type="hidden" class="sortable__add_group_handler" value="view_ns.create_new_group" />
    <div class="add_field_error hidden error"></div>
    <table cellspacing="1" cellpadding="3" width="100%">
    <tr>
      <td width="140"><?php echo $this->_tpl_vars['LANG']['phrase_group_name']; ?>
</td>
      <td><input type="text" class="new_group_name" /></td>
    </tr>
    </table>
  </div>