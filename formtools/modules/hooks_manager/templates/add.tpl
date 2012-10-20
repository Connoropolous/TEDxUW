{include file='modules_header.tpl'}

  <table cellpadding="0" cellspacing="0">
  <tr>
    <td width="45"><a href="index.php"><img src="images/icon.gif" border="0" width="34" height="34" /></a></td>
    <td class="title"><a href="index.php">
      <a href="../../admin/modules">{$LANG.word_modules}</a>
      <span class="joiner">&raquo;</span>
      <a href="index.php">{$L.module_name}</a>
      <span class="joiner">&raquo;</span>
      {$L.phrase_add_rule}
    </td>
  </tr>
  </table>

  {include file='messages.tpl'}

  <form action="edit.php" method="post" onsubmit="return rsv.validate(this, rules)">

    <table cellspacing="1" cellpadding="1" border="0" width="100%">
    <tr>
      <td width="120">{$LANG.word_status}</td>
      <td>
        <input type="radio" name="status" value="enabled" id="status1" checked />
          <label for="status1" class="green">{$LANG.word_enabled}</label>
        <input type="radio" name="status" value="disabled" id="status2" />
          <label for="status2" class="red">{$LANG.word_disabled}</label>
      </td>
    </tr>
    <tr>
      <td>{$L.phrase_rule_name}</td>
      <td><input type="text" name="rule_name" value="" style="width:100%" maxlength="255" /></td>
    </tr>
    <tr>
      <td>{$L.word_priority}</td>
      <td>
        <select name="priority">
          {section name=foo start=1 loop=100 step=1}
            <option value="{$smarty.section.foo.index}" {if $smarty.section.foo.index == 50}selected{/if}>{$smarty.section.foo.index}</option>
          {/section}
        </select>
        <span class="medium_grey">{$L.text_priority_desc}</span>
      </td>
    </tr>
    <tr>
      <td>{$L.phrase_hook_type}</td>
      <td>
        <input type="radio" name="hook_type" value="code" id="ht1" checked onclick="hm.select_hook_type('code')" />
          <label for="ht1">{$L.phrase_code_hook}</label>
        <input type="radio" name="hook_type" value="template" id="ht2" onclick="hm.select_hook_type('template')" />
          <label for="ht2">{$L.phrase_template_hook}</label>
        <input type="radio" name="hook_type" value="custom" id="ht3" onclick="hm.select_hook_type('custom')" />
          <label for="ht3">{$L.phrase_custom_hook}</label>
      </td>
    </tr>
    </table>

    <div class="grey_box margin_top" id="code_hook_fields">
      <table cellspacing="1" cellpadding="1" border="0" width="100%">
      <tr>
        <td width="120" valign="top">{$L.phrase_code_hook}</td>
        <td>
          <select name="code_hook_dropdown" onchange="hm.select_hook(this.value)" onkeyup="hm.select_hook(this.value)">
            <option value="">{$LANG.phrase_please_select}</option>
            {foreach from=$code_hooks item=hook name=row}
              <option value="{$hook.function_name},{$hook.action_location}">{$hook.function_name}, {$hook.action_location}</option>
            {/foreach}
          </select>
        </td>
      </tr>
      <tr>
        <td valign="top">{$L.phrase_php_code}</td>
        <td>
          <div style="border: 1px solid #666666; background: #ffffff; padding: 3px">
            <textarea name="code_hook_code" id="code_hook_code" style="width:100%; height:240px"></textarea>
          </div>
          <script>
          var html_editor = new CodeMirror.fromTextArea("code_hook_code", {literal}{{/literal}
          parserfile: ["parsejavascript.js", "tokenizejavascript.js"],
          path: "{$g_root_url}/global/codemirror/js/",
          stylesheet: "{$g_root_url}/global/codemirror/css/jscolors.css"
          {literal}});{/literal}
          </script>
          <table cellspacing="1" cellpadding="0" width="100%" class="hook_param_table">
          <tr>
            <th width="50%">{$L.phrase_available_variables}</th>
            <th width="50%">{$L.phrase_overridable_variables}</th>
          </tr>
          <tr>
            <td valign="top">
              <div id="code_hook_params">&#8212;</div>
            </td>
            <td valign="top">
              <div id="code_hook_overridable_values">&#8212;</div>
            </td>
          </tr>
          </table>

        </td>
      </tr>
      </table>

      <p>
        <input type="submit" name="add_rule" value="{$L.phrase_add_rule}" />
      </p>
    </div>

    <div id="template_hook_fields" style="display:none">
      <div class="grey_box margin_top">
        <table cellspacing="1" cellpadding="1" border="0" width="100%">
        <tr>
          <td width="120" valign="top">{$L.phrase_template_hook}</td>
          <td>
            <select name="template_hook_dropdown">
              <option value="">{$LANG.phrase_please_select}</option>
              {foreach from=$template_hooks item=hook name=row}
                <option value="{$hook.action_location}">{$hook.filepath} - {$hook.action_location}</option>
              {/foreach}
            </select>
          </td>
        </tr>
        <tr>
          <td>{$L.phrase_content_type}</td>
          <td>
            <input type="radio" name="template_hook_code_type" value="html" id="thct1" />
              <label for="thct1">{$LANG.word_html}</label>
            <input type="radio" name="template_hook_code_type" value="php" id="thct2" />
              <label for="thct2">{$L.word_php}</label>
            <input type="radio" name="template_hook_code_type" value="smarty" id="thct3" />
              <label for="thct3">{$L.word_smarty}</label>
          </td>
        </tr>
        <tr>
          <td valign="top">{$L.phrase_php_code}</td>
          <td>
            <div style="border: 1px solid #666666; background: #ffffff; padding: 3px">
              <textarea name="template_hook_code" id="template_hook_code" style="width:100%; height:240px"></textarea>
            </div>
            <script>
            var html_editor = new CodeMirror.fromTextArea("template_hook_code", {literal}{{/literal}
            parserfile: ["parsejavascript.js", "tokenizejavascript.js"],
            path: "{$g_root_url}/global/codemirror/js/",
            stylesheet: "{$g_root_url}/global/codemirror/css/jscolors.css"
            {literal}});{/literal}
            </script>
          </td>
        </tr>
        </table>
      </div>

      <p>
        <input type="submit" name="add_rule" value="{$L.phrase_add_rule}" />
      </p>

    </div>

    <div id="custom_hook_fields" style="display:none">
      <div class="grey_box margin_top">
        <table cellspacing="1" cellpadding="1" border="0" width="100%">
        <tr>
          <td width="120" valign="top">{$L.phrase_custom_hook}</td>
          <td>
            <input type="text" name="custom_hook" id="custom_hook" onkeyup="hm.generate_custom_hook()" style="width: 240px" />
            <span class="medium_grey">{$L.text_custom_hook_desc}</span>
          </td>
        </tr>
        <tr>
          <td>{$L.phrase_smarty_code}</td>
          <td>
            <div id="custom_hook_smarty_code"></div>
          </td>
        </tr>
        <tr>
          <td>{$L.phrase_content_type}</td>
          <td>
            <input type="radio" name="custom_hook_code_type" value="html" id="chct1" />
              <label for="chct1">{$LANG.word_html}</label>
            <input type="radio" name="custom_hook_code_type" value="php" id="chct2" />
              <label for="chct2">{$L.word_php}</label>
            <input type="radio" name="custom_hook_code_type" value="smarty" id="chct3" />
              <label for="chct3">{$L.word_smarty}</label>
          </td>
        </tr>
        <tr>
          <td valign="top">{$L.phrase_php_code}</td>
          <td>
            <div style="border: 1px solid #666666; background: #ffffff; padding: 3px">
              <textarea name="custom_hook_code" id="custom_hook_code" style="width:100%; height:240px"></textarea>
            </div>
            <script type="text/javascript">
            var html_editor = new CodeMirror.fromTextArea("custom_hook_code", {literal}{{/literal}
            parserfile: ["parsejavascript.js", "tokenizejavascript.js"],
            path: "{$g_root_url}/global/codemirror/js/",
            stylesheet: "{$g_root_url}/global/codemirror/css/jscolors.css"
            {literal}});{/literal}
            </script>
          </td>
        </tr>
        </table>

      </div>
      <p>
        <input type="submit" name="add_rule" value="{$L.phrase_add_rule}" />
      </p>
    </div>

  </form>
{include file='modules_footer.tpl'}