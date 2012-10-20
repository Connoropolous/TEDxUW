{include file='modules_header.tpl'}

  <table cellpadding="0" cellspacing="0">
  <tr>
    <td width="45"><a href="index.php"><img src="images/form_backup.gif" border="0" width="34" height="34" /></a></td>
    <td class="title">
      <a href="../">{$LANG.word_modules}</a>
      <span class="joiner">&raquo;</span>
      <a href="./">{$L.module_name}</a>
      <span class="joiner">&raquo;</span>
      {$LANG.word_settings}
    </td>
  </tr>
  </table>

  {include file='messages.tpl'}

  <form action="{$same_page}" method="post">

    <table class="list_table">
    <tr>
      <td width="200">{$L.phrase_show_create_backup_button}</td>
      <td>
        <input type="radio" name="show_backup_form_button" id="add_btn1" value="yes"
          {if $module_settings.show_backup_form_button == "yes"}checked{/if} />
          <label for="add_btn1">{$LANG.word_yes}</label>
        <input type="radio" name="show_backup_form_button" id="add_btn2" value="no"
          {if $module_settings.show_backup_form_button == "no"}checked{/if}/>
          <label for="add_btn2">{$LANG.word_no}</label>
      </td>
    </tr>
    </table>

    <p>
      <input type="submit" name="update" value="{$LANG.word_update}" />
    </p>

  </form>

{include file='modules_footer.tpl'}
