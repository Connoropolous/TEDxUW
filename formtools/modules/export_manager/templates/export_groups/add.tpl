{include file='modules_header.tpl'}

  <table cellpadding="0" cellspacing="0" class="margin_bottom_large">
  <tr>
    <td width="45"><a href="../"><img src="../images/icon_export.gif" border="0" width="34" height="34" /></a></td>
    <td class="title">
      <a href="../../../admin/modules">{$LANG.word_modules}</a>
      <span class="joiner">&raquo;</span>
      <a href="../">{$L.module_name}</a>
      <span class="joiner">&raquo;</span>
      {$L.phrase_add_export_group}
    </td>
  </tr>
  </table>

  <div class="margin_bottom_large">
    {$L.text_export_group_summary}
  </div>

  {include file='messages.tpl'}

  <form action="../" method="post" onsubmit="return rsv.validate(this, rules)">

    <table border="0" width="500" class="add_export_group_table">
    <tr>
      <td width="130" class="medium_grey">{$L.phrase_export_group_name}</td>
      <td>
        <input type="text" name="group_name" value="" style="width:200px" maxlength="50" />
      </td>
    </tr>
    <tr>
      <td class="medium_grey">{$L.word_visibility}</td>
      <td>
        <input type="radio" name="visibility" value="show" id="st1" checked />
          <label for="st1" class="green">{$LANG.word_show}</label>
        <input type="radio" name="visibility" value="hide" id="st2" />
          <label for="st2" class="red">{$LANG.word_hide}</label>
      </td>
    </tr>
    <tr>
      <td valign="top" class="medium_grey">{$L.word_icon}</td>
      <td>
        <input type="hidden" name="icon" id="icon" value="" />
		<ul class="icon_list">
		  <li class="no_icon selected"></li>
	      {foreach from=$icons item=icon name=i}
	        {assign var=index value=$smarty.foreach.i.iteration}
	        <li><img src="{$g_root_url}/modules/export_manager/images/icons/{$icon}" /></li>
	        {/foreach}
		</ul>
      </td>
    </tr>
    </table>

    <p>
      <input type="submit" name="add_export_group" value="{$L.phrase_add_export_group}" />
    </p>

  </form>

{include file='modules_footer.tpl'}