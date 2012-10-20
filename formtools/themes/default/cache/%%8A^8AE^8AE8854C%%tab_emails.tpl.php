<?php /* Smarty version 2.6.18, created on 2012-10-14 21:11:06
         compiled from C:%5CUsers%5CConnor%5CDocuments%5CCodeCraft%5CTEDxUW%5Cformtools/themes/default/admin/forms/tab_emails.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'upper', 'C:\\Users\\Connor\\Documents\\CodeCraft\\TEDxUW\\formtools/themes/default/admin/forms/tab_emails.tpl', 1, false),array('modifier', 'count', 'C:\\Users\\Connor\\Documents\\CodeCraft\\TEDxUW\\formtools/themes/default/admin/forms/tab_emails.tpl', 12, false),array('function', 'ft_include', 'C:\\Users\\Connor\\Documents\\CodeCraft\\TEDxUW\\formtools/themes/default/admin/forms/tab_emails.tpl', 3, false),)), $this); ?>
  <div class="subtitle underline margin_top_large"><?php echo ((is_array($_tmp=$this->_tpl_vars['LANG']['word_emails'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
</div>

  <?php echo smarty_function_ft_include(array('file' => 'messages.tpl'), $this);?>


  <div class="margin_bottom_large">
    <?php echo $this->_tpl_vars['LANG']['text_email_tab_summary']; ?>

  </div>

  <form action="<?php echo $this->_tpl_vars['same_page']; ?>
" method="post">
    <input type="hidden" name="page" value="emails" />

    <?php if (count($this->_tpl_vars['form_emails']) == 0): ?>

      <div class="notify yellow_bg" style="width:100%">
        <div style="padding: 8px">
          <?php echo $this->_tpl_vars['LANG']['notify_no_emails_defined']; ?>

        </div>
      </div>

    <?php else: ?>
      <?php echo $this->_tpl_vars['pagination']; ?>


      <table class="list_table" cellspacing="1" cellpadding="1">
      <tr>
        <th><?php echo $this->_tpl_vars['LANG']['phrase_email_template']; ?>
</th>
        <th><?php echo $this->_tpl_vars['LANG']['word_recipient_sp']; ?>
</th>
        <th width="90"><?php echo $this->_tpl_vars['LANG']['word_status']; ?>
</th>
        <th class="edit"></th>
        <th class="del colN"></th>
      </tr>

      <?php $_from = $this->_tpl_vars['form_emails']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['row'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['row']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['email']):
        $this->_foreach['row']['iteration']++;
?>
        <?php $this->assign('index', ($this->_foreach['row']['iteration']-1)); ?>
        <?php $this->assign('count', $this->_foreach['row']['iteration']); ?>
        <?php $this->assign('email_id', $this->_tpl_vars['email']['email_id']); ?>

         <tr>
           <td><?php echo $this->_tpl_vars['email']['email_template_name']; ?>
</td>
           <td>
            <?php if (count($this->_tpl_vars['email']['recipients']) == 0): ?>
              <span class="light_grey"><?php echo $this->_tpl_vars['LANG']['word_none']; ?>
</span>
            <?php elseif (count($this->_tpl_vars['email']['recipients']) == 1): ?>
              <?php echo $this->_tpl_vars['email']['recipients'][0]['final_recipient']; ?>

            <?php else: ?>
              <select>
                                <?php $this->assign('last_recipient_type', ""); ?>
                <?php $_from = $this->_tpl_vars['email']['recipients']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['user_row'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['user_row']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['recipient']):
        $this->_foreach['user_row']['iteration']++;
?>

                  <?php if ($this->_tpl_vars['last_recipient_type'] != $this->_tpl_vars['recipient']['recipient_type']): ?>
                    <?php if ($this->_tpl_vars['last_recipient_type'] != ""): ?>
                      </optgroup>
                    <?php endif; ?>
                    <optgroup label="<?php echo $this->_tpl_vars['recipient']['recipient_type']; ?>
">

                    <?php $this->assign('last_recipient_type', $this->_tpl_vars['recipient']['recipient_type']); ?>
                  <?php endif; ?>

                  <option><?php if ($this->_tpl_vars['recipient']['recipient_user_type'] == 'form_email_field'): ?><?php echo $this->_tpl_vars['LANG']['phrase_form_email_field_b_c']; ?>
<?php endif; ?> <?php echo $this->_tpl_vars['recipient']['final_recipient']; ?>
</option>
                <?php endforeach; endif; unset($_from); ?>

                <?php if ($this->_tpl_vars['last_recipient_type'] != ""): ?>
                  </optgroup>
                <?php endif; ?>
              </select>
            <?php endif; ?>
           </td>
          <td align="center">
            <?php if ($this->_tpl_vars['email']['email_status'] == 'enabled'): ?>
              <span class="light_green"><?php echo $this->_tpl_vars['LANG']['word_enabled']; ?>
</span>
            <?php else: ?>
              <span class="red"><?php echo $this->_tpl_vars['LANG']['word_disabled']; ?>
</span>
            <?php endif; ?>
          </td>
          <td class="edit"><a href="<?php echo $this->_tpl_vars['same_page']; ?>
?page=edit_email&email_id=<?php echo $this->_tpl_vars['email_id']; ?>
"></a></td>
          <td class="del colN"><a href="#" onclick="page_ns.delete_email(<?php echo $this->_tpl_vars['email_id']; ?>
)"></a></td>
        </tr>
      <?php endforeach; endif; unset($_from); ?>
      </table>

    <?php endif; ?>

    <div class="margin_top_large">
      <?php if (count($this->_tpl_vars['all_form_emails']) > 0): ?>
        <select name="create_email_from_email_id">
          <option value=""><?php echo $this->_tpl_vars['LANG']['phrase_new_blank_email']; ?>
</option>
          <optgroup label="<?php echo $this->_tpl_vars['LANG']['phrase_copy_email_settings_from']; ?>
">
          <?php $_from = $this->_tpl_vars['all_form_emails']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
              <option value="<?php echo $this->_tpl_vars['i']['email_id']; ?>
"><?php echo $this->_tpl_vars['i']['email_template_name']; ?>
</option>
          <?php endforeach; endif; unset($_from); ?>
          </optgroup>
        </select>
      <?php endif; ?>
      <input type="submit" name="add_email" value="<?php echo $this->_tpl_vars['LANG']['phrase_create_new_email']; ?>
" />
      <input type="submit" name="edit_email_user_settings" value="<?php echo $this->_tpl_vars['LANG']['phrase_configure_form_email_fields']; ?>
 (<?php echo $this->_tpl_vars['num_registered_form_emails']; ?>
)" />
    </div>

  </form>