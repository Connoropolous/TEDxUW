{include file='modules_header.tpl'}

  <table cellpadding="0" cellspacing="0">
  <tr>
    <td width="45"><a href="index.php"><img src="images/icon_pages.gif" border="0" width="34" height="34" /></a></td>
    <td class="title">
      <a href="../../admin/modules">{$LANG.word_modules}</a>
      <span class="joiner">&raquo;</span>
      {$L.module_name}
    </td>
  </tr>
  </table>

  {include file='messages.tpl'}

  <div class="margin_bottom_large">
    {$L.text_intro_para_1}
    {$text_intro_para_2}
  </div>

  {if $pages|@count == 0}

    <div class="notify yellow_bg" class="margin_bottom_large">
      <div style="padding:8px">
        {$L.notify_no_pages}
      </div>
    </div>

  {else}

    {$pagination}

    <table class="list_table" style="width:100%" cellpadding="1" cellspacing="1">
    <tr style="height: 20px;">
      <th width="20">{$LANG.word_id|upper}</th>
      <th>{$L.word_page}</th>
      <th width="100">Page Type</th>
      <th width="120">Who can Access?</th>
      <th width="60">{$LANG.word_view|upper}</th>
      <th class="edit"></th>
      <th class="del"></th>
    </tr>

    {foreach from=$pages item=page name=row}
      {assign var='index' value=$smarty.foreach.row.index}
      {assign var='count' value=$smarty.foreach.row.iteration}
      {assign var='page_id' value=$page.page_id}
      <tr>
        <td align="center" class="light_grey">{$page_id}</td>
        <td class="pad_left_small">{$page.page_name}</td>
        <td class="pad_left">
          {if $page.content_type == "html"}
            <span class="">{$LANG.word_html}</span>
          {elseif $page.content_type == "php"}
            <span class="">{$L.word_php}</span>
          {elseif $page.content_type == "smarty"}
            <span class="">{$L.word_smarty}</span>
          {/if}
        </td>
        <td class="pad_left">
          {$page_info.access_type}
          {if $page.access_type == 'admin'}
            <span class="blue">{$LANG.phrase_admin_only}</span>
          {elseif $page.access_type == 'public'}
            <span class="green">{$LANG.word_public}</span>
          {elseif $page.access_type == 'private'}
            <span class="purple">{$LANG.word_private}</span>
          {/if}
        </td>
        <td align="center"><a href="view.php?page_id={$page_id}">{$LANG.word_view|upper}</a></td>
        <td class="edit"><a href="edit.php?page_id={$page_id}"></a></td>
        <td class="del"><a href="#" onclick="return pages_ns.delete_page({$page_id})"></a></td>
      </tr>

    {/foreach}

    </table>

  {/if}

  <form action="add.php" method="post">
    <p>
      <input type="submit" value="{$L.phrase_add_page}" />
    </p>
  </form>

{include file='modules_footer.tpl'}
