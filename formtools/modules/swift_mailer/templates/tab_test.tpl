  {include file="messages.tpl"}

  <div class="margin_bottom_large">
    {$L.text_test_desc}
  </div>

  <form action="{$same_page}" method="post" onsubmit="return rsv.validate(this, rules)">

    <table cellpadding="0" cellspacing="1">
    <tr>
      <td class="medium_grey" width="120">{$L.phrase_recipient_email}</td>
      <td><input type="text" name="recipient_email" style="width:200px" value="{$recipient_email|escape}" /></td>
    </tr>
    <tr>
      <td class="medium_grey">{$L.phrase_from_email}</td>
      <td><input type="text" name="from_email" style="width:200px" value="{$from_email|escape}" /></td>
    </tr>
    </table>

    <p>
      <input type="radio" name="test_email_format" value="text" id="ex1" {if $test_email_format == "text"}checked{/if} />
        <label for="ex1">{$L.phrase_plain_text_email}</label><br />
      <input type="radio" name="test_email_format" value="html" id="ex2" {if $test_email_format == "html"}checked{/if} />
        <label for="ex2">{$L.phrase_html_email}</label><br />
      <input type="radio" name="test_email_format" value="multipart" id="ex3" {if $test_email_format == "multipart"}checked{/if} />
        <label for="ex3">{$L.phrase_multipart_email}</label>
    </p>

    <p>
      <input type="submit" name="send" value="{$L.phrase_send_test_email}" />
    </p>

  </form>
