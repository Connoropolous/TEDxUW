<?php /* Smarty version 2.6.18, created on 2012-10-14 20:45:00
         compiled from C:%5CUsers%5CConnor%5CDocuments%5CCodeCraft%5CTEDxUW%5Cformtools/themes/default/tabset_open.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'in_array', 'C:\\Users\\Connor\\Documents\\CodeCraft\\TEDxUW\\formtools/themes/default/tabset_open.tpl', 7, false),array('modifier', 'default', 'C:\\Users\\Connor\\Documents\\CodeCraft\\TEDxUW\\formtools/themes/default/tabset_open.tpl', 17, false),)), $this); ?>
  <ul class="main_tabset">
    <?php $_from = $this->_tpl_vars['tabs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['curr_tab_key'] => $this->_tpl_vars['curr_tab']):
?>
            <?php if ($this->_tpl_vars['curr_tab_key'] == $this->_tpl_vars['page'] || ( is_array ( $this->_tpl_vars['curr_tab']['pages'] ) && ((is_array($_tmp=$this->_tpl_vars['page'])) ? $this->_run_mod_handler('in_array', true, $_tmp, $this->_tpl_vars['curr_tab']['pages']) : in_array($_tmp, $this->_tpl_vars['curr_tab']['pages'])) ) || $this->_tpl_vars['tab_number'] == $this->_tpl_vars['curr_tab_key']): ?>
        <li class="selected"><a href="<?php echo $this->_tpl_vars['curr_tab']['tab_link']; ?>
"><?php echo $this->_tpl_vars['curr_tab']['tab_label']; ?>
</a></li>
      <?php else: ?>
        <li><a href="<?php echo $this->_tpl_vars['curr_tab']['tab_link']; ?>
"><?php echo $this->_tpl_vars['curr_tab']['tab_label']; ?>
</a></li>
      <?php endif; ?>
    <?php endforeach; endif; unset($_from); ?>
  </ul>

  <div class="prevnext_links">
    <?php if ($this->_tpl_vars['show_tabset_nav_links']): ?>
      <?php $this->assign('prev_label', ((is_array($_tmp=@$this->_tpl_vars['prev_tabset_link_label'])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['LANG']['word_previous_leftarrow']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['LANG']['word_previous_leftarrow']))); ?>
      <?php if ($this->_tpl_vars['prev_tabset_link']): ?>
        <span><a href="<?php echo $this->_tpl_vars['prev_tabset_link']; ?>
"><?php echo $this->_tpl_vars['prev_label']; ?>
</a></span>
      <?php else: ?>
        <span class="no_link"><?php echo $this->_tpl_vars['prev_label']; ?>
</span>
      <?php endif; ?>

      <?php $this->assign('next_label', ((is_array($_tmp=@$this->_tpl_vars['next_tabset_link_label'])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['LANG']['word_next_rightarrow']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['LANG']['word_next_rightarrow']))); ?>
      <?php if ($this->_tpl_vars['next_tabset_link']): ?>
        <span><a href="<?php echo $this->_tpl_vars['next_tabset_link']; ?>
"><?php echo $this->_tpl_vars['next_label']; ?>
</a></span>
      <?php else: ?>
        <span class="no_link"><?php echo $this->_tpl_vars['next_label']; ?>
</span>
      <?php endif; ?>
    <?php endif; ?>
  </div>

  <div class="clear"></div>
  <div class="tab_content">