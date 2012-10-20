<?php /* Smarty version 2.6.18, created on 2012-10-14 20:52:01
         compiled from ../../modules/export_manager/templates/export_options_html.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', '../../modules/export_manager/templates/export_options_html.tpl', 10, false),array('function', 'eval', '../../modules/export_manager/templates/export_options_html.tpl', 30, false),)), $this); ?>

  <?php if (count($this->_tpl_vars['export_groups']) > 0): ?>
    <script src="<?php echo $this->_tpl_vars['modules_dir']; ?>
/export_manager/global/scripts/export_manager.js?v=4"></script>
    <script>
    <?php echo '
    if (typeof em == \'undefined\') {
      em = {};
    }
    '; ?>

    em.export_page = "<?php echo $this->_tpl_vars['modules_dir']; ?>
/export_manager/export.php";
    g.messages["validation_select_rows_to_export"] = "<?php echo $this->_tpl_vars['LANG']['export_manager']['validation_select_rows_to_export']; ?>
";
    </script>

    <div class="module_section export_manager_module">
      <?php if ($this->_tpl_vars['is_admin']): ?><div class="module_link"><a href="<?php echo $this->_tpl_vars['g_root_url']; ?>
/modules/export_manager"></a></div><?php endif; ?>
      <h2><?php echo $this->_tpl_vars['LANG']['word_download']; ?>
 / <?php echo $this->_tpl_vars['LANG']['export_manager']['word_export']; ?>
</h2>
      <table cellpadding="0" cellpadding="0">
      <?php $_from = $this->_tpl_vars['export_groups']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['row'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['row']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['export_group']):
        $this->_foreach['row']['iteration']++;
?>
        <?php $this->assign('export_group_id', $this->_tpl_vars['export_group']['export_group_id']); ?>
        <tr>
          <td class="icon"><img src="<?php echo $this->_tpl_vars['export_icon_folder']; ?>
/<?php echo $this->_tpl_vars['export_group']['icon']; ?>
"/></td>
          <td class="export_group_name"><?php echo smarty_function_eval(array('var' => $this->_tpl_vars['export_group']['group_name']), $this);?>
</td>
          <td class="target_content">
            <?php $this->assign('var_name', "export_group_".($this->_tpl_vars['export_group_id'])."_results"); ?>
            <input type="radio" name="export_group_<?php echo $this->_tpl_vars['export_group_id']; ?>
_results" id="export_group_<?php echo $this->_tpl_vars['export_group_id']; ?>
_results_1" value="all"
              <?php if ($this->_tpl_vars['SESSION']['export_manager'][$this->_tpl_vars['var_name']] == 'all' || ! isset ( $this->_tpl_vars['SESSION']['export_manager'][$this->_tpl_vars['var_name']] )): ?>checked<?php endif; ?> />
              <label for="export_group_<?php echo $this->_tpl_vars['export_group_id']; ?>
_results_1""><?php echo $this->_tpl_vars['LANG']['word_all']; ?>
</label>
            <input type="radio" name="export_group_<?php echo $this->_tpl_vars['export_group_id']; ?>
_results" id="export_group_<?php echo $this->_tpl_vars['export_group_id']; ?>
_results_2" value="selected"
              <?php if ($this->_tpl_vars['SESSION']['export_manager'][$this->_tpl_vars['var_name']] == 'selected'): ?>checked<?php endif; ?> />
              <label for="export_group_<?php echo $this->_tpl_vars['export_group_id']; ?>
_results_2""><?php echo $this->_tpl_vars['LANG']['word_selected']; ?>
</label>
          </td>
          <td>
            <?php if ($this->_tpl_vars['export_group']['action'] == 'popup'): ?>
              <script>
              em.export_group_id_<?php echo $this->_tpl_vars['export_group_id']; ?>
_height = <?php echo $this->_tpl_vars['export_group']['popup_height']; ?>
;
              em.export_group_id_<?php echo $this->_tpl_vars['export_group_id']; ?>
_width  = <?php echo $this->_tpl_vars['export_group']['popup_width']; ?>
;
              </script>
            <?php endif; ?>
            <?php if (count($this->_tpl_vars['export_group']['export_types']) > 1): ?>
              <?php $this->assign('var_name', "export_group_".($this->_tpl_vars['export_group_id'])."_export_type"); ?>
                <select name="export_group_<?php echo $this->_tpl_vars['export_group_id']; ?>
_export_type" id="export_group_<?php echo $this->_tpl_vars['export_group_id']; ?>
_export_type">
                <?php $_from = $this->_tpl_vars['export_group']['export_types']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['row'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['row']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['export_type']):
        $this->_foreach['row']['iteration']++;
?>
                  <option value="<?php echo $this->_tpl_vars['export_type']['export_type_id']; ?>
" <?php if ($this->_tpl_vars['page_vars'][$this->_tpl_vars['var_name']] == $this->_tpl_vars['export_type']['export_type_id']): ?>selected<?php endif; ?>><?php echo smarty_function_eval(array('var' => $this->_tpl_vars['export_type']['export_type_name']), $this);?>
</option>
                <?php endforeach; endif; unset($_from); ?>
                </select>
            <?php endif; ?>
            <input type="button" name="export_group_<?php echo $this->_tpl_vars['export_group_id']; ?>
" value="<?php echo smarty_function_eval(array('var' => $this->_tpl_vars['export_group']['action_button_text']), $this);?>
"
              onclick="em.export_submissions(<?php echo $this->_tpl_vars['export_group_id']; ?>
, '<?php echo $this->_tpl_vars['export_group']['action']; ?>
')" />
          </td>
        </tr>
      <?php endforeach; endif; unset($_from); ?>
      </table>
    </div>

  <?php endif; ?>