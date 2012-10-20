<?php /* Smarty version 2.6.18, created on 2012-10-21 00:09:53
         compiled from C:%5CUsers%5CConnor%5CDocuments%5CCodeCraft%5CTEDxUW%5Cformtools/themes/default/admin/forms/tab_edit_view.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'upper', 'C:\\Users\\Connor\\Documents\\CodeCraft\\TEDxUW\\formtools/themes/default/admin/forms/tab_edit_view.tpl', 7, false),array('function', 'ft_include', 'C:\\Users\\Connor\\Documents\\CodeCraft\\TEDxUW\\formtools/themes/default/admin/forms/tab_edit_view.tpl', 10, false),)), $this); ?>
    <div class="previous_page_icon">
      <a href="edit.php?page=views"><img src="<?php echo $this->_tpl_vars['images_url']; ?>
/up.jpg" title="<?php echo $this->_tpl_vars['LANG']['phrase_previous_page']; ?>
" alt="<?php echo $this->_tpl_vars['LANG']['phrase_previous_page']; ?>
" border="0" /></a>
    </div>

    <div class="underline margin_top_large">
      <div style="float:right; padding-right: 20px; margin-top: -4px;"><?php echo $this->_tpl_vars['previous_view_link']; ?>
 &nbsp; <?php echo $this->_tpl_vars['next_view_link']; ?>
</div>
      <span class="subtitle"><a href="edit.php?page=views"><?php echo ((is_array($_tmp=$this->_tpl_vars['LANG']['word_views'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
</a></span> &raquo; <span><?php echo $this->_tpl_vars['view_info']['view_name']; ?>
</span>
    </div>

    <?php echo smarty_function_ft_include(array('file' => 'messages.tpl'), $this);?>


    <form method="post" id="edit_view_form" action="<?php echo $this->_tpl_vars['same_page']; ?>
" onsubmit="return view_ns.process_form(this)">
      <input type="hidden" name="view_id" value="<?php echo $this->_tpl_vars['view_id']; ?>
" />

      <div class="inner_tabset" id="edit_view">
        <div class="tab_row fiveCols">
          <div class="inner_tab1<?php if ($this->_tpl_vars['edit_view_tab'] == 1): ?> selected<?php endif; ?>"><?php echo $this->_tpl_vars['LANG']['word_general']; ?>
</div>
          <div class="inner_tab2<?php if ($this->_tpl_vars['edit_view_tab'] == 2): ?> selected<?php endif; ?>"><?php echo $this->_tpl_vars['LANG']['word_columns']; ?>
</div>
          <div class="inner_tab3<?php if ($this->_tpl_vars['edit_view_tab'] == 3): ?> selected<?php endif; ?>"><?php echo $this->_tpl_vars['LANG']['word_fields']; ?>
</div>
          <div class="inner_tab4<?php if ($this->_tpl_vars['edit_view_tab'] == 4): ?> selected<?php endif; ?>"><?php echo $this->_tpl_vars['LANG']['word_tabs']; ?>
</div>
          <div class="inner_tab5<?php if ($this->_tpl_vars['edit_view_tab'] == 5): ?> selected<?php endif; ?>"><?php echo $this->_tpl_vars['LANG']['word_filters']; ?>
</div>
        </div>
        <div class="inner_tab_content">
          <div class="inner_tab_content1" <?php if ($this->_tpl_vars['edit_view_tab'] != 1): ?>style="display:none"<?php endif; ?>>
            <?php echo smarty_function_ft_include(array('file' => "admin/forms/tab_edit_view__main.tpl"), $this);?>

          </div>
          <div class="inner_tab_content2" <?php if ($this->_tpl_vars['edit_view_tab'] != 2): ?>style="display:none"<?php endif; ?>>
            <?php echo smarty_function_ft_include(array('file' => "admin/forms/tab_edit_view__list_page.tpl"), $this);?>

          </div>
          <div class="inner_tab_content3" <?php if ($this->_tpl_vars['edit_view_tab'] != 3): ?>style="display:none"<?php endif; ?>>
            <?php echo smarty_function_ft_include(array('file' => "admin/forms/tab_edit_view__fields.tpl"), $this);?>

          </div>
          <div class="inner_tab_content4" <?php if ($this->_tpl_vars['edit_view_tab'] != 4): ?>style="display:none"<?php endif; ?>>
            <?php echo smarty_function_ft_include(array('file' => "admin/forms/tab_edit_view__tabs.tpl"), $this);?>

          </div>
          <div class="inner_tab_content5" <?php if ($this->_tpl_vars['edit_view_tab'] != 5): ?>style="display:none"<?php endif; ?>>
            <?php echo smarty_function_ft_include(array('file' => "admin/forms/tab_edit_view__filters.tpl"), $this);?>

          </div>
        </div>
      </div>

      <p>
        <input type="submit" name="update_view" value="<?php echo $this->_tpl_vars['LANG']['phrase_update_view']; ?>
" />
      </p>
    </form>