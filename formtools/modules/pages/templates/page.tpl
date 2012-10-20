{include file="header.tpl"}

  {if $account_type == "admin"}
    <a href="{$g_root_url}/modules/pages/edit.php?page_id={$page_id}" style="float:right" title="{$phrase_edit_page}"><img src="{$theme_url}/images/admin_edit.png" border="0" /></a>
  {/if}

  <div class="title margin_bottom_large">{$page_info.heading}</div>

  {$content}

{include file="footer.tpl"}
