{include file='modules_header.tpl'}

  <table cellpadding="0" cellspacing="0">
  <tr>
    <td width="45"><a href="index.php"><img src="images/icon_client_audit.gif" border="0" width="34" height="34" /></a></td>
    <td class="title">
      <a href="../../admin/modules">{$LANG.word_modules}</a>
      <span class="joiner">&raquo;</span>
      {$L.module_name}
    </td>
  </tr>
  </table>

  {include file='messages.tpl'}

  {if $total_count == 0}
    <div>{$L.notify_no_activity}</div>
  {else}

    <form action="{$same_page}" method="post">
      <table cellspacing="1" cellpadding="0" id="search_table" class="margin_bottom" width="100%">
        <tr>
          <td width="120">{$L.phrase_client_account}</td>
          <td colspan="2">
            <select name="client_id">
              <option value="" {if $search_criteria.client_id == ""}selected{/if}>{$LANG.phrase_all_clients}</option>
              <optgroup label="{$L.phrase_current_clients}">
              {foreach from=$clients item=client name=row}
                <option value="{$client.account_id}" {if $search_criteria.client_id == $client.account_id}selected{/if}>{$client.last_name}, {$client.first_name}</option>
              {/foreach}
              </optgroup>
              {if $deleted_clients|@count > 0}
                <optgroup label="{$L.phrase_deleted_clients}">
                {foreach from=$deleted_clients item=client name=row}
                  <option value="{$client.account_id}" {if $search_criteria.client_id == $client.account_id}selected{/if}>{$client.last_name}, {$client.first_name}</option>
                {/foreach}
                </optgroup>
              {/if}
            </select>
          </td>
        </tr>
        <tr>
          <td>{$L.word_events}</td>
          <td valign="top">
            <ul>
              <li>
                <input type="checkbox" name="change_types[]" id="ct1" value="login"
                  {if "login"|in_array:$search_criteria.change_types}checked{/if} />
                  <label for="ct1">{$LANG.word_login}</label>
              </li>
              <li>
                <input type="checkbox" name="change_types[]" id="ct2" value="logout"
                  {if "logout"|in_array:$search_criteria.change_types}checked{/if} />
                  <label for="ct2">{$LANG.word_logout}</label>
              </li>
              <li>
                <input type="checkbox" name="change_types[]" id="ct3" value="account_created"
                  {if "account_created"|in_array:$search_criteria.change_types}checked{/if} />
                  <label for="ct3">{$L.phrase_account_created}</label>
              </li>
              <li>
                <input type="checkbox" name="change_types[]" id="ct4" value="account_deleted"
                  {if "account_deleted"|in_array:$search_criteria.change_types}checked{/if} />
                  <label for="ct4">{$L.phrase_account_deleted}</label>
              </li>
            </ul>
          </td>
          <td valign="top">
            <ul>
              <li>
                <input type="checkbox" name="change_types[]" id="ct5" value="permissions"
                  {if "permissions"|in_array:$search_criteria.change_types}checked{/if} />
                  <label for="ct5">{$L.phrase_permissions_updated}</label>
              </li>
              <li>
                <input type="checkbox" name="change_types[]" id="ct6" value="client_update"
                  {if "client_update"|in_array:$search_criteria.change_types}checked{/if} />
                  <label for="ct6">{$L.phrase_account_updated_by_client}</label>
              </li>
              <li>
                <input type="checkbox" name="change_types[]" id="ct7" value="admin_update"
                  {if "admin_update"|in_array:$search_criteria.change_types}checked{/if} />
                  <label for="ct7">{$L.phrase_account_updated_by_admin}</label>
              </li>
              <li>
                <input type="checkbox" name="change_types[]" id="ct8" value="account_disabled_from_failed_logins"
                  {if "account_disabled_from_failed_logins"|in_array:$search_criteria.change_types}checked{/if} />
                  <label for="ct8">{$L.phrase_account_disabled_failed_logins}</label>
              </li>
            </ul>
          </td>
        </tr>
        <tr>
          <td valign="top">{$L.word_dates}</td>
          <td colspan="3">
            <table cellspacing="0" cellpadding="0">
            <tr>
              <td class="pad_right">
                <input type="radio" name="date_range" id="dr1" value="all" {if $search_criteria.date_range == "all"}checked{/if}
                  onclick="page_ns.selectDateType(this.value)" />
                  <label for="dr1">{$L.phrase_all_dates}</label>
              </td>
              <td width="80" class="pad_right">
                <input type="radio" name="date_range" id="dr2" value="range" {if $search_criteria.date_range == "range"}checked{/if}
                  onclick="page_ns.selectDateType(this.value)" />
                  <label for="dr2">{$L.word_range}</label>
              </td>
              <td>
                <table cellspacing="0" cellpadding="0">
                <tr>
                  <td class="pad_right">{$LANG.word_from_c}</td>
                  <td class="pad_right">
                    <input type="text" name="date_from" id="date_from" class="datepicker" style="width: 80px;"
                      value="{$search_criteria.date_from|escape}" {if $search_criteria.date_range == "all"}disabled{/if} />
                  </td>
                  <td class="pad_right">{$L.word_to_c}</td>
                  <td>
                    <input type="text" name="date_to" id="date_to" class="datepicker" style="width: 80px;"
                      value="{$search_criteria.date_to|escape}" {if $search_criteria.date_range == "all"}disabled{/if} />
                  </td>
                </tr>
                </table>
              </td>
            </tr>
            </table>
            <div class="vertical_pad"> </div>
          </td>
        </tr>
        <tr>
          <td colspan="3" align="right">
            <input type="submit" name="search_forms" value="{$LANG.word_search}" />
            <input type="button" name="reset" onclick="window.location='{$same_page}?reset=1'"
              {if $num_search_results < $total_count}
                value="{$LANG.phrase_show_all} ({$total_count})" class="bold"
              {else}
                value="{$LANG.phrase_show_all}" class="light_grey" disabled
              {/if} />
          </td>
        </tr>
      </table>
    </form>

    {if $num_search_results == 0}
      {assign var="g_message" value=$L.notify_no_results}
      {assign var="g_success" value=false}
      {include file='messages.tpl'}
    {else}

      {$pagination}

      <form action="{$same_page}" method="post" id="client_audit_form">

        <table class="list_table" cellpadding="1" cellspacing="1" border="0" width="650">
        <tr>
          <th width="30"><input type="checkbox" id="toggle" /></th>
          <th>{$LANG.word_date}</th>
          <th>{$LANG.word_client}</th>
          <th>{$L.word_event}</th>
          <th width="80">{$L.word_details}</th>
        </tr>
        {foreach from=$search_results item=row}
          <tr>
            <td align="center"><input type="checkbox" name="change_ids[]" class="change_row" value="{$row.change_id}" /></td>
            <td>
              {$row.change_date|custom_format_date:$SESSION.account.timezone_offset:$SESSION.account.date_format}
            </td>
            <td>
              {if $row.account_exists}
                <a href="../../admin/clients/edit.php?client_id={$row.account_id}">{display_account_name account_id=$row.account_id format="last_first"}</a>
              {else}
                <span class="light_grey">{display_deleted_account_name account_id=$row.account_id format="last_first"}</span>
              {/if}
            </td>
            <td>
              {if $row.change_type == "login"}
                <span class="ct_login">{$LANG.word_login}</span>
              {elseif $row.change_type == "logout"}
                <span class="ct_logout">{$LANG.word_logout}</span>
              {elseif $row.change_type == "permissions"}
                <span class="ct_permissions">{$L.phrase_permissions_updated}</span>
              {elseif $row.change_type == "admin_update"}
                <span class="ct_admin_update">{$L.phrase_updated_by_admin}</span>
              {elseif $row.change_type == "client_update"}
                <span class="ct_client_update">{$L.phrase_updated_by_client}</span>
              {elseif $row.change_type == "account_created"}
                <span class="ct_account_created">{$L.phrase_account_created}</span>
              {elseif $row.change_type == "account_deleted"}
                <span class="ct_account_deleted">{$L.phrase_account_deleted}</span>
              {elseif $row.change_type == "account_disabled_from_failed_logins"}
                <span class="ct_account_disabled_from_failed_logins">{$L.phrase_account_disabled_failed_logins}</span>
              {/if}
            </td>
            <td align="center">
              {if $row.change_type == "login" || $row.change_type == "logout"}
                <span class="light_grey">&#8212;</span>
              {else}
                <a href="details.php?change_id={$row.change_id}">{$L.word_details|upper}</a>
              {/if}
            </td>
          </tr>
        {/foreach}
        </table>

        <p>
          <input type="button" class="delete_all" name="delete_all" id="delete_all" value="{$L.phrase_delete_all_results}" style="float: right"/>
          <input type="button" class="delete_selected" value="{$L.phrase_delete_selected_rows}" />
        </p>

      </form>

    {/if}
  {/if}

{include file='modules_footer.tpl'}
