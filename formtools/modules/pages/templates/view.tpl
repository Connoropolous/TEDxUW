{include file='modules_header.tpl'}

  <a href="{$g_root_url}/modules/pages/edit.php?page_id={$page_id}" style="float:right" title="{$phrase_edit_page}"><img src="{$theme_url}/images/admin_edit.png" border="0" /></a>

  <div class="title margin_bottom_large">{$page_info.heading}</div>

  {$content}

  <p>
    <a href="index.php">&laquo; {$L.phrase_back_to_pages}</a>
  </p>

{include file='modules_footer.tpl'}
