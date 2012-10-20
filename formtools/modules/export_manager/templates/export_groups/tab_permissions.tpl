  {include file='messages.tpl'}

  <form action="{$same_page}" method="post">
    <input type="hidden" name="export_group_id" value="{$export_group_info.export_group_id}" />

    <table cellspacing="1" cellpadding="2" border="0" width="100%">
    <tr>
      <td width="130" class="medium_grey" valign="top">{$LANG.phrase_access_type}</td>
      <td>
        <table cellspacing="1" cellpadding="0" class="margin_bottom">
        <tr>
          <td>
            <input type="radio" name="access_type" id="at1" value="admin" {if $export_group_info.access_type == 'admin'}checked{/if} />
              <label for="at1">{$LANG.phrase_admin_only}</label>
          </td>
        </tr>
        <tr>
          <td>
            <input type="radio" name="access_type" id="at2" value="public" {if $export_group_info.access_type == 'public'}checked{/if} />
              <label for="at2">{$LANG.word_public} <span class="light_grey">(all clients have access)</span></label>
          </td>
        </tr>
        <tr>
          <td>
            <input type="radio" name="access_type" id="at3" value="private" {if $export_group_info.access_type == 'private'}checked{/if} />
              <label for="at3">{$LANG.word_private} <span class="light_grey">(only specific clients have access)</span></label>
          </td>
        </tr>
        </table>

        <div id="custom_clients" {if $export_group_info.access_type != 'private'}style="display:none"{/if}>
          <table cellpadding="0" cellspacing="0" class="subpanel">
          <tr>
            <td class="medium_grey">{$LANG.phrase_available_clients}</td>
            <td></td>
            <td class="medium_grey">{$LANG.phrase_selected_clients}</td>
          </tr>
          <tr>
            <td>
              {clients_dropdown name_id="available_client_ids[]" multiple="true" multiple_action="hide"
                clients=$export_group_info.client_ids size="4" style="width: 220px"}
            </td>
            <td align="center" valign="middle" width="100">
              <input type="button" value="{$LANG.word_add_uc_rightarrow}"
                onclick="ft.move_options(this.form['available_client_ids[]'], this.form['selected_client_ids[]']);" /><br />
              <input type="button" value="{$LANG.word_remove_uc_leftarrow}"
                onclick="ft.move_options(this.form['selected_client_ids[]'], this.form['available_client_ids[]']);" />
            </td>
            <td>
              {clients_dropdown name_id="selected_client_ids[]" multiple="true" multiple_action="show"
                clients=$export_group_info.client_ids size="4" style="width: 220px"}
            </td>
          </tr>
          </table>
        </div>

      </td>
    </tr>
    <tr>
      <td class="medium_grey" valign="top">Where Shown</td>
      <td>

	    <div>
	      <input type="radio" name="form_view_mapping" id="fvm1" value="all" {if $export_group_info.form_view_mapping == 'all'}checked{/if} />
	      <label for="fvm1">All forms and Views</label>
	    </div>
	    <div>
	      <input type="radio" name="form_view_mapping" id="fvm2" value="except" {if $export_group_info.form_view_mapping == 'except'}checked{/if} />
	      <label for="fvm2">All forms and Views, <b>except</b>:</label>
	    </div>
	    <div class="margin_bottom">
	      <input type="radio" name="form_view_mapping" id="fvm3" value="only" {if $export_group_info.form_view_mapping == 'only'}checked{/if} />
	      <label for="fvm3"><b>Only</b> forms and Views:</label>
	    </div>


        <div id="custom_forms" {if $export_group_info.form_view_mapping == 'all'}style="display:none"{/if} class="margin_top">
          <table cellpadding="0" cellspacing="0" class="subpanel">
          <tr>
            <td class="medium_grey" width="50%">{$LANG.word_forms}</td>
            <td class="medium_grey" width="50%">{$LANG.word_views}</td>
          </tr>
          <tr>
            <td height="200">
              <div class="overflow_panel">
                <ul>
                {foreach from=$forms item=form_info}
                  <li>
                    <input type="checkbox" name="form_ids[]" class="form_ids" id="f{$form_info.form_id}" value="{$form_info.form_id}"
                      {if $form_info.form_id|in_array:$selected_form_ids}checked{/if} />
                      <label for="f{$form_info.form_id}">{$form_info.form_name}</label>
                  </li>
                {/foreach}
                </ul>
              </div>
            </td>
            <td height="200">
              <div class="overflow_panel">

                {foreach from=$forms item=form_info}
                  {assign var=form_id value=$form_info.form_id}
                  <div class="view_group" id="f{$form_id}_views" {if !$form_id|in_array:$selected_form_ids}style="display:none"{/if}>
                    <h2>{$form_info.form_name}</h2>
                    <ul>
                      <li>
                        {assign var=all_views_checked value="form`$form_id`_all_views"|in_array:$selected_view_ids}
                        <input type="checkbox" name="view_ids[]" id="form{$form_id}_all_views" value="form{$form_id}_all_views" class="view_ids all_views"
                          {if $all_views_checked}checked{/if} />
                          <label for="form{$form_id}_all_views" class="all_views_label">&#8212; All Views &#8212;</label>
                      </li>
                      {foreach from=$form_info.views item=view_info}
                      {assign var=view_id value=$view_info.view_id}
                      <li>
                        <input type="checkbox" name="view_ids[]" id="v{$view_id}" value="{$view_id}" class="view_ids"
                          {if $all_views_checked}
                            disabled
                          {else}
                            {if $view_id|in_array:$selected_view_ids}checked{/if}
                          {/if} />
                          <label for="v{$view_id}">{$view_info.view_name}</label>
                      </li>
                      {/foreach}
                    </ul>
                  </div>
                {/foreach}

              </div>
            </td>
          </tr>
          </table>
        </div>

      </td>
    </tr>
    </table>

    <p>
      <input type="submit" name="update_permissions" value="{$LANG.word_update}" />
    </p>

  </form>
