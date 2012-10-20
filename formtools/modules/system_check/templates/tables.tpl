{include file='modules_header.tpl'}

  <table cellpadding="0" cellspacing="0">
  <tr>
    <td width="45"><img src="images/icon.png" width="34" height="34" /></td>
    <td class="title">
      <a href="../../admin/modules">{$LANG.word_modules}</a>
      <span class="joiner">&raquo;</span>
      <a href="./">{$L.module_name}</a>
      <span class="joiner">&raquo;</span>
      {$L.phrase_table_verification}
    </td>
  </tr>
  </table>

  {include file="messages.tpl"}

  <div class="margin_bottom_large">
    {$L.text_table_verification_intro}
  </div>

  <table class="list_table" cellspacing="1" cellpadding="0" style="width: 600px">
  <tr>
    <th width="30"> </th>
    <th>{$L.word_component}</th>
    <th>{$L.phrase_has_tables_q}</th>
    <th>{$LANG.word_version}</th>
    <th>{$L.word_result}</th>
  </tr>
  <tr>
    <td align="center"><input type="checkbox" class="components" value="core" checked="checked" /></td>
    <td class="pad_left_small">Form Tools Core</td>
    <td class="pad_left_small">{$LANG.word_yes}</td>
    <td align="center" class="pad_left_small">{$core_version}</td>
    <td align="center">
      <span id="result__core" class="di_status untested">{$L.word_untested|upper}</span>
    </td>
  </tr>
  {foreach from=$module_list item=module_info}
  {assign var=has_tables value=$module_info.module_config.tables|@count}
  <tr {if !$has_tables}class="no_test"{/if}>
    <td align="center">
      {if $has_tables}
        <input type="checkbox" class="components" value="{$module_info.module_id}" checked="checked" />
      {/if}
    </td>
    <td class="pad_left_small">{$module_info.module_name}</td>
	  <td class="pad_left_small">
	    {if $has_tables}
	      {$LANG.word_yes}
	    {else}
	      {$LANG.word_no} - {$L.phrase_nothing_to_test}
	    {/if}
	  </td>
    <td align="center" class="pad_left_small">{$module_info.version}</td>
    <td align="center">
      {if $has_tables}
        <span id="result__{$module_info.module_id}" class="di_status untested">{$L.word_untested|upper}</span>
      {else}
        &#8212;
      {/if}
    </td>
  </tr>
  {/foreach}
  </table>

  <p>
    <input type="button" value="{$L.phrase_test_selected_components}" onclick="sc_ns.start(sc_ns.init_component_table_test)" />
  </p>

	<table cellspacing="1" cellpadding="1" width="100%" class="log_table">
	<tr>
	  <td class="full_log_heading">{$L.phrase_full_logs}</td>
	  <td class="error_log_heading">{$L.phrase_error_logs}</td>
	</tr>
	<tr>
	  <td>
	    <textarea id="full_log"></textarea>
	  </td>
	  <td>
	    <textarea id="error_log"></textarea>
	  </td>
	</tr>
	</table>

{include file='modules_footer.tpl'}