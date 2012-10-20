<?php /* Smarty version 2.6.18, created on 2012-10-14 20:44:55
         compiled from C:%5CUsers%5CConnor%5CDocuments%5CCodeCraft%5CTEDxUW%5Cformtools/themes/default/admin/clients/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ft_include', 'C:\\Users\\Connor\\Documents\\CodeCraft\\TEDxUW\\formtools/themes/default/admin/clients/index.tpl', 1, false),array('function', 'template_hook', 'C:\\Users\\Connor\\Documents\\CodeCraft\\TEDxUW\\formtools/themes/default/admin/clients/index.tpl', 12, false),array('modifier', 'escape', 'C:\\Users\\Connor\\Documents\\CodeCraft\\TEDxUW\\formtools/themes/default/admin/clients/index.tpl', 34, false),array('modifier', 'count', 'C:\\Users\\Connor\\Documents\\CodeCraft\\TEDxUW\\formtools/themes/default/admin/clients/index.tpl', 37, false),array('modifier', 'upper', 'C:\\Users\\Connor\\Documents\\CodeCraft\\TEDxUW\\formtools/themes/default/admin/clients/index.tpl', 97, false),array('modifier', 'custom_format_date', 'C:\\Users\\Connor\\Documents\\CodeCraft\\TEDxUW\\formtools/themes/default/admin/clients/index.tpl', 192, false),)), $this); ?>
<?php echo smarty_function_ft_include(array('file' => 'header.tpl'), $this);?>


  <table cellpadding="0" cellspacing="0">
  <tr>
    <td width="45"><img src="<?php echo $this->_tpl_vars['images_url']; ?>
/icon_accounts.gif" width="34" height="34" /></td>
    <td class="title"><?php echo $this->_tpl_vars['LANG']['word_clients']; ?>
</td>
  </tr>
  </table>

  <?php echo smarty_function_ft_include(array('file' => "messages.tpl"), $this);?>


  <?php echo smarty_function_template_hook(array('location' => 'admin_list_clients_top'), $this);?>


  <?php if ($this->_tpl_vars['num_clients'] == 0): ?>

    <div><?php echo $this->_tpl_vars['LANG']['text_no_clients']; ?>
</div>

  <?php else: ?>

    <div id="search_form" class=" margin_bottom_large">
      <form action="<?php echo $this->_tpl_vars['same_page']; ?>
" method="post">
        <table cellspacing="2" cellpadding="0" id="search_form_table">
        <tr>
          <td class="blue" width="70"><?php echo $this->_tpl_vars['LANG']['word_search']; ?>
</td>
          <td>
            <select name="status">
              <option value="" <?php if ($this->_tpl_vars['search_criteria']['status'] == ""): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['LANG']['phrase_all_statuses']; ?>
</option>
              <option value="active" <?php if ($this->_tpl_vars['search_criteria']['status'] == 'active'): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['LANG']['word_active']; ?>
</option>
              <option value="pending" <?php if ($this->_tpl_vars['search_criteria']['status'] == 'pending'): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['LANG']['word_pending']; ?>
</option>
              <option value="disabled" <?php if ($this->_tpl_vars['search_criteria']['status'] == 'disabled'): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['LANG']['word_disabled']; ?>
</option>
            </select>
          </td>
          <td>
            <input type="text" size="20" name="keyword" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['search_criteria']['keyword'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
            <input type="submit" name="search_forms" value="<?php echo $this->_tpl_vars['LANG']['word_search']; ?>
" />
            <input type="button" name="reset" onclick="window.location='<?php echo $this->_tpl_vars['same_page']; ?>
?reset=1'"
              <?php if (count($this->_tpl_vars['clients']) < $this->_tpl_vars['num_clients']): ?>
                value="<?php echo $this->_tpl_vars['LANG']['phrase_show_all']; ?>
 (<?php echo $this->_tpl_vars['num_clients']; ?>
)"  class="bold"
              <?php else: ?>
                value="<?php echo $this->_tpl_vars['LANG']['phrase_show_all']; ?>
" class="light_grey" disabled
              <?php endif; ?> />
          </td>
        </tr>
        </table>
      </form>
    </div>

    <?php if (count($this->_tpl_vars['clients']) == 0): ?>

      <div class="notify yellow_bg">
        <div style="padding: 8px">
          <?php echo $this->_tpl_vars['LANG']['text_no_clients_found']; ?>

        </div>
      </div>

    <?php else: ?>

      <?php echo $this->_tpl_vars['pagination']; ?>


      <form action="<?php echo $this->_tpl_vars['same_page']; ?>
" method="post">
      <?php $this->assign('table_group_id', '1'); ?>

            <?php $_from = $this->_tpl_vars['clients']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['row'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['row']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['client']):
        $this->_foreach['row']['iteration']++;
?>

        <?php $this->assign('index', ($this->_foreach['row']['iteration']-1)); ?>
        <?php $this->assign('count', $this->_foreach['row']['iteration']); ?>
        <?php $this->assign('client_id', $this->_tpl_vars['clients'][$this->_tpl_vars['index']]['account_id']); ?>
        <?php $this->assign('client_info', $this->_tpl_vars['clients'][$this->_tpl_vars['index']]); ?>

                <?php if ($this->_tpl_vars['count'] == 1 || $this->_tpl_vars['count'] != 1 && ( ( $this->_tpl_vars['count']-1 ) % $this->_tpl_vars['settings']['num_clients_per_page'] == 0 )): ?>

          <?php if ($this->_tpl_vars['table_group_id'] == '1'): ?>
            <?php $this->assign('style', "display: block"); ?>
          <?php else: ?>
            <?php $this->assign('style', "display: none"); ?>
          <?php endif; ?>

          <div id="page_<?php echo $this->_tpl_vars['table_group_id']; ?>
" style="<?php echo $this->_tpl_vars['style']; ?>
">

            <table class="list_table" width="100%" cellpadding="0" cellspacing="1">
            <tr>
              <?php $this->assign('up_down', ""); ?>
              <?php if ($this->_tpl_vars['order'] == "client_id-DESC"): ?>
                <?php $this->assign('sort_order', "order=client_id-ASC"); ?>
                <?php $this->assign('up_down', "<img src=\"".($this->_tpl_vars['theme_url'])."/images/sort_down.gif\" />"); ?>
              <?php elseif ($this->_tpl_vars['order'] == "client_id-ASC"): ?>
                <?php $this->assign('sort_order', "order=client_id-DESC"); ?>
                <?php $this->assign('up_down', "<img src=\"".($this->_tpl_vars['theme_url'])."/images/sort_up.gif\" />"); ?>
              <?php else: ?>
                <?php $this->assign('sort_order', "order=client_id-DESC"); ?>
              <?php endif; ?>
              <th width="30" class="sortable_col<?php if ($this->_tpl_vars['up_down']): ?> over<?php endif; ?>">
                <a href="<?php echo $this->_tpl_vars['same_page']; ?>
?<?php echo $this->_tpl_vars['sort_order']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['LANG']['word_id'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
 <?php echo $this->_tpl_vars['up_down']; ?>
</a>
              </th>

              <?php $this->assign('up_down', ""); ?>
              <?php if ($this->_tpl_vars['order'] == "first_name-DESC"): ?>
                <?php $this->assign('sort_order', "order=first_name-ASC"); ?>
                <?php $this->assign('up_down', "<img src=\"".($this->_tpl_vars['theme_url'])."/images/sort_down.gif\" />"); ?>
              <?php elseif ($this->_tpl_vars['order'] == "first_name-ASC"): ?>
                <?php $this->assign('sort_order', "order=first_name-DESC"); ?>
                <?php $this->assign('up_down', "<img src=\"".($this->_tpl_vars['theme_url'])."/images/sort_up.gif\" />"); ?>
              <?php else: ?>
                <?php $this->assign('sort_order', "order=first_name-DESC"); ?>
              <?php endif; ?>
              <th class="sortable_col<?php if ($this->_tpl_vars['up_down']): ?> over<?php endif; ?>">
                <a href="<?php echo $this->_tpl_vars['same_page']; ?>
?<?php echo $this->_tpl_vars['sort_order']; ?>
"><?php echo $this->_tpl_vars['LANG']['phrase_first_name']; ?>
 <?php echo $this->_tpl_vars['up_down']; ?>
</a>
              </th>

              <?php $this->assign('up_down', ""); ?>
              <?php if ($this->_tpl_vars['order'] == "last_name-DESC"): ?>
                <?php $this->assign('sort_order', "order=last_name-ASC"); ?>
                <?php $this->assign('up_down', "<img src=\"".($this->_tpl_vars['theme_url'])."/images/sort_down.gif\" />"); ?>
              <?php elseif ($this->_tpl_vars['order'] == "last_name-ASC"): ?>
                <?php $this->assign('sort_order', "order=last_name-DESC"); ?>
                <?php $this->assign('up_down', "<img src=\"".($this->_tpl_vars['theme_url'])."/images/sort_up.gif\" />"); ?>
              <?php else: ?>
                <?php $this->assign('sort_order', "order=last_name-DESC"); ?>
              <?php endif; ?>
              <th class="sortable_col<?php if ($this->_tpl_vars['up_down']): ?> over<?php endif; ?>">
                <a href="<?php echo $this->_tpl_vars['same_page']; ?>
?<?php echo $this->_tpl_vars['sort_order']; ?>
"><?php echo $this->_tpl_vars['LANG']['phrase_last_name']; ?>
 <?php echo $this->_tpl_vars['up_down']; ?>
</a>
              </th>

              <?php $this->assign('up_down', ""); ?>
              <?php if ($this->_tpl_vars['order'] == "email-DESC"): ?>
                <?php $this->assign('sort_order', "order=email-ASC"); ?>
                <?php $this->assign('up_down', "<img src=\"".($this->_tpl_vars['theme_url'])."/images/sort_down.gif\" />"); ?>
              <?php elseif ($this->_tpl_vars['order'] == "email-ASC"): ?>
                <?php $this->assign('sort_order', "order=email-DESC"); ?>
                <?php $this->assign('up_down', "<img src=\"".($this->_tpl_vars['theme_url'])."/images/sort_up.gif\" />"); ?>
              <?php else: ?>
                <?php $this->assign('sort_order', "order=email-DESC"); ?>
              <?php endif; ?>
              <th class="sortable_col<?php if ($this->_tpl_vars['up_down']): ?> over<?php endif; ?>">
                <a href="<?php echo $this->_tpl_vars['same_page']; ?>
?<?php echo $this->_tpl_vars['sort_order']; ?>
"><?php echo $this->_tpl_vars['LANG']['word_email']; ?>
 <?php echo $this->_tpl_vars['up_down']; ?>
</a>
              </td>

              <?php $this->assign('up_down', ""); ?>
              <?php if ($this->_tpl_vars['order'] == "status-DESC"): ?>
                <?php $this->assign('sort_order', "order=status-ASC"); ?>
                <?php $this->assign('up_down', "<img src=\"".($this->_tpl_vars['theme_url'])."/images/sort_down.gif\" />"); ?>
              <?php elseif ($this->_tpl_vars['order'] == "status-ASC"): ?>
                <?php $this->assign('sort_order', "order=status-DESC"); ?>
                <?php $this->assign('up_down', "<img src=\"".($this->_tpl_vars['theme_url'])."/images/sort_up.gif\" />"); ?>
              <?php else: ?>
                <?php $this->assign('sort_order', "order=status-DESC"); ?>
              <?php endif; ?>
              <th width="70" class="sortable_col<?php if ($this->_tpl_vars['up_down']): ?> over<?php endif; ?>">
                <a href="<?php echo $this->_tpl_vars['same_page']; ?>
?<?php echo $this->_tpl_vars['sort_order']; ?>
"><?php echo $this->_tpl_vars['LANG']['word_status']; ?>
 <?php echo $this->_tpl_vars['up_down']; ?>
</a>
              </th>

              <?php $this->assign('up_down', ""); ?>
              <?php if ($this->_tpl_vars['order'] == "last_logged_in-DESC"): ?>
                <?php $this->assign('sort_order', "order=last_logged_in-ASC"); ?>
                <?php $this->assign('up_down', "<img src=\"".($this->_tpl_vars['theme_url'])."/images/sort_down.gif\" />"); ?>
              <?php elseif ($this->_tpl_vars['order'] == "last_logged_in-ASC"): ?>
                <?php $this->assign('sort_order', "order=last_logged_in-DESC"); ?>
                <?php $this->assign('up_down', "<img src=\"".($this->_tpl_vars['theme_url'])."/images/sort_up.gif\" />"); ?>
              <?php else: ?>
                <?php $this->assign('sort_order', "order=last_logged_in-DESC"); ?>
              <?php endif; ?>
              <th class="sortable_col<?php if ($this->_tpl_vars['up_down']): ?> over<?php endif; ?>">
                <a href="<?php echo $this->_tpl_vars['same_page']; ?>
?<?php echo $this->_tpl_vars['sort_order']; ?>
"><?php echo $this->_tpl_vars['LANG']['phrase_last_logged_in']; ?>
 <?php echo $this->_tpl_vars['up_down']; ?>
</a>
              </th>
              <th width="70"><?php echo ((is_array($_tmp=$this->_tpl_vars['LANG']['word_login'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
</th>
              <th class="edit"></th>
              <th class="del"></th>
            </tr>

          <?php endif; ?>

          <tr>
            <td align="center" class="medium_grey"><?php echo $this->_tpl_vars['client_id']; ?>
</td>
            <td class="pad_left_small"><?php echo $this->_tpl_vars['client_info']['first_name']; ?>
</td>
            <td class="pad_left_small"><?php echo $this->_tpl_vars['client_info']['last_name']; ?>
</td>
            <td class="pad_left_small"><a href="mailto:<?php echo $this->_tpl_vars['client_info']['email']; ?>
"><?php echo $this->_tpl_vars['client_info']['email']; ?>
</a></td>
            <td align="center">
              <?php if ($this->_tpl_vars['client_info']['account_status'] == 'active'): ?>
                <span class="light_green"><?php echo $this->_tpl_vars['LANG']['word_active']; ?>
</span>
              <?php elseif ($this->_tpl_vars['client_info']['account_status'] == 'disabled'): ?>
                <span style="color: red"><?php echo $this->_tpl_vars['LANG']['word_disabled']; ?>
</span>
              <?php elseif ($this->_tpl_vars['client_info']['account_status'] == 'pending'): ?>
                <span style="color: orange"><?php echo $this->_tpl_vars['LANG']['word_pending']; ?>
</span>
              <?php endif; ?>
            </td>
            <td class="pad_left_small">
              <?php if ($this->_tpl_vars['client_info']['last_logged_in'] != ""): ?>
               <?php echo ((is_array($_tmp=$this->_tpl_vars['client_info']['last_logged_in'])) ? $this->_run_mod_handler('custom_format_date', true, $_tmp, $this->_tpl_vars['SESSION']['account']['timezone_offset'], $this->_tpl_vars['SESSION']['account']['date_format']) : smarty_modifier_custom_format_date($_tmp, $this->_tpl_vars['SESSION']['account']['timezone_offset'], $this->_tpl_vars['SESSION']['account']['date_format'])); ?>

              <?php else: ?>
                <span class="medium_grey"><?php echo $this->_tpl_vars['LANG']['word_never']; ?>
</span>
              <?php endif; ?>
            </td>
            <td align="center"><a href="<?php echo $this->_tpl_vars['same_page']; ?>
?login=<?php echo $this->_tpl_vars['client_id']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['LANG']['word_login'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
</a></td>
            <td class="edit"><a href="edit.php?client_id=<?php echo $this->_tpl_vars['client_id']; ?>
"> </a></td>
            <td class="del"><a href="#" onclick="return page_ns.delete_client(<?php echo $this->_tpl_vars['client_id']; ?>
)"></a></td>
          </tr>

        <?php if ($this->_tpl_vars['count'] != 1 && ( $this->_tpl_vars['count'] % $this->_tpl_vars['settings']['num_clients_per_page'] ) == 0): ?>
          </table></div>
          <?php $this->assign('table_group_id', $this->_tpl_vars['table_group_id']+1); ?>
        <?php endif; ?>

      <?php endforeach; endif; unset($_from); ?>

            <?php if (( count($this->_tpl_vars['clients']) % $this->_tpl_vars['settings']['num_clients_per_page'] ) != 0): ?>
        </table></div>
      <?php endif; ?>

    <?php endif; ?>
    </form>

  <?php endif; ?>

  <?php echo smarty_function_template_hook(array('location' => 'admin_list_clients_bottom'), $this);?>


  <form method="post" action="add.php">
    <p>
      <input type="submit" value="<?php echo $this->_tpl_vars['LANG']['phrase_add_client']; ?>
" />
    </p>
  </form>

<?php echo smarty_function_ft_include(array('file' => "footer.tpl"), $this);?>