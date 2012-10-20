<?php /* Smarty version 2.6.18, created on 2012-10-14 20:22:59
         compiled from C:%5CUsers%5CConnor%5CDocuments%5CCodeCraft%5CTEDxUW%5Cformtools/themes/default/messages.tpl */ ?>

<?php if ($this->_tpl_vars['g_message']): ?>

  <?php if ($this->_tpl_vars['g_success']): ?>
    <?php $this->assign('class', 'notify'); ?>
    <script><?php echo '$(function() { $("#ft_message_inner").effect("highlight", {color: "#" + g.notify_colours[1] }, 1200); });'; ?>
</script>
  <?php else: ?>
    <?php $this->assign('class', 'error'); ?>
    <script><?php echo '$(function() { $("#ft_message_inner").effect("highlight", {color: "#" + g.error_colours[1] }, 1200); });'; ?>
</script>
  <?php endif; ?>

  <div id="ft_message">
    <div style="height: 8px;"> </div>
    <div class="<?php echo $this->_tpl_vars['class']; ?>
" id="ft_message_inner">
      <div style="padding:8px">
        <span style="float: right; padding-left: 5px;"><a href="#" onclick="return ft.hide_message('ft_message')">X</a></span>
        <?php echo $this->_tpl_vars['g_message']; ?>

      </div>
    </div>
  </div>

<?php else: ?>

  <div id="ft_message" style="width: 100%; display:none">
    <div style="height: 8px;"> </div>
    <div class="<?php echo $this->_tpl_vars['class']; ?>
" id="ft_message_inner"></div>
  </div>

<?php endif; ?>

<div style="height: 10px;"> </div>