{include file='modules_header.tpl'}

  <table cellpadding="0" cellspacing="0">
  <tr>
    <td width="45"><img src="images/icon.png" width="34" height="34" /></td>
    <td class="title">
      <a href="../../admin/modules">{$LANG.word_modules}</a>
      <span class="joiner">&raquo;</span>
      {$L.module_name}
    </td>
  </tr>
  </table>

  {include file="messages.tpl"}

  <div class="margin_bottom_large">
    {$L.text_module_intro}
  </div>

  <hr size="1" />

  <table cellspacing="0" class="index_link_table">
  <tr>
    <td valign="top" width="160"><a href="files.php">{$L.phrase_file_verification}</a></td>
    <td>{$L.text_file_check} {$L.text_problems_identified_not_fixed}</td>
  </tr>
  <tr>
    <td valign="top"><a href="tables.php">{$L.phrase_table_verification}</a></td>
    <td>{$L.text_table_verification_intro} {$L.text_problems_identified_not_fixed}</td>
  </tr>
  <tr>
    <td valign="top"><a href="hooks.php">{$L.phrase_hook_verification}</a></td>
    <td>{$L.text_hook_verification_intro} {$L.text_problems_identified_and_fixed}</td>
  </tr>
  <tr>
    <td valign="top" class="rowN"><a href="orphans.php">{$L.phrase_orphan_clean_up}</a></td>
    <td>{$L.text_orphan_desc_short} {$L.text_problems_identified_and_fixed}</td>
  </tr>
  </table>

{include file='modules_footer.tpl'}