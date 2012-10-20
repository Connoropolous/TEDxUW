<?php /* Smarty version 2.6.18, created on 2012-10-20 17:29:55
         compiled from /Users/lucaszw/Sites/TEDxUW/formtools/themes/default/admin/forms/tab_main.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'upper', '/Users/lucaszw/Sites/TEDxUW/formtools/themes/default/admin/forms/tab_main.tpl', 1, false),array('modifier', 'escape', '/Users/lucaszw/Sites/TEDxUW/formtools/themes/default/admin/forms/tab_main.tpl', 19, false),array('modifier', 'count', '/Users/lucaszw/Sites/TEDxUW/formtools/themes/default/admin/forms/tab_main.tpl', 102, false),array('function', 'ft_include', '/Users/lucaszw/Sites/TEDxUW/formtools/themes/default/admin/forms/tab_main.tpl', 3, false),array('function', 'template_hook', '/Users/lucaszw/Sites/TEDxUW/formtools/themes/default/admin/forms/tab_main.tpl', 27, false),array('function', 'clients_dropdown', '/Users/lucaszw/Sites/TEDxUW/formtools/themes/default/admin/forms/tab_main.tpl', 188, false),)), $this); ?>
  <div class="subtitle underline margin_top_large"><?php echo ((is_array($_tmp=$this->_tpl_vars['LANG']['phrase_main_settings'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
</div>

  <?php echo smarty_function_ft_include(array('file' => "messages.tpl"), $this);?>


  <form method="post" name="edit_form" id="edit_form" action="<?php echo $this->_tpl_vars['same_page']; ?>
" onsubmit="return rsv.validate(this, rules)">
    <input type="hidden" name="form_id" id="form_id" value="<?php echo $this->_tpl_vars['form_id']; ?>
" />
    <table class="list_table margin_bottom_large" width="100%" cellpadding="0" cellspacing="1">
    <tr>
      <td class="pad_left_small" width="200" valign="top"><?php echo $this->_tpl_vars['LANG']['word_status']; ?>
</td>
      <td>
        <input type="radio" name="active" id="active1" value="yes" <?php if ($this->_tpl_vars['form_info']['is_active'] == 'yes'): ?>checked<?php endif; ?> />
          <label for="active1" class="light_green"><?php echo $this->_tpl_vars['LANG']['word_online']; ?>
 <?php echo $this->_tpl_vars['LANG']['phrase_accepting_submissions']; ?>
</label><br />
        <input type="radio" name="active" id="active2" value="no" <?php if ($this->_tpl_vars['form_info']['is_active'] == 'no'): ?>checked<?php endif; ?> />
          <label for="active2" class="orange"><?php echo $this->_tpl_vars['LANG']['word_offline']; ?>
</label>
      </td>
    </tr>
    <tr>
      <td class="pad_left_small"><?php echo $this->_tpl_vars['LANG']['phrase_form_name']; ?>
</td>
      <td><input type="text" name="form_name" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['form_info']['form_name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" style="width: 99%" /></td>
    </tr>
    <tr>
      <td valign="top" class="pad_left_small"><?php echo $this->_tpl_vars['LANG']['phrase_form_type']; ?>
</td>
      <td>
        <select name="form_type" id="form_type">
          <option value="external" <?php if ($this->_tpl_vars['form_info']['form_type'] == 'external'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['LANG']['phrase_external_your_own_form']; ?>
</option>
          <option value="internal" <?php if ($this->_tpl_vars['form_info']['form_type'] == 'internal'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['LANG']['word_internal']; ?>
</option>
          <?php echo smarty_function_template_hook(array('location' => 'admin_edit_form_main_tab_form_type_dropdown'), $this);?>

        </select>
      </td>
    </tr>
    </table>

    <div id="form_settings__external" class="form_type_specific_options" <?php if ($this->_tpl_vars['form_info']['form_type'] != 'external'): ?>style="display:none"<?php endif; ?>>
      <div class="subtitle underline margin_bottom_large margin_top_large"><?php echo ((is_array($_tmp=$this->_tpl_vars['LANG']['phrase_external_form_info'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
</div>

      <table class="list_table margin_bottom_large" width="100%" cellpadding="0" cellspacing="1">
      <tr>
        <td class="pad_left_small" width="200"><label for="submission_type"><?php echo $this->_tpl_vars['LANG']['phrase_submission_type']; ?>
</label></td>
        <td>
          <select name="submission_type" id="submission_type">
            <option value="direct" <?php if ($this->_tpl_vars['form_info']['submission_type'] == 'direct'): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['LANG']['word_direct']; ?>
</option>
            <option value="code" <?php if ($this->_tpl_vars['form_info']['submission_type'] == 'code'): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['LANG']['word_code']; ?>
 (API)</option>
          </select>
        </td>
      </tr>
      <tbody id="multi_page_form_row" <?php if ($this->_tpl_vars['form_info']['submission_type'] == 'direct'): ?>style="display:none"<?php endif; ?>>
        <tr>
          <td class="pad_left_small"><label for="is_multi_page_form"><?php echo $this->_tpl_vars['LANG']['phrase_is_multi_page_form_q']; ?>
</label></td>
          <td>
            <input type="radio" class="is_multi_page_form" name="is_multi_page_form" id="impf1" value="yes"
              <?php if ($this->_tpl_vars['form_info']['is_multi_page_form'] == 'yes'): ?>checked<?php endif; ?> />
              <label for="impf1"><?php echo $this->_tpl_vars['LANG']['word_yes']; ?>
</label>
            <input type="radio" class="is_multi_page_form" name="is_multi_page_form" id="impf2" value="no"
              <?php if ($this->_tpl_vars['form_info']['is_multi_page_form'] == 'no'): ?>checked<?php endif; ?> />
              <label for="impf2"><?php echo $this->_tpl_vars['LANG']['word_no']; ?>
</label>
          </td>
        </tr>
      </tbody>
      <tr>
        <td valign="top" class="pad_left_small">
          <span id="form_label_single" <?php if ($this->_tpl_vars['form_info']['is_multi_page_form'] == 'yes'): ?>style="display:none"<?php endif; ?>><?php echo $this->_tpl_vars['LANG']['phrase_form_url']; ?>
</span>
          <span id="form_label_multiple" <?php if ($this->_tpl_vars['form_info']['is_multi_page_form'] == 'no'): ?>style="display:none"<?php endif; ?>><?php echo $this->_tpl_vars['LANG']['phrase_form_urls']; ?>
</span>
        </td>
        <td>
          <div id="form_url_single" <?php if ($this->_tpl_vars['form_info']['is_multi_page_form'] == 'yes'): ?>style="display:none"<?php endif; ?>>
            <table width="100%" cellpadding="0" cellspacing="0">
            <tr>
              <td><input type="text" name="form_url" id="form_url" value="<?php echo $this->_tpl_vars['form_info']['form_url']; ?>
" style="width: 98%" /></td>
              <td width="60"><input type="button" class="check_url" id="check_url__form_url" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['LANG']['phrase_check_url'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" /></td>
            </tr>
            </table>
          </div>
          <div id="form_url_multiple" <?php if ($this->_tpl_vars['form_info']['is_multi_page_form'] == 'no' || $this->_tpl_vars['form_info']['submission_info'] == 'direct'): ?>style="display:none"<?php endif; ?>>
            <div class="sortable multi_page_form_list" id="<?php echo $this->_tpl_vars['sortable_id']; ?>
">
              <ul class="header_row">
                <li class="col1"><?php echo $this->_tpl_vars['LANG']['word_page']; ?>
</li>
                <li class="col2"><?php echo $this->_tpl_vars['LANG']['phrase_form_url']; ?>
</li>
                <li class="col3"></li>
                <li class="col4 colN del"></li>
              </ul>
              <div class="clear"></div>
              <ul class="rows">
                <?php $this->assign('previous_item', ""); ?>
                <?php $_from = $this->_tpl_vars['form_info']['multi_page_form_urls']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['row'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['row']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['i']):
        $this->_foreach['row']['iteration']++;
?>
                  <?php $this->assign('count', $this->_foreach['row']['iteration']); ?>
                  <li class="sortable_row<?php if (($this->_foreach['row']['iteration'] == $this->_foreach['row']['total'])): ?> rowN<?php endif; ?>">
                    <div class="row_content">
                      <div class="row_group<?php if (($this->_foreach['row']['iteration'] == $this->_foreach['row']['total'])): ?> rowN<?php endif; ?>">
                        <input type="hidden" class="sr_order" value="<?php echo $this->_tpl_vars['count']; ?>
" />
                        <ul>
                          <li class="col1 sort_col"><?php echo $this->_tpl_vars['count']; ?>
</li>
                          <li class="col2"><input type="text" name="multi_page_urls[]" id="mp_url_<?php echo $this->_tpl_vars['count']; ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['i']['form_url'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" /></li>
                          <li class="col3"><input type="button" class="check_url" id="check_url__mp_url_<?php echo $this->_tpl_vars['count']; ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['LANG']['phrase_check_url'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" /></li>
                          <li class="col4 colN del"></li>
                        </ul>
                        <div class="clear"></div>
                      </div>
                    </div>
                    <div class="clear"></div>
                  </li>
                <?php endforeach; endif; unset($_from); ?>
                <?php if (count($this->_tpl_vars['form_info']['multi_page_form_urls']) == 0): ?>
                  <li class="sortable_row">
                    <div class="row_content">
                      <div class="row_group rowN">
                        <input type="hidden" class="sr_order" value="1" />
                        <ul>
                          <li class="col1 sort_col">1</li>
                          <li class="col2"><input type="text" name="multi_page_urls[]" id="mp_url_0" /></li>
                          <li class="col3"><input type="button" class="check_url" id="check_url__mp_url_0" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['LANG']['phrase_check_url'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" /></li>
                          <li class="col4 colN del"></li>
                        </ul>
                        <div class="clear"></div>
                      </div>
                    </div>
                    <div class="clear"></div>
                  </li>
                <?php endif; ?>
              </ul>
            </div>
            <div class="clear"></div>
            <div>
              <a href="#" onclick="return mf_ns.add_multi_page_form_page()"><?php echo $this->_tpl_vars['LANG']['phrase_add_row']; ?>
</a>
            </div>
          </div>
        </td>
      </tr>
      <tbody id="redirect_url_row" <?php if ($this->_tpl_vars['form_info']['submission_type'] == 'code'): ?>style="display:none"<?php endif; ?>>
        <tr>
          <td valign="top" width="200" class="pad_left_small"><?php echo $this->_tpl_vars['LANG']['phrase_redirect_url']; ?>
</td>
          <td>
            <table width="100%" cellpadding="0" cellspacing="0">
            <tr>
              <td><input type="text" name="redirect_url" id="redirect_url" value="<?php echo $this->_tpl_vars['form_info']['redirect_url']; ?>
" style="width: 98%" /></td>
              <td width="60"><input type="button" class="check_url" id="check_url__redirect_url" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['LANG']['phrase_check_url'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" /></td>
            </tr>
            </table>
          </td>
        </tr>
      </tbody>
      </table>
    </div>

    <?php echo smarty_function_template_hook(array('location' => 'admin_edit_form_main_tab_after_main_settings'), $this);?>


    <div class="subtitle underline margin_bottom_large margin_top_large"><?php echo ((is_array($_tmp=$this->_tpl_vars['LANG']['phrase_permissions_other_settings'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
</div>

    <table class="list_table margin_bottom_large" width="100%" cellpadding="0" cellspacing="1">
    <tr>
      <td class="pad_left_small" valign="top" width="200"><?php echo $this->_tpl_vars['LANG']['word_access']; ?>
</td>
      <td>
        <table cellspacing="1" cellpadding="0" >
        <tr>
          <td>
            <input type="radio" name="access_type" id="at1" value="admin" <?php if ($this->_tpl_vars['form_info']['access_type'] == 'admin'): ?>checked<?php endif; ?> />
              <label for="at1"><?php echo $this->_tpl_vars['LANG']['phrase_admin_only']; ?>
</label>
          </td>
        </tr>
        <tr>
          <td>
            <div style="float:right;margin-left: 20px">
              <input type="button" id="client_omit_list_button"
                value="<?php echo $this->_tpl_vars['LANG']['phrase_manage_client_omit_list']; ?>
<?php if ($this->_tpl_vars['form_info']['access_type'] == 'public'): ?> (<?php echo $this->_tpl_vars['num_clients_on_omit_list']; ?>
)<?php endif; ?>"
                onclick="window.location='edit.php?page=public_form_omit_list&form_id=<?php echo $this->_tpl_vars['form_id']; ?>
'"
                <?php if ($this->_tpl_vars['form_info']['access_type'] != 'public'): ?>disabled<?php endif; ?> /><br />
            </div>
            <input type="radio" name="access_type" id="at2" value="public" <?php if ($this->_tpl_vars['form_info']['access_type'] == 'public'): ?>checked<?php endif; ?> />
              <label for="at2"><?php echo $this->_tpl_vars['LANG']['word_public']; ?>
 <span class="light_grey"><?php echo $this->_tpl_vars['LANG']['phrase_all_clients_have_access']; ?>
</span></label>
          </td>
        </tr>
        <tr>
          <td>
            <input type="radio" name="access_type" id="at3" value="private" <?php if ($this->_tpl_vars['form_info']['access_type'] == 'private'): ?>checked<?php endif; ?> />
              <label for="at3"><?php echo $this->_tpl_vars['LANG']['word_private']; ?>
 <span class="light_grey"><?php echo $this->_tpl_vars['LANG']['phrase_only_specific_clients_have_access']; ?>
</span></label>
          </td>
        </tr>
        </table>

        <div id="custom_clients" <?php if ($this->_tpl_vars['form_info']['access_type'] != 'private'): ?>style="display:none"<?php endif; ?> class="margin_top">
          <table cellpadding="0" cellspacing="0" class="subpanel">
          <tr>
            <td class="medium_grey"><?php echo $this->_tpl_vars['LANG']['phrase_available_clients']; ?>
</td>
            <td></td>
            <td class="medium_grey"><?php echo $this->_tpl_vars['LANG']['phrase_selected_clients']; ?>
</td>
          </tr>
          <tr>
            <td>
              <?php echo smarty_function_clients_dropdown(array('name_id' => "available_client_ids[]",'multiple' => 'true','multiple_action' => 'hide','clients' => $this->_tpl_vars['selected_client_ids'],'size' => '4','style' => "width: 202px"), $this);?>

            </td>
            <td align="center" valign="middle" width="100">
              <input type="button" value="<?php echo $this->_tpl_vars['LANG']['word_add_uc_rightarrow']; ?>
"
                onclick="ft.move_options(this.form['available_client_ids[]'], this.form['selected_client_ids[]']);" /><br />
              <input type="button" value="<?php echo $this->_tpl_vars['LANG']['word_remove_uc_leftarrow']; ?>
"
                onclick="ft.move_options(this.form['selected_client_ids[]'], this.form['available_client_ids[]']);" />
            </td>
            <td>
              <?php echo smarty_function_clients_dropdown(array('name_id' => "selected_client_ids[]",'multiple' => 'true','multiple_action' => 'show','clients' => $this->_tpl_vars['selected_client_ids'],'size' => '4','style' => "width: 202px"), $this);?>

            </td>
          </tr>
          </table>
        </div>

      </td>
    </tr>
    <tr>
      <td class="pad_left_small"><?php echo $this->_tpl_vars['LANG']['phrase_delete_uploaded_fields_with_submission']; ?>
</td>
      <td>
        <input type="radio" name="auto_delete_submission_files" id="auto_delete_submission_files1" value="yes" <?php if ($this->_tpl_vars['form_info']['auto_delete_submission_files'] == 'yes'): ?>checked<?php endif; ?> />
          <label for="auto_delete_submission_files1"><?php echo $this->_tpl_vars['LANG']['word_yes']; ?>
</label>
        <input type="radio" name="auto_delete_submission_files" id="auto_delete_submission_files2" value="no" <?php if ($this->_tpl_vars['form_info']['auto_delete_submission_files'] == 'no'): ?>checked<?php endif; ?> />
          <label for="auto_delete_submission_files2"><?php echo $this->_tpl_vars['LANG']['word_no']; ?>
</label>
      </td>
    </tr>
    <tr>
      <td class="pad_left_small"><?php echo $this->_tpl_vars['LANG']['phrase_strip_tags_in_submissions']; ?>
</td>
      <td>
        <input type="radio" name="submission_strip_tags" id="sst1" value="yes" <?php if ($this->_tpl_vars['form_info']['submission_strip_tags'] == 'yes'): ?>checked<?php endif; ?> />
          <label for="sst1"><?php echo $this->_tpl_vars['LANG']['word_yes']; ?>
</label>
        <input type="radio" name="submission_strip_tags" id="sst2" value="no" <?php if ($this->_tpl_vars['form_info']['submission_strip_tags'] == 'no'): ?>checked<?php endif; ?> />
          <label for="sst2"><?php echo $this->_tpl_vars['LANG']['word_no']; ?>
</label>
      </td>
    </tr>
    <tr>
      <td class="pad_left_small" valign="top"><?php echo $this->_tpl_vars['LANG']['phrase_edit_submission_label']; ?>
</td>
      <td><input type="text" name="edit_submission_page_label" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['form_info']['edit_submission_page_label'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"
        class="lang_placeholder_field lang_field_full" /></td>
    </tr>
    <tr>
      <td class="pad_left_small" valign="top"><?php echo $this->_tpl_vars['LANG']['phrase_add_submission_button']; ?>
</td>
      <td>
        <input type="text" name="add_submission_button_label" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['form_info']['add_submission_button_label'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"
          class="lang_placeholder_field lang_field_full" />
        <div class="medium_grey"><?php echo $this->_tpl_vars['LANG']['text_add_submission_button']; ?>
</div>
      </td>
    </tr>
    </table>

    <p>
      <input type="submit" name="update_main" value="<?php echo $this->_tpl_vars['LANG']['word_update']; ?>
" />
      <?php echo smarty_function_template_hook(array('location' => 'admin_edit_form_main_tab_button_row'), $this);?>

    </p>

   </form>