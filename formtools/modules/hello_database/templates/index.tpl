{include file='modules_header.tpl'}

  <table cellpadding="0" cellspacing="0">
  <tr>
    <td width="45"><a href="index.php"><img src="images/icon_hello_database.png" border="0" width="34" height="34" /></a></td>
    <td class="title">
      <a href="../../admin/modules">{$LANG.word_modules}</a>
      <span class="joiner">&raquo;</span>
      {$L.phrase_hello_database}
    </td>
  </tr>
  </table>

  <p>
    {$L.text_random_nums}
    <span class="medium_grey">{$random_numbers}</span>
  </p>

  <p class="italic">
    {$L.phrase_look_at_code}
  </p>

{include file='modules_footer.tpl'}