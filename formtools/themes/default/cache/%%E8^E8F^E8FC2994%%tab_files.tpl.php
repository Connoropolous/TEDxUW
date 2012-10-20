<?php /* Smarty version 2.6.18, created on 2012-10-14 20:46:31
         compiled from C:%5CUsers%5CConnor%5CDocuments%5CCodeCraft%5CTEDxUW%5Cformtools/themes/default/admin/settings/tab_files.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'upper', 'C:\\Users\\Connor\\Documents\\CodeCraft\\TEDxUW\\formtools/themes/default/admin/settings/tab_files.tpl', 1, false),array('modifier', 'in_array', 'C:\\Users\\Connor\\Documents\\CodeCraft\\TEDxUW\\formtools/themes/default/admin/settings/tab_files.tpl', 71, false),array('modifier', 'escape', 'C:\\Users\\Connor\\Documents\\CodeCraft\\TEDxUW\\formtools/themes/default/admin/settings/tab_files.tpl', 125, false),array('function', 'ft_include', 'C:\\Users\\Connor\\Documents\\CodeCraft\\TEDxUW\\formtools/themes/default/admin/settings/tab_files.tpl', 3, false),array('function', 'template_hook', 'C:\\Users\\Connor\\Documents\\CodeCraft\\TEDxUW\\formtools/themes/default/admin/settings/tab_files.tpl', 131, false),)), $this); ?>
    <div class="subtitle underline margin_top_large"><?php echo ((is_array($_tmp=$this->_tpl_vars['LANG']['word_files'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
</div>

    <?php echo smarty_function_ft_include(array('file' => 'messages.tpl'), $this);?>


    <div class="margin_bottom_large">
      <?php echo $this->_tpl_vars['LANG']['text_default_file_settings_page']; ?>

    </div>

    <form action="<?php echo $this->_tpl_vars['same_page']; ?>
" method="post" name="file_upload_settings_form">
      <input type="hidden" name="page" value="files" />

      <table cellpadding="0" cellspacing="1" class="list_table" width="100%">
      <tr>
        <td width="120" class="pad_left"><?php echo $this->_tpl_vars['LANG']['phrase_upload_folder_path']; ?>
</td>
        <td>
          <input type="hidden" name="original_file_upload_dir" value="<?php echo $this->_tpl_vars['settings']['file_upload_dir']; ?>
" />
          <table cellpadding="0" cellspacing="0" width="100%">
          <tr>
            <td><input type="text" name="file_upload_dir" id="file_upload_dir" value="<?php echo $this->_tpl_vars['settings']['file_upload_dir']; ?>
" style="width: 98%" /></td>
            <td width="180">
              <input type="button" value="<?php echo $this->_tpl_vars['LANG']['phrase_test_folder_permissions']; ?>
" onclick="ft.test_folder_permissions($('#file_upload_dir').val(), 'permissions_result')" style="width: 180px;" />
            </td>
          </tr>
          </table>
          <div id="permissions_result"></div>
        </td>
      </tr>
      <tr>
        <td class="pad_left"><?php echo $this->_tpl_vars['LANG']['phrase_upload_folder_url']; ?>
</td>
        <td>
          <table cellpadding="0" cellspacing="0" width="100%">
          <tr>
            <td><input type="text" name="file_upload_url" id="file_upload_url" value="<?php echo $this->_tpl_vars['settings']['file_upload_url']; ?>
" style="width: 98%" /></td>
            <?php if ($this->_tpl_vars['allow_url_fopen']): ?>
              <td width="150"><input type="button" value="<?php echo $this->_tpl_vars['LANG']['phrase_confirm_folder_url_match']; ?>
" onclick="ft.test_folder_url_match($('#file_upload_dir').val(), $('#file_upload_url').val(), 'folder_match_message_id')" style="width: 180px;" /></td>
            <?php endif; ?>
          </tr>
          </table>
          <div id="folder_match_message_id"></div>
        </td>
      </tr>
      <tr>
        <td class="pad_left"><?php echo $this->_tpl_vars['LANG']['phrase_max_file_size']; ?>
</td>
        <td>
          <select name="file_upload_max_size">
            <?php if ($this->_tpl_vars['max_filesize'] >= 20): ?><option value="20"   <?php if ($this->_tpl_vars['settings']['file_upload_max_size'] == 20): ?>selected<?php endif; ?>>20 KB</option><?php endif; ?>
            <?php if ($this->_tpl_vars['max_filesize'] >= 50): ?><option value="50"   <?php if ($this->_tpl_vars['settings']['file_upload_max_size'] == 50): ?>selected<?php endif; ?>>50 KB</option><?php endif; ?>
            <?php if ($this->_tpl_vars['max_filesize'] >= 100): ?><option value="100"  <?php if ($this->_tpl_vars['settings']['file_upload_max_size'] == 100): ?>selected<?php endif; ?>>100 KB</option><?php endif; ?>
            <?php if ($this->_tpl_vars['max_filesize'] >= 200): ?><option value="200"  <?php if ($this->_tpl_vars['settings']['file_upload_max_size'] == 200): ?>selected<?php endif; ?>>200 KB</option><?php endif; ?>
            <?php if ($this->_tpl_vars['max_filesize'] >= 300): ?><option value="300"  <?php if ($this->_tpl_vars['settings']['file_upload_max_size'] == 300): ?>selected<?php endif; ?>>300 KB</option><?php endif; ?>
            <?php if ($this->_tpl_vars['max_filesize'] >= 500): ?><option value="500"  <?php if ($this->_tpl_vars['settings']['file_upload_max_size'] == 500): ?>selected<?php endif; ?>>1/2 MB</option><?php endif; ?>
            <?php if ($this->_tpl_vars['max_filesize'] >= 1000): ?><option value="1000" <?php if ($this->_tpl_vars['settings']['file_upload_max_size'] == 1000): ?>selected<?php endif; ?>>1 MB</option><?php endif; ?>
            <?php if ($this->_tpl_vars['max_filesize'] >= 2000): ?><option value="2000" <?php if ($this->_tpl_vars['settings']['file_upload_max_size'] == 2000): ?>selected<?php endif; ?>>2 MB</option><?php endif; ?>
            <?php if ($this->_tpl_vars['max_filesize'] >= 3000): ?><option value="3000" <?php if ($this->_tpl_vars['settings']['file_upload_max_size'] == 2000): ?>selected<?php endif; ?>>3 MB</option><?php endif; ?>
            <?php if ($this->_tpl_vars['max_filesize'] >= 5000): ?><option value="5000" <?php if ($this->_tpl_vars['settings']['file_upload_max_size'] == 5000): ?>selected<?php endif; ?>>5 MB</option><?php endif; ?>
            <?php if ($this->_tpl_vars['max_filesize'] >= 10000): ?><option value="10000" <?php if ($this->_tpl_vars['settings']['file_upload_max_size'] == 10000): ?>selected<?php endif; ?>>10 MB</option><?php endif; ?>
            <?php if ($this->_tpl_vars['max_filesize'] > 5000): ?><option value="<?php echo $this->_tpl_vars['max_filesize']; ?>
" <?php if ($this->_tpl_vars['settings']['file_upload_max_size'] == $this->_tpl_vars['max_filesize']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['max_filesize']/1000; ?>
 MB</option><?php endif; ?>
          </select>
          <span class="pad_left light_grey"><?php echo $this->_tpl_vars['LANG']['phrase_php_ini_max_allowed_upload_size_c']; ?>
 <?php echo $this->_tpl_vars['max_filesize']/1000; ?>
 MB</span>

        </td>
      </tr>
      <tr>
        <td class="pad_left"><?php echo $this->_tpl_vars['LANG']['phrase_permitted_file_types']; ?>
</td>
        <td>

          <table cellspacing="0" cellpadding="0">
          <tr>
            <td width="90" class="subpanel">
              <div class="bold nowrap"><?php echo $this->_tpl_vars['LANG']['phrase_images_media']; ?>
</div>
              <input type="checkbox" name="file_upload_filetypes[]" value="bmp" id="bmp" <?php if (((is_array($_tmp='bmp')) ? $this->_run_mod_handler('in_array', true, $_tmp, $this->_tpl_vars['file_upload_filetypes']) : in_array($_tmp, $this->_tpl_vars['file_upload_filetypes']))): ?>checked="checked"<?php endif; ?> />
                <label for="bmp">bmp</label><br />
              <input type="checkbox" name="file_upload_filetypes[]" value="gif" id="gif" <?php if (((is_array($_tmp='gif')) ? $this->_run_mod_handler('in_array', true, $_tmp, $this->_tpl_vars['file_upload_filetypes']) : in_array($_tmp, $this->_tpl_vars['file_upload_filetypes']))): ?>checked="checked"<?php endif; ?> />
                <label for="gif">gif</label><br />
              <input type="checkbox" name="file_upload_filetypes[]" value="jpg,jpeg" id="jpg" <?php if (((is_array($_tmp='jpg')) ? $this->_run_mod_handler('in_array', true, $_tmp, $this->_tpl_vars['file_upload_filetypes']) : in_array($_tmp, $this->_tpl_vars['file_upload_filetypes']))): ?>checked="checked"<?php endif; ?> />
                <label for="jpg">jpg / jpeg</label><br />
              <input type="checkbox" name="file_upload_filetypes[]" value="png" id="png" <?php if (((is_array($_tmp='png')) ? $this->_run_mod_handler('in_array', true, $_tmp, $this->_tpl_vars['file_upload_filetypes']) : in_array($_tmp, $this->_tpl_vars['file_upload_filetypes']))): ?>checked="checked"<?php endif; ?> />
                <label for="png">png</label><br />
              <input type="checkbox" name="file_upload_filetypes[]" value="avi" id="avi" <?php if (((is_array($_tmp='avi')) ? $this->_run_mod_handler('in_array', true, $_tmp, $this->_tpl_vars['file_upload_filetypes']) : in_array($_tmp, $this->_tpl_vars['file_upload_filetypes']))): ?>checked="checked"<?php endif; ?> />
                <label for="avi">avi</label><br />
              <input type="checkbox" name="file_upload_filetypes[]" value="mp3" id="mp3" <?php if (((is_array($_tmp='mp3')) ? $this->_run_mod_handler('in_array', true, $_tmp, $this->_tpl_vars['file_upload_filetypes']) : in_array($_tmp, $this->_tpl_vars['file_upload_filetypes']))): ?>checked="checked"<?php endif; ?> />
                <label for="mp3">mp3</label><br />
              <input type="checkbox" name="file_upload_filetypes[]" value="mp4" id="mp4" <?php if (((is_array($_tmp='mp4')) ? $this->_run_mod_handler('in_array', true, $_tmp, $this->_tpl_vars['file_upload_filetypes']) : in_array($_tmp, $this->_tpl_vars['file_upload_filetypes']))): ?>checked="checked"<?php endif; ?> />
                <label for="mp4">mp4</label>
            </td>
            <td valign="top" width="90" class="subpanel">
              <div class="bold nowrap"><?php echo $this->_tpl_vars['LANG']['word_web']; ?>
</div>
              <input type="checkbox" name="file_upload_filetypes[]" value="css" id="css" <?php if (((is_array($_tmp='css')) ? $this->_run_mod_handler('in_array', true, $_tmp, $this->_tpl_vars['file_upload_filetypes']) : in_array($_tmp, $this->_tpl_vars['file_upload_filetypes']))): ?>checked="checked"<?php endif; ?> />
                <label for="css">css</label><br />
              <input type="checkbox" name="file_upload_filetypes[]" value="js" id="js" <?php if (((is_array($_tmp='js')) ? $this->_run_mod_handler('in_array', true, $_tmp, $this->_tpl_vars['file_upload_filetypes']) : in_array($_tmp, $this->_tpl_vars['file_upload_filetypes']))): ?>checked="checked"<?php endif; ?> />
                <label for="js">js</label><br />
              <input type="checkbox" name="file_upload_filetypes[]" value="html,htm" id="html" <?php if (((is_array($_tmp='js')) ? $this->_run_mod_handler('in_array', true, $_tmp, $this->_tpl_vars['file_upload_filetypes']) : in_array($_tmp, $this->_tpl_vars['file_upload_filetypes']))): ?>checked="checked"<?php endif; ?> />
                <label for="html">htm / html</label>
            </td>
            <td valign="top" width="90" class="subpanel">
              <div class="bold nowrap"><?php echo $this->_tpl_vars['LANG']['word_data']; ?>
</div>
              <input type="checkbox" name="file_upload_filetypes[]" value="doc" id="doc" <?php if (((is_array($_tmp='doc')) ? $this->_run_mod_handler('in_array', true, $_tmp, $this->_tpl_vars['file_upload_filetypes']) : in_array($_tmp, $this->_tpl_vars['file_upload_filetypes']))): ?>checked="checked"<?php endif; ?> />
                <label for="doc">doc</label><br />
              <input type="checkbox" name="file_upload_filetypes[]" value="rtf" id="rtf" <?php if (((is_array($_tmp='rtf')) ? $this->_run_mod_handler('in_array', true, $_tmp, $this->_tpl_vars['file_upload_filetypes']) : in_array($_tmp, $this->_tpl_vars['file_upload_filetypes']))): ?>checked="checked"<?php endif; ?> />
                <label for="rtf">rtf</label><br />
              <input type="checkbox" name="file_upload_filetypes[]" value="txt" id="txt" <?php if (((is_array($_tmp='txt')) ? $this->_run_mod_handler('in_array', true, $_tmp, $this->_tpl_vars['file_upload_filetypes']) : in_array($_tmp, $this->_tpl_vars['file_upload_filetypes']))): ?>checked="checked"<?php endif; ?> />
                <label for="txt">txt</label><br />
              <input type="checkbox" name="file_upload_filetypes[]" value="pdf" id="pdf" <?php if (((is_array($_tmp='pdf')) ? $this->_run_mod_handler('in_array', true, $_tmp, $this->_tpl_vars['file_upload_filetypes']) : in_array($_tmp, $this->_tpl_vars['file_upload_filetypes']))): ?>checked="checked"<?php endif; ?> />
                <label for="pdf">pdf</label><br />
              <input type="checkbox" name="file_upload_filetypes[]" value="xml" id="xml" <?php if (((is_array($_tmp='xml')) ? $this->_run_mod_handler('in_array', true, $_tmp, $this->_tpl_vars['file_upload_filetypes']) : in_array($_tmp, $this->_tpl_vars['file_upload_filetypes']))): ?>checked="checked"<?php endif; ?> />
                <label for="xml">xml</label><br />
              <input type="checkbox" name="file_upload_filetypes[]" value="csv" id="csv" <?php if (((is_array($_tmp='csv')) ? $this->_run_mod_handler('in_array', true, $_tmp, $this->_tpl_vars['file_upload_filetypes']) : in_array($_tmp, $this->_tpl_vars['file_upload_filetypes']))): ?>checked="checked"<?php endif; ?> />
                <label for="csv">csv</label><br />
            </td>
            <td valign="top" width="90" class="subpanel">
              <div class="bold nowrap"><?php echo $this->_tpl_vars['LANG']['word_misc']; ?>
</div>
              <input type="checkbox" name="file_upload_filetypes[]" value="zip" id="zip" <?php if (((is_array($_tmp='zip')) ? $this->_run_mod_handler('in_array', true, $_tmp, $this->_tpl_vars['file_upload_filetypes']) : in_array($_tmp, $this->_tpl_vars['file_upload_filetypes']))): ?>checked="checked"<?php endif; ?> />
                <label for="zip">zip</label><br />
              <input type="checkbox" name="file_upload_filetypes[]" value="tar,tar.gz" id="tar" <?php if (((is_array($_tmp='tar')) ? $this->_run_mod_handler('in_array', true, $_tmp, $this->_tpl_vars['file_upload_filetypes']) : in_array($_tmp, $this->_tpl_vars['file_upload_filetypes']))): ?>checked="checked"<?php endif; ?> />
                <label for="tar">tar / tar.gz</label><br />
              <input type="checkbox" name="file_upload_filetypes[]" value="swf" id="swf" <?php if (((is_array($_tmp='swf')) ? $this->_run_mod_handler('in_array', true, $_tmp, $this->_tpl_vars['file_upload_filetypes']) : in_array($_tmp, $this->_tpl_vars['file_upload_filetypes']))): ?>checked="checked"<?php endif; ?> />
                <label for="swf">swf</label><br />
              <input type="checkbox" name="file_upload_filetypes[]" value="fla" id="fla" <?php if (((is_array($_tmp='fla')) ? $this->_run_mod_handler('in_array', true, $_tmp, $this->_tpl_vars['file_upload_filetypes']) : in_array($_tmp, $this->_tpl_vars['file_upload_filetypes']))): ?>checked="checked"<?php endif; ?> />
                <label for="fla">fla</label>
            </td>
          </tr>
          </table>

          <div class="pad_left_small pad_top">
            <div><?php echo $this->_tpl_vars['LANG']['word_other_c']; ?>
<input type="text" name="file_upload_filetypes_other" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['other_filetypes'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" style="width: 480px" /></div>
            <div class="pad_top_small medium_grey"><?php echo $this->_tpl_vars['LANG']['text_file_extension_info']; ?>
</div>
          </div>

        </td>
      </tr>
      <?php echo smarty_function_template_hook(array('location' => 'admin_settings_files_bottom'), $this);?>

      </table>

      <p>
        <input type="submit" name="update_files" value="<?php echo $this->_tpl_vars['LANG']['word_update']; ?>
" />
      </p>
    </form>