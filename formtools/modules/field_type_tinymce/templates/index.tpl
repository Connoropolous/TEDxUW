{include file='modules_header.tpl'}

  <table cellpadding="0" cellspacing="0">
  <tr>
    <td width="45"><img src="images/tinymce_icon.png" width="34" height="34" /></td>
    <td class="title">
      <a href="../../admin/modules">{$LANG.word_modules}</a>
      <span class="joiner">&raquo;</span>
      {$L.module_name}
    </td>
  </tr>
  </table>

  {include file="messages.tpl"}

  <div class="margin_bottom_large">
    Use the fields below to configure the default settings for the TinyMCE field type.
  </div>

  <form action="{$same_page}" method="post">

    <table cellspacing="0" cellpadding="1">
    <tr>
      <td width="170" class="medium_grey">{$LANG.word_toolbar}</td>
      <td>
        <select name="toolbar" id="toolbar">
          <option value="basic" {if $module_settings.toolbar == "basic"}selected{/if}>{$LANG.word_basic}</option>
          <option value="simple" {if $module_settings.toolbar == "simple"}selected{/if}>{$LANG.word_simple}</option>
          <option value="advanced" {if $module_settings.toolbar == "advanced"}selected{/if}>{$LANG.word_advanced}</option>
          <option value="expert" {if $module_settings.toolbar == "expert"}selected{/if}>{$LANG.word_expert}</option>
        </select>
      </td>
    </tr>
    <tr>
      <td class="medium_grey">{$LANG.phrase_toolbar_location}</td>
      <td>
        <input type="radio" name="location" id="ttl1" value="top"
          {if $module_settings.location == "top"}checked{/if} /> <label for="ttl1">{$LANG.word_top}</label>
        <input type="radio" name="location" id="ttl2" value="bottom"
          {if $module_settings.location == "bottom"}checked{/if} /> <label for="ttl2">{$LANG.word_bottom}</label>
      </td>
    </tr>
    <tr>
      <td class="medium_grey">{$LANG.phrase_toolbar_alignment}</td>
      <td>
        <input type="radio" name="alignment" id="tinymce_toolbar_align1" value="left"
          {if $module_settings.alignment == "left"}checked{/if} /> <label for="tinymce_toolbar_align1">{$LANG.word_left}</label>
        <input type="radio" name="alignment" id="tinymce_toolbar_align2" value="center"
          {if $module_settings.alignment == "center"}checked{/if} /> <label for="tinymce_toolbar_align2">{$LANG.word_center}</label>
        <input type="radio" name="alignment" id="tinymce_toolbar_align3" value="right"
          {if $module_settings.alignment == "right"}checked{/if} /> <label for="tinymce_toolbar_align3">{$LANG.word_right}</label>
      </td>
    </tr>
    <tr>
      <td class="medium_grey">{$LANG.phrase_show_path_information}</td>
      <td>
        <input type="radio" name="show_path" id="tinymce_show_path1" value="yes"
          {if $module_settings.show_path == "yes"}checked{/if} /> <label for="tinymce_show_path1">{$LANG.word_yes}</label>
        <input type="radio" name="show_path" id="tinymce_show_path2" value="no"
          {if $module_settings.show_path == "no"}checked{/if} /> <label for="tinymce_show_path2">{$LANG.word_no}</label>
      </td>
    </tr>
    <tr>
      <td class="medium_grey">&mdash; {$LANG.phrase_path_info_location}</td>
      <td class="subelements">
        <input type="radio" name="path_info_location" id="tinymce_path_info_location1" value="top"
          {if $module_settings.path_info_location == "top"}checked{/if} {if $module_settings.show_path == "no"}disabled{/if}
          /> <label for="tinymce_path_info_location1"{if $module_settings.show_path == "no"} class="light_grey"{/if}>{$LANG.word_top}</label>
        <input type="radio" name="path_info_location" id="tinymce_path_info_location2" value="bottom"
          {if $module_settings.path_info_location == "bottom"}checked{/if} {if $module_settings.show_path == "no"}disabled{/if}
          /> <label for="tinymce_path_info_location2"{if $module_settings.show_path == "no"} class="light_grey"{/if}>{$LANG.word_bottom}</label>
      </td>
    </tr>
    <tr>
      <td class="medium_grey">&mdash; {$LANG.phrase_allow_toolbar_resizing}</td>
      <td class="subelements">
        <input type="radio" name="resizing" id="tinymce_resize1" value="yes"
          {if $module_settings.resizing == "true"}checked{/if} {if $module_settings.show_path == "no"}disabled{/if}
          /> <label for="tinymce_resize1">{$LANG.word_yes}</label>
        <input type="radio" name="resizing" id="tinymce_resize2" value="no"
          {if $module_settings.resizing == ""}checked{/if} {if $module_settings.show_path == "no"}disabled{/if}
          /> <label for="tinymce_resize2">{$LANG.word_no}</label>
      </td>
    </tr>
    </table>

    <p class="bold">{$LANG.phrase_example_editor}</p>

    <div>
      <textarea id="example" name="example" rows="8" cols="90" style="width: 100%">{$L.text_example_wysiwyg}</textarea>
    </div>

    <p>
      <input type="submit" name="update" value="{$LANG.word_update|upper}" />
    </p>

  </form>

{include file='modules_footer.tpl'}