<?php /* Smarty version 2.6.18, created on 2012-10-14 20:52:01
         compiled from C:%5CUsers%5CConnor%5CDocuments%5CCodeCraft%5CTEDxUW%5Cformtools/themes/default/admin/forms/submissions.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ft_include', 'C:\\Users\\Connor\\Documents\\CodeCraft\\TEDxUW\\formtools/themes/default/admin/forms/submissions.tpl', 1, false),array('function', 'views_dropdown', 'C:\\Users\\Connor\\Documents\\CodeCraft\\TEDxUW\\formtools/themes/default/admin/forms/submissions.tpl', 17, false),array('function', 'eval', 'C:\\Users\\Connor\\Documents\\CodeCraft\\TEDxUW\\formtools/themes/default/admin/forms/submissions.tpl', 32, false),array('function', 'form_view_fields_dropdown', 'C:\\Users\\Connor\\Documents\\CodeCraft\\TEDxUW\\formtools/themes/default/admin/forms/submissions.tpl', 60, false),array('function', 'submission_listing_quicklinks', 'C:\\Users\\Connor\\Documents\\CodeCraft\\TEDxUW\\formtools/themes/default/admin/forms/submissions.tpl', 93, false),array('function', 'template_hook', 'C:\\Users\\Connor\\Documents\\CodeCraft\\TEDxUW\\formtools/themes/default/admin/forms/submissions.tpl', 113, false),array('function', 'display_custom_field', 'C:\\Users\\Connor\\Documents\\CodeCraft\\TEDxUW\\formtools/themes/default/admin/forms/submissions.tpl', 158, false),array('modifier', 'count', 'C:\\Users\\Connor\\Documents\\CodeCraft\\TEDxUW\\formtools/themes/default/admin/forms/submissions.tpl', 35, false),array('modifier', 'default', 'C:\\Users\\Connor\\Documents\\CodeCraft\\TEDxUW\\formtools/themes/default/admin/forms/submissions.tpl', 67, false),array('modifier', 'escape', 'C:\\Users\\Connor\\Documents\\CodeCraft\\TEDxUW\\formtools/themes/default/admin/forms/submissions.tpl', 74, false),array('modifier', 'cat', 'C:\\Users\\Connor\\Documents\\CodeCraft\\TEDxUW\\formtools/themes/default/admin/forms/submissions.tpl', 122, false),array('modifier', 'in_array', 'C:\\Users\\Connor\\Documents\\CodeCraft\\TEDxUW\\formtools/themes/default/admin/forms/submissions.tpl', 145, false),)), $this); ?>
<?php echo smarty_function_ft_include(array('file' => 'header.tpl'), $this);?>


  <div></div>

  <table cellpadding="0" cellspacing="0" width="100%">
  <tr>
    <td width="45"><a href="./"><img src="<?php echo $this->_tpl_vars['images_url']; ?>
/icon_forms.gif" border="0" width="34" height="34" /></a></td>
    <td class="title">
      <a href="./"><?php echo $this->_tpl_vars['LANG']['word_forms']; ?>
</a> <span class="joiner">&raquo;</span>
      <?php echo $this->_tpl_vars['form_info']['form_name']; ?>

    </td>
    <td align="right" valign="top">
      <div style="float:right; padding-left: 4px;">
        <a href="edit.php?form_id=<?php echo $this->_tpl_vars['form_id']; ?>
"><img src="<?php echo $this->_tpl_vars['images_url']; ?>
/admin_view.png" border="0" alt="<?php echo $this->_tpl_vars['LANG']['phrase_edit_form']; ?>
"
          title="<?php echo $this->_tpl_vars['LANG']['phrase_edit_form']; ?>
" width="48" height="23" /></a>
      </div>
      <?php echo smarty_function_views_dropdown(array('grouped_views' => $this->_tpl_vars['grouped_views'],'form_id' => $this->_tpl_vars['form_id'],'selected' => $this->_tpl_vars['view_id'],'onchange' => "window.location='".($this->_tpl_vars['same_page'])."?form_id=".($this->_tpl_vars['form_id'])."&page=1&view_id=' + this.value",'open_html' => '<div class="views_dropdown">','close_html' => '</div>','hide_single_view' => true), $this);?>

    </td>
  </tr>
  </table>

    <?php if ($this->_tpl_vars['total_form_submissions'] == 0): ?>
    <p>
      <?php echo $this->_tpl_vars['LANG']['text_no_submissions_found']; ?>

    </p>

    <?php if ($this->_tpl_vars['view_info']['may_add_submissions'] == 'yes'): ?>
      <input type="button" id="add_submission" value="<?php echo smarty_function_eval(array('var' => $this->_tpl_vars['form_info']['add_submission_button_label']), $this);?>
" onclick="window.location='<?php echo $this->_tpl_vars['same_page']; ?>
?add_submission'" />
    <?php endif; ?>

  <?php elseif (count($this->_tpl_vars['view_info']['columns']) == 0): ?>

    <div class="notify margin_top_large">
      <div style="padding: 8px">
        <?php echo $this->_tpl_vars['LANG']['notify_view_missing_columns']; ?>
 <?php echo $this->_tpl_vars['notify_view_missing_columns_admin_fix']; ?>

      </div>
    </div>

  <?php else: ?>

  <?php echo smarty_function_ft_include(array('file' => "messages.tpl"), $this);?>


  <?php if ($this->_tpl_vars['has_searchable_field']): ?>
    <div id="search_form">

      <form action="<?php echo $this->_tpl_vars['same_page']; ?>
" method="post" name="search_form" onsubmit="return rsv.validate(this, rules)">
        <input type="hidden" name="search" value="1" />
        <input type="hidden" name="select_all" value="<?php if ($this->_tpl_vars['curr_view_select_all'] == 'yes'): ?>1<?php endif; ?>"  />
        <table cellspacing="0" cellpadding="0" id="search_form_table">
        <tr>
          <td class="blue" width="70"><?php echo $this->_tpl_vars['LANG']['word_search']; ?>
</td>
          <td>
            <table cellspacing="2" cellpadding="0">
            <tr>
              <td>
                <?php echo smarty_function_form_view_fields_dropdown(array('name_id' => 'search_field','form_id' => $this->_tpl_vars['form_id'],'view_id' => $this->_tpl_vars['view_id'],'blank_option_value' => 'all','blank_option_text' => $this->_tpl_vars['LANG']['phrase_all_fields'],'default' => $this->_tpl_vars['curr_search_fields']['search_field'],'field_types' => $this->_tpl_vars['field_types']), $this);?>

              </td>
              <td>
                <div id="search_dropdown_section" style="display: none">
                  <input type="text" name="search_date" id="search_date"
                    value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['curr_search_fields']['search_date'])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['default_date_field_search_value']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['default_date_field_search_value'])); ?>
" />
                </div>
              </td>
            </tr>
            </table>
          </td>
          <td>
            <input type="text" placeholder="<?php echo ((is_array($_tmp=$this->_tpl_vars['LANG']['phrase_search_keyword'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" name="search_keyword" id="search_keyword"
              class="search_keyword" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['curr_search_fields']['search_keyword'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
          </td>
          <td>
            <input type="submit" name="search" value="<?php echo $this->_tpl_vars['LANG']['word_search']; ?>
" />
            <input type="button" name="" onclick="window.location='submissions.php?page=1&reset=1'"
              <?php if ($this->_tpl_vars['search_num_results'] < $this->_tpl_vars['view_num_results']): ?>
                class="bold" value="<?php echo $this->_tpl_vars['LANG']['phrase_show_all']; ?>
 (<?php echo $this->_tpl_vars['view_num_results']; ?>
)"
              <?php else: ?>
                value="<?php echo $this->_tpl_vars['LANG']['phrase_show_all']; ?>
" disabled
              <?php endif; ?> />
          </td>
        </tr>
        </table>
      </form>
    </div>

  <?php endif; ?>

  <?php echo smarty_function_submission_listing_quicklinks(array('context' => 'admin'), $this);?>


  <?php echo $this->_tpl_vars['pagination']; ?>


  <?php if ($this->_tpl_vars['search_num_results'] == 0): ?>

    <div class="notify margin_bottom_large">
      <div style="padding:8px">
        <?php echo $this->_tpl_vars['LANG']['text_no_search_results']; ?>

      </div>
    </div>

    <?php if ($this->_tpl_vars['view_info']['may_add_submissions'] == 'yes'): ?>
      <input type="button" id="add_submission" value="<?php echo smarty_function_eval(array('var' => $this->_tpl_vars['form_info']['add_submission_button_label']), $this);?>
" onclick="window.location='<?php echo $this->_tpl_vars['same_page']; ?>
?add_submission'" />
    <?php endif; ?>

  <?php else: ?>

    <form name="current_form" action="<?php echo $this->_tpl_vars['same_page']; ?>
" method="post">

    <?php echo smarty_function_template_hook(array('location' => 'admin_submission_listings_top'), $this);?>


    <table class="list_table submissions_table" id="submissions_table" cellpadding="1" cellspacing="1" border="0" width="650">
    <tr>
      <th align="center" width="25"> </th>
      <?php $_from = $this->_tpl_vars['display_fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
        <?php if ($this->_tpl_vars['i']['is_sortable'] == 'yes'): ?>
          <?php $this->assign('up_down', ""); ?>
                    <?php if ($this->_tpl_vars['order'] == ((is_array($_tmp=$this->_tpl_vars['i']['col_name'])) ? $this->_run_mod_handler('cat', true, $_tmp, '-DESC') : smarty_modifier_cat($_tmp, '-DESC'))): ?>
            <?php $this->assign('order_col', "&order=".($this->_tpl_vars['i']['col_name'])."-ASC"); ?>
            <?php $this->assign('up_down', "<img src=\"".($this->_tpl_vars['theme_url'])."/images/sort_down.gif\" />"); ?>
          <?php elseif ($this->_tpl_vars['order'] == ((is_array($_tmp=$this->_tpl_vars['i']['col_name'])) ? $this->_run_mod_handler('cat', true, $_tmp, '-ASC') : smarty_modifier_cat($_tmp, '-ASC'))): ?>
            <?php $this->assign('order_col', "&order=".($this->_tpl_vars['i']['col_name'])."-DESC"); ?>
            <?php $this->assign('up_down', "<img src=\"".($this->_tpl_vars['theme_url'])."/images/sort_up.gif\" />"); ?>
          <?php else: ?>
            <?php $this->assign('order_col', "&order=".($this->_tpl_vars['i']['col_name'])."-ASC"); ?>
          <?php endif; ?>
          <th<?php if ($this->_tpl_vars['i']['custom_width']): ?> width="<?php echo $this->_tpl_vars['i']['custom_width']; ?>
"<?php endif; ?> class="sortable_col <?php if ($this->_tpl_vars['up_down']): ?>over<?php endif; ?>">
            <a href="<?php echo $this->_tpl_vars['same_page']; ?>
?<?php echo $this->_tpl_vars['pass_along_str']; ?>
<?php echo $this->_tpl_vars['order_col']; ?>
"><?php echo $this->_tpl_vars['i']['field_title']; ?>
 <?php echo $this->_tpl_vars['up_down']; ?>
</a>
          </th>
        <?php else: ?>
          <th<?php if ($this->_tpl_vars['i']['custom_width']): ?> width="<?php echo $this->_tpl_vars['i']['custom_width']; ?>
"<?php endif; ?>><?php echo $this->_tpl_vars['i']['field_title']; ?>
</th>
        <?php endif; ?>

      <?php endforeach; endif; unset($_from); ?>
      <th class="edit"> </th>
    </tr>

    <?php $_from = $this->_tpl_vars['search_rows']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['search_row']):
?>
      <?php $this->assign('submission_id', $this->_tpl_vars['search_row']['submission_id']); ?>
      <?php $this->assign('precheck', ""); ?>
      <?php if (((is_array($_tmp=$this->_tpl_vars['submission_id'])) ? $this->_run_mod_handler('in_array', true, $_tmp, $this->_tpl_vars['preselected_subids']) : in_array($_tmp, $this->_tpl_vars['preselected_subids']))): ?>
        <?php $this->assign('precheck', 'checked'); ?>
      <?php endif; ?>
      <tr class="unselected_row_color">
        <td align="center"><input type="checkbox" class="select_row_cb" name="submissions[]" value="<?php echo $this->_tpl_vars['submission_id']; ?>
" <?php echo $this->_tpl_vars['precheck']; ?>
 /></td>
        <?php $_from = $this->_tpl_vars['display_fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k2'] => $this->_tpl_vars['curr_field']):
?>
          <?php $this->assign('col_name', $this->_tpl_vars['curr_field']['col_name']); ?>
          <td>
            <?php if ($this->_tpl_vars['curr_field']['truncate'] == 'truncate' && $this->_tpl_vars['curr_field']['custom_width']): ?>
              <div class="truncate" style="width:<?php echo $this->_tpl_vars['curr_field']['custom_width']; ?>
px">
            <?php elseif ($this->_tpl_vars['curr_field']['truncate'] == 'truncate'): ?>
              <div class="truncate_no_fixed_width">
            <?php endif; ?>
              <?php echo smarty_function_display_custom_field(array('form_id' => $this->_tpl_vars['form_id'],'view_id' => $this->_tpl_vars['view_id'],'submission_id' => $this->_tpl_vars['submission_id'],'value' => $this->_tpl_vars['search_row'][$this->_tpl_vars['col_name']],'field_info' => $this->_tpl_vars['curr_field'],'field_types' => $this->_tpl_vars['field_types'],'settings' => $this->_tpl_vars['settings'],'context' => 'submission_listing'), $this);?>

            <?php if ($this->_tpl_vars['curr_field']['truncate'] == 'truncate'): ?>
              </div>
            <?php endif; ?>
          </td>
        <?php endforeach; endif; unset($_from); ?>
        <td class="edit"><a href="edit_submission.php?form_id=<?php echo $this->_tpl_vars['form_id']; ?>
&view_id=<?php echo $this->_tpl_vars['view_id']; ?>
&submission_id=<?php echo $this->_tpl_vars['submission_id']; ?>
" title="<?php echo $this->_tpl_vars['LANG']['word_edit']; ?>
"></a></td>
      </tr>
    <?php endforeach; endif; unset($_from); ?>
    </table>

    <div class="margin_top margin_bottom">
      <div style="float:right; padding:1px" id="display_num_selected_rows" class="<?php if (count($this->_tpl_vars['preselected_subids']) == 0): ?>light_grey<?php else: ?>green<?php endif; ?>"></div>
      <?php echo smarty_function_template_hook(array('location' => 'admin_submission_listings_buttons1'), $this);?>

      <?php if ($this->_tpl_vars['view_info']['may_delete_submissions'] == 'yes'): ?>
        <input type="button" value="<?php echo $this->_tpl_vars['LANG']['word_delete']; ?>
" class="red" onclick="ms.delete_submissions()" />
      <?php endif; ?>
      <?php echo smarty_function_template_hook(array('location' => 'admin_submission_listings_buttons2'), $this);?>

      <input type="button" id="select_button" value="<?php echo $this->_tpl_vars['LANG']['phrase_select_all_on_page']; ?>
" onclick="ms.select_all_on_page();" />
      <input type="button" id="unselect_button" value="<?php echo $this->_tpl_vars['LANG']['phrase_unselect_all']; ?>
" onclick="ms.unselect_all()" />
      <?php echo smarty_function_template_hook(array('location' => 'admin_submission_listings_buttons3'), $this);?>

      <?php if ($this->_tpl_vars['view_info']['may_add_submissions'] == 'yes'): ?>
        <input type="button" id="add_submission" value="<?php echo smarty_function_eval(array('var' => $this->_tpl_vars['form_info']['add_submission_button_label']), $this);?>
" onclick="window.location='<?php echo $this->_tpl_vars['same_page']; ?>
?add_submission'" />
      <?php endif; ?>
      <?php echo smarty_function_template_hook(array('location' => 'admin_submission_listings_buttons4'), $this);?>

    </div>

    <?php echo smarty_function_template_hook(array('location' => 'admin_submission_listings_bottom'), $this);?>


    </form>

    <?php endif; ?>

  <?php endif; ?>

<?php echo smarty_function_ft_include(array('file' => 'footer.tpl'), $this);?>
