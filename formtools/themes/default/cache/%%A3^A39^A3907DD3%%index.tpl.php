<?php /* Smarty version 2.6.18, created on 2012-10-20 17:33:50
         compiled from /Users/lucaszw/Sites/TEDxUW/formtools/themes/default/admin/modules/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', '/Users/lucaszw/Sites/TEDxUW/formtools/themes/default/admin/modules/index.tpl', 18, false),array('modifier', 'in_array', '/Users/lucaszw/Sites/TEDxUW/formtools/themes/default/admin/modules/index.tpl', 19, false),array('modifier', 'count', '/Users/lucaszw/Sites/TEDxUW/formtools/themes/default/admin/modules/index.tpl', 26, false),array('modifier', 'upper', '/Users/lucaszw/Sites/TEDxUW/formtools/themes/default/admin/modules/index.tpl', 108, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

  <table cellpadding="0" cellspacing="0" height="35">
  <tr>
    <td width="45"><img src="<?php echo $this->_tpl_vars['images_url']; ?>
/icon_modules.gif" width="34" height="34" /></td>
    <td class="title"><?php echo $this->_tpl_vars['LANG']['word_modules']; ?>
</td>
  </tr>
  </table>

  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'messages.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

  <div id="search_form" class=" margin_bottom_large">
    <form action="<?php echo $this->_tpl_vars['same_page']; ?>
" method="post">
      <table cellspacing="2" cellpadding="0" id="search_form_table">
      <tr>
        <td class="blue" width="70"><?php echo $this->_tpl_vars['LANG']['word_search']; ?>
</td>
        <td>
          <input type="text" size="20" name="keyword" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['search_criteria']['keyword'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
          <input type="checkbox" id="status_enabled" name="status[]" value="enabled" <?php if (((is_array($_tmp='enabled')) ? $this->_run_mod_handler('in_array', true, $_tmp, $this->_tpl_vars['search_criteria']['status']) : in_array($_tmp, $this->_tpl_vars['search_criteria']['status']))): ?>checked<?php endif; ?> />
            <label for="status_enabled"><?php echo $this->_tpl_vars['LANG']['word_enabled']; ?>
</label>
          <input type="checkbox" id="status_disabled" name="status[]" value="disabled" <?php if (((is_array($_tmp='disabled')) ? $this->_run_mod_handler('in_array', true, $_tmp, $this->_tpl_vars['search_criteria']['status']) : in_array($_tmp, $this->_tpl_vars['search_criteria']['status']))): ?>checked<?php endif; ?> />
            <label for="status_disabled"><?php echo $this->_tpl_vars['LANG']['word_disabled']; ?>
</label>

          <input type="submit" name="search_modules" value="<?php echo $this->_tpl_vars['LANG']['word_search']; ?>
" class="margin_left" />
          <input type="button" name="reset" onclick="window.location='<?php echo $this->_tpl_vars['same_page']; ?>
?reset=1'"
            <?php if (count($this->_tpl_vars['modules']) < $this->_tpl_vars['num_modules']): ?>
              value="<?php echo $this->_tpl_vars['LANG']['phrase_show_all']; ?>
 (<?php echo $this->_tpl_vars['num_modules']; ?>
)" class="bold"
            <?php else: ?>
              value="<?php echo $this->_tpl_vars['LANG']['phrase_show_all']; ?>
" class="light_grey" disabled
            <?php endif; ?> />
        </td>
      </tr>
      </table>
    </form>
  </div>

  <?php if (count($this->_tpl_vars['modules']) == 0): ?>

    <div class="notify yellow_bg">
      <div style="padding: 8px">
        <?php echo $this->_tpl_vars['LANG']['text_no_modules_found']; ?>

      </div>
    </div>

    <p>
      <input type="button" onclick="window.location='<?php echo $this->_tpl_vars['same_page']; ?>
?refresh_module_list'" class="blue" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['LANG']['phrase_refresh_module_list'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
    </p>

  <?php else: ?>

    <?php echo $this->_tpl_vars['pagination']; ?>


    <form action="<?php echo $this->_tpl_vars['same_page']; ?>
" method="post" class="check_areas" id="modules_form">
      <input type="hidden" name="module_ids_in_page" value="<?php echo $this->_tpl_vars['module_ids_in_page']; ?>
" />

      <?php $this->assign('table_group_id', '1'); ?>

            <?php $_from = $this->_tpl_vars['modules']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['row'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['row']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['module']):
        $this->_foreach['row']['iteration']++;
?>
        <?php $this->assign('index', ($this->_foreach['row']['iteration']-1)); ?>
        <?php $this->assign('count', $this->_foreach['row']['iteration']); ?>
        <?php $this->assign('module_id', $this->_tpl_vars['modules'][$this->_tpl_vars['index']]['module_id']); ?>
        <?php $this->assign('module', $this->_tpl_vars['modules'][$this->_tpl_vars['index']]); ?>

                <?php if ($this->_tpl_vars['count'] == 1 || $this->_tpl_vars['count'] != 1 && ( ( $this->_tpl_vars['count']-1 ) % $this->_tpl_vars['settings']['num_modules_per_page'] == 0 )): ?>

          <?php if ($this->_tpl_vars['table_group_id'] == '1'): ?>
            <?php $this->assign('style', "display: block"); ?>
          <?php else: ?>
            <?php $this->assign('style', "display: none"); ?>
          <?php endif; ?>

          <div id="page_<?php echo $this->_tpl_vars['table_group_id']; ?>
" style="<?php echo $this->_tpl_vars['style']; ?>
">

          <table class="list_table" cellspacing="1" cellpadding="0">
          <tr>
            <?php $this->assign('up_down', ""); ?>
            <?php if ($this->_tpl_vars['order'] == "module_name-DESC"): ?>
              <?php $this->assign('sort_order', "order=module_name-ASC"); ?>
              <?php $this->assign('up_down', "<img src=\"".($this->_tpl_vars['theme_url'])."/images/sort_down.gif\" />"); ?>
            <?php elseif ($this->_tpl_vars['order'] == "module_name-ASC"): ?>
              <?php $this->assign('sort_order', "order=module_name-DESC"); ?>
              <?php $this->assign('up_down', "<img src=\"".($this->_tpl_vars['theme_url'])."/images/sort_up.gif\" />"); ?>
            <?php else: ?>
              <?php $this->assign('sort_order', "order=module_name-DESC"); ?>
            <?php endif; ?>
            <th<?php if ($this->_tpl_vars['up_down']): ?> class="over"<?php endif; ?>>
              <a href="<?php echo $this->_tpl_vars['same_page']; ?>
?<?php echo $this->_tpl_vars['sort_order']; ?>
"><?php echo $this->_tpl_vars['LANG']['word_module']; ?>
 <?php echo $this->_tpl_vars['up_down']; ?>
</a>
            </th>
            <th class="pad_left pad_right"><?php echo $this->_tpl_vars['LANG']['word_version']; ?>
</th>

            <?php $this->assign('up_down', ""); ?>
            <?php if ($this->_tpl_vars['order'] == "is_enabled-DESC"): ?>
              <?php $this->assign('sort_order', "order=is_enabled-ASC"); ?>
              <?php $this->assign('up_down', "<img src=\"".($this->_tpl_vars['theme_url'])."/images/sort_down.gif\" />"); ?>
            <?php elseif ($this->_tpl_vars['order'] == "is_enabled-ASC"): ?>
              <?php $this->assign('sort_order', "order=is_enabled-DESC"); ?>
              <?php $this->assign('up_down', "<img src=\"".($this->_tpl_vars['theme_url'])."/images/sort_up.gif\" />"); ?>
            <?php else: ?>
              <?php $this->assign('sort_order', "order=is_enabled-DESC"); ?>
            <?php endif; ?>
            <th width="70"<?php if ($this->_tpl_vars['up_down']): ?> class="over"<?php endif; ?>>
              <a href="<?php echo $this->_tpl_vars['same_page']; ?>
?<?php echo $this->_tpl_vars['sort_order']; ?>
"><?php echo $this->_tpl_vars['LANG']['word_enabled']; ?>
 <?php echo $this->_tpl_vars['up_down']; ?>
</a>
            </th>
            <th width="70"><?php echo ((is_array($_tmp=$this->_tpl_vars['LANG']['word_select'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
</th>
            <th width="70" class="del2"><?php echo ((is_array($_tmp=$this->_tpl_vars['LANG']['word_uninstall'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
</th>
          </tr>

        <?php endif; ?>

        <?php if ($this->_tpl_vars['module']['is_installed'] == 'no' || $this->_tpl_vars['module']['needs_upgrading']): ?>
           <tr class="selected_row_color">
        <?php else: ?>
          <tr>
        <?php endif; ?>

          <td class="pad_left_small pad_right_large" valign="top">
            <div><span class="bold pad_right_large"><?php echo $this->_tpl_vars['module']['module_name']; ?>
</span> [<a href="about.php?module_id=<?php echo $this->_tpl_vars['module']['module_id']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['LANG']['word_about'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
</a>]</div>
            <div class="medium_grey"><?php echo $this->_tpl_vars['module']['description']; ?>
</div>
          </td>
          <td valign="top" align="center"><?php echo $this->_tpl_vars['module']['version']; ?>
</td>
          <td valign="top" align="center" <?php if ($this->_tpl_vars['module']['is_installed'] == 'yes' && $this->_tpl_vars['module']['module_folder'] != 'core_field_types'): ?>class="check_area"<?php endif; ?>>
            <?php if ($this->_tpl_vars['module']['is_installed'] == 'no'): ?>
              <input type="hidden" class="module_id" value="<?php echo $this->_tpl_vars['module']['module_id']; ?>
" />
              <input type="hidden" class="module_folder" value="<?php echo $this->_tpl_vars['module']['module_folder']; ?>
" />
              <a href="<?php echo $this->_tpl_vars['same_page']; ?>
?install=<?php echo $this->_tpl_vars['module']['module_id']; ?>
"<?php if ($this->_tpl_vars['module']['is_premium'] == 'yes'): ?> class="is_premium"<?php endif; ?>><?php echo ((is_array($_tmp=$this->_tpl_vars['LANG']['word_install'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
</a>
            <?php else: ?>
              <?php if ($this->_tpl_vars['module']['module_folder'] != 'core_field_types'): ?>
                <input type="checkbox" name="is_enabled[]" value="<?php echo $this->_tpl_vars['module']['module_id']; ?>
" <?php if ($this->_tpl_vars['module']['is_enabled'] == 'yes'): ?>checked<?php endif; ?> />
              <?php endif; ?>
            <?php endif; ?>
          </td>
          <td valign="top" align="center">
            <?php if ($this->_tpl_vars['module']['is_enabled'] == 'yes' || $this->_tpl_vars['module']['module_folder'] == 'core_field_types'): ?>
              <?php if ($this->_tpl_vars['module']['needs_upgrading']): ?>
                <a href="<?php echo $this->_tpl_vars['same_page']; ?>
?upgrade=<?php echo $this->_tpl_vars['module_id']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['LANG']['word_upgrade'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
</a>
              <?php else: ?>
                <a href="<?php echo $this->_tpl_vars['g_root_url']; ?>
/modules/<?php echo $this->_tpl_vars['module']['module_folder']; ?>
/"><?php echo ((is_array($_tmp=$this->_tpl_vars['LANG']['word_select'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
</a>
              <?php endif; ?>
            <?php endif; ?>
          </td>
          <td valign="top" class="del2" align="center">
            <?php if ($this->_tpl_vars['module']['module_folder'] != 'core_field_types'): ?>
              <a href="#" onclick="return mm.uninstall_module(<?php echo $this->_tpl_vars['module']['module_id']; ?>
)"><?php echo ((is_array($_tmp=$this->_tpl_vars['LANG']['word_uninstall'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
</a>
            <?php endif; ?>
          </td>
        </tr>

        <?php if ($this->_tpl_vars['count'] != 1 && ( $this->_tpl_vars['count'] % $this->_tpl_vars['settings']['num_modules_per_page'] ) == 0): ?>
          </table></div>
          <?php $this->assign('table_group_id', $this->_tpl_vars['table_group_id']+1); ?>
        <?php endif; ?>

      <?php endforeach; endif; unset($_from); ?>

            <?php if (( count($this->_tpl_vars['modules']) % $this->_tpl_vars['settings']['num_modules_per_page'] ) != 0): ?>
        </table></div>
      <?php endif; ?>

      <p>
        <input type="submit" name="enable_modules" value="<?php echo $this->_tpl_vars['LANG']['word_update']; ?>
" />
        <input type="button" onclick="window.location='<?php echo $this->_tpl_vars['same_page']; ?>
?refresh_module_list'" class="blue" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['LANG']['phrase_refresh_module_list'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
      </p>

    </form>

    <div id="premium_module_dialog" class="hidden">
      <span class="popup_icon popup_type_info"></span>
      <div class="margin_bottom_large">
        <?php echo $this->_tpl_vars['LANG']['text_enter_license_key']; ?>

      </div>
      <div class="license_key_panel">
        <span class="margin_right_large"><?php echo $this->_tpl_vars['LANG']['phrase_license_key']; ?>
</span>
        <input type="text" id="key_section1" maxlength="4" value="" />-<input type="text" id="key_section2" maxlength="4" value="" />-<input type="text" id="key_section3" maxlength="4" value="" />
      </div>
    </div>
  <?php endif; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>