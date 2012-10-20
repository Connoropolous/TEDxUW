  {include file="messages.tpl"}

  <div class="margin_bottom_large">
    {$text_settings_desc}
  </div>

  <form action="{$same_page}" method="post" onsubmit="return rsv.validate(this, rules)">
    <table cellpadding="0" cellspacing="1">
    <tr>
      <td width="25">
        <input type="checkbox" name="swiftmailer_enabled" id="swiftmailer_enabled" value="yes"
          {if $sm_settings.swiftmailer_enabled == "yes"}checked{/if}
          onchange="page_ns.toggle_enabled_fields(this.checked)" />
      </td>
      <td colspan="2" class="bold"><label for="swiftmailer_enabled">{$L.phrase_enable_module}</label></td>
    </tr>
    <tr>
      <td> </td>
      <td width="180" class="medium_grey">{$L.phrase_smtp_server}</td>
      <td>
        <input type="text" name="smtp_server" id="smtp_server" style="width:200px" value="{$sm_settings.smtp_server|escape}"
          {if $sm_settings.swiftmailer_enabled != "yes"}disabled{/if} />
      </td>
    </tr>
    <tr>
      <td> </td>
      <td class="medium_grey">{$L.word_port}</td>
      <td>
        <input type="text" name="port" id="port" style="width:35px" value="{$sm_settings.port|escape}"
          {if $sm_settings.swiftmailer_enabled != "yes"}disabled{/if} />
      </td>
    </tr>
    <tr>
      <td>
        <input type="checkbox" name="requires_authentication" id="requires_authentication" value="yes"
          {if $sm_settings.requires_authentication == "yes"}checked{/if}
          onchange="page_ns.toggle_authentication_fields(this.checked)" />
      </td>
      <td colspan="2" class="bold"><label for="requires_authentication">{$L.phrase_use_authentication}</label></td>
    </tr>
    <tr>
      <td> </td>
      <td class="medium_grey">{$LANG.word_username}</td>
      <td><input type="text" name="username" id="username" style="width:200px" value="{$sm_settings.username|escape}"
        {if $sm_settings.requires_authentication == "no"}disabled{/if} /></td>
    </tr>
    <tr>
      <td> </td>
      <td class="medium_grey">{$LANG.word_password}</td>
      <td><input type="password" name="password" id="password" style="width:200px" value="{$sm_settings.password|escape}"
        {if $sm_settings.requires_authentication == "no"}disabled{/if} /></td>
    </tr>
    <tr>
      <td> </td>
      <td class="medium_grey">{$L.phrase_authentication_procedure}</td>
      <td>
        <input type="radio" name="authentication_procedure" id="ap1" value="LOGIN" {if $sm_settings.authentication_procedure == "LOGIN"}checked{/if}
          {if $sm_settings.requires_authentication == "no"}disabled{/if} />
          <label for="ap1">LOGIN</label>
        <input type="radio" name="authentication_procedure" id="ap2" value="PLAIN" {if $sm_settings.authentication_procedure == "PLAIN"}checked{/if}
          {if $sm_settings.requires_authentication == "no"}disabled{/if} />
          <label for="ap2">PLAIN</label>
        <input type="radio" name="authentication_procedure" id="ap3" value="CRAMMD5" {if $sm_settings.authentication_procedure == "CRAMMD5"}checked{/if}
          {if $sm_settings.requires_authentication == "no"}disabled{/if} />
          <label for="ap3">CRAM-MD5</label>
      </td>
    </tr>
    <tr>
      <td>
        <input type="checkbox" name="use_encryption" id="use_encryption" value="yes" {if $sm_settings.use_encryption == "yes"}checked{/if}
          onchange="page_ns.toggle_encryption_fields(this.checked)" />
      </td>
      <td colspan="2" class="bold"><label for="use_encryption">{$L.phrase_use_encryption}</label></td>
    </tr>
    <tr>
      <td> </td>
      <td class="medium_grey">{$L.phrase_encryption_type}</td>
      <td>
        <input type="radio" name="encryption_type" id="et1" value="SSL" {if $sm_settings.encryption_type == "SSL"}checked{/if}
          {if $sm_settings.use_encryption != "yes"}disabled{/if} />
          <label for="et1">SSL</label>
        <input type="radio" name="encryption_type" id="et2" value="TLS" {if $sm_settings.encryption_type == "TLS"}checked{/if}
          {if $sm_settings.use_encryption != "yes"}disabled{/if} />
          <label for="et2">TLS</label>
      </td>
    </tr>
    </table>

    <br />

    <div class="grey_box">
      <div style="margin_top">
        <a href="#" onclick="return page_ns.toggle_advanced_settings()">{$LANG.phrase_advanced_settings_rightarrow}</a>
      </div>

      <div {if $remember_advanced_settings == "" || $remember_advanced_settings == "false"}style="display:none"{/if} id="advanced_settings">
         <table cellpadding="0" cellspacing="1">
        <tr>
          <td colspan="2" class="medium_grey" width="205">{$L.phrase_server_connection_timeout}</td>
          <td>
            <input type="text" name="server_connection_timeout" id="server_connection_timeout" style="width:35px"
              value="{$sm_settings.server_connection_timeout|escape}" /> {$L.word_seconds}
          </td>
        </tr>
        <tr>
          <td colspan="2" class="medium_grey">{$L.phrase_email_charset}</td>
          <td><input type="text" name="charset" id="charset" style="width:80px" value="{$sm_settings.charset|escape}" /></td>
        </tr>
        <tr>
          <td width="25">
            <input type="checkbox" name="use_anti_flooding" id="use_anti_flooding" value="yes" {if $sm_settings.use_anti_flooding == "yes"}checked{/if}
              onchange="page_ns.toggle_antiflooding_fields(this.checked)" />
          </td>
          <td class="bold" colspan="2"><label for="use_anti_flooding">{$L.phrase_use_antiflooding}</label></td>
        </tr>
        <tr>
          <td> </td>
          <td class="medium_grey">{$L.phrase_email_batch_size}</td>
          <td class="medium_grey">
            <input type="text" name="anti_flooding_email_batch_size" id="anti_flooding_email_batch_size" style="width:35px"
              value="{$sm_settings.anti_flooding_email_batch_size|escape}"
              {if $sm_settings.use_anti_flooding != "yes"}disabled{/if} />
          </td>
        </tr>
        <tr>
          <td> </td>
          <td class="medium_grey">{$L.phrase_batch_wait_time}</td>
          <td class="medium_grey">
            <input type="text" name="anti_flooding_email_batch_wait_time" id="anti_flooding_email_batch_wait_time" style="width:35px"
              value="{$sm_settings.anti_flooding_email_batch_wait_time|escape}"
               {if $sm_settings.use_anti_flooding != "yes"}disabled{/if} /> {$L.word_seconds}</td>
        </tr>
        </table>
      </div>

    </div>

    <p>
      <input type="submit" name="update" value="{$LANG.word_update}" />
    </p>

  </form>
