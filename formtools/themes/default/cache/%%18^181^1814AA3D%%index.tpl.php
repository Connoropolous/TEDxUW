<?php /* Smarty version 2.6.18, created on 2012-10-20 17:33:41
         compiled from /Users/lucaszw/Sites/TEDxUW/formtools/themes/default/admin/forms/add/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ft_include', '/Users/lucaszw/Sites/TEDxUW/formtools/themes/default/admin/forms/add/index.tpl', 1, false),array('function', 'template_hook', '/Users/lucaszw/Sites/TEDxUW/formtools/themes/default/admin/forms/add/index.tpl', 46, false),array('modifier', 'upper', '/Users/lucaszw/Sites/TEDxUW/formtools/themes/default/admin/forms/add/index.tpl', 27, false),)), $this); ?>
<?php echo smarty_function_ft_include(array('file' => 'header.tpl'), $this);?>


  <table cellpadding="0" cellspacing="0" class="margin_bottom_large">
  <tr>
    <td width="45"><a href="../"><img src="<?php echo $this->_tpl_vars['images_url']; ?>
/icon_forms.gif" border="0" width="34" height="34" /></a></td>
    <td class="title"><a href="../"><?php echo $this->_tpl_vars['LANG']['word_forms']; ?>
</a> <span class="joiner">&raquo;</span> <?php echo $this->_tpl_vars['LANG']['phrase_add_form']; ?>
</td>
  </tr>
  </table>

  <?php if ($this->_tpl_vars['max_forms_reached']): ?>
    <div class="notify margin_bottom_large">
      <div style="padding:6px">
        <?php echo $this->_tpl_vars['notify_max_forms_reached']; ?>

      </div>
    </div>
  <?php else: ?>

	  <div class="margin_bottom_large">
	    <?php echo $this->_tpl_vars['LANG']['text_choose_form_type']; ?>

	  </div>

	  <form action="<?php echo $this->_tpl_vars['same_page']; ?>
" method="post">
	    <table width="100%">
	      <tr>
	        <td width="49%" valign="top">
	          <div class="grey_box add_form_select">
	            <span style="float:right"><input type="submit" name="internal" class="blue bold" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['LANG']['word_select'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
" /></span>
	            <div class="bold"><?php echo $this->_tpl_vars['LANG']['word_internal']; ?>
</div>
	            <div class="medium_grey">
	              <?php echo $this->_tpl_vars['LANG']['text_internal_form_desc']; ?>

	            </div>
	          </div>
	        </td>
	        <td width="2%"> </td>
	        <td width="49%" valign="top">
	          <div class="grey_box add_form_select margin_bottom_large">
	            <span style="float:right"><input type="button" id="select_external" name="external" class="blue bold" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['LANG']['word_select'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
" /></span>
	            <div class="bold"><?php echo $this->_tpl_vars['LANG']['word_external']; ?>
</div>
	            <div class="medium_grey">
	              <?php echo $this->_tpl_vars['LANG']['text_external_form_desc']; ?>

	            </div>
	          </div>
	        </td>
	      </tr>
	    </table>
	    <?php echo smarty_function_template_hook(array('location' => 'add_form_page'), $this);?>

	  </form>

	  <div id="add_external_form_dialog" class="hidden">
	    <table width="100%">
	    <tr>
	      <td valign="top" width="65"><span class="margin_top_large popup_icon popup_type_info"></span></td>
	      <td>
	        <p>
	          <?php echo $this->_tpl_vars['LANG']['text_add_form_step_1_text_1']; ?>

	        </p>
	        <ul>
	          <li><?php echo $this->_tpl_vars['LANG']['text_add_form_step_1_text_2']; ?>
</li>
	          <li><?php echo $this->_tpl_vars['LANG']['text_add_form_step_1_text_3']; ?>
</li>
	        </ul>
	        <p>
	          <?php echo $this->_tpl_vars['LANG']['text_add_form_help_link']; ?>

	        </p>
	      </td>
	    </tr>
	    </table>
	  </div>

  <?php endif; ?>

<?php echo smarty_function_ft_include(array('file' => 'footer.tpl'), $this);?>
