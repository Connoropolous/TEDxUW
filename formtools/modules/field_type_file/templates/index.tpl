{include file='modules_header.tpl'}

  <table cellpadding="0" cellspacing="0">
  <tr>
    <td width="45"><img src="images/file_upload_icon.png" width="34" height="34" /></td>
    <td class="title">
      <a href="../../admin/modules">{$LANG.word_modules}</a>
      <span class="joiner">&raquo;</span>
      {$L.module_name}
    </td>
  </tr>
  </table>

  {include file="messages.tpl"}

  <div class="margin_bottom_large">
    This module doesn't have a configuration section. Use the <a href="{$g_root_url}/admin/settings/index.php?page=files">Settings -> Files</a>
    page to define the default file upload settings. You can override those settings by editing any individual form field.
  </div>

{include file='modules_footer.tpl'}