<?php /* Smarty version 2.6.18, created on 2012-10-20 17:28:08
         compiled from /Users/lucaszw/Sites/TEDxUW/formtools/themes/default/pagination.tpl */ ?>

<div class="margin_bottom_large">
  <?php if ($this->_tpl_vars['show_total_results']): ?>
    <?php echo $this->_tpl_vars['LANG']['phrase_total_results_c']; ?>
 <b><?php echo $this->_tpl_vars['num_results']; ?>
</b>&nbsp;

        <?php echo $this->_tpl_vars['viewing_range']; ?>

  <?php endif; ?>

  <?php if ($this->_tpl_vars['total_pages'] > 1): ?>
    <div id="list_nav">
      <?php if ($this->_tpl_vars['show_page_label']): ?>
        <?php echo $this->_tpl_vars['LANG']['word_page_c']; ?>

      <?php endif; ?>

            <?php if ($this->_tpl_vars['current_page'] != 1): ?>
        <?php $this->assign('previous_page', $this->_tpl_vars['current_page']-1); ?>
        <a href="<?php echo $this->_tpl_vars['same_page']; ?>
?<?php echo $this->_tpl_vars['page_str']; ?>
=<?php echo $this->_tpl_vars['previous_page']; ?>
<?php echo $this->_tpl_vars['query_str']; ?>
">&laquo;</a>
      <?php endif; ?>

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

        <?php if ($this->_tpl_vars['page'] >= $this->_tpl_vars['first_page'] && $this->_tpl_vars['page'] <= $this->_tpl_vars['last_page']): ?>
          <?php if ($this->_tpl_vars['page'] == $this->_tpl_vars['current_page']): ?>
            <span id="list_current_page"><b><?php echo $this->_tpl_vars['page']; ?>
</b></span>
          <?php else: ?>
            <span class="pad_right_small"><a href="<?php echo $this->_tpl_vars['same_page']; ?>
?<?php echo $this->_tpl_vars['page_str']; ?>
=<?php echo $this->_tpl_vars['page']; ?>
<?php echo $this->_tpl_vars['query_str']; ?>
"><?php echo $this->_tpl_vars['page']; ?>
</a></span>
          <?php endif; ?>
        <?php endif; ?>
      <?php endfor; endif; ?>

            <?php if ($this->_tpl_vars['current_page'] < $this->_tpl_vars['total_pages']): ?>
        <?php $this->assign('next_page', $this->_tpl_vars['current_page']+1); ?>
        <a href="<?php echo $this->_tpl_vars['same_page']; ?>
?<?php echo $this->_tpl_vars['page_str']; ?>
=<?php echo $this->_tpl_vars['next_page']; ?>
<?php echo $this->_tpl_vars['query_str']; ?>
">&raquo;</a>
      <?php endif; ?>

    </div>

  <?php endif; ?>

</div>