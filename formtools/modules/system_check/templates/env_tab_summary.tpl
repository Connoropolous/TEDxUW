{include file="messages.tpl"}

<div class="subtitle underline margin_bottom">{$L.word_summary|upper}</div>

<table>
<tr>
  <td width="180">{$LANG.phrase_php_version}</td>
  <td class="medium_grey">{$env_info.php_version}</td>
</tr>
<tr>
  <td>{$LANG.phrase_mysql_version}</td>
  <td class="medium_grey">{$env_info.mysql_version}</td>
</tr>
<tr>
  <td>{$L.phrase_php_sessions}</td>
  <td class="medium_grey">{$env_info.sessions_available}</td>
</tr>
<tr>
  <td>{$L.phrase_suhosin_extension}</td>
  <td class="medium_grey">{$env_info.suhosin_installed}</td>
</tr>
<tr>
  <td>{$L.phrase_curl_extension}</td>
  <td class="medium_grey">{$env_info.curl_available}</td>
</tr>
<tr>
  <td>{$L.phrase_simplexml_extension}</td>
  <td class="medium_grey">{$env_info.simpleXML_available}</td>
</tr>
</table>

<br />

<div class="subtitle underline margin_bottom">{$L.phrase_environment_overview|upper}</div>

<div class="margin_bottom_large">
  {$L.text_environment_overview_summary}
</div>

<textarea style="width:100%; height:220px" class="medium_grey"	>{$report_card}</textarea>
