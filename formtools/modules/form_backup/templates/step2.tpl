{include file='modules_header.tpl'}

  <table cellpadding="0" cellspacing="0" class="margin_bottom_large">
  <tr>
    <td width="45"><a href="index.php"><img src="images/form_backup.gif" border="0" width="34" height="34" /></a></td>
    <td class="title">
      <a href="../">{$LANG.word_modules}</a>
      <span class="joiner">&raquo;</span>
      {$L.module_name}
    </td>
  </tr>
  </table>

  <div id="form_copier_nav">
    <div><a href="index.php">1. {$L.phrase_select_form}</a></div>
    <div>2. {$LANG.word_settings}</div>
    <div class="unselected">3. {$LANG.word_complete}</div>
  </div>

  <div class="margin_bottom_large">
    {$L.text_choose_settings}
  </div>

  <form action="complete.php" method="post">
    <input type="hidden" name="form_id" value="{$form_id}" />

    <table cellpadding="0" cellspacing="0" width="100%" class="form_backup_table">
    <tr>
      <td width="180" class="medium_grey">{$L.phrase_new_form_name}</td>
      <td><input type="text" name="form_name" style="width:300px" value="{$form_info.form_name|escape}" /></td>
    </tr>
    <tr>
      <td class="medium_grey">{$L.phrase_copy_submissions}</td>
      <td>
        <input type="radio" name="copy_submissions" value="yes" id="cs1" checked />
          <label for="cs1">{$LANG.word_yes}</label>
        <input type="radio" name="copy_submissions" value="no" id="cs2" />
          <label for="cs2">{$LANG.word_no}</label>
      </td>
    </tr>
    <tr>
      <td class="medium_grey">{$L.phrase_disable_new_form}</td>
      <td>
        <input type="radio" name="form_disabled" value="yes" id="fd1" checked />
          <label for="fd1">{$LANG.word_yes}</label>
        <input type="radio" name="form_disabled" value="no" id="fd2" />
          <label for="fd2">{$LANG.word_no}</label>
      </td>
    </tr>
    <tr>
      <td class="medium_grey">{$LANG.word_views}</td>
      <td>
        {foreach from=$views item=view}
          <input type="checkbox" name="view_ids[]" value="{$view.view_id}" id="view_{$view.view_id}" checked />
            <label for="view_{$view.view_id}">{$view.view_name}</label><br />
        {/foreach}
      </td>
    </tr>
    <tr>
      <td class="medium_grey">{$L.phrase_email_templates}</td>
      <td>
        {foreach from=$emails item=email}
          <input type="checkbox" name="email_ids[]" value="{$email.email_id}" id="email_{$email.email_id}" checked />
            <label for="email_{$email.email_id}">{$email.email_template_name}</label><br />
        {/foreach}
        {if $emails|@count == 0}
          <span class="light_grey">No email templates defined</span>
        {/if}
      </td>
    </tr>
    <tr>
      <td class="medium_grey">{$L.phrase_form_permissions}</td>
      <td>
        <input type="radio" name="form_permissions" value="same_permissions" id="fp1" checked />
          <label for="fp1">{$L.phrase_same_permissions_as_base_form}</label><br />
        <input type="radio" name="form_permissions" value="admin" id="fp2" />
          <label for="fp2">{$LANG.phrase_admin_only}</label>
      </td>
    </tr>
    </table>

    <p>
      <input type="submit" value="{$L.word_continue}" />
    </p>

  </form>

{include file='modules_footer.tpl'}