{include file='modules_header.tpl'}

  <table cellpadding="0" cellspacing="0">
  <tr>
    <td width="45"><a href="index.php"><img src="images/icon_export.gif" border="0" width="34" height="34" /></a></td>
    <td class="title">
      <a href="../../admin/modules">{$LANG.word_modules}</a>
      <span class="joiner">&raquo;</span>
      {$L.module_name}
    </td>
  </tr>
  </table>

  {include file='messages.tpl'}

  <div class="margin_bottom_large">
    {$L.text_export_manager_intro}
  </div>

  <form action="{$same_page}" method="post">
    {if $export_groups|@count == 0}
      <div class="notify yellow_bg" class="margin_bottom_large">
        <div style="padding:8px">
          {$L.notify_no_export_groups}
        </div>
      </div>
    {else}
      <div class="sortable export_group_list" id="{$sortable_id}">
        <input type="hidden" class="sortable__custom_delete_handler" value="page_ns.delete_export_group" />
        <ul class="header_row">
          <li class="col1">{$LANG.word_order}</li>
          <li class="col2">{$L.phrase_export_group}</li>
          <li class="col3">{$L.word_icon}</li>
          <li class="col4">{$L.word_visibility}</li>
          <li class="col5">{$LANG.phrase_access_type}</li>
          <li class="col6">{$L.phrase_num_export_types}</li>
          <li class="col7 edit"></li>
          <li class="col8 colN del"></li>
        </ul>
        <div class="clear"></div>
        <ul class="rows" id="rows">
        {foreach from=$export_groups item=group name=row}
          {assign var='index' value=$smarty.foreach.row.index}
          {assign var='count' value=$smarty.foreach.row.iteration}
          {assign var='export_group_id' value=$group.export_group_id}
          <li class="sortable_row">
            <div class="row_content">
              <div class="row_group{if $smarty.foreach.row.last} rowN{/if}">
                <input type="hidden" class="sr_order" value="{$export_group_id}" />
                <ul>
                  <li class="col1 sort_col">{$count}</li>
                  <li class="col2">{eval var=$group.group_name}</li>
                  <li class="col3">{if $group.icon}<img src="images/icons/{$group.icon}" />{/if}</li>
                  <li class="col4">
                    {if $group.visibility == "show"}
                      <span class="green">{$LANG.word_show}</span>
                    {else}
                      <span class="red">{$LANG.word_hide}</span>
                    {/if}
                  </li>
                  <li class="col5">
                    {if $group.access_type == 'admin'}
                      {$LANG.phrase_admin_only}
                    {elseif $group.access_type == 'public'}
                      {$LANG.word_public}
                    {elseif $group.access_type == 'private'}
                      {$LANG.word_private}
                    {/if}
                  </li>
                  <li class="col6 check_area"><a href="export_groups/edit.php?page=export_types&export_group_id={$export_group_id}">{$group.num_export_types}</a></li>
                  <li class="col7 edit"><a href="export_groups/edit.php?page=main&export_group_id={$export_group_id}"></a></li>
                  <li class="col8 colN del"></li>
                </ul>
                <div class="clear"></div>
              </div>
            </div>
            <div class="clear"></div>
          </li>
        {/foreach}
        </ul>
      </div>
    {/if}

    <p>
      {if $export_groups|@count > 0}
        <input type="submit" name="update" value="{$LANG.phrase_update_order}" />
      {/if}
      <input type="button" value="{$L.phrase_add_export_group}" onclick="window.location='export_groups/add.php'" />
    </p>

  </form>

{include file='modules_footer.tpl'}
