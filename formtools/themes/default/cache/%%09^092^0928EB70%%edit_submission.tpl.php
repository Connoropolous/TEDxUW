<?php /* Smarty version 2.6.18, created on 2012-10-20 17:38:55
         compiled from /Users/lucaszw/Sites/TEDxUW/formtools/themes/default/admin/forms/edit_submission.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ft_include', '/Users/lucaszw/Sites/TEDxUW/formtools/themes/default/admin/forms/edit_submission.tpl', 1, false),array('function', 'views_dropdown', '/Users/lucaszw/Sites/TEDxUW/formtools/themes/default/admin/forms/edit_submission.tpl', 13, false),array('function', 'template_hook', '/Users/lucaszw/Sites/TEDxUW/formtools/themes/default/admin/forms/edit_submission.tpl', 29, false),array('function', 'edit_custom_field', '/Users/lucaszw/Sites/TEDxUW/formtools/themes/default/admin/forms/edit_submission.tpl', 63, false),array('function', 'display_email_template_dropdown', '/Users/lucaszw/Sites/TEDxUW/formtools/themes/default/admin/forms/edit_submission.tpl', 85, false),array('function', 'eval', '/Users/lucaszw/Sites/TEDxUW/formtools/themes/default/admin/forms/edit_submission.tpl', 96, false),array('modifier', 'count', '/Users/lucaszw/Sites/TEDxUW/formtools/themes/default/admin/forms/edit_submission.tpl', 31, false),array('modifier', 'upper', '/Users/lucaszw/Sites/TEDxUW/formtools/themes/default/admin/forms/edit_submission.tpl', 49, false),)), $this); ?>
<?php echo smarty_function_ft_include(array('file' => 'header.tpl'), $this);?>


  <div class="edit_submission">
    <table cellpadding="0" cellspacing="0" width="100%">
    <tr>
      <td><span class="title"><?php echo $this->_tpl_vars['edit_submission_page_label']; ?>
</span></td>
      <td align="right">
        <div style="float:right; padding-left: 4px;">
          <a href="edit.php?form_id=<?php echo $this->_tpl_vars['form_id']; ?>
"><img src="<?php echo $this->_tpl_vars['images_url']; ?>
/admin_view.png" border="0" alt="<?php echo $this->_tpl_vars['LANG']['phrase_edit_form']; ?>
"
            title="<?php echo $this->_tpl_vars['LANG']['phrase_edit_form']; ?>
" width="48" height="23" /></a>
        </div>
        <div class="views_dropdown">
        <?php echo smarty_function_views_dropdown(array('form_id' => $this->_tpl_vars['form_id'],'submission_id' => $this->_tpl_vars['submission_id'],'selected' => $this->_tpl_vars['view_id'],'omit_hidden_views' => true,'onchange' => "window.location='".($this->_tpl_vars['same_page'])."?form_id=".($this->_tpl_vars['form_id'])."&submission_id=".($this->_tpl_vars['submission_id'])."&view_id=' + this.value",'open_html' => '<div class="views_dropdown">','close_html' => '</div>','hide_single_view' => true), $this);?>

      </div>
      </td>
    </tr>
    </table>

    <table cellpadding="0" cellspacing="0" class="pad_top_large pad_bottom_large">
    <tr>
      <td width="80" class="nowrap"><?php echo $this->_tpl_vars['previous_link_html']; ?>
</td>
      <td width="150" class="nowrap"><?php echo $this->_tpl_vars['search_results_link_html']; ?>
</td>
      <td><?php echo $this->_tpl_vars['next_link_html']; ?>
</td>
    </tr>
    </table>

    <?php echo smarty_function_template_hook(array('location' => 'admin_edit_submission_top'), $this);?>


    <?php if (count($this->_tpl_vars['tabs']) > 0): ?>
      <?php echo smarty_function_ft_include(array('file' => 'tabset_open.tpl'), $this);?>

    <?php endif; ?>

    <?php echo smarty_function_ft_include(array('file' => "messages.tpl"), $this);?>


    <form action="edit_submission.php?form_id=<?php echo $this->_tpl_vars['form_id']; ?>
&submission_id=<?php echo $this->_tpl_vars['submission_id']; ?>
" method="post" id="edit_submission_form"
      name="edit_submission_form" enctype="multipart/form-data">
            <input type="hidden" name="form_id" id="form_id" value="<?php echo $this->_tpl_vars['form_id']; ?>
" />
      <input type="hidden" name="submission_id" id="submission_id" value="<?php echo $this->_tpl_vars['submission_id']; ?>
" />
      <input type="hidden" name="tab" id="tab" value="<?php echo $this->_tpl_vars['tab_number']; ?>
" />

      <?php $_from = $this->_tpl_vars['grouped_fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['curr_group']):
?>
        <?php $this->assign('group', $this->_tpl_vars['curr_group']['group']); ?>
        <?php $this->assign('fields', $this->_tpl_vars['curr_group']['fields']); ?>

        <?php if ($this->_tpl_vars['group']['group_name']): ?>
          <h3><?php echo ((is_array($_tmp=$this->_tpl_vars['group']['group_name'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
</h3>
        <?php endif; ?>

        <?php if (count($this->_tpl_vars['fields']) > 0): ?>
          <table class="list_table" cellpadding="1" cellspacing="1" border="0" width="100%">
        <?php endif; ?>

        <?php $_from = $this->_tpl_vars['fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['curr_field']):
?>
          <?php $this->assign('field_id', $this->_tpl_vars['field']['field_id']); ?>
          <tr>
            <td width="160" class="pad_left_small" valign="top"><?php echo $this->_tpl_vars['curr_field']['field_title']; ?>

              <?php if ($this->_tpl_vars['curr_field']['is_required'] && $this->_tpl_vars['curr_field']['is_editable'] == 'yes'): ?><span class="req">*</span><?php endif; ?>
            </td>
            <td valign="top">
              <?php echo smarty_function_edit_custom_field(array('form_id' => $this->_tpl_vars['form_id'],'submission_id' => $this->_tpl_vars['submission_id'],'field_info' => $this->_tpl_vars['curr_field'],'field_types' => $this->_tpl_vars['field_types'],'settings' => $this->_tpl_vars['settings']), $this);?>

            </td>
          </tr>
        <?php endforeach; endif; unset($_from); ?>

        <?php if (count($this->_tpl_vars['fields']) > 0): ?>
          </table>
        <?php endif; ?>

      <?php endforeach; endif; unset($_from); ?>

      <input type="hidden" name="field_ids" value="<?php echo $this->_tpl_vars['page_field_ids_str']; ?>
" />

            <?php if (count($this->_tpl_vars['page_field_ids']) == 0): ?>
        <div class="margin_bottom_large"><?php echo $this->_tpl_vars['LANG']['notify_no_fields_in_tab']; ?>
</div>
      <?php endif; ?>

      <div style="position:relative">
        <span style="float:right">
                    <?php echo smarty_function_display_email_template_dropdown(array('form_id' => $this->_tpl_vars['form_id'],'view_id' => $this->_tpl_vars['view_id'],'submission_id' => $this->_tpl_vars['submission_id']), $this);?>

        </span>
                <?php if (count($this->_tpl_vars['page_field_ids']) > 0 && $this->_tpl_vars['tab_has_editable_fields']): ?>
          <input type="submit" name="update" value="<?php echo $this->_tpl_vars['LANG']['word_update']; ?>
" />
        <?php endif; ?>
        <?php if ($this->_tpl_vars['view_info']['may_delete_submissions'] == 'yes'): ?>
          <input type="button" name="delete" value="<?php echo $this->_tpl_vars['LANG']['word_delete']; ?>
" class="red" onclick="return ms.delete_submission(<?php echo $this->_tpl_vars['submission_id']; ?>
, 'submissions.php')"/>
        <?php endif; ?>
        <?php if ($this->_tpl_vars['view_info']['may_add_submissions'] == 'yes'): ?>
          <span class="button_separator">|</span>
          <input type="button" value="<?php echo smarty_function_eval(array('var' => $this->_tpl_vars['form_info']['add_submission_button_label']), $this);?>
" onclick="window.location='submissions.php?form_id=<?php echo $this->_tpl_vars['form_id']; ?>
&add_submission'" />
        <?php endif; ?>
      </div>
    </form>

    <?php if (count($this->_tpl_vars['tabs']) > 0): ?>
      <?php echo smarty_function_ft_include(array('file' => 'tabset_close.tpl'), $this);?>

    <?php endif; ?>

    <?php echo smarty_function_template_hook(array('location' => 'admin_edit_submission_bottom'), $this);?>

  </div>

<?php echo smarty_function_ft_include(array('file' => 'footer.tpl'), $this);?>