{include file='modules_header.tpl'}

  <table cellpadding="0" cellspacing="0">
  <tr>
    <td width="45"><a href="index.php"><img src="images/icon_client_audit.gif" border="0" width="34" height="34" /></a></td>
    <td class="title">
      <a href="../../admin/modules">{$LANG.word_modules}</a>
      <span class="joiner">&raquo;</span>
      <a href="./">{$L.module_name}</a>
      <span class="joiner">&raquo;</span>
      {$L.word_changes}
    </td>
  </tr>
  </table>

  <table cellspacing="0" cellpadding="0" class="margin_bottom_large">
    <tr>
      <td width="80" class="nowrap">
        {if $nav_info.previous_change_id == ""}
          <span class="light_grey">{$LANG.word_previous_leftarrow}</span>
        {else}
          <a href="?change_id={$nav_info.previous_change_id}">{$LANG.word_previous_leftarrow}</a>
        {/if}
      </td>
      <td width="150" class="nowrap"><a href="./">{$LANG.phrase_back_to_search_results}</a></td>
      <td>
        {if $nav_info.next_change_id == ""}
          <span class="light_grey">{$LANG.word_next_rightarrow}</span>
        {else}
          <a href="?change_id={$nav_info.next_change_id}">{$LANG.word_next_rightarrow}</a>
        {/if}
      </td>
    </tr>
  </table>

  <div class="notify">
    <div style="padding: 6px">
      <table cellspacing="0" cellpadding="0">
      <tr>
        <td width="120" class="bold">{$LANG.word_client}</td>
        <td>
          <a href="../../admin/clients/edit.php?client_id={$change_info.account_id}">{display_account_name account_id=$change_info.account_id}</a>
        </td>
      </tr>
      <tr>
        <td>{$L.phrase_change_type}</td>
        <td>
        {if $change_info.change_type == "permissions"}
          <span class="ct_permissions">Permissions updated</span>
        {elseif $change_info.change_type == "admin_update"}
          <span class="ct_admin_update">Updated by admin</span>
        {elseif $change_info.change_type == "client_update"}
          <span class="ct_client_update">Updated by client</span>
        {elseif $change_info.change_type == "account_created"}
          <span class="ct_account_created">Account created</span>
        {elseif $change_info.change_type == "account_deleted"}
          <span class="ct_account_deleted">Account deleted</span>
        {elseif $change_info.change_type == "account_disabled_from_failed_logins"}
          <span class="ct_account_disabled_from_failed_logins">Account disabled from failed logins</span>
        {/if}
        </td>
      </tr>
      <tr>
        <td>{$L.phrase_change_date}</td>
        <td>
          {$change_info.change_date|custom_format_date:$SESSION.account.timezone_offset:$SESSION.account.date_format}
        </td>
      </tr>
      </table>
    </div>
  </div>

  {if $change_info.change_type == "permissions"}

    <p>
      {$L.text_permissions_desc}
    </p>

    <table cellspacing="1" cellpadding="0" class="list_table">
    {foreach from=$permissions key=form_id item=view_ids}
      <tr{if $form_id|in_array:$added_forms} class="added"{/if}>
        <td class="pad_left"><a href="../../admin/forms/edit.php?form_id={$form_id}&page=main">{display_form_name form_id=$form_id}</a></td>
        <td class="pad_left">
         {foreach from=$all_form_views.$form_id item=view_info}
           {if $view_info.view_id|in_array:$view_ids}
             <div{if $view_info.view_id|in_array:$added_views} class="added"{/if}><a href="../../admin/forms/edit.php?page=edit_view&form_id={$form_id}&view_id={$view_info.view_id}">{display_view_name view_id=$view_info.view_id}</a></div>
           {/if}
           {if $view_info.view_id|in_array:$removed_views}
             <div class="removed"><a href="../../admin/forms/edit.php?page=edit_view&form_id={$form_id}&view_id={$view_info.view_id}">{display_view_name view_id=$view_info.view_id}</a></div>
           {/if}
         {/foreach}
        </td>
      </tr>
    {/foreach}
    {* now list any deleted forms *}
    {foreach from=$removed_forms item=form_id}
      <tr class="deleted">
        <td class="pad_left"><a href="../../admin/forms/edit.php?form_id={$form_id}&page=main">{display_form_name form_id=$form_id}</a></td>
        <td class="pad_left">{$L.phrase_all_views}</td>
      </tr>
    {/foreach}
    </table>

  {else}

    <p>
      {$L.text_details_desc}
    </p>

    <table cellspacing="1" cellpadding="0" class="list_table">
    <tr>
      <th colspan="2">{$LANG.phrase_main_settings}</th>
    </tr>
    <tr{if "account_status"|in_array:$changes} class="changed"{/if}>
      <td width="180" class="pad_left">{$L.phrase_account_status}</td>
      <td class="pad_left">{$change_info.account_info.account_status}</td>
    </tr>
    <tr{if "first_name"|in_array:$changes} class="changed"{/if}>
      <td width="180" class="pad_left">{$LANG.phrase_first_name}</td>
      <td class="pad_left">{$change_info.account_info.first_name}</td>
    </tr>
    <tr{if "last_name"|in_array:$changes} class="changed"{/if}>
      <td class="pad_left">{$LANG.phrase_last_name}</td>
      <td class="pad_left">{$change_info.account_info.last_name}</td>
    </tr>
    <tr{if "email"|in_array:$changes} class="changed"{/if}>
      <td width="180" class="pad_left">{$LANG.word_email}</td>
      <td class="pad_left">{$change_info.account_info.email}</td>
    </tr>
    <tr{if "username"|in_array:$changes} class="changed"{/if}>
      <td width="180" class="pad_left">Username</td>
      <td class="pad_left">{$change_info.account_info.username}</td>
    </tr>
    <tr{if "password"|in_array:$changes} class="changed"{/if}>
      <td width="180" class="pad_left">{$LANG.word_password}</td>
      <td class="pad_left">{$change_info.account_info.password}</td>
    </tr>
    <tr{if "ui_language"|in_array:$changes} class="changed"{/if}>
      <td width="180" class="pad_left">{$LANG.word_language}</td>
      <td class="pad_left">{$change_info.account_info.ui_language}</td>
    </tr>
    <tr{if "timezone_offset"|in_array:$changes} class="changed"{/if}>
      <td width="180" class="pad_left">{$LANG.phrase_system_time_offset}</td>
      <td class="pad_left">{$change_info.account_info.timezone_offset}</td>
    </tr>
    <tr{if "sessions_timeout"|in_array:$changes} class="changed"{/if}>
      <td width="180" class="pad_left">{$LANG.phrase_sessions_timeout}</td>
      <td class="pad_left">{$change_info.account_info.sessions_timeout}</td>
    </tr>
    <tr{if "date_format"|in_array:$changes} class="changed"{/if}>
      <td width="180" class="pad_left">{$LANG.phrase_date_format}</td>
      <td class="pad_left">{$change_info.account_info.date_format}</td>
    </tr>
    <tr{if "login_page"|in_array:$changes} class="changed"{/if}>
      <td width="180" class="pad_left">{$LANG.phrase_login_page}</td>
      <td class="pad_left">{$change_info.account_info.login_page}</td>
    </tr>
    <tr{if "logout_url"|in_array:$changes} class="changed"{/if}>
      <td width="180" class="pad_left">{$LANG.phrase_logout_url}</td>
      <td class="pad_left">{$change_info.account_info.logout_url}</td>
    </tr>
    <tr{if "theme"|in_array:$changes} class="changed"{/if}>
      <td width="180" class="pad_left">{$LANG.word_theme}</td>
      <td class="pad_left">{$change_info.account_info.theme}</td>
    </tr>
    <tr{if "menu_id"|in_array:$changes} class="changed"{/if}>
      <td width="180" class="pad_left">{$LANG.word_menu}</td>
      <td class="pad_left">{$change_info.account_info.menu_id}</td>
    </tr>
    </table>

    <br />

    {if $changed_settings}
      <table cellspacing="1" cellpadding="0" class="list_table">
      <tr>
        <th colspan="2">{$L.phrase_other_changed_settings}</th>
      </tr>
      {foreach from=$changed_settings key=setting_name item=setting_value}
      <tr class="changed">
        <td width="180">
          {if $setting_name|array_key_exists:$settings_labels}
            {$settings_labels.$setting_name}
          {else}
            {$setting_name}
          {/if}
        </td>
        <td>{$setting_value}</td>
      </tr>
      {/foreach}
      </table>
    {/if}

  {/if}

{include file='modules_footer.tpl'}