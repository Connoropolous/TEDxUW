{include file='modules_header.tpl'}

  <table cellpadding="0" cellspacing="0">
  <tr>
    <td width="45"><a href="index.php"><img src="images/icon_hello_database.png" border="0" width="34" height="34" /></a></td>
    <td class="title">
      <a href="../../admin/modules">{$LANG.word_modules}</a>
      <span class="joiner">&raquo;</span>
      <a href="./">{$L.module_name}</a>
      <span class="joiner">&raquo;</span>
      {$L.word_settings}
    </td>
  </tr>
  </table>

  {include file='messages.tpl'}

  <div class="margin_bottom_large">
    {$L.text_settings_page}
  </div>

  <form action="{$same_page}" method="post">

    <table cellspacing="0" cellpadding="1">
    <tr>
      <td class="nowrap pad_right_large">{$L.phrase_enter_any_string}</td>
      <td><input type="text" name="demo_setting" value="{$demo_setting|escape}" maxlength="50" /></td>
    </tr>
    </table>

    <p>
      <input type="submit" name="update" value="{$LANG.word_update|upper}" />
    </p>
  </form>

{include file='modules_footer.tpl'}
