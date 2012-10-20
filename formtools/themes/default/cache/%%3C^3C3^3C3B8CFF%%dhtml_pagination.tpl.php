<?php /* Smarty version 2.6.18, created on 2012-10-14 20:23:12
         compiled from C:%5CUsers%5CConnor%5CDocuments%5CCodeCraft%5CTEDxUW%5Cformtools/themes/default/dhtml_pagination.tpl */ ?>

<div class="margin_bottom_large">
  <?php echo $this->_tpl_vars['LANG']['phrase_total_results_c']; ?>
 <b><?php echo $this->_tpl_vars['num_results']; ?>
</b>&nbsp;

    <?php echo $this->_tpl_vars['viewing_range']; ?>


  <?php if ($this->_tpl_vars['total_pages'] > 1): ?>
    <div id="list_nav"><?php echo $this->_tpl_vars['LANG']['word_page_c']; ?>


        <span id="nav_previous_page">
      <?php if ($this->_tpl_vars['current_page'] != 1): ?>
        <?php $this->assign('previous_page', $this->_tpl_vars['current_page']-1); ?>
        <a href="javascript:ft.display_dhtml_page_nav(<?php echo $this->_tpl_vars['num_results']; ?>
, <?php echo $this->_tpl_vars['num_per_page']; ?>
, <?php echo $this->_tpl_vars['previous_page']; ?>
)">&laquo;</a>
      <?php else: ?>
        &laquo;
      <?php endif; ?>
    </span>

    <?php unset($this->_sections['counter']);
$this->_sections['counter']['name'] = 'counter';
$this->_sections['counter']['start'] = (int)1;
$this->_sections['counter']['loop'] = is_array($_loop=$this->_tpl_vars['total_pages']+1) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['counter']['show'] = true;
$this->_sections['counter']['max'] = $this->_sections['counter']['loop'];
$this->_sections['counter']['step'] = 1;
if ($this->_sections['counter']['start'] < 0)
    $this->_sections['counter']['start'] = max($this->_sections['counter']['step'] > 0 ? 0 : -1, $this->_sections['counter']['loop'] + $this->_sections['counter']['start']);
else
    $this->_sections['counter']['start'] = min($this->_sections['counter']['start'], $this->_sections['counter']['step'] > 0 ? $this->_sections['counter']['loop'] : $this->_sections['counter']['loop']-1);
if ($this->_sections['counter']['show']) {
    $this->_sections['counter']['total'] = min(ceil(($this->_sections['counter']['step'] > 0 ? $this->_sections['counter']['loop'] - $this->_sections['counter']['start'] : $this->_sections['counter']['start']+1)/abs($this->_sections['counter']['step'])), $this->_sections['counter']['max']);
    if ($this->_sections['counter']['total'] == 0)
        $this->_sections['counter']['show'] = false;
} else
    $this->_sections['counter']['total'] = 0;
if ($this->_sections['counter']['show']):

            for ($this->_sections['counter']['index'] = $this->_sections['counter']['start'], $this->_sections['counter']['iteration'] = 1;
                 $this->_sections['counter']['iteration'] <= $this->_sections['counter']['total'];
                 $this->_sections['counter']['index'] += $this->_sections['counter']['step'], $this->_sections['counter']['iteration']++):
$this->_sections['counter']['rownum'] = $this->_sections['counter']['iteration'];
$this->_sections['counter']['index_prev'] = $this->_sections['counter']['index'] - $this->_sections['counter']['step'];
$this->_sections['counter']['index_next'] = $this->_sections['counter']['index'] + $this->_sections['counter']['step'];
$this->_sections['counter']['first']      = ($this->_sections['counter']['iteration'] == 1);
$this->_sections['counter']['last']       = ($this->_sections['counter']['iteration'] == $this->_sections['counter']['total']);
?>
      <?php $this->assign('page', $this->_sections['counter']['index']); ?>

      <span id="nav_page_<?php echo $this->_tpl_vars['page']; ?>
">
        <?php if ($this->_tpl_vars['page'] == $this->_tpl_vars['current_page']): ?>
          <span id="list_current_page"><b><?php echo $this->_tpl_vars['page']; ?>
</b></span>
        <?php else: ?>
          <span class="pad_right_small"><a href="javascript:ft.display_dhtml_page_nav(<?php echo $this->_tpl_vars['num_results']; ?>
, <?php echo $this->_tpl_vars['num_per_page']; ?>
, <?php echo $this->_tpl_vars['page']; ?>
)"><?php echo $this->_tpl_vars['page']; ?>
</a></span>
        <?php endif; ?>
      </span>
    <?php endfor; endif; ?>

        <span id="nav_next_page">

      <?php if ($this->_tpl_vars['current_page'] != $this->_tpl_vars['total_pages']): ?>
        <?php $this->assign('next_page', $this->_tpl_vars['current_page']+1); ?>
        <a href="javascript:ft.display_dhtml_page_nav(<?php echo $this->_tpl_vars['num_results']; ?>
, <?php echo $this->_tpl_vars['num_per_page']; ?>
, <?php echo $this->_tpl_vars['next_page']; ?>
)">&raquo;</a>
      <?php else: ?>
        <span id="nav_next_page">&raquo;</span>
      <?php endif; ?>

    </span>

    </div>

  <?php endif; ?>

</div>