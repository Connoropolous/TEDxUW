{include file='modules_header.tpl'}

  <table cellpadding="0" cellspacing="0">
  <tr>
    <td width="45"><img src="images/icon.png" width="34" height="34" /></td>
    <td class="title">
      <a href="../../admin/modules">{$LANG.word_modules}</a>
      <span class="joiner">&raquo;</span>
      <a href="./">{$L.module_name}</a>
      <span class="joiner">&raquo;</span>
      {$L.phrase_orphan_clean_up}
    </td>
  </tr>
  </table>

  {include file="messages.tpl"}

  <div class="margin_bottom_large">
    {$L.text_orphan_record_check_intro}
  </div>

    <!-- For compatibility with the existing, generic test code -->
    <div class="hidden">
      <input type="checkbox" class="components" value="core" checked="checked" />
    </div>

	  <p>
	    <input type="button" value="{$L.phrase_run_test}" onclick="sc_ns.start(sc_ns.init_orphan_record_test)" />
	  </p>

		<table cellspacing="1" cellpadding="1" width="100%" class="log_table">
		<tr>
		  <td class="full_log_heading">{$L.phrase_full_logs}</td>
		  <td class="error_log_heading">{$L.phrase_error_logs}</td>
		</tr>
		<tr>
		  <td>
		    <textarea id="full_log" style="height: 300px"></textarea>
		  </td>
		  <td>
		    <textarea id="error_log" style="height: 300px"></textarea>
		  </td>
		</tr>
		</table>

{include file='modules_footer.tpl'}