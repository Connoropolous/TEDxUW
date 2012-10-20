{include file='modules_header.tpl'}

  <table cellpadding="0" cellspacing="0" class="margin_bottom_large">
  <tr>
    <td width="45"><img src="images/icon.png" width="34" height="34" /></td>
    <td class="title">
      <a href="../../admin/modules">{$LANG.word_modules}</a>
      <span class="joiner">&raquo;</span>
      <a href="./">{$L.module_name}</a>
      <span class="joiner">&raquo;</span>
      {$L.phrase_environment_info}
    </td>
  </tr>
  </table>

  {ft_include file='tabset_open.tpl'}
  {if     $page == "summary"}
    {ft_include file='../../modules/system_check/templates/env_tab_summary.tpl'}
  {elseif $page == "phpinfo"}
    {ft_include file='../../modules/system_check/templates/env_tab_phpinfo.tpl'}
  {else}
    {ft_include file='../../modules/system_check/templates/env_tab_summary.tpl'}
  {/if}
  {ft_include file='tabset_close.tpl'}

{include file='modules_footer.tpl'}