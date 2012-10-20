<?php /* Smarty version 2.6.18, created on 2012-10-21 00:09:53
         compiled from C:%5CUsers%5CConnor%5CDocuments%5CCodeCraft%5CTEDxUW%5Cformtools/themes/default/admin/forms/tab_edit_view__main.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'C:\\Users\\Connor\\Documents\\CodeCraft\\TEDxUW\\formtools/themes/default/admin/forms/tab_edit_view__main.tpl', 5, false),array('modifier', 'count', 'C:\\Users\\Connor\\Documents\\CodeCraft\\TEDxUW\\formtools/themes/default/admin/forms/tab_edit_view__main.tpl', 136, false),array('function', 'form_fields_dropdown', 'C:\\Users\\Connor\\Documents\\CodeCraft\\TEDxUW\\formtools/themes/default/admin/forms/tab_edit_view__main.tpl', 18, false),)), $this); ?>
  <table cellspacing="0" cellpadding="0" width="100%" class="margin_bottom_large">
  <tr>
    <td width="180" class="pad_left"><?php echo $this->_tpl_vars['LANG']['phrase_view_name']; ?>
</td>
    <td>
      <input type="text" maxlength="100" style="width: 300px;" name="view_name" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['view_info']['view_name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
    </td>
  </tr>
  <tr>
    <td class="pad_left"><?php echo $this->_tpl_vars['LANG']['phrase_submissions_per_page']; ?>
</td>
    <td><input type="text" size="3" name="num_submissions_per_page" value="<?php echo $this->_tpl_vars['view_info']['num_submissions_per_page']; ?>
" /></td>
  </tr>
  <tr>
    <td class="pad_left"><?php echo $this->_tpl_vars['LANG']['phrase_default_sort_order']; ?>
</td>
    <td>
      <table cellpadding="0" cellspacing="0">
      <tr>
        <td>
          <?php echo smarty_function_form_fields_dropdown(array('name_id' => 'default_sort_field','form_id' => $this->_tpl_vars['form_id'],'view_id' => $this->_tpl_vars['view_id'],'default' => $this->_tpl_vars['view_info']['default_sort_field']), $this);?>

        </td>
        <td>
          <select name="default_sort_field_order">
            <option value="asc" <?php if ($this->_tpl_vars['view_info']['default_sort_field_order'] == 'asc'): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['LANG']['word_asc']; ?>
</option>
            <option value="desc" <?php if ($this->_tpl_vars['view_info']['default_sort_field_order'] == 'desc'): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['LANG']['word_desc']; ?>
</option>
          </select>
        </td>
      </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td class="pad_left" width="180" valign="top"><?php echo $this->_tpl_vars['LANG']['word_access']; ?>
</td>
    <td>
      <table cellspacing="0" cellpadding="0">
      <tr>
        <td>
          <input type="radio" name="access_type" id="at1" value="admin" <?php if ($this->_tpl_vars['view_info']['access_type'] == 'admin'): ?>checked<?php endif; ?> />
          <label for="at1"><?php echo $this->_tpl_vars['LANG']['phrase_admin_only']; ?>
</label>
        </td>
      </tr>
      <tr>
        <td>
          <div style="float:right;margin-left: 20px">
            <input type="button" id="client_omit_list_button"
              value="Manage Client Omit List<?php if ($this->_tpl_vars['view_info']['access_type'] == 'public'): ?> (<?php echo $this->_tpl_vars['num_clients_on_omit_list']; ?>
)<?php endif; ?>"
              onclick="window.location='edit.php?page=public_view_omit_list&view_id=<?php echo $this->_tpl_vars['view_id']; ?>
'"
              <?php if ($this->_tpl_vars['view_info']['access_type'] != 'public'): ?>disabled<?php endif; ?> />
          </div>
          <input type="radio" name="access_type" id="at2" value="public" <?php if ($this->_tpl_vars['view_info']['access_type'] == 'public'): ?>checked<?php endif; ?> />
          <label for="at2"><?php echo $this->_tpl_vars['LANG']['word_public']; ?>
 <span class="light_grey"><?php echo $this->_tpl_vars['LANG']['phrase_all_clients_have_access']; ?>
</span></label>
        </td>
      </tr>
      <tr>
        <td>
          <input type="radio" name="access_type" id="at3" value="private" <?php if ($this->_tpl_vars['view_info']['access_type'] == 'private'): ?>checked<?php endif; ?> />
          <label for="at3"><?php echo $this->_tpl_vars['LANG']['word_private']; ?>
 <span class="light_grey"><?php echo $this->_tpl_vars['LANG']['phrase_only_specific_clients_have_access']; ?>
</span></label>
        </td>
      </tr>
      <tr>
        <td>
          <input type="radio" name="access_type" id="at4" value="hidden" <?php if ($this->_tpl_vars['view_info']['access_type'] == 'hidden'): ?>checked<?php endif; ?> />
          <label for="at4"><?php echo $this->_tpl_vars['LANG']['word_hidden']; ?>
</label>
        </td>
      </tr>
      </table>

      <?php if ($this->_tpl_vars['form_info']['access_type'] == 'admin' || $this->_tpl_vars['form_info']['access_type'] == 'private'): ?>
        <div class="hint">
          <?php if ($this->_tpl_vars['form_info']['access_type'] == 'admin'): ?>
            <?php echo $this->_tpl_vars['LANG']['text_form_view_permission_info_admin']; ?>

          <?php elseif ($this->_tpl_vars['form_info']['access_type'] == 'private'): ?>
            <?php echo $this->_tpl_vars['LANG']['text_form_view_permission_info_private']; ?>

          <?php endif; ?>
          <a href="?page=main"><?php echo $this->_tpl_vars['LANG']['phrase_edit_form_access_type_b']; ?>
</a>
        </div>
      <?php endif; ?>

      <div id="custom_clients" <?php if ($this->_tpl_vars['view_info']['access_type'] != 'private'): ?>style="display:none"<?php endif; ?> class="margin_top">
        <table cellpadding="1" cellspacing="0" class="list_table">
        <tr>
          <td class="medium_grey pad_left_small"><?php echo $this->_tpl_vars['LANG']['phrase_available_clients']; ?>
</td>
          <td></td>
          <td class="medium_grey pad_left_small"><?php echo $this->_tpl_vars['LANG']['phrase_selected_clients']; ?>
</td>
        </tr>
        <tr>
          <td>
            <select name="available_user_ids[]" multiple size="4" style="width: 180px">
              <?php echo $this->_tpl_vars['available_users']; ?>

            </select>
          </td>
          <td align="center" valign="center" width="100">
            <input type="button" value="<?php echo $this->_tpl_vars['LANG']['word_add_uc_rightarrow']; ?>
"
              onclick="ft.move_options(this.form['available_user_ids[]'], this.form['selected_user_ids[]']);" /><br />
            <input type="button" value="<?php echo $this->_tpl_vars['LANG']['word_remove_uc_leftarrow']; ?>
"
              onclick="ft.move_options(this.form['selected_user_ids[]'], this.form['available_user_ids[]']);" />
          </td>
          <td>
            <select id="selected_user_ids" name="selected_user_ids[]" multiple size="4" style="width: 180px">
              <?php echo $this->_tpl_vars['selected_users']; ?>

            </select>
          </td>
        </tr>
        </table>
      </div>

      <div class="margin_bottom_large"> </div>
    </td>
  </tr>
  <tr>
    <td class="pad_left" valign="top"><?php echo $this->_tpl_vars['LANG']['phrase_may_delete_submissions']; ?>
</td>
    <td valign="top">
      <input type="radio" name="may_delete_submissions" value="yes" id="cmds1" <?php if ($this->_tpl_vars['view_info']['may_delete_submissions'] == 'yes'): ?>checked<?php endif; ?> />
      <label for="cmds1"><?php echo $this->_tpl_vars['LANG']['word_yes']; ?>
</label>
      <input type="radio" name="may_delete_submissions" value="no" id="cmds2" <?php if ($this->_tpl_vars['view_info']['may_delete_submissions'] == 'no'): ?>checked<?php endif; ?> />
      <label for="cmds2"><?php echo $this->_tpl_vars['LANG']['word_no']; ?>
</label>
      <div class="hint margin_bottom">
        <?php echo $this->_tpl_vars['LANG']['text_delete_view_submissions']; ?>

      </div>
    </td>
  </tr>
  <tr>
    <td class="pad_left"><?php echo $this->_tpl_vars['LANG']['phrase_may_add_submissions']; ?>
</td>
    <td valign="top">
      <input type="radio" name="may_add_submissions" value="yes" id="cmas1" <?php if ($this->_tpl_vars['view_info']['may_add_submissions'] == 'yes'): ?>checked<?php endif; ?> />
      <label for="cmas1"><?php echo $this->_tpl_vars['LANG']['word_yes']; ?>
</label>
      <input type="radio" name="may_add_submissions" value="no" id="cmas2" <?php if ($this->_tpl_vars['view_info']['may_add_submissions'] == 'no'): ?>checked<?php endif; ?> />
      <label for="cmas2"><?php echo $this->_tpl_vars['LANG']['word_no']; ?>
</label>
    </td>
  </tr>
  <tbody id="add_submission_default_values" <?php if ($this->_tpl_vars['view_info']['may_add_submissions'] == 'no'): ?>style="display: none"<?php endif; ?>>
    <tr>
      <td width="180" valign="top" class="pad_left"><?php echo $this->_tpl_vars['LANG']['phrase_default_values_new_submissions']; ?>
</td>
      <td>
        <div class="hint margin_bottom">
          <?php echo $this->_tpl_vars['LANG']['text_default_values_in_view']; ?>

        </div>
        <div id="no_new_submission_default_values" <?php if (count($this->_tpl_vars['new_view_submission_defaults']) > 0): ?>class="hidden"<?php endif; ?>>
          <a href=""><?php echo $this->_tpl_vars['LANG']['phrase_add_default_settings_rightarrow']; ?>
</a>
        </div>

        <div id="new_submission_default_values" <?php if (count($this->_tpl_vars['new_view_submission_defaults']) == 0): ?>class="hidden"<?php endif; ?>>
          <table cellspacing="1" cellpadding="0" class="list_table" width="100%" id="new_view_default_submission_vals">
          <tbody><tr>
            <th><?php echo $this->_tpl_vars['LANG']['word_field']; ?>
</th>
            <th width="200"><?php echo $this->_tpl_vars['LANG']['phrase_default_value']; ?>
</th>
            <th class="del" width="18"></th>
          </tr>
                    <?php $_from = $this->_tpl_vars['new_view_submission_defaults']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['row'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['row']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['filter']):
        $this->_foreach['row']['iteration']++;
?>
            <?php $this->assign('count', $this->_foreach['row']['iteration']); ?>
            <?php $this->assign('field_id', $this->_tpl_vars['filter']['field_id']); ?>
            <?php $this->assign('curr_val', $this->_tpl_vars['filter']['default_value']); ?>
            <tr id="standard_row_<?php echo $this->_tpl_vars['count']; ?>
">
              <td>
                <select name="new_submissions[]" class="new_submission_default_val_fields"
                  onchange="view_ns.change_standard_filter_field(<?php echo $this->_tpl_vars['count']; ?>
)">
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
                    <option value="<?php echo $this->_tpl_vars['curr_field_id']; ?>
" <?php echo $this->_tpl_vars['selected']; ?>
><?php echo $this->_tpl_vars['field']['field_title']; ?>
</option>
                  <?php endforeach; endif; unset($_from); ?>
                </select>
              </td>
              <td>
                <input type="text" name="new_submissions_vals[]" class="new_submission_default_vals" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['curr_val'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
              </td>
              <td class="del"><a href="#" onclick="return view_ns.delete_new_view_submission_vals(this)"></a></td>
            </tr>
            <?php endforeach; endif; unset($_from); ?>
            </tbody>
          </table>

          <div>
            <a href="#" onclick="return view_ns.add_default_values_for_submission()"><?php echo $this->_tpl_vars['LANG']['phrase_add_row']; ?>
</a>
          </div>
        </div>

      </td>
    </tr>
  </tbody>
  </table>