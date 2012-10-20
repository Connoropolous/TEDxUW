<?php /* Smarty version 2.6.18, created on 2012-10-21 00:09:53
         compiled from C:%5CUsers%5CConnor%5CDocuments%5CCodeCraft%5CTEDxUW%5Cformtools/themes/default/admin/forms/tab_edit_view__tabs.tpl */ ?>
  <div class="hint margin_bottom_large">
    <?php echo $this->_tpl_vars['LANG']['text_edit_tab_summary']; ?>

  </div>

  <table class="list_table" cellpadding="0" cellspacing="1" id="tab_options_table" style="width: 350px; float: left">
    <tr>
      <th width="40"><?php echo $this->_tpl_vars['LANG']['word_tab']; ?>
</th>
      <th><?php echo $this->_tpl_vars['LANG']['phrase_tab_label']; ?>
</th>
    </tr>
    <tr>
      <td align="center">1</td>
      <td><input type="text" name="tabs[]" id="tab_label1" class="tab_label" value="<?php echo $this->_tpl_vars['view_tabs'][1]['tab_label']; ?>
" maxlength="50" /></td>
    </tr>
    <tr>
      <td align="center">2</td>
      <td><input type="text" name="tabs[]" id="tab_label2" class="tab_label" value="<?php echo $this->_tpl_vars['view_tabs'][2]['tab_label']; ?>
" maxlength="50" /></td>
    </tr>
    <tr>
      <td align="center">3</td>
      <td><input type="text" name="tabs[]" id="tab_label3" class="tab_label" value="<?php echo $this->_tpl_vars['view_tabs'][3]['tab_label']; ?>
" maxlength="50" /></td>
    </tr>
    <tr>
      <td align="center">4</td>
      <td><input type="text" name="tabs[]" id="tab_label4" class="tab_label" value="<?php echo $this->_tpl_vars['view_tabs'][4]['tab_label']; ?>
" maxlength="50" /></td>
    </tr>
    <tr>
      <td align="center">5</td>
      <td><input type="text" name="tabs[]" id="tab_label5" class="tab_label" value="<?php echo $this->_tpl_vars['view_tabs'][5]['tab_label']; ?>
" maxlength="50" /></td>
    </tr>
    <tr>
      <td align="center">6</td>
      <td><input type="text" name="tabs[]" id="tab_label6" class="tab_label" value="<?php echo $this->_tpl_vars['view_tabs'][6]['tab_label']; ?>
" maxlength="50" /></td>
    </tr>
  </table>

  <input type="button" value="<?php echo $this->_tpl_vars['LANG']['phrase_remove_tabs']; ?>
" onclick="view_ns.remove_tabs()" style="margin-left: 10px; float: left" />

  <div class="clear"></div>