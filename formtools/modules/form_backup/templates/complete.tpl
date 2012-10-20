{include file='modules_header.tpl'}

  <table cellpadding="0" cellspacing="0" class="margin_bottom_large">
  <tr>
    <td width="45"><a href="index.php"><img src="images/form_backup.gif" border="0" width="34" height="34" /></a></td>
    <td class="title">
      <a href="../">{$LANG.word_modules}</a>
      <span class="joiner">&raquo;</span>
      {$L.module_name}
    </td>
  </tr>
  </table>

  <div id="form_copier_nav">
    <div><a href="index.php">1. {$L.phrase_select_form}</a></div>
    <div>2. {$LANG.word_settings}</div>
    <div>3. {$LANG.word_complete}</div>
  </div>

  {include file='messages.tpl'}

  <p>
    <input type="button" onclick="window.location='index.php'" value="{$L.phrase_backup_another_form}" />
  </p>

{include file='modules_footer.tpl'}