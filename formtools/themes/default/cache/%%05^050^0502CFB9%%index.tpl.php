<?php /* Smarty version 2.6.18, created on 2012-10-14 20:44:57
         compiled from C:%5CUsers%5CConnor%5CDocuments%5CCodeCraft%5CTEDxUW%5Cformtools/themes/default/admin/themes/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'themes_dropdown', 'C:\\Users\\Connor\\Documents\\CodeCraft\\TEDxUW\\formtools/themes/default/admin/themes/index.tpl', 20, false),array('function', 'eval_smarty_string', 'C:\\Users\\Connor\\Documents\\CodeCraft\\TEDxUW\\formtools/themes/default/admin/themes/index.tpl', 64, false),array('function', 'template_hook', 'C:\\Users\\Connor\\Documents\\CodeCraft\\TEDxUW\\formtools/themes/default/admin/themes/index.tpl', 77, false),array('modifier', 'count', 'C:\\Users\\Connor\\Documents\\CodeCraft\\TEDxUW\\formtools/themes/default/admin/themes/index.tpl', 31, false),array('modifier', 'escape', 'C:\\Users\\Connor\\Documents\\CodeCraft\\TEDxUW\\formtools/themes/default/admin/themes/index.tpl', 48, false),array('modifier', 'upper', 'C:\\Users\\Connor\\Documents\\CodeCraft\\TEDxUW\\formtools/themes/default/admin/themes/index.tpl', 54, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

  <table cellpadding="0" cellspacing="0" height="35">
  <tr>
    <td width="45"><img src="<?php echo $this->_tpl_vars['images_url']; ?>
/icon_themes.gif" width="34" height="29" /></td>
    <td class="title"><?php echo $this->_tpl_vars['LANG']['word_themes']; ?>
</td>
  </tr>
  </table>

  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'messages.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

  <div class="margin_bottom_large">
    <?php echo $this->_tpl_vars['LANG']['text_theme_page_intro']; ?>

  </div>

  <form action="<?php echo $this->_tpl_vars['same_page']; ?>
" method="post" onsubmit="return rsv.validate(this, rules)">
    <table cellspacing="0" cellpadding="1" class="margin_bottom_large">
      <tr>
        <td width="180"><?php echo $this->_tpl_vars['LANG']['phrase_administrator_theme']; ?>
</td>
        <td><?php echo smarty_function_themes_dropdown(array('name_id' => 'admin_theme','default' => $this->_tpl_vars['admin_theme'],'default_swatch' => $this->_tpl_vars['admin_theme_swatch']), $this);?>
</td>
      </tr>
      <tr>
        <td><?php echo $this->_tpl_vars['LANG']['phrase_default_client_account_theme']; ?>
</td>
        <td>
          <?php echo smarty_function_themes_dropdown(array('name_id' => 'default_client_theme','default' => $this->_tpl_vars['client_theme'],'default_swatch' => $this->_tpl_vars['client_theme_swatch']), $this);?>

          <span class="medium_grey"><?php echo $this->_tpl_vars['LANG']['text_also_default_login_page_theme']; ?>
</span>
        </td>
      </tr>
      </table>

      <?php if (count($this->_tpl_vars['themes']) == 0): ?>
        <div><?php echo $this->_tpl_vars['LANG']['text_no_themes']; ?>
</div>
      <?php else: ?>

        <table cellspacing="1" cellpadding="0" width="100%" class="list_table check_areas">
        <tr>
          <th width="200"><?php echo $this->_tpl_vars['LANG']['word_image']; ?>
</th>
          <th><?php echo $this->_tpl_vars['LANG']['phrase_theme_info']; ?>
</th>
          <th width="70"><?php echo $this->_tpl_vars['LANG']['word_enabled']; ?>
</th>
        </tr>

        <?php $_from = $this->_tpl_vars['themes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['row'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['row']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['theme']):
        $this->_foreach['row']['iteration']++;
?>
          <?php $this->assign('index', ($this->_foreach['row']['iteration']-1)); ?>
          <?php $this->assign('theme_info', $this->_tpl_vars['themes'][$this->_tpl_vars['index']]); ?>
          <tr>
            <td valign="top">
              <a href="<?php echo $this->_tpl_vars['g_root_url']; ?>
/themes/<?php echo $this->_tpl_vars['theme_info']['theme_folder']; ?>
/about/screenshot.gif" class="fancybox"
                title="<?php echo ((is_array($_tmp=$this->_tpl_vars['theme_info']['theme_name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"><img src="<?php echo $this->_tpl_vars['g_root_url']; ?>
/themes/<?php echo $this->_tpl_vars['theme_info']['theme_folder']; ?>
/about/thumbnail.gif" border="0" /></a>
            </td>
            <td valign="top" class="pad_left">
              <div>
                <span class="bold"><?php echo $this->_tpl_vars['theme_info']['theme_name']; ?>
</span>
                <span class="pad_right_large"><?php echo $this->_tpl_vars['theme_info']['theme_version']; ?>
</span>
                [<a href="about.php?theme_id=<?php echo $this->_tpl_vars['theme_info']['theme_id']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['LANG']['word_about'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
</a>]
              </div>
              <?php if ($this->_tpl_vars['theme_info']['uses_swatches'] == 'yes'): ?>
                <div><?php echo $this->_tpl_vars['LANG']['phrase_available_swatches_c']; ?>
 <span class="medium_grey"><?php echo $this->_tpl_vars['theme_info']['available_swatches']; ?>
</span></div>
              <?php endif; ?>
              <?php if ($this->_tpl_vars['theme_info']['author']): ?><div><?php echo $this->_tpl_vars['LANG']['word_author_c']; ?>
 <?php echo $this->_tpl_vars['theme_info']['author']; ?>
</div><?php endif; ?>
              <?php if ($this->_tpl_vars['theme_info']['description']): ?><p><?php echo $this->_tpl_vars['theme_info']['description']; ?>
</p><?php endif; ?>
              <?php if (! $this->_tpl_vars['theme_info']['cache_folder_writable']): ?>
                <div class="error">
                  <div style="padding: 6px">
                    <?php echo smarty_function_eval_smarty_string(array('placeholder_str' => $this->_tpl_vars['LANG']['notify_theme_cache_folder_not_writable'],'folder' => ($this->_tpl_vars['g_root_dir'])."/themes/".($this->_tpl_vars['theme_info']['theme_folder'])."/cache/"), $this);?>

                  </div>
                </div>
              <?php endif; ?>
            </td>
            <td valign="top" align="center" class="check_area">
              <input type="checkbox" name="is_enabled[]" value="<?php echo $this->_tpl_vars['theme_info']['theme_folder']; ?>
"
                <?php if ($this->_tpl_vars['theme_info']['is_enabled'] == 'yes'): ?>checked="checked"<?php endif; ?>
                <?php if (! $this->_tpl_vars['theme_info']['cache_folder_writable']): ?>disabled="disabled"<?php endif; ?> />
            </td>
          </tr>
        <?php endforeach; endif; unset($_from); ?>
        <?php echo smarty_function_template_hook(array('location' => 'admin_settings_themes_bottom'), $this);?>

        </table>

      <?php endif; ?>

      <p>
        <input type="submit" name="update" value="<?php echo $this->_tpl_vars['LANG']['word_update']; ?>
" />
        <input type="submit" name="refresh_theme_list" class="blue" value="<?php echo $this->_tpl_vars['LANG']['phrase_refresh_theme_list']; ?>
" />
      </p>
    </form>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>