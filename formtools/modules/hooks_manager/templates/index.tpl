{include file='modules_header.tpl'}

  <table cellpadding="0" cellspacing="0">
  <tr>
    <td width="45"><img src="images/icon.gif" width="34" height="34" /></td>
    <td class="title">
      <a href="../../admin/modules">{$LANG.word_modules}</a>
      <span class="joiner">&raquo;</span>
      {$L.module_name}
    </td>
  </tr>
  </table>

  {include file='messages.tpl'}

  {if $num_results == 0}

    <div class="notify" class="margin_bottom_large">
      <div style="padding:8px">
        {$L.notify_no_rules}
      </div>
    </div>

  {else}

    {$pagination}

    <table class="list_table" style="width:100%" cellpadding="1" cellspacing="1">
    <tr style="height: 20px;">
      <th>{$L.phrase_rule_name}</th>
      <th>{$L.phrase_hook_type}</th>
      <th>{$L.word_hook}</th>
      <th width="100">{$LANG.word_status}</th>
      <th class="edit"></th>
      <th class="del"></th>
    </tr>

    {foreach from=$results item=result name=row}
      {assign var=hook_id value=$result.hook_id}
      <tr>
        <td>{$result.rule_name}</td>
        <td class="pad_left_small">
          {if $result.is_custom_hook == "yes"}
            <span class="">{$LANG.word_custom}</span>
          {elseif $result.hook_type == "code"}
            <span class="">{$LANG.word_code}</span>
          {else}
            <span class="">{$L.word_template}</span>
          {/if}
        </td>
        <td>
	  {if $result.hook_type == "code"}
	    {$result.function_name}, {$result.action_location}
	  {else}
	    {$result.action_location}
	  {/if}
        </td>
        <td align="center">
          {if $result.status == "enabled"}
             <span class="green">{$LANG.word_enabled}</span>
          {else if $result.status == "disabled"}
             <span class="red">{$LANG.word_disabled}</span>
          {/if}
        </td>
        <td class="edit"><a href="edit.php?hook_id={$hook_id}"></a></td>
        <td class="del"><a href="#" onclick="return page_ns.delete_rule({$hook_id})"></a></td>
      </tr>
    {/foreach}

    </table>

  {/if}

  <form action="add.php" method="post">
    <p>
      <input type="submit" value="{$L.phrase_add_rule}" />
    </p>
  </form>

{include file='modules_footer.tpl'}