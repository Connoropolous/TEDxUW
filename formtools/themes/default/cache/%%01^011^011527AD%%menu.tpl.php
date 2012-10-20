<?php /* Smarty version 2.6.18, created on 2012-10-14 20:22:59
         compiled from C:%5CUsers%5CConnor%5CDocuments%5CCodeCraft%5CTEDxUW%5Cformtools/themes/default/menu.tpl */ ?>


  <?php $this->assign('is_current_parent_menu', false); ?>

  <div class="menu_items">
  <?php $_from = $this->_tpl_vars['SESSION']['menu']['menu_items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>

    <?php $this->assign('link_id', ""); ?>

        <?php if ($this->_tpl_vars['i']['is_submenu'] == 'no'): ?>

            <?php if ($this->_tpl_vars['i']['url'] == $this->_tpl_vars['nav_parent_page_url']): ?>
        <?php $this->assign('is_current_parent_menu', true); ?>
      <?php else: ?>
        <?php $this->assign('is_current_parent_menu', false); ?>
      <?php endif; ?>

      <div class="nav_link"><a href="<?php echo $this->_tpl_vars['i']['url']; ?>
"<?php echo $this->_tpl_vars['link_id']; ?>
 class="no_border"><?php echo $this->_tpl_vars['i']['display_text']; ?>
</a></div>

        <?php else: ?>
      <div class="nav_link_submenu"><a href="<?php echo $this->_tpl_vars['i']['url']; ?>
"<?php echo $this->_tpl_vars['link_id']; ?>
 class="no_border">&#8212; <?php echo $this->_tpl_vars['i']['display_text']; ?>
</a></div>
    <?php endif; ?>

  <?php endforeach; endif; unset($_from); ?>
  </div>