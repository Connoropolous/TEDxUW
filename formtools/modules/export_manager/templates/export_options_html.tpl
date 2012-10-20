{*
  This template generates the HTML for the various export options at the foot of the submission
  listing page, for both the administrator and clients.

  1. popup
  2. new window (form: target="_blank")
  3. generate file
*}

  {if $export_groups|@count > 0}
    <script src="{$modules_dir}/export_manager/global/scripts/export_manager.js?v=4"></script>
    <script>
    {literal}
    if (typeof em == 'undefined') {
      em = {};
    }
    {/literal}
    em.export_page = "{$modules_dir}/export_manager/export.php";
    g.messages["validation_select_rows_to_export"] = "{$LANG.export_manager.validation_select_rows_to_export}";
    </script>

    <div class="module_section export_manager_module">
      {if $is_admin}<div class="module_link"><a href="{$g_root_url}/modules/export_manager"></a></div>{/if}
      <h2>{$LANG.word_download} / {$LANG.export_manager.word_export}</h2>
      <table cellpadding="0" cellpadding="0">
      {foreach from=$export_groups item=export_group name=row}
        {assign var=export_group_id value=$export_group.export_group_id}
        <tr>
          <td class="icon"><img src="{$export_icon_folder}/{$export_group.icon}"/></td>
          <td class="export_group_name">{eval var=$export_group.group_name}</td>
          <td class="target_content">
            {assign var=var_name value="export_group_`$export_group_id`_results"}
            <input type="radio" name="export_group_{$export_group_id}_results" id="export_group_{$export_group_id}_results_1" value="all"
              {if $SESSION.export_manager.$var_name == "all" || !isset($SESSION.export_manager.$var_name)}checked{/if} />
              <label for="export_group_{$export_group_id}_results_1"">{$LANG.word_all}</label>
            <input type="radio" name="export_group_{$export_group_id}_results" id="export_group_{$export_group_id}_results_2" value="selected"
              {if $SESSION.export_manager.$var_name == "selected"}checked{/if} />
              <label for="export_group_{$export_group_id}_results_2"">{$LANG.word_selected}</label>
          </td>
          <td>
            {if $export_group.action == "popup"}
              <script>
              em.export_group_id_{$export_group_id}_height = {$export_group.popup_height};
              em.export_group_id_{$export_group_id}_width  = {$export_group.popup_width};
              </script>
            {/if}
            {if $export_group.export_types|@count > 1}
              {assign var=var_name value="export_group_`$export_group_id`_export_type"}
                <select name="export_group_{$export_group_id}_export_type" id="export_group_{$export_group_id}_export_type">
                {foreach from=$export_group.export_types item=export_type name=row}
                  <option value="{$export_type.export_type_id}" {if $page_vars.$var_name == $export_type.export_type_id}selected{/if}>{eval var=$export_type.export_type_name}</option>
                {/foreach}
                </select>
            {/if}
            <input type="button" name="export_group_{$export_group_id}" value="{eval var=$export_group.action_button_text}"
              onclick="em.export_submissions({$export_group_id}, '{$export_group.action}')" />
          </td>
        </tr>
      {/foreach}
      </table>
    </div>

  {/if}
