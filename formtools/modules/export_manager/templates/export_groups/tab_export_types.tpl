  {include file='messages.tpl'}

  <form action="{$same_page}" method="post">
    <input type="hidden" name="export_group_id" value="{$export_group_info.export_group_id}" />

    {if $export_types|@count == 0}
      <div class="notify yellow_bg" class="margin_bottom_large">
        <div style="padding:8px">
          {$L.notify_no_export_types}
        </div>
      </div>
    {else}
      <div class="sortable export_type_list" id="{$sortable_id}">
        <input type="hidden" class="sortable__custom_delete_handler" value="em_ns.delete_export_type" />
        <ul class="header_row">
          <li class="col1">{$LANG.word_order}</li>
          <li class="col2">{$LANG.word_id|upper}</li>
          <li class="col3">{$L.phrase_export_type}</li>
          <li class="col4">{$L.word_visibility}</li>
          <li class="col5 edit"></li>
          <li class="col6 colN del"></li>
        </ul>
        <div class="clear"></div>
        <ul class="rows" id="rows">
        {foreach from=$export_types item=export_type name=row}
          {assign var='index' value=$smarty.foreach.row.index}
          {assign var='count' value=$smarty.foreach.row.iteration}
          {assign var='export_type_id' value=$export_type.export_type_id}
          <li class="sortable_row">
            <div class="row_content">
              <div class="row_group{if $smarty.foreach.row.last} rowN{/if}">
                <input type="hidden" class="sr_order" value="{$export_type_id}" />
                <ul>
                  <li class="col1 sort_col">{$count}</li>
                  <li class="col2">{$export_type_id}</li>
                  <li class="col3">{eval var=$export_type.export_type_name}</li>
                  <li class="col4">
                    {if $export_type.export_type_visibility == "show"}
                      <span class="green">{$LANG.word_show}</span>
                    {else}
                      <span class="red">{$LANG.word_hide}</span>
                    {/if}
                  </li>
                  <li class="col5 edit"><a href="edit.php?page=edit_export_type&export_type_id={$export_type_id}"></a></li>
                  <li class="col6 colN del"></li>
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
      {if $export_types|@count > 0}
        <input type="submit" name="reorder_export_types" value="{$LANG.phrase_update_order}" />
      {/if}
      <input type="submit" name="create_export_type" value="{$L.phrase_add_export_type}" />
    </p>

  </form>