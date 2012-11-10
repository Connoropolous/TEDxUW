-- phpMyAdmin SQL Dump
-- version 3.4.11.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 10, 2012 at 02:05 PM
-- Server version: 5.1.65
-- PHP Version: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hous9135_tedx`
--

-- --------------------------------------------------------

--
-- Table structure for table `ft_accounts`
--

CREATE TABLE IF NOT EXISTS `ft_accounts` (
  `account_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `account_type` enum('admin','client') NOT NULL DEFAULT 'client',
  `account_status` enum('active','disabled','pending') NOT NULL DEFAULT 'disabled',
  `last_logged_in` datetime DEFAULT NULL,
  `ui_language` varchar(50) NOT NULL DEFAULT 'en_us',
  `timezone_offset` varchar(4) DEFAULT NULL,
  `sessions_timeout` varchar(10) NOT NULL DEFAULT '30',
  `date_format` varchar(50) NOT NULL DEFAULT 'M jS, g:i A',
  `login_page` varchar(50) NOT NULL DEFAULT 'client_forms',
  `logout_url` varchar(255) DEFAULT NULL,
  `theme` varchar(50) NOT NULL DEFAULT 'default',
  `swatch` varchar(255) NOT NULL,
  `menu_id` mediumint(8) unsigned NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `temp_reset_password` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`account_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `ft_accounts`
--

INSERT INTO `ft_accounts` (`account_id`, `account_type`, `account_status`, `last_logged_in`, `ui_language`, `timezone_offset`, `sessions_timeout`, `date_format`, `login_page`, `logout_url`, `theme`, `swatch`, `menu_id`, `first_name`, `last_name`, `email`, `username`, `password`, `temp_reset_password`) VALUES
(1, 'admin', 'active', '2012-11-10 14:03:24', 'en_us', '0', '30', 'M jS, g:i A', 'admin_forms', 'http://www.indigodesign.me/game/current/formtools', 'default', 'green', 1, 'TEDx', 'UW', 'connorturland@gmail.com', 'tedx', '26c7a79ed8ee198969e4e23c358d5a7b', NULL),
(2, 'client', 'active', '2011-12-09 12:15:24', 'en_us', '0', '30', 'M jS y, g:i A', 'client_forms', 'http://www.indigodesign.me/game/current/formtools', 'default', 'green', 2, 'THE', 'MUSEUM', 'themuseum@themuseum.ca', 'THEMUSEUM', '5e95ada161b470cc3aaaab25906bc7cd', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ft_account_settings`
--

CREATE TABLE IF NOT EXISTS `ft_account_settings` (
  `account_id` mediumint(8) unsigned NOT NULL,
  `setting_name` varchar(255) NOT NULL,
  `setting_value` mediumtext NOT NULL,
  PRIMARY KEY (`account_id`,`setting_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ft_account_settings`
--

INSERT INTO `ft_account_settings` (`account_id`, `setting_name`, `setting_value`) VALUES
(2, 'client_notes', ''),
(2, 'company_name', ''),
(2, 'page_titles', 'Form Tools - {$page}'),
(2, 'footer_text', ''),
(2, 'may_edit_page_titles', 'no'),
(2, 'may_edit_footer_text', 'no'),
(2, 'may_edit_theme', 'yes'),
(2, 'may_edit_logout_url', 'yes'),
(2, 'may_edit_language', 'yes'),
(2, 'may_edit_timezone_offset', 'yes'),
(2, 'may_edit_sessions_timeout', 'no'),
(2, 'may_edit_date_format', 'no'),
(2, 'max_failed_login_attempts', ''),
(2, 'num_failed_login_attempts', '0'),
(2, 'password_history', '5e95ada161b470cc3aaaab25906bc7cd'),
(2, 'min_password_length', ''),
(2, 'num_password_history', ''),
(2, 'required_password_chars', ''),
(2, 'may_edit_max_failed_login_attempts', 'no'),
(2, 'forms_page_default_message', '{$LANG.text_client_welcome}');

-- --------------------------------------------------------

--
-- Table structure for table `ft_client_forms`
--

CREATE TABLE IF NOT EXISTS `ft_client_forms` (
  `account_id` mediumint(8) unsigned NOT NULL,
  `form_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`account_id`,`form_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ft_client_forms`
--

INSERT INTO `ft_client_forms` (`account_id`, `form_id`) VALUES
(2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ft_client_views`
--

CREATE TABLE IF NOT EXISTS `ft_client_views` (
  `account_id` mediumint(8) unsigned NOT NULL,
  `view_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`account_id`,`view_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ft_email_templates`
--

CREATE TABLE IF NOT EXISTS `ft_email_templates` (
  `email_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `form_id` mediumint(8) unsigned NOT NULL,
  `email_template_name` varchar(100) DEFAULT NULL,
  `email_status` enum('enabled','disabled') NOT NULL DEFAULT 'enabled',
  `view_mapping_type` enum('all','specific') NOT NULL DEFAULT 'all',
  `limit_email_content_to_fields_in_view` mediumint(9) DEFAULT NULL,
  `email_event_trigger` set('on_submission','on_edit','on_delete') DEFAULT NULL,
  `include_on_edit_submission_page` enum('no','all_views','specific_views') NOT NULL DEFAULT 'no',
  `subject` varchar(255) DEFAULT NULL,
  `email_from` enum('admin','client','form_email_field','custom','none') DEFAULT NULL,
  `email_from_account_id` mediumint(8) unsigned DEFAULT NULL,
  `email_from_form_email_id` mediumint(8) unsigned DEFAULT NULL,
  `custom_from_name` varchar(100) DEFAULT NULL,
  `custom_from_email` varchar(100) DEFAULT NULL,
  `email_reply_to` enum('admin','client','form_email_field','custom','none') DEFAULT NULL,
  `email_reply_to_account_id` mediumint(8) unsigned DEFAULT NULL,
  `email_reply_to_form_email_id` mediumint(8) unsigned DEFAULT NULL,
  `custom_reply_to_name` varchar(100) DEFAULT NULL,
  `custom_reply_to_email` varchar(100) DEFAULT NULL,
  `html_template` mediumtext,
  `text_template` mediumtext,
  PRIMARY KEY (`email_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ft_email_template_edit_submission_views`
--

CREATE TABLE IF NOT EXISTS `ft_email_template_edit_submission_views` (
  `email_id` mediumint(8) unsigned NOT NULL,
  `view_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`email_id`,`view_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ft_email_template_recipients`
--

CREATE TABLE IF NOT EXISTS `ft_email_template_recipients` (
  `recipient_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `email_template_id` mediumint(8) unsigned NOT NULL,
  `recipient_user_type` enum('admin','client','form_email_field','custom') NOT NULL,
  `recipient_type` enum('main','cc','bcc') NOT NULL DEFAULT 'main',
  `account_id` mediumint(9) DEFAULT NULL,
  `form_email_id` mediumint(8) unsigned DEFAULT NULL,
  `custom_recipient_name` varchar(200) DEFAULT NULL,
  `custom_recipient_email` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`recipient_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ft_email_template_when_sent_views`
--

CREATE TABLE IF NOT EXISTS `ft_email_template_when_sent_views` (
  `email_id` mediumint(9) NOT NULL,
  `view_id` mediumint(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ft_field_options`
--

CREATE TABLE IF NOT EXISTS `ft_field_options` (
  `list_id` mediumint(8) unsigned NOT NULL,
  `list_group_id` mediumint(9) NOT NULL,
  `option_order` smallint(4) NOT NULL,
  `option_value` varchar(255) NOT NULL,
  `option_name` varchar(255) NOT NULL,
  `is_new_sort_group` enum('yes','no') NOT NULL,
  PRIMARY KEY (`list_id`,`list_group_id`,`option_order`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ft_field_options`
--

INSERT INTO `ft_field_options` (`list_id`, `list_group_id`, `option_order`, `option_value`, `option_name`, `is_new_sort_group`) VALUES
(1, 7, 1, 'agree', 'Opted into receiving emails.', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `ft_field_settings`
--

CREATE TABLE IF NOT EXISTS `ft_field_settings` (
  `field_id` mediumint(8) unsigned NOT NULL,
  `setting_id` mediumint(9) NOT NULL,
  `setting_value` mediumtext,
  PRIMARY KEY (`field_id`,`setting_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ft_field_settings`
--

INSERT INTO `ft_field_settings` (`field_id`, `setting_id`, `setting_value`) VALUES
(12, 22, 'datetime:yy-mm-dd|h:mm TT|ampm`true'),
(12, 23, 'yes'),
(13, 22, 'datetime:yy-mm-dd|h:mm TT|ampm`true'),
(13, 23, 'yes'),
(19, 19, '1');

-- --------------------------------------------------------

--
-- Table structure for table `ft_field_types`
--

CREATE TABLE IF NOT EXISTS `ft_field_types` (
  `field_type_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `is_editable` enum('yes','no') NOT NULL,
  `non_editable_info` mediumtext,
  `managed_by_module_id` mediumint(9) DEFAULT NULL,
  `field_type_name` varchar(255) NOT NULL,
  `field_type_identifier` varchar(50) NOT NULL,
  `group_id` smallint(6) NOT NULL,
  `is_file_field` enum('yes','no') NOT NULL DEFAULT 'no',
  `is_date_field` enum('yes','no') NOT NULL DEFAULT 'no',
  `raw_field_type_map` varchar(50) DEFAULT NULL,
  `raw_field_type_map_multi_select_id` mediumint(9) DEFAULT NULL,
  `list_order` smallint(6) NOT NULL,
  `compatible_field_sizes` varchar(255) NOT NULL,
  `view_field_rendering_type` enum('none','php','smarty') NOT NULL DEFAULT 'none',
  `view_field_php_function_source` varchar(255) DEFAULT NULL,
  `view_field_php_function` varchar(255) DEFAULT NULL,
  `view_field_smarty_markup` mediumtext NOT NULL,
  `edit_field_smarty_markup` mediumtext NOT NULL,
  `php_processing` mediumtext NOT NULL,
  `resources_css` mediumtext,
  `resources_js` mediumtext,
  PRIMARY KEY (`field_type_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `ft_field_types`
--

INSERT INTO `ft_field_types` (`field_type_id`, `is_editable`, `non_editable_info`, `managed_by_module_id`, `field_type_name`, `field_type_identifier`, `group_id`, `is_file_field`, `is_date_field`, `raw_field_type_map`, `raw_field_type_map_multi_select_id`, `list_order`, `compatible_field_sizes`, `view_field_rendering_type`, `view_field_php_function_source`, `view_field_php_function`, `view_field_smarty_markup`, `edit_field_smarty_markup`, `php_processing`, `resources_css`, `resources_js`) VALUES
(1, 'no', '{$LANG.text_non_deletable_fields}', NULL, '{$LANG.word_textbox}', 'textbox', 1, 'no', 'no', 'textbox', NULL, 1, '1char,2chars,tiny,small,medium,large,very_large', 'smarty', 'core', '', '{$VALUE|htmlspecialchars}', '<input type="text" name="{$NAME}" value="{$VALUE|escape}" \r\n  class="{$size}{if $highlight} {$highlight}{/if}" \r\n  {if $maxlength}maxlength="{$maxlength}"{/if} />\r\n \r\n{if $comments}\r\n  <div class="cf_field_comments">{$comments}</div>\r\n{/if}\r\n', '\r\n', 'input.cf_size_tiny {\r\n  width: 30px; \r\n}\r\ninput.cf_size_small {\r\n  width: 80px; \r\n}\r\ninput.cf_size_medium {\r\n  width: 150px; \r\n}\r\ninput.cf_size_large {\r\n  width: 250px;\r\n}\r\ninput.cf_size_full_width {\r\n  width: 99%; \r\n}\r\n\r\n', ''),
(2, 'yes', NULL, NULL, '{$LANG.word_textarea}', 'textarea', 1, 'no', 'no', 'textarea', NULL, 2, 'medium,large,very_large', 'smarty', 'core', '', '{if $CONTEXTPAGE == "edit_submission"}  \r\n  {$VALUE|nl2br}\r\n{else}\r\n  {$VALUE}\r\n{/if}', '{* figure out all the classes *}\r\n{assign var=classes value=$height}\r\n{if $highlight_colour}\r\n  {assign var=classes value="`$classes` `$highlight_colour`"}\r\n{/if}\r\n{if $input_length == "words" && $maxlength != ""}\r\n  {assign var=classes value="`$classes` cf_wordcounter max`$maxlength`"}\r\n{elseif $input_length == "chars" && $maxlength != ""}\r\n  {assign var=classes value="`$classes` cf_textcounter max`$maxlength`"}\r\n{/if}\r\n\r\n<textarea name="{$NAME}" id="{$NAME}_id" class="{$classes}">{$VALUE}</textarea>\r\n\r\n{if $input_length == "words" && $maxlength != ""}\r\n  <div class="cf_counter" id="{$NAME}_counter">\r\n    {$maxlength} {$LANG.phrase_word_limit_p} <span></span> {$LANG.phrase_remaining_words}\r\n  </div>\r\n{elseif $input_length == "chars" && $maxlength != ""}\r\n  <div class="cf_counter" id="{$NAME}_counter">\r\n    {$maxlength} {$LANG.phrase_characters_limit_p} <span></span> {$LANG.phrase_remaining_characters}\r\n  </div>\r\n{/if}\r\n\r\n{if $comments}\r\n  <div class="cf_field_comments">{$comments|nl2br}</div>\r\n{/if}', '', '.cf_counter span {\r\n  font-weight: bold; \r\n}\r\ntextarea {\r\n  width: 99%;\r\n}\r\ntextarea.cf_size_tiny {\r\n  height: 30px;\r\n}\r\ntextarea.cf_size_small {\r\n  height: 80px;  \r\n}\r\ntextarea.cf_size_medium {\r\n  height: 150px;  \r\n}\r\ntextarea.cf_size_large {\r\n  height: 300px;\r\n}\r\n', '/**\r\n * The following code provides a simple text/word counter option for any  \r\n * textarea. It either just keeps counting up, or limits the results to a\r\n * certain number - all depending on what the user has selected via the\r\n * field type settings.\r\n */\r\nvar cf_counter = {};\r\ncf_counter.get_max_count = function(el) {\r\n  var classes = $(el).attr(''class'').split(" ").slice(-1);\r\n  var max = null;\r\n  for (var i=0; i<classes.length; i++) {\r\n    var result = classes[i].match(/max(\\d+)/);\r\n    if (result != null) {\r\n      max = result[1];\r\n      break;\r\n    }\r\n  }\r\n  return max;\r\n}\r\n\r\n$(function() {\r\n  $("textarea[class~=''cf_wordcounter'']").each(function() {\r\n    var max = cf_counter.get_max_count(this);\r\n    if (max == null) {\r\n      return;\r\n    }\r\n    $(this).bind("keydown", function() {\r\n      var val = $(this).val();\r\n      var len        = val.split(/[\\s]+/);\r\n      var field_name = $(this).attr("name");\r\n      var num_words  = len.length - 1;\r\n      if (num_words > max) {\r\n        var allowed_words = val.split(/[\\s]+/, max);\r\n        truncated_str = allowed_words.join(" ");\r\n        $(this).val(truncated_str);\r\n      } else {\r\n        $("#" + field_name + "_counter").find("span").html(parseInt(max) - parseInt(num_words));\r\n      }\r\n    });     \r\n    $(this).trigger("keydown");\r\n  });\r\n\r\n  $("textarea[class~=''cf_textcounter'']").each(function() {\r\n    var max = cf_counter.get_max_count(this);\r\n    if (max == null) {\r\n      return;\r\n    }\r\n    $(this).bind("keydown", function() {    \r\n      var field_name = $(this).attr("name");      \r\n      if (this.value.length > max) {\r\n        this.value = this.value.substring(0, max);\r\n      } else {\r\n        $("#" + field_name + "_counter").find("span").html(max - this.value.length);\r\n      }\r\n    });\r\n    $(this).trigger("keydown");\r\n  }); \r\n});'),
(3, 'yes', NULL, NULL, '{$LANG.word_password}', 'password', 1, 'no', 'no', 'password', NULL, 3, '1char,2chars,tiny,small,medium', 'none', 'core', '', '\r\n', '<input type="password" name="{$NAME}" value="{$VALUE|escape}" \r\n  class="cf_password" />\r\n \r\n{if $comments}\r\n  <div class="cf_field_comments">{$comments}</div>\r\n{/if}\r\n', '', 'input.cf_password {\r\n  width: 120px;\r\n}\r\n', ''),
(4, 'yes', NULL, NULL, '{$LANG.word_dropdown}', 'dropdown', 1, 'no', 'no', 'select', 11, 6, '1char,2chars,tiny,small,medium,large', 'php', 'core', 'ft_display_field_type_dropdown', '{strip}{if $contents != ""}\r\n  {foreach from=$contents.options item=curr_group_info name=group}\r\n    {assign var=options value=$curr_group_info.options}\r\n    {foreach from=$options item=option name=row}\r\n      {if $VALUE == $option.option_value}{$option.option_name}{/if}\r\n    {/foreach}\r\n  {/foreach}\r\n{/if}{/strip}', '{if $contents == ""}\r\n  <div class="cf_field_comments">\r\n    {$LANG.phrase_not_assigned_to_option_list} \r\n  </div>\r\n{else}\r\n  <select name="{$NAME}">\r\n  {foreach from=$contents.options item=curr_group_info name=group}\r\n    {assign var=group_info value=$curr_group_info.group_info}\r\n    {assign var=options value=$curr_group_info.options}\r\n    {if $group_info.group_name}\r\n      <optgroup label="{$group_info.group_name|escape}">\r\n    {/if}\r\n    {foreach from=$options item=option name=row}\r\n      <option value="{$option.option_value}"\r\n        {if $VALUE == $option.option_value}selected{/if}>{$option.option_name}</option>\r\n    {/foreach}\r\n    {if $group_info.group_name}\r\n      </optgroup>\r\n    {/if}\r\n  {/foreach}\r\n  </select>\r\n{/if}\r\n\r\n{if $comments}\r\n  <div class="cf_field_comments">{$comments}</div>\r\n{/if}\r\n\r\n', '', '', ''),
(5, 'yes', NULL, NULL, '{$LANG.phrase_multi_select_dropdown}', 'multi_select_dropdown', 1, 'no', 'no', 'multi-select', 13, 7, '1char,2chars,tiny,small,medium,large', 'php', 'core', 'ft_display_field_type_multi_select_dropdown', '{if $contents != ""}\r\n  {assign var=vals value="`$g_multi_val_delimiter`"|explode:$VALUE}\r\n  {assign var=is_first value=true}\r\n  {strip}\r\n  {foreach from=$contents.options item=curr_group_info name=group}\r\n    {assign var=options value=$curr_group_info.options}\r\n    {foreach from=$options item=option name=row}\r\n      {if $option.option_value|in_array:$vals}\r\n        {if $is_first == false}, {/if}\r\n        {$option.option_name}\r\n        {assign var=is_first value=false}\r\n      {/if}\r\n    {/foreach}\r\n  {/foreach}\r\n  {/strip}\r\n{/if}', '{if $contents == ""}\r\n  <div class="cf_field_comments">{$LANG.phrase_not_assigned_to_option_list}</div>\r\n{else}\r\n  {assign var=vals value="`$g_multi_val_delimiter`"|explode:$VALUE}\r\n  <select name="{$NAME}[]" multiple size="{if $num_rows}{$num_rows}{else}5{/if}">\r\n  {foreach from=$contents.options item=curr_group_info name=group}\r\n    {assign var=group_info value=$curr_group_info.group_info}\r\n    {assign var=options value=$curr_group_info.options}\r\n    {if $group_info.group_name}\r\n      <optgroup label="{$group_info.group_name|escape}">\r\n    {/if}\r\n    {foreach from=$options item=option name=row}\r\n      <option value="{$option.option_value}"\r\n        {if $option.option_value|in_array:$vals}selected{/if}>{$option.option_name}</option>\r\n    {/foreach}\r\n    {if $group_info.group_name}\r\n      </optgroup>\r\n    {/if}\r\n  {/foreach}\r\n  </select>\r\n{/if}\r\n\r\n{if $comments}\r\n  <div class="cf_field_comments">{$comments}</div>\r\n{/if}\r\n', '', '', ''),
(6, 'yes', NULL, NULL, '{$LANG.phrase_radio_buttons}', 'radio_buttons', 1, 'no', 'no', 'radio-buttons', 16, 4, '1char,2chars,tiny,small,medium,large', 'php', 'core', 'ft_display_field_type_radios', '{strip}{if $contents != ""}\r\n  {foreach from=$contents.options item=curr_group_info name=group}\r\n    {assign var=options value=$curr_group_info.options}\r\n    {foreach from=$options item=option name=row}\r\n      {if $VALUE == $option.option_value}{$option.option_name}{/if}\r\n    {/foreach}\r\n  {/foreach}\r\n{/if}{/strip}', '{if $contents == ""}\r\n  <div class="cf_field_comments">{$LANG.phrase_not_assigned_to_option_list}</div>\r\n{else}\r\n  {assign var=is_in_columns value=false}\r\n  {if $formatting == "cf_option_list_2cols" || \r\n      $formatting == "cf_option_list_3cols" || \r\n      $formatting == "cf_option_list_4cols"}\r\n    {assign var=is_in_columns value=true}\r\n  {/if}\r\n\r\n  {assign var=counter value="1"}\r\n  {foreach from=$contents.options item=curr_group_info name=group}\r\n    {assign var=group_info value=$curr_group_info.group_info}\r\n    {assign var=options value=$curr_group_info.options}\r\n\r\n    {if $group_info.group_name}\r\n      <div class="cf_option_list_group_label">{$group_info.group_name}</div>\r\n    {/if}\r\n\r\n    {if $is_in_columns}<div class="{$formatting}">{/if}\r\n\r\n    {foreach from=$options item=option name=row}\r\n      {if $is_in_columns}<div class="column">{/if}\r\n        <input type="radio" name="{$NAME}" id="{$NAME}_{$counter}" \r\n          value="{$option.option_value}"\r\n          {if $VALUE == $option.option_value}checked{/if} />\r\n          <label for="{$NAME}_{$counter}">{$option.option_name}</label>\r\n      {if $is_in_columns}</div>{/if}\r\n      {if $formatting == "vertical"}<br />{/if}\r\n      {assign var=counter value=$counter+1}\r\n    {/foreach}\r\n\r\n    {if $is_in_columns}</div>{/if}\r\n  {/foreach}\r\n\r\n  {if $comments}<div class="cf_field_comments">{$comments}</div>{/if}\r\n{/if}', '', '/* All CSS styles for this field type are found in Shared Resources */\r\n', ''),
(7, 'yes', NULL, NULL, '{$LANG.word_checkboxes}', 'checkboxes', 1, 'no', 'no', 'checkboxes', 19, 5, '1char,2chars,tiny,small,medium,large', 'php', 'core', 'ft_display_field_type_checkboxes', '{strip}{if $contents != ""}\r\n  {assign var=vals value="`$g_multi_val_delimiter`"|explode:$VALUE}\r\n  {assign var=is_first value=true}\r\n  {strip}\r\n  {foreach from=$contents.options item=curr_group_info name=group}\r\n    {assign var=options value=$curr_group_info.options}\r\n    {foreach from=$options item=option name=row}\r\n      {if $option.option_value|in_array:$vals}\r\n        {if $is_first == false}, {/if}\r\n        {$option.option_name}\r\n        {assign var=is_first value=false}\r\n      {/if}\r\n    {/foreach}\r\n  {/foreach}\r\n  {/strip}\r\n{/if}{/strip}', '{if $contents == ""}\r\n  <div class="cf_field_comments">{$LANG.phrase_not_assigned_to_option_list}</div>\r\n{else}\r\n  {assign var=vals value="`$g_multi_val_delimiter`"|explode:$VALUE}\r\n  {assign var=is_in_columns value=false}\r\n  {if $formatting == "cf_option_list_2cols" || \r\n      $formatting == "cf_option_list_3cols" || \r\n      $formatting == "cf_option_list_4cols"}\r\n    {assign var=is_in_columns value=true}\r\n  {/if}\r\n\r\n  {assign var=counter value="1"}\r\n  {foreach from=$contents.options item=curr_group_info name=group}\r\n    {assign var=group_info value=$curr_group_info.group_info}\r\n    {assign var=options value=$curr_group_info.options}\r\n\r\n    {if $group_info.group_name}\r\n      <div class="cf_option_list_group_label">{$group_info.group_name}</div>\r\n    {/if}\r\n\r\n    {if $is_in_columns}<div class="{$formatting}">{/if}\r\n\r\n    {foreach from=$options item=option name=row}\r\n      {if $is_in_columns}<div class="column">{/if}\r\n        <input type="checkbox" name="{$NAME}[]" id="{$NAME}_{$counter}" \r\n          value="{$option.option_value|escape}" \r\n          {if $option.option_value|in_array:$vals}checked{/if} />\r\n          <label for="{$NAME}_{$counter}">{$option.option_name}</label>\r\n      {if $is_in_columns}</div>{/if}\r\n      {if $formatting == "vertical"}<br />{/if}\r\n      {assign var=counter value=$counter+1}\r\n    {/foreach}\r\n\r\n    {if $is_in_columns}</div>{/if}\r\n  {/foreach}\r\n\r\n  {if {$comments}\r\n    <div class="cf_field_comments">{$comments}</div> \r\n  {/if}\r\n{/if}', '', '/* all CSS is found in Shared Resources */\r\n', ''),
(8, 'no', '{$LANG.text_non_deletable_fields}', NULL, '{$LANG.word_date}', 'date', 2, 'no', 'yes', '', NULL, 1, 'small', 'php', 'core', 'ft_display_field_type_date', '{strip}\r\n  {if $VALUE}\r\n    {assign var=tzo value=""}\r\n    {if $apply_timezone_offset == "yes"}\r\n      {assign var=tzo value=$ACCOUNT_INFO.timezone_offset}\r\n    {/if}\r\n    {if $display_format == "yy-mm-dd" || !$display_format}\r\n      {$VALUE|custom_format_date:$tzo:"Y-m-d"}\r\n    {elseif $display_format == "dd/mm/yy"}\r\n      {$VALUE|custom_format_date:$tzo:"d/m/Y"}\r\n    {elseif $display_format == "mm/dd/yy"}\r\n      {$VALUE|custom_format_date:$tzo:"m/d/Y"}\r\n    {elseif $display_format == "M d, yy"}\r\n      {$VALUE|custom_format_date:$tzo:"M j, Y"}\r\n    {elseif $display_format == "MM d, yy"}\r\n      {$VALUE|custom_format_date:$tzo:"F j, Y"}\r\n    {elseif $display_format == "D M d, yy"}\r\n      {$VALUE|custom_format_date:$tzo:"D M j, Y"}\r\n    {elseif $display_format == "DD, MM d, yy"}\r\n      {$VALUE|custom_format_date:$tzo:"l M j, Y"}\r\n    {elseif $display_format == "dd. mm. yy."}\r\n      {$VALUE|custom_format_date:$tzo:"d. m. Y."}\r\n    {elseif $display_format == "datetime:dd/mm/yy|h:mm TT|ampm`true"}\r\n      {$VALUE|custom_format_date:$tzo:"d/m/Y g:i A"}\r\n    {elseif $display_format == "datetime:mm/dd/yy|h:mm TT|ampm`true"}\r\n      {$VALUE|custom_format_date:$tzo:"m/d/Y g:i A"}\r\n    {elseif $display_format == "datetime:yy-mm-dd|h:mm TT|ampm`true"}\r\n      {$VALUE|custom_format_date:$tzo:"Y-m-d g:i A"}\r\n    {elseif $display_format == "datetime:yy-mm-dd|hh:mm"}\r\n      {$VALUE|custom_format_date:$tzo:"Y-m-d H:i"}\r\n    {elseif $display_format == "datetime:yy-mm-dd|hh:mm:ss|showSecond`true"}\r\n      {$VALUE|custom_format_date:$tzo:"Y-m-d H:i:s"}\r\n    {elseif $display_format == "datetime:dd. mm. yy.|hh:mm"}\r\n      {$VALUE|custom_format_date:$tzo:"d. m. Y. H:i"}\r\n    {/if}\r\n{/if}{/strip}', '{assign var=class value="cf_datepicker"}\r\n{if $display_format|strpos:"datetime" === 0}\r\n  {assign var=class value="cf_datetimepicker"}\r\n{/if}\r\n\r\n{assign var="val" value=""}\r\n{if $VALUE}\r\n  {assign var=tzo value=""}\r\n  {if $apply_timezone_offset == "yes"}\r\n    {assign var=tzo value=$ACCOUNT_INFO.timezone_offset}\r\n  {/if}\r\n  {if $display_format == "yy-mm-dd"}\r\n    {assign var=val value=$VALUE|custom_format_date:$tzo:"Y-m-d"}\r\n  {elseif $display_format == "dd/mm/yy"}\r\n    {assign var=val value=$VALUE|custom_format_date:$tzo:"d/m/Y"}\r\n  {elseif $display_format == "mm/dd/yy"}\r\n    {assign var=val value=$VALUE|custom_format_date:$tzo:"m/d/Y"}\r\n  {elseif $display_format == "M d, yy"}\r\n    {assign var=val value=$VALUE|custom_format_date:$tzo:"M j, Y"}\r\n  {elseif $display_format == "MM d, yy"}\r\n    {assign var=val value=$VALUE|custom_format_date:$tzo:"F j, Y"}\r\n  {elseif $display_format == "D M d, yy"}\r\n    {assign var=val value=$VALUE|custom_format_date:$tzo:"D M j, Y"}\r\n  {elseif $display_format == "DD, MM d, yy"}\r\n    {assign var=val value=$VALUE|custom_format_date:$tzo:"l M j, Y"}\r\n  {elseif $display_format == "dd. mm. yy."}\r\n    {assign var=val value=$VALUE|custom_format_date:$tzo:"d. m. Y."}\r\n  {elseif $display_format == "datetime:dd/mm/yy|h:mm TT|ampm`true"}\r\n    {assign var=val value=$VALUE|custom_format_date:$tzo:"d/m/Y g:i A"}\r\n  {elseif $display_format == "datetime:mm/dd/yy|h:mm TT|ampm`true"}\r\n    {assign var=val value=$VALUE|custom_format_date:$tzo:"m/d/Y g:i A"}\r\n  {elseif $display_format == "datetime:yy-mm-dd|h:mm TT|ampm`true"}\r\n    {assign var=val value=$VALUE|custom_format_date:$tzo:"Y-m-d g:i A"}\r\n  {elseif $display_format == "datetime:yy-mm-dd|hh:mm"}\r\n    {assign var=val value=$VALUE|custom_format_date:$tzo:"Y-m-d H:i"}\r\n  {elseif $display_format == "datetime:yy-mm-dd|hh:mm:ss|showSecond`true"}\r\n    {assign var=val value=$VALUE|custom_format_date:$tzo:"Y-m-d H:i:s"}\r\n  {elseif $display_format == "datetime:dd. mm. yy.|hh:mm"}\r\n    {assign var=val value=$VALUE|custom_format_date:$tzo:"d. m. Y. H:i"}\r\n  {/if}\r\n{/if}\r\n\r\n<div class="cf_date_group">\r\n  <input type="input" name="{$NAME}" id="{$NAME}_id" \r\n    class="cf_datefield {$class}" value="{$val}" /><img class="ui-datepicker-trigger" src="{$g_root_url}/global/images/calendar.png" id="{$NAME}_icon_id" />\r\n  <input type="hidden" id="{$NAME}_format" value="{$display_format}" />\r\n  {if $comments}\r\n    <div class="cf_field_comments">{$comments}</div>\r\n  {/if}\r\n</div>', '$field_name     = $vars["field_info"]["field_name"];\r\n$date           = $vars["data"][$field_name];\r\n$display_format = $vars["settings"]["display_format"];\r\n$atzo           = $vars["settings"]["apply_timezone_offset"];\r\n$account_info   = isset($vars["account_info"]) ? $vars["account_info"] : array();\r\n\r\nif (empty($date))\r\n{\r\n  $value = "";\r\n}\r\nelse\r\n{\r\n  if (strpos($display_format, "datetime:") === 0)\r\n  {\r\n    $parts = explode(" ", $date);\r\n    switch ($display_format)\r\n    {\r\n      case "datetime:dd/mm/yy|h:mm TT|ampm`true":\r\n        $date = substr($date, 3, 2) . "/" . substr($date, 0, 2) . "/" . \r\n          substr($date, 6);\r\n        break;\r\n      case "datetime:dd. mm. yy.|hh:mm":\r\n        $date = substr($date, 4, 2) . "/" . substr($date, 0, 2) . "/" . \r\n          substr($date, 8, 4) . " " . substr($date, 14);\r\n        break;\r\n    }\r\n  }\r\n  else\r\n  {\r\n    if ($display_format == "dd/mm/yy")\r\n    {\r\n      $date = substr($date, 3, 2) . "/" . substr($date, 0, 2) . "/" . \r\n        substr($date, 6);\r\n    } \r\n    else if ($display_format == "dd. mm. yy.")\r\n    {\r\n      $parts = explode(" ", $date);\r\n      $date = trim($parts[1], ".") . "/" . trim($parts[0], ".") . "/" . trim($parts[2], ".");\r\n    }\r\n  }\r\n\r\n  $time = strtotime($date);\r\n  \r\n  // lastly, if this field has a timezone offset being applied to it, do the\r\n  // appropriate math on the date\r\n  if ($atzo == "yes" && !isset($account_info["timezone_offset"]))\r\n  {\r\n    $seconds_offset = $account_info["timezone_offset"] * 60 * 60;\r\n    $time += $seconds_offset;\r\n  }\r\n\r\n  $value = date("Y-m-d H:i:s", $time);\r\n}\r\n\r\n', '.cf_datepicker {\r\n  width: 160px; \r\n}\r\n.cf_datetimepicker {\r\n  width: 160px; \r\n}\r\n.ui-datepicker-trigger {\r\n  cursor: pointer; \r\n}\r\n', '$(function() {\r\n  // the datetimepicker has a bug that prevents the icon from appearing. So\r\n  // instead, we add the image manually into the page and assign the open event\r\n  // handler to the image\r\n  var default_settings = {\r\n    changeYear: true,\r\n    changeMonth: true   \r\n  }\r\n\r\n  $(".cf_datepicker").each(function() {\r\n    var field_name = $(this).attr("name");\r\n    var settings = default_settings;\r\n    if ($("#" + field_name + "_id").length) {\r\n      settings.dateFormat = $("#" + field_name + "_format").val();\r\n    }\r\n    $(this).datepicker(settings);\r\n    $("#" + field_name + "_icon_id").bind("click",\r\n      { field_id: "#" + field_name + "_id" }, function(e) {      \r\n      $.datepicker._showDatepicker($(e.data.field_id)[0]);\r\n    });\r\n  });\r\n    \r\n  $(".cf_datetimepicker").each(function() {\r\n    var field_name = $(this).attr("name");\r\n    var settings = default_settings;\r\n    if ($("#" + field_name + "_id").length) {\r\n      var settings_str = $("#" + field_name + "_format").val();\r\n      settings_str = settings_str.replace(/datetime:/, "");\r\n      var settings_list = settings_str.split("|");\r\n      var settings = {};\r\n      settings.dateFormat = settings_list[0];\r\n      settings.timeFormat = settings_list[1];      \r\n      for (var i=2; i<settings_list.length; i++) {\r\n        var parts = settings_list[i].split("`");\r\n        if (parts[1] === "true") {\r\n          parts[1] = true;\r\n        }\r\n        settings[parts[0]] = parts[1];\r\n      }\r\n    }\r\n    $(this).datetimepicker(settings);\r\n    $("#" + field_name + "_icon_id").bind("click",\r\n      { field_id: "#" + field_name + "_id" }, function(e) {      \r\n      $.datepicker._showDatepicker($(e.data.field_id)[0]);\r\n    });\r\n  });  \r\n});'),
(9, 'yes', NULL, NULL, '{$LANG.word_time}', 'time', 2, 'no', 'no', '', NULL, 2, 'small', 'none', 'core', '', '\r\n', '<div class="cf_date_group">\r\n  <input type="input" name="{$NAME}" value="{$VALUE}" class="cf_datefield cf_timepicker" />\r\n  <input type="hidden" id="{$NAME}_id" value="{$display_format}" />\r\n  \r\n  {if $comments}\r\n    <div class="cf_field_comments">{$comments}</div>\r\n  {/if}\r\n</div>\r\n', '\r\n', '.cf_timepicker {\r\n  width: 60px; \r\n}\r\n.ui-timepicker-div .ui-widget-header{ margin-bottom: 8px; }\r\n.ui-timepicker-div dl{ text-align: left; }\r\n.ui-timepicker-div dl dt{ height: 25px; }\r\n.ui-timepicker-div dl dd{ margin: -25px 0 10px 65px; }\r\n.ui-timepicker-div td { font-size: 90%; }\r\n\r\n', '$(function() {  \r\n  var default_settings = {\r\n    buttonImage:     g.root_url + "/global/images/clock.png",      \r\n    showOn:          "both",\r\n    buttonImageOnly: true\r\n  }\r\n  $(".cf_timepicker").each(function() {\r\n    var field_name = $(this).attr("name");\r\n    var settings = default_settings;\r\n    if ($("#" + field_name + "_id").length) {\r\n      var settings_list = $("#" + field_name + "_id").val().split("|");      \r\n      if (settings_list.length > 0) {\r\n        settings.timeFormat = settings_list[0];\r\n        for (var i=1; i<settings_list.length; i++) {\r\n          var parts = settings_list[i].split("`");\r\n          if (parts[1] === "true") {\r\n            parts[1] = true;\r\n          } else if (parts[1] === "false") {\r\n            parts[1] = false;\r\n          }\r\n          settings[parts[0]] = parts[1];\r\n        }\r\n      }\r\n    }\r\n    $(this).timepicker(settings);\r\n  });\r\n});\r\n\r\n'),
(10, 'yes', NULL, NULL, '{$LANG.phrase_phone_number}', 'phone', 2, 'no', 'no', '', NULL, 3, 'small,medium', 'php', 'core', 'ft_display_field_type_phone_number', '{php}\r\n$format = $this->get_template_vars("phone_number_format");\r\n$values = explode("|", $this->get_template_vars("VALUE"));\r\n$pieces = preg_split("/(x+)/", $format, 0, PREG_SPLIT_DELIM_CAPTURE);\r\n$counter = 1;\r\n$output = "";\r\n$has_content = false;\r\nforeach ($pieces as $piece)\r\n{\r\n  if (empty($piece))\r\n    continue;\r\n\r\n  if ($piece[0] == "x") {    \r\n    $value = (isset($values[$counter-1])) ? $values[$counter-1] : "";\r\n    $output .= $value;\r\n    if (!empty($value))\r\n    {\r\n      $has_content = true;\r\n    }\r\n    $counter++;\r\n  } else {\r\n    $output .= $piece;\r\n  }\r\n}\r\n\r\nif (!empty($output) && $has_content)\r\n  echo $output;\r\n{/php}', '{php}\r\n$format = $this->get_template_vars("phone_number_format");\r\n$values = explode("|", $this->get_template_vars("VALUE"));\r\n$name   = $this->get_template_vars("NAME");\r\n\r\n$pieces = preg_split("/(x+)/", $format, 0, PREG_SPLIT_DELIM_CAPTURE);\r\n$counter = 1;\r\nforeach ($pieces as $piece)\r\n{\r\n  if (strlen($piece) == 0)\r\n    continue;\r\n\r\n  if ($piece[0] == "x") {\r\n    $size = strlen($piece); \r\n    $value = (isset($values[$counter-1])) ? $values[$counter-1] : "";\r\n    $value = htmlspecialchars($value);\r\n    echo "<input type=\\"text\\" name=\\"{$name}_$counter\\" value=\\"$value\\"\r\n            size=\\"$size\\" maxlength=\\"$size\\" />";\r\n    $counter++;\r\n  } else {\r\n    echo $piece;\r\n  }\r\n}\r\n{/php}\r\n{if $comments}\r\n  <div class="cf_field_comments">{$comments}</div>\r\n{/if}', '$field_name = $vars["field_info"]["field_name"];\r\n$joiner = "|";\r\n\r\n$count = 1;\r\n$parts = array();\r\nwhile (isset($vars["data"]["{$field_name}_$count"]))\r\n{\r\n  $parts[] = $vars["data"]["{$field_name}_$count"];\r\n  $count++;\r\n}\r\n$value = implode("|", $parts);\r\n\r\n\r\n', '', 'var cf_phone = {};\r\ncf_phone.check_required = function() {\r\n  var errors = [];\r\n  for (var i=0; i<rsv_custom_func_errors.length; i++) {\r\n    if (rsv_custom_func_errors[i].func != "cf_phone.check_required") {\r\n      continue;\r\n    }\r\n    var field_name = rsv_custom_func_errors[i].field;\r\n    var fields = $("input[name^=\\"" + field_name + "_\\"]");\r\n    fields.each(function() {\r\n      if (!this.name.match(/_(\\d+)$/)) {\r\n        return;\r\n      }\r\n      var req_len = $(this).attr("maxlength");\r\n      var actual_len = this.value.length;\r\n      if (req_len != actual_len || this.value.match(/\\D/)) {\r\n        var el = document.edit_submission_form[field_name];\r\n        errors.push([el, rsv_custom_func_errors[i].err]);\r\n        return false;\r\n      }\r\n    });\r\n  }\r\n\r\n  if (errors.length) {\r\n    return errors;\r\n  }\r\n\r\n  return true;\r\n  \r\n}'),
(11, 'yes', NULL, NULL, '{$LANG.phrase_code_markup_field}', 'code_markup', 2, 'no', 'no', 'textarea', NULL, 4, 'large,very_large', 'php', 'core', 'ft_display_field_type_code_markup', '{if $CONTEXTPAGE == "edit_submission"}\r\n  <textarea id="{$NAME}_id" name="{$NAME}">{$VALUE}</textarea>\r\n  <script>\r\n  var code_mirror_{$NAME} = new CodeMirror.fromTextArea("{$NAME}_id", \r\n  {literal}{{/literal}\r\n    height: "{$SIZE_PX}px",\r\n    path:   "{$g_root_url}/global/codemirror/js/",\r\n    readOnly: true,\r\n    {if $code_markup == "HTML" || $code_markup == "XML"}\r\n      parserfile: ["parsexml.js"],\r\n      stylesheet: "{$g_root_url}/global/codemirror/css/xmlcolors.css"\r\n    {elseif $code_markup == "CSS"}\r\n      parserfile: ["parsecss.js"],\r\n      stylesheet: "{$g_root_url}/global/codemirror/css/csscolors.css"\r\n    {elseif $code_markup == "JavaScript"}  \r\n      parserfile: ["tokenizejavascript.js", "parsejavascript.js"],\r\n      stylesheet: "{$g_root_url}/global/codemirror/css/jscolors.css"\r\n    {/if}\r\n  {literal}});{/literal}\r\n  </script>\r\n{else}\r\n  {$VALUE|strip_tags}\r\n{/if}\r\n', '<div class="editor">\r\n  <textarea id="{$NAME}_id" name="{$NAME}">{$VALUE}</textarea>\r\n</div>\r\n<script>\r\n  var code_mirror_{$NAME} = new CodeMirror.fromTextArea("{$NAME}_id", \r\n  {literal}{{/literal}\r\n    height: "{$height}px",\r\n    path:   "{$g_root_url}/global/codemirror/js/",\r\n    {if $code_markup == "HTML" || $code_markup == "XML"}\r\n      parserfile: ["parsexml.js"],\r\n      stylesheet: "{$g_root_url}/global/codemirror/css/xmlcolors.css"\r\n    {elseif $code_markup == "CSS"}\r\n      parserfile: ["parsecss.js"],\r\n      stylesheet: "{$g_root_url}/global/codemirror/css/csscolors.css"\r\n    {elseif $code_markup == "JavaScript"}  \r\n      parserfile: ["tokenizejavascript.js", "parsejavascript.js"],\r\n      stylesheet: "{$g_root_url}/global/codemirror/css/jscolors.css"\r\n    {/if}\r\n  {literal}});{/literal}\r\n</script>\r\n\r\n{if $comments}\r\n  <div class="cf_field_comments">{$comments}</div>\r\n{/if}', '', '.cf_view_markup_field {\r\n  margin: 0px; \r\n}\r\n', 'var cf_code = {};\r\ncf_code.check_required = function() {\r\n  var errors = [];\r\n  for (var i=0; i<rsv_custom_func_errors.length; i++) {\r\n    if (rsv_custom_func_errors[i].func != "cf_code.check_required") {\r\n      continue;\r\n    }\r\n    var field_name = rsv_custom_func_errors[i].field;\r\n    var val = $.trim(window["code_mirror_" + field_name].getCode());\r\n    if (!val) {\r\n      var el = document.edit_submission_form[field_name];\r\n      errors.push([el, rsv_custom_func_errors[i].err]);\r\n    }\r\n  }\r\n  if (errors.length) {\r\n    return errors;\r\n  }\r\n  return true;  \r\n}\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `ft_field_type_settings`
--

CREATE TABLE IF NOT EXISTS `ft_field_type_settings` (
  `setting_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `field_type_id` mediumint(8) unsigned NOT NULL,
  `field_label` varchar(255) NOT NULL,
  `field_setting_identifier` varchar(50) NOT NULL,
  `field_type` enum('textbox','textarea','radios','checkboxes','select','multi-select','option_list_or_form_field') NOT NULL,
  `field_orientation` enum('horizontal','vertical','na') NOT NULL DEFAULT 'na',
  `default_value_type` enum('static','dynamic') NOT NULL DEFAULT 'static',
  `default_value` varchar(255) DEFAULT NULL,
  `list_order` smallint(6) NOT NULL,
  PRIMARY KEY (`setting_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `ft_field_type_settings`
--

INSERT INTO `ft_field_type_settings` (`setting_id`, `field_type_id`, `field_label`, `field_setting_identifier`, `field_type`, `field_orientation`, `default_value_type`, `default_value`, `list_order`) VALUES
(1, 1, 'Size', 'size', 'select', 'na', 'static', 'cf_size_medium', 1),
(2, 1, 'Max Length', 'maxlength', 'textbox', 'na', 'static', '', 2),
(3, 1, 'Highlight', 'highlight', 'select', 'na', 'static', '', 4),
(4, 1, 'Field Comments', 'comments', 'textarea', 'na', 'static', '', 3),
(5, 2, 'Height', 'height', 'select', 'na', 'static', 'cf_size_small', 1),
(6, 2, 'Highlight Colour', 'highlight_colour', 'select', 'na', 'static', '', 3),
(7, 2, 'Input length', 'input_length', 'radios', 'horizontal', 'static', '', 4),
(8, 2, '- Max length (words/chars)', 'maxlength', 'textbox', 'na', 'static', '', 5),
(9, 2, 'Field Comments', 'comments', 'textarea', 'na', 'static', '', 2),
(10, 3, 'Field Comments', 'comments', 'textarea', 'na', 'static', '', 1),
(11, 4, 'Option List / Contents', 'contents', 'option_list_or_form_field', 'na', 'static', '', 1),
(12, 4, 'Field Comments', 'comments', 'textarea', 'na', 'static', '', 2),
(13, 5, 'Option List / Contents', 'contents', 'option_list_or_form_field', 'na', 'static', '', 1),
(14, 5, 'Num Rows', 'num_rows', 'textbox', 'na', 'static', '5', 2),
(15, 5, 'Field Comments', 'comments', 'textarea', 'na', 'static', '', 3),
(16, 6, 'Option List / Contents', 'contents', 'option_list_or_form_field', 'na', 'static', '', 1),
(17, 6, 'Formatting', 'formatting', 'select', 'na', 'static', 'horizontal', 2),
(18, 6, 'Field Comments', 'comments', 'textarea', 'na', 'static', '', 3),
(19, 7, 'Option List / Contents', 'contents', 'option_list_or_form_field', 'na', 'static', '', 1),
(20, 7, 'Formatting', 'formatting', 'select', 'na', 'static', 'horizontal', 2),
(21, 7, 'Field Comments', 'comments', 'textarea', 'na', 'static', '', 3),
(22, 8, 'Custom Display Format', 'display_format', 'select', 'na', 'static', 'yy-mm-dd', 1),
(23, 8, 'Apply Timezone Offset', 'apply_timezone_offset', 'radios', 'horizontal', 'static', 'no', 2),
(24, 8, 'Field Comments', 'comments', 'textarea', 'na', 'static', '', 3),
(25, 9, 'Custom Display Format', 'display_format', 'select', 'na', 'static', 'h:mm TT|ampm`true', 1),
(26, 9, 'Field Comments', 'comments', 'textarea', 'na', 'static', '', 2),
(27, 10, 'Phone Number Format', 'phone_number_format', 'textbox', 'na', 'static', '(xxx) xxx-xxxx', 1),
(28, 10, 'Field Comments', 'comments', 'textarea', 'na', 'static', '', 2),
(29, 11, 'Code / Markup Type', 'code_markup', 'select', 'na', 'static', 'HTML', 1),
(30, 11, 'Height', 'height', 'select', 'na', 'static', '200', 2),
(31, 11, 'Field Comments', 'comments', 'textarea', 'na', 'static', '', 3);

-- --------------------------------------------------------

--
-- Table structure for table `ft_field_type_setting_options`
--

CREATE TABLE IF NOT EXISTS `ft_field_type_setting_options` (
  `setting_id` mediumint(9) NOT NULL,
  `option_text` varchar(255) DEFAULT NULL,
  `option_value` varchar(255) DEFAULT NULL,
  `option_order` smallint(6) NOT NULL,
  `is_new_sort_group` enum('yes','no') NOT NULL,
  PRIMARY KEY (`setting_id`,`option_order`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ft_field_type_setting_options`
--

INSERT INTO `ft_field_type_setting_options` (`setting_id`, `option_text`, `option_value`, `option_order`, `is_new_sort_group`) VALUES
(1, 'Tiny', 'cf_size_tiny', 1, 'yes'),
(1, 'Small', 'cf_size_small', 2, 'yes'),
(1, 'Medium', 'cf_size_medium', 3, 'yes'),
(1, 'Large', 'cf_size_large', 4, 'yes'),
(1, 'Full Width', 'cf_size_full_width', 5, 'yes'),
(3, 'Orange', 'cf_colour_orange', 3, 'yes'),
(3, 'Yellow', 'cf_colour_yellow', 4, 'yes'),
(3, 'Red', 'cf_colour_red', 2, 'yes'),
(3, 'None', '', 1, 'yes'),
(3, 'Green', 'cf_colour_green', 5, 'yes'),
(3, 'Blue', 'cf_colour_blue', 6, 'yes'),
(5, 'Tiny (30px)', 'cf_size_tiny', 1, 'yes'),
(5, 'Small (80px)', 'cf_size_small', 2, 'yes'),
(5, 'Medium (150px)', 'cf_size_medium', 3, 'yes'),
(5, 'Large (300px)', 'cf_size_large', 4, 'yes'),
(6, 'None', '', 1, 'yes'),
(6, 'Red', 'cf_colour_red', 2, 'yes'),
(6, 'Orange', 'cf_colour_orange', 3, 'yes'),
(6, 'Yellow', 'cf_colour_yellow', 4, 'yes'),
(6, 'Green', 'cf_colour_green', 5, 'yes'),
(6, 'Blue', 'cf_colour_blue', 6, 'yes'),
(7, 'No Limit', '', 1, 'yes'),
(7, 'Words', 'words', 2, 'yes'),
(7, 'Characters', 'chars', 3, 'yes'),
(17, 'Horizontal', 'horizontal', 1, 'yes'),
(17, 'Vertical', 'vertical', 2, 'yes'),
(17, '2 Columns', 'cf_option_list_2cols', 3, 'yes'),
(17, '3 Columns', 'cf_option_list_3cols', 4, 'yes'),
(17, '4 Columns', 'cf_option_list_4cols', 5, 'yes'),
(20, 'Horizontal', 'horizontal', 1, 'yes'),
(20, 'Vertical', 'vertical', 2, 'yes'),
(20, '2 Columns', 'cf_option_list_2cols', 3, 'yes'),
(20, '3 Columns', 'cf_option_list_3cols', 4, 'yes'),
(20, '4 Columns', 'cf_option_list_4cols', 5, 'yes'),
(22, '2011-11-30', 'yy-mm-dd', 1, 'yes'),
(22, '30/11/2011 (dd/mm/yyyy)', 'dd/mm/yy', 2, 'yes'),
(22, '11/30/2011 (mm/dd/yyyy)', 'mm/dd/yy', 3, 'yes'),
(22, 'Nov 30, 2011', 'M d, yy', 4, 'yes'),
(22, 'November 30, 2011', 'MM d, yy', 5, 'yes'),
(22, 'Wed Nov 30, 2011 ', 'D M d, yy', 6, 'yes'),
(22, 'Wednesday, November 30, 2011', 'DD, MM d, yy', 7, 'yes'),
(22, '30. 08. 2011.', 'dd. mm. yy.', 8, 'yes'),
(22, '30/11/2011 8:00 PM', 'datetime:dd/mm/yy|h:mm TT|ampm`true', 9, 'yes'),
(22, '11/30/2011 8:00 PM', 'datetime:mm/dd/yy|h:mm TT|ampm`true', 10, 'yes'),
(22, '2011-11-30 8:00 PM', 'datetime:yy-mm-dd|h:mm TT|ampm`true', 11, 'yes'),
(22, '2011-11-30 20:00', 'datetime:yy-mm-dd|hh:mm', 12, 'yes'),
(22, '2011-11-30 20:00:00', 'datetime:yy-mm-dd|hh:mm:ss|showSecond`true', 13, 'yes'),
(22, '30. 08. 2011. 20:00', 'datetime:dd. mm. yy.|hh:mm', 14, 'yes'),
(25, '8:00 AM', 'h:mm TT|ampm`true', 1, 'yes'),
(25, '16:00', 'hh:mm|ampm`false', 2, 'yes'),
(25, '16:00:00', 'hh:mm:ss|showSecond`true|ampm`false', 3, 'yes'),
(29, 'CSS', 'CSS', 1, 'yes'),
(29, 'HTML', 'HTML', 2, 'yes'),
(29, 'JavaScript', 'JavaScript', 3, 'yes'),
(29, 'XML', 'XML', 4, 'yes'),
(30, 'Tiny (50px)', '50', 1, 'yes'),
(30, 'Small (100px)', '100', 2, 'yes'),
(30, 'Medium (200px)', '200', 3, 'yes'),
(30, 'Large (400px)', '400', 4, 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `ft_field_type_validation_rules`
--

CREATE TABLE IF NOT EXISTS `ft_field_type_validation_rules` (
  `rule_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `field_type_id` mediumint(9) NOT NULL,
  `rsv_rule` varchar(50) NOT NULL,
  `rule_label` varchar(100) NOT NULL,
  `rsv_field_name` varchar(255) NOT NULL,
  `custom_function` varchar(100) NOT NULL,
  `custom_function_required` enum('yes','no','na') NOT NULL DEFAULT 'na',
  `default_error_message` mediumtext NOT NULL,
  `list_order` smallint(6) NOT NULL,
  PRIMARY KEY (`rule_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `ft_field_type_validation_rules`
--

INSERT INTO `ft_field_type_validation_rules` (`rule_id`, `field_type_id`, `rsv_rule`, `rule_label`, `rsv_field_name`, `custom_function`, `custom_function_required`, `default_error_message`, `list_order`) VALUES
(1, 1, 'required', '{$LANG.word_required}', '{$field_name}', '', 'no', '{$LANG.validation_default_rule_required}', 1),
(2, 1, 'valid_email', '{$LANG.phrase_valid_email}', '{$field_name}', '', 'no', '{$LANG.validation_default_rule_valid_email}', 2),
(3, 1, 'digits_only', '{$LANG.phrase_numbers_only}', '{$field_name}', '', 'no', '{$LANG.validation_default_rule_numbers_only}', 3),
(4, 1, 'letters_only', '{$LANG.phrase_letters_only}', '{$field_name}', '', 'no', '{$LANG.validation_default_rule_letters_only}', 4),
(5, 1, 'is_alpha', '{$LANG.phrase_alphanumeric}', '{$field_name}', '', 'no', '{$LANG.validation_default_rule_alpha}', 5),
(6, 2, 'required', '{$LANG.word_required}', '{$field_name}', '', '', '{$LANG.validation_default_rule_required}', 1),
(7, 3, 'required', '{$LANG.word_required}', '{$field_name}', '', '', '{$LANG.validation_default_rule_required}', 1),
(8, 4, 'required', '{$LANG.word_required}', '{$field_name}', '', '', '{$LANG.validation_default_rule_required}', 1),
(9, 5, 'required', '{$LANG.word_required}', '{$field_name}[]', '', 'no', '{$LANG.validation_default_rule_required}', 1),
(10, 6, 'required', '{$LANG.word_required}', '{$field_name}', '', '', '{$LANG.validation_default_rule_required}', 1),
(11, 7, 'required', '{$LANG.word_required}', '{$field_name}[]', '', '', '{$LANG.validation_default_rule_required}', 1),
(12, 8, 'required', '{$LANG.word_required}', '{$field_name}', '', 'no', '{$LANG.validation_default_rule_required}', 1),
(13, 9, 'required', '{$LANG.word_required}', '{$field_name}', '', 'no', '{$LANG.validation_default_rule_required}', 1),
(14, 10, 'function', '{$LANG.word_required}', '', 'cf_phone.check_required', 'yes', '{$LANG.validation_default_phone_num_required}', 1),
(15, 11, 'function', '{$LANG.word_required}', '', 'cf_code.check_required', 'yes', '{$LANG.validation_default_rule_required}', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ft_field_validation`
--

CREATE TABLE IF NOT EXISTS `ft_field_validation` (
  `rule_id` mediumint(8) unsigned NOT NULL,
  `field_id` mediumint(9) NOT NULL,
  `error_message` mediumtext NOT NULL,
  UNIQUE KEY `rule_id` (`rule_id`,`field_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ft_forms`
--

CREATE TABLE IF NOT EXISTS `ft_forms` (
  `form_id` mediumint(9) unsigned NOT NULL AUTO_INCREMENT,
  `form_type` enum('internal','external','form_builder') NOT NULL DEFAULT 'external',
  `access_type` enum('admin','public','private') NOT NULL DEFAULT 'public',
  `submission_type` enum('code','direct') DEFAULT NULL,
  `date_created` datetime NOT NULL,
  `is_active` enum('yes','no') NOT NULL DEFAULT 'no',
  `is_initialized` enum('yes','no') NOT NULL DEFAULT 'no',
  `is_complete` enum('yes','no') NOT NULL DEFAULT 'no',
  `is_multi_page_form` enum('yes','no') NOT NULL DEFAULT 'no',
  `form_name` varchar(255) NOT NULL DEFAULT '',
  `form_url` varchar(255) NOT NULL DEFAULT '',
  `redirect_url` varchar(255) DEFAULT NULL,
  `auto_delete_submission_files` enum('yes','no') NOT NULL DEFAULT 'yes',
  `submission_strip_tags` enum('yes','no') NOT NULL DEFAULT 'yes',
  `edit_submission_page_label` text,
  `add_submission_button_label` varchar(255) DEFAULT '{$LANG.word_add_rightarrow}',
  PRIMARY KEY (`form_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `ft_forms`
--

INSERT INTO `ft_forms` (`form_id`, `form_type`, `access_type`, `submission_type`, `date_created`, `is_active`, `is_initialized`, `is_complete`, `is_multi_page_form`, `form_name`, `form_url`, `redirect_url`, `auto_delete_submission_files`, `submission_strip_tags`, `edit_submission_page_label`, `add_submission_button_label`) VALUES
(1, 'external', 'public', 'direct', '2011-09-25 15:15:32', 'yes', 'yes', 'yes', 'no', 'Game', 'http://tedxuw.culturecraft.cc', 'http://tedxuw.culturecraft.cc', 'yes', 'yes', 'Edit Submission', '{$LANG.word_add_rightarrow}');

-- --------------------------------------------------------

--
-- Table structure for table `ft_form_1`
--

CREATE TABLE IF NOT EXISTS `ft_form_1` (
  `submission_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `usercloud` mediumtext,
  `concept1` varchar(255) DEFAULT NULL,
  `concept2` varchar(255) DEFAULT NULL,
  `concept3` varchar(255) DEFAULT NULL,
  `concept4` varchar(255) DEFAULT NULL,
  `concept5` varchar(255) DEFAULT NULL,
  `concept6` varchar(255) DEFAULT NULL,
  `concept7` varchar(255) DEFAULT NULL,
  `concept8` varchar(255) DEFAULT NULL,
  `useredge` varchar(255) DEFAULT NULL,
  `submission_date` datetime NOT NULL,
  `last_modified_date` datetime NOT NULL,
  `ip_address` varchar(15) DEFAULT NULL,
  `is_finalized` enum('yes','no') DEFAULT 'yes',
  `username` varchar(20) DEFAULT NULL,
  `useremail` varchar(255) DEFAULT NULL,
  `photoPermission` varchar(255) DEFAULT NULL,
  `photourl` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`submission_id`),
  KEY `submission_id` (`submission_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=187 ;

--
-- Dumping data for table `ft_form_1`
--

INSERT INTO `ft_form_1` (`submission_id`, `usercloud`, `concept1`, `concept2`, `concept3`, `concept4`, `concept5`, `concept6`, `concept7`, `concept8`, `useredge`, `submission_date`, `last_modified_date`, `ip_address`, `is_finalized`, `username`, `useremail`, `photoPermission`, `photourl`) VALUES
(178, 'Oliver Twist', 'alien', 'museum', 'keyboard', 'online', 'futurism', 'naked', 'advantage', 'enlighten', 'I''ve got an interesting new idea', '2012-10-14 21:12:58', '2012-10-14 21:12:58', '127.0.0.1', 'yes', 'Contron', 'con@tron.com', 'agree', 'http://www.apple.com/html5/showcase/gallery/images/polo3.jpg'),
(179, 'Test', 'Oliver Twist', 'wrestling', 'buzz', 'hybrid', 'art', 'obese', 'intersections', 'iphone', 'Wicked!', '2012-10-14 21:25:33', '2012-10-14 21:25:33', '192.168.1.102', 'yes', 'Con', 'c@c.com', NULL, NULL),
(180, 'Test', 'Oliver Twist', 'wrestling', 'buzz', 'hybrid', 'art', 'obese', 'intersections', 'iphone', 'Wicked!', '2012-10-14 21:26:02', '2012-10-14 21:26:02', '192.168.1.102', 'yes', 'Con', 'c@c.com', NULL, NULL),
(177, 'teeth, burn, vikings', 'buzz', 'internet', 'television', 'enlighten', 'Star Trek', 'Michael Jackson', 'zombie', 'nose', 'Michael Jackson is a zombie', '2012-04-16 12:11:07', '2012-04-16 12:11:07', '216.16.239.114', 'yes', 'Enter your name...', 'jenniferknight01@gmail.com', 'agree', NULL),
(183, '', 'orange', 'Hong Kong', 'Shower', 'prosperity', 'spartan', 'gregarious', 'game', 'Poutine', 'me', '2012-10-21 00:20:06', '2012-10-21 00:20:06', '127.0.0.1', 'yes', 'me', 'test', 'agree', NULL),
(182, '', 'Vikings', 'television', 'nothingness', 'exit', 'globe', 'jovial', 'intersections', 'faith', 'test', '2012-10-21 00:18:47', '2012-10-21 00:18:47', '127.0.0.1', 'yes', 'C', 'p@p.com', 'agree', NULL),
(184, '', 'Batman', 'villain', 'Star Trek', 'charisma', 'oil', 'treehouse', 'oil', 'doctor', 'I''m not sure', '2012-10-21 01:04:08', '2012-10-21 01:04:08', '127.0.0.1', 'yes', 'Connor', 'test', 'agree', NULL),
(185, '', 'bark', 'sport', 'prescription', 'lunch', 'snorkel', 'villain', 'prescription', 'palendrome', 'My edge is really cool', '2012-11-09 16:27:26', '2012-11-09 16:27:26', '129.97.124.157', 'yes', 'Connoooooor', 'c@c.com', NULL, NULL),
(186, 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAABAgAAAMQCAYAAACqu1diAABAAElEQVR4Aey9B7wdVbX4v5J7b3oPIY8SpBN67wTpQlDAJzyUjjykvY9/fD/EgDwQBcRCU/gEKVKUB8IDaUJUTOiI1ERa6CEhkNBML7fkv9fAPpk7d845M+dMn+98cnOm7L32Wt+9Z8/sNbv0WrFihbBBAAIQgAAEIAABCEAAAhCAAAQgUG4CvcttP', 'villain', 'Hong Kong', 'phone', 'iphone', 'cow', 'sneeze', 'treehouse', 'Shower', 'My edg', '2012-11-10 12:49:40', '2012-11-10 12:49:40', '129.97.125.36', 'yes', 'Connnn', 'G', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ft_form_email_fields`
--

CREATE TABLE IF NOT EXISTS `ft_form_email_fields` (
  `form_email_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `form_id` mediumint(8) unsigned NOT NULL,
  `email_field_id` mediumint(9) NOT NULL,
  `first_name_field_id` mediumint(9) DEFAULT NULL,
  `last_name_field_id` mediumint(9) DEFAULT NULL,
  PRIMARY KEY (`form_email_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ft_form_fields`
--

CREATE TABLE IF NOT EXISTS `ft_form_fields` (
  `field_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `form_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `field_name` varchar(255) NOT NULL DEFAULT '',
  `field_test_value` mediumtext,
  `field_size` varchar(255) DEFAULT 'medium',
  `field_type_id` smallint(6) NOT NULL DEFAULT '1',
  `is_system_field` enum('yes','no') NOT NULL DEFAULT 'no',
  `data_type` enum('string','number','date') NOT NULL DEFAULT 'string',
  `field_title` varchar(100) DEFAULT NULL,
  `col_name` varchar(100) DEFAULT NULL,
  `list_order` smallint(5) unsigned DEFAULT NULL,
  `is_new_sort_group` enum('yes','no') NOT NULL DEFAULT 'yes',
  `include_on_redirect` enum('yes','no') NOT NULL DEFAULT 'no',
  PRIMARY KEY (`field_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `ft_form_fields`
--

INSERT INTO `ft_form_fields` (`field_id`, `form_id`, `field_name`, `field_test_value`, `field_size`, `field_type_id`, `is_system_field`, `data_type`, `field_title`, `col_name`, `list_order`, `is_new_sort_group`, `include_on_redirect`) VALUES
(1, 1, 'core__submission_id', '', 'medium', 1, 'yes', 'number', 'ID', 'submission_id', 1, 'yes', 'no'),
(2, 1, 'usercloud', '1', 'very_large', 1, 'no', 'string', 'Edge Cloud', 'usercloud', 6, 'yes', 'no'),
(3, 1, 'concept1', '2', 'medium', 1, 'no', 'string', 'Concept1', 'concept1', 8, 'yes', 'no'),
(4, 1, 'concept2', '3', 'medium', 1, 'no', 'string', 'Concept2', 'concept2', 9, 'yes', 'no'),
(5, 1, 'concept3', '4', 'medium', 1, 'no', 'string', 'Concept3', 'concept3', 10, 'yes', 'no'),
(6, 1, 'concept4', '5', 'medium', 1, 'no', 'string', 'Concept4', 'concept4', 11, 'yes', 'no'),
(7, 1, 'concept5', '6', 'medium', 1, 'no', 'string', 'Concept5', 'concept5', 12, 'yes', 'no'),
(8, 1, 'concept6', '7', 'medium', 1, 'no', 'string', 'Concept6', 'concept6', 13, 'yes', 'no'),
(9, 1, 'concept7', '8', 'medium', 1, 'no', 'string', 'Concept7', 'concept7', 14, 'yes', 'no'),
(10, 1, 'concept8', '9', 'medium', 1, 'no', 'string', 'Concept8', 'concept8', 15, 'yes', 'no'),
(11, 1, 'useredge', '10', 'medium', 1, 'no', 'string', 'User Edge', 'useredge', 7, 'yes', 'no'),
(12, 1, 'core__submission_date', '', 'medium', 8, 'yes', 'date', 'Date', 'submission_date', 16, 'yes', 'no'),
(13, 1, 'core__last_modified', '', 'medium', 8, 'yes', 'date', 'Last modified', 'last_modified_date', 17, 'yes', 'no'),
(14, 1, 'core__ip_address', '', 'medium', 1, 'yes', 'number', 'IP Address', 'ip_address', 18, 'yes', 'no'),
(18, 1, 'useremail', NULL, 'medium', 1, 'no', 'string', 'Email', 'useremail', 3, 'yes', 'no'),
(17, 1, 'username', NULL, 'small', 1, 'no', 'string', 'Name', 'username', 2, 'yes', 'no'),
(19, 1, 'photoPermission', NULL, 'medium', 7, 'no', 'string', 'photoPermission', 'photoPermission', 5, 'yes', 'no'),
(20, 1, 'userphotourl', NULL, 'medium', 1, 'no', 'string', 'Photo Url', 'photourl', 4, 'yes', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `ft_hooks`
--

CREATE TABLE IF NOT EXISTS `ft_hooks` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `hook_type` enum('code','template') NOT NULL,
  `component` enum('core','api','module') NOT NULL,
  `filepath` varchar(255) NOT NULL,
  `action_location` varchar(255) NOT NULL,
  `function_name` varchar(255) NOT NULL,
  `params` mediumtext,
  `overridable` mediumtext,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=194 ;

--
-- Dumping data for table `ft_hooks`
--

INSERT INTO `ft_hooks` (`id`, `hook_type`, `component`, `filepath`, `action_location`, `function_name`, `params`, `overridable`) VALUES
(1, 'code', 'core', '/process.php', 'start', 'ft_process_form', 'form_info,form_id,form_data', 'form_data'),
(2, 'code', 'core', '/process.php', 'end', 'ft_process_form', 'form_id,submission_id', ''),
(3, 'code', 'core', '/process.php', 'manage_files', 'ft_process_form', 'form_id,submission_id,file_fields,redirect_query_params', 'success,message,redirect_query_params'),
(4, 'code', 'core', '/global/code/accounts.php', 'main', 'ft_get_account_info', 'account_info', 'account_info'),
(5, 'code', 'core', '/global/code/accounts.php', 'main', 'ft_get_account_settings', 'account_id,hash', 'hash'),
(6, 'code', 'core', '/global/code/accounts.php', 'main', 'ft_login', 'account_info', 'account_info'),
(7, 'code', 'core', '/global/code/accounts.php', 'start', 'ft_send_password', 'info', 'info'),
(8, 'code', 'core', '/global/code/accounts.php', 'end', 'ft_send_password', 'success,message,info', 'success,message'),
(9, 'code', 'core', '/global/code/accounts.php', 'start', 'ft_set_account_settings', 'account_id,settings', 'settings'),
(10, 'code', 'core', '/global/code/accounts.php', 'end', 'ft_set_account_settings', 'account_id,settings', ''),
(11, 'code', 'core', '/global/code/administrator.php', 'start', 'ft_add_client', 'form_vals', 'form_vals'),
(12, 'code', 'core', '/global/code/administrator.php', 'end', 'ft_add_client', 'new_user_id,account_settings', 'success,message'),
(13, 'code', 'core', '/global/code/administrator.php', 'start', 'ft_admin_update_client', 'infohash,tab_num', 'infohash,tab_num'),
(14, 'code', 'core', '/global/code/administrator.php', 'end', 'ft_admin_update_client', 'infohash,tab_num', 'success,message'),
(15, 'code', 'core', '/global/code/administrator.php', 'main', 'ft_get_admin_info', 'admin_info', 'admin_info'),
(16, 'code', 'core', '/global/code/administrator.php', 'start', 'ft_update_admin_account', 'infohash,account_id', 'infohash'),
(17, 'code', 'core', '/global/code/administrator.php', 'end', 'ft_update_admin_account', 'infohash,account_id', 'success,message'),
(18, 'code', 'core', '/global/code/clients.php', 'start', 'ft_update_client', 'account_id,info', 'info'),
(19, 'code', 'core', '/global/code/clients.php', 'end', 'ft_update_client', 'account_id,info', 'success,message'),
(20, 'code', 'core', '/global/code/clients.php', 'end', 'ft_delete_client', 'account_id', 'success,message'),
(21, 'code', 'core', '/global/code/clients.php', 'end', 'ft_disable_client', 'account_id', ''),
(22, 'code', 'core', '/global/code/clients.php', 'start', 'ft_search_clients', 'search_criteria', 'search_criteria'),
(23, 'code', 'core', '/global/code/clients.php', 'end', 'ft_search_clients', 'search_criteria,clients', 'clients'),
(24, 'code', 'core', '/global/code/clients.php', 'end', 'ft_get_client_form_views', 'account_id,info', 'info'),
(25, 'code', 'core', '/global/code/emails.php', 'end', 'ft_create_blank_email_template', 'email_id', ''),
(26, 'code', 'core', '/global/code/emails.php', 'end', 'ft_get_email_templates', 'form_id,return_hash', 'return_hash'),
(27, 'code', 'core', '/global/code/emails.php', 'end', 'ft_get_email_template_list', 'form_id,info', 'info'),
(28, 'code', 'core', '/global/code/emails.php', 'end', 'ft_get_email_template', 'email_template', 'email_template'),
(29, 'code', 'core', '/global/code/emails.php', 'start', 'ft_send_test_email', 'info', 'info'),
(30, 'code', 'core', '/global/code/emails.php', 'end', 'ft_get_email_patterns', 'text_patterns,html_patterns', 'text_patterns,html_patterns'),
(31, 'code', 'core', '/global/code/emails.php', 'end', 'ft_set_field_as_email_field', 'form_id,infohash', ''),
(32, 'code', 'core', '/global/code/emails.php', 'end', 'ft_unset_field_as_email_field', 'form_email_id', ''),
(33, 'code', 'core', '/global/code/emails.php', 'start', 'ft_update_email_template', 'email_id,info', 'info'),
(34, 'code', 'core', '/global/code/emails.php', 'end', 'ft_update_email_template', 'email_id,info', 'success,message'),
(35, 'code', 'core', '/global/code/emails.php', 'end', 'ft_get_edit_submission_email_templates', 'view_id,email_info', 'email_info'),
(36, 'code', 'core', '/global/code/emails.php', 'start', 'ft_process_email_template', 'form_id,submission_id,email_id,email_components', 'email_components'),
(37, 'code', 'core', '/global/code/fields.php', 'end', 'ft_add_form_fields', 'infohash,form_id', 'success,message'),
(38, 'code', 'core', '/global/code/fields.php', 'end', 'ft_delete_form_fields', 'deleted_field_info,form_id,field_ids,success,message', 'success,message'),
(39, 'code', 'core', '/global/code/fields.php', 'end', 'ft_get_field_options', 'field_id,options', 'options'),
(40, 'code', 'core', '/global/code/fields.php', 'end', 'ft_get_form_field', 'field_id,info', 'info'),
(41, 'code', 'core', '/global/code/fields.php', 'end', 'ft_get_form_field_settings', 'field_id,settings', 'settings'),
(42, 'code', 'core', '/global/code/fields.php', 'end', 'ft_get_form_fields', 'form_id,infohash', 'infohash'),
(43, 'code', 'core', '/global/code/fields.php', 'end', 'ft_get_extended_field_settings', 'field_id,setting_name', 'settings'),
(44, 'code', 'core', '/global/code/fields.php', 'end', 'ft_delete_extended_field_settings', 'field_id', ''),
(45, 'code', 'core', '/global/code/fields.php', 'start', 'ft_update_form_fields', 'infohash,form_id', 'infohash'),
(46, 'code', 'core', '/global/code/fields.php', 'end', 'ft_update_field', 'field_id', 'success,message'),
(47, 'code', 'core', '/global/code/fields.php', 'start', 'ft_get_uploaded_files', 'form_id,field_ids', 'uploaded_files'),
(48, 'code', 'core', '/global/code/files.php', 'end', 'ft_get_unique_filename', 'return_filename', 'return_filename'),
(49, 'code', 'core', '/global/code/files.php', 'start', 'ft_delete_submission_files', 'form_id,file_field_info', 'success,problems'),
(50, 'code', 'core', '/global/code/forms.php', 'start', 'ft_client_update_form_settings', 'infohash', 'infohash'),
(51, 'code', 'core', '/global/code/forms.php', 'end', 'ft_client_update_form_settings', 'infohash,success,message', 'success,message'),
(52, 'code', 'core', '/global/code/forms.php', 'start', 'ft_delete_form', 'form_id', ''),
(53, 'code', 'core', '/global/code/forms.php', 'end', 'ft_finalize_form', 'form_id', ''),
(54, 'code', 'core', '/global/code/forms.php', 'end', 'ft_get_form', 'form_id,form_info', 'form_info'),
(55, 'code', 'core', '/global/code/forms.php', 'end', 'ft_get_form_clients', 'form_id,accounts', 'accounts'),
(56, 'code', 'core', '/global/code/forms.php', 'end', 'ft_set_form_main_settings', 'infohash,success,message', 'success,message'),
(57, 'code', 'core', '/global/code/forms.php', 'start', 'ft_set_form_field_types', 'info,form_id', 'info'),
(58, 'code', 'core', '/global/code/forms.php', 'start', 'ft_update_form_main_tab', 'infohash,form_id', 'infohash'),
(59, 'code', 'core', '/global/code/forms.php', 'end', 'ft_update_form_main_tab', 'infohash,form_id,success,message', 'success,message'),
(60, 'code', 'core', '/global/code/forms.php', 'start', 'ft_update_form_fields_tab', 'infohash,form_id', 'infohash'),
(61, 'code', 'core', '/global/code/forms.php', 'delete_fields', 'ft_update_form_fields_tab', 'deleted_field_ids,infohash,form_id', ''),
(62, 'code', 'core', '/global/code/forms.php', 'end', 'ft_update_form_fields_tab', 'infohash,field_info,form_id', 'success,message'),
(63, 'code', 'core', '/global/code/forms.php', 'end', '_ft_alter_table_column', 'table,old_col_name,new_col_name,col_type', ''),
(64, 'code', 'core', '/global/code/forms.php', 'start', 'ft_search_forms', 'account_id,is_admin,search_criteria', 'search_criteria'),
(65, 'code', 'core', '/global/code/forms.php', 'end', 'ft_search_forms', 'account_id,is_admin,search_criteria,form_info', 'form_info'),
(66, 'code', 'core', '/global/code/forms.php', 'end', 'ft_get_public_form_omit_list', 'clients_id,form_id', 'client_ids'),
(67, 'code', 'core', '/global/code/general.php', 'end', 'ft_display_custom_page_message', 'flag', 'g_success,g_message'),
(68, 'code', 'core', '/global/code/general.php', 'end', 'ft_eval_smarty_string', 'output,placeholder_str,placeholders,theme', 'output'),
(69, 'code', 'core', '/global/code/general.php', 'end', 'ft_check_permission', 'account_type', 'boot_out_user,message_flag'),
(70, 'code', 'core', '/global/code/general.php', 'main', 'ft_check_client_may_view', 'client_id,form_id,view_id,permissions', 'permissions'),
(71, 'code', 'core', '/global/code/general.php', 'end', 'ft_generate_js_messages', 'js', 'js'),
(72, 'code', 'core', '/global/code/general.php', 'end', 'ft_get_submission_placeholders', 'placeholders', 'placeholders'),
(73, 'code', 'core', '/global/code/menus.php', 'end', 'ft_get_menus', 'return_hash', 'return_hash'),
(74, 'code', 'core', '/global/code/menus.php', 'end', 'ft_get_menu_list', 'menus', 'menus'),
(75, 'code', 'core', '/global/code/menus.php', 'end', 'ft_get_admin_menu', 'menu_info', 'menu_info'),
(76, 'code', 'core', '/global/code/menus.php', 'end', 'ft_get_client_menu', 'menu_info', 'menu_info'),
(77, 'code', 'core', '/global/code/menus.php', 'end', 'ft_get_menu_items', 'menu_items,menu_id', 'menu_items'),
(78, 'code', 'core', '/global/code/menus.php', 'middle', 'ft_get_admin_menu_pages_dropdown', 'select_lines', 'select_lines'),
(79, 'code', 'core', '/global/code/menus.php', 'middle', 'ft_get_client_menu_pages_dropdown', 'select_lines', 'select_lines'),
(80, 'code', 'core', '/global/code/menus.php', 'end', 'ft_update_admin_menu', 'success,message,info', 'success,message'),
(81, 'code', 'core', '/global/code/menus.php', 'end', 'ft_update_menu_order', 'menu_id', ''),
(82, 'code', 'core', '/global/code/menus.php', 'end', 'ft_update_client_menu', 'info', 'success,message'),
(83, 'code', 'core', '/global/code/menus.php', 'end', 'ft_get_page_url', 'page_identifier,params,full_url', 'full_url'),
(84, 'code', 'core', '/global/code/menus.php', 'start', 'ft_construct_page_url', 'url,page_identifier,custom_options,args', 'url'),
(85, 'code', 'core', '/global/code/menus.php', 'start', 'ft_delete_client_menu', 'menu_id', ''),
(86, 'code', 'core', '/global/code/modules.php', 'end', 'ft_uninstall_module', 'module_id,success,message', 'success,message'),
(87, 'code', 'core', '/global/code/modules.php', 'end', 'ft_get_module_menu_items', 'menu_items,module_id,module_folder', 'menu_items'),
(88, 'code', 'core', '/global/code/modules.php', 'end', 'ft_get_module', 'module_id,result', 'result'),
(89, 'code', 'core', '/global/code/modules.php', 'start', 'ft_search_modules', 'search_criteria', 'search_criteria'),
(90, 'code', 'core', '/global/code/modules.php', 'start', 'ft_get_modules', 'modules_info', 'modules_info'),
(91, 'code', 'core', '/global/code/modules.php', 'end', 'ft_init_module_page', 'account_type,module_folder', ''),
(92, 'code', 'core', '/global/code/modules.php', 'end', 'ft_include_module', 'module_folder', ''),
(93, 'code', 'core', '/global/code/modules.php', 'start', 'ft_module_override_data', 'location,data', 'data'),
(94, 'code', 'core', '/global/code/option_lists.php', 'end', 'ft_get_option_lists', 'return_hash', 'return_hash'),
(95, 'code', 'core', '/global/code/option_lists.php', 'end', 'ft_update_option_list', 'list_id,info', 'success,message'),
(96, 'code', 'core', '/global/code/option_lists.php', 'end', 'ft_delete_option_list', 'list_id', 'success,message'),
(97, 'code', 'core', '/global/code/settings.php', 'end', 'ft_update_main_settings', 'settings', 'success,message'),
(98, 'code', 'core', '/global/code/settings.php', 'end', 'ft_update_account_settings', 'settings', 'success,message'),
(99, 'code', 'core', '/global/code/settings.php', 'end', 'ft_update_file_settings', 'infohash', 'success,message'),
(100, 'code', 'core', '/global/code/settings.php', 'end', 'ft_update_theme_settings', 'infohash', 'success,message'),
(101, 'code', 'core', '/global/code/submissions.php', 'end', 'ft_create_blank_submission', 'form_id,now,ip,new_submission_id', ''),
(102, 'code', 'core', '/global/code/submissions.php', 'start', 'ft_delete_submission', 'form_id,view_id,submission_id,is_admin', ''),
(103, 'code', 'core', '/global/code/submissions.php', 'end', 'ft_delete_submission', 'form_id,view_id,submission_id,is_admin', 'success,message'),
(104, 'code', 'core', '/global/code/submissions.php', 'start', 'ft_delete_submissions', 'form_id,view_id,submissions_to_delete,omit_list,search_fields,is_admin', 'submission_ids'),
(105, 'code', 'core', '/global/code/submissions.php', 'end', 'ft_delete_submissions', 'form_id,view_id,submissions_to_delete,omit_list,search_fields,is_admin', 'success,message'),
(106, 'code', 'core', '/global/code/submissions.php', 'end', 'ft_get_submission', 'form_id,submission_id,view_id,return_arr', 'return_arr'),
(107, 'code', 'core', '/global/code/submissions.php', 'end', 'ft_get_submission_info', 'form_id,submission_id,submission', 'submission'),
(108, 'code', 'core', '/global/code/submissions.php', 'start', 'ft_update_submission', 'form_id,submission_id,infohash', 'infohash'),
(109, 'code', 'core', '/global/code/submissions.php', 'manage_files', 'ft_update_submission', 'form_id,submission_id,file_fields', 'success,message'),
(110, 'code', 'core', '/global/code/submissions.php', 'end', 'ft_update_submission', 'form_id,submission_id,infohash', 'success,message'),
(111, 'code', 'core', '/global/code/submissions.php', 'end', 'ft_search_submissions', 'form_id,submission_id,view_id,results_per_page,page_num,order,columns,search_fields,submission_ids,return_hash', 'return_hash'),
(112, 'code', 'core', '/global/code/submissions.php', 'main', 'ft_display_submission_listing_quicklinks', 'context', 'quicklinks'),
(113, 'code', 'core', '/global/code/themes.php', 'end', 'ft_get_theme', 'theme_id,theme_info', 'theme_info'),
(114, 'code', 'core', '/global/code/themes.php', 'end', 'ft_get_theme_by_theme_folder', 'theme_folder,theme_info', 'theme_info'),
(115, 'code', 'core', '/global/code/themes.php', 'end', 'ft_get_themes', 'theme_info', 'theme_info'),
(116, 'code', 'core', '/global/code/themes.php', 'main', 'ft_display_page', 'g_smarty,template,page_vars', 'g_smarty'),
(117, 'code', 'core', '/global/code/themes.php', 'main', 'ft_display_module_page', 'g_smarty,template,page_vars', 'g_smarty'),
(118, 'code', 'core', '/global/code/views.php', 'end', 'ft_get_view', 'view_id,view_info', 'view_info'),
(119, 'code', 'core', '/global/code/views.php', 'end', 'ft_get_views', 'return_hash', 'return_hash'),
(120, 'code', 'core', '/global/code/views.php', 'end', 'ft_get_view_ids', 'view_ids', 'view_ids'),
(121, 'code', 'core', '/global/code/views.php', 'end', 'ft_get_view_tabs', 'view_id,tab_info', 'tab_info'),
(122, 'code', 'core', '/global/code/views.php', 'end', 'ft_create_new_view', 'view_id', ''),
(123, 'code', 'core', '/global/code/views.php', 'end', 'ft_delete_view', 'view_id', 'success,message'),
(124, 'code', 'core', '/global/code/views.php', 'end', 'ft_get_view_clients', 'account_info', 'account_info'),
(125, 'code', 'core', '/global/code/views.php', 'end', 'ft_update_view', 'view_id,info', 'success,message'),
(126, 'code', 'core', '/global/code/views.php', 'start', 'ft_get_view_filter_sql', 'placeholders,is_client_account', 'placeholders,is_client_account'),
(127, 'code', 'core', '/global/code/views.php', 'end', 'ft_get_form_views', 'view_hash', 'view_hash'),
(128, 'code', 'core', '/global/code/views.php', 'end', 'ft_get_view_list', 'form_id,result', 'result'),
(129, 'code', 'api', '/global/api/api.php', 'start', 'ft_api_process_form', 'form_info,form_id,form_data', 'form_data'),
(130, 'code', 'api', '/global/api/api.php', 'manage_files', 'ft_api_process_form', 'form_id,submission_id,file_fields,namespace', 'success,message'),
(131, 'template', 'core', '/themes/default/admin/account/index.tpl', 'admin_account_top', '', '', ''),
(132, 'template', 'core', '/themes/default/admin/account/index.tpl', 'admin_account_bottom', '', '', ''),
(133, 'template', 'core', '/themes/default/admin/clients/add.tpl', 'admin_add_client_top', '', '', ''),
(134, 'template', 'core', '/themes/default/admin/clients/add.tpl', 'admin_add_client_bottom', '', '', ''),
(135, 'template', 'core', '/themes/default/admin/clients/edit.tpl', 'admin_edit_client_pages_top', '', '', ''),
(136, 'template', 'core', '/themes/default/admin/clients/edit.tpl', 'admin_edit_client_pages_bottom', '', '', ''),
(137, 'template', 'core', '/themes/default/admin/clients/index.tpl', 'admin_list_clients_top', '', '', ''),
(138, 'template', 'core', '/themes/default/admin/clients/index.tpl', 'admin_list_clients_bottom', '', '', ''),
(139, 'template', 'core', '/themes/default/admin/clients/tab_forms.tpl', 'admin_edit_client_forms_top', '', '', ''),
(140, 'template', 'core', '/themes/default/admin/clients/tab_forms.tpl', 'admin_edit_client_forms_bottom', '', '', ''),
(141, 'template', 'core', '/themes/default/admin/clients/tab_main.tpl', 'admin_edit_client_main_top', '', '', ''),
(142, 'template', 'core', '/themes/default/admin/clients/tab_main.tpl', 'admin_edit_client_main_middle', '', '', ''),
(143, 'template', 'core', '/themes/default/admin/clients/tab_main.tpl', 'admin_edit_client_main_bottom', '', '', ''),
(144, 'template', 'core', '/themes/default/admin/clients/tab_settings.tpl', 'admin_edit_client_settings_top', '', '', ''),
(145, 'template', 'core', '/themes/default/admin/clients/tab_settings.tpl', 'admin_edit_client_settings_bottom', '', '', ''),
(146, 'template', 'core', '/themes/default/admin/forms/add/index.tpl', 'add_form_page', '', '', ''),
(147, 'template', 'core', '/themes/default/admin/forms/edit.tpl', 'admin_edit_form_content', '', '', ''),
(148, 'template', 'core', '/themes/default/admin/forms/edit_submission.tpl', 'admin_edit_submission_top', '', '', ''),
(149, 'template', 'core', '/themes/default/admin/forms/edit_submission.tpl', 'admin_edit_submission_bottom', '', '', ''),
(150, 'template', 'core', '/themes/default/admin/forms/index.tpl', 'admin_forms_list_top', '', '', ''),
(151, 'template', 'core', '/themes/default/admin/forms/index.tpl', 'admin_forms_form_type_label', '', '', ''),
(152, 'template', 'core', '/themes/default/admin/forms/index.tpl', 'admin_forms_list_bottom', '', '', ''),
(153, 'template', 'core', '/themes/default/admin/forms/option_lists/index.tpl', 'option_list_button_row', '', '', ''),
(154, 'template', 'core', '/themes/default/admin/forms/option_lists/tab_main.tpl', 'edit_option_list_main', '', '', ''),
(155, 'template', 'core', '/themes/default/admin/forms/submissions.tpl', 'admin_submission_listings_top', '', '', ''),
(156, 'template', 'core', '/themes/default/admin/forms/submissions.tpl', 'admin_submission_listings_buttons1', '', '', ''),
(157, 'template', 'core', '/themes/default/admin/forms/submissions.tpl', 'admin_submission_listings_buttons2', '', '', ''),
(158, 'template', 'core', '/themes/default/admin/forms/submissions.tpl', 'admin_submission_listings_buttons3', '', '', ''),
(159, 'template', 'core', '/themes/default/admin/forms/submissions.tpl', 'admin_submission_listings_buttons4', '', '', ''),
(160, 'template', 'core', '/themes/default/admin/forms/submissions.tpl', 'admin_submission_listings_bottom', '', '', ''),
(161, 'template', 'core', '/themes/default/admin/forms/tab_edit_email_tab1.tpl', 'edit_template_tab1', '', '', ''),
(162, 'template', 'core', '/themes/default/admin/forms/tab_edit_email_tab1.tpl', 'edit_template_tab1_advanced', '', '', ''),
(163, 'template', 'core', '/themes/default/admin/forms/tab_edit_email_tab2.tpl', 'edit_template_tab2', '', '', ''),
(164, 'template', 'core', '/themes/default/admin/forms/tab_edit_view__filters.tpl', 'admin_edit_view_client_map_filter_dropdown', '', '', ''),
(165, 'template', 'core', '/themes/default/admin/forms/tab_fields.tpl', 'admin_edit_form_fields_tab_button_row', '', '', ''),
(166, 'template', 'core', '/themes/default/admin/forms/tab_main.tpl', 'admin_edit_form_main_tab_form_type_dropdown', '', '', ''),
(167, 'template', 'core', '/themes/default/admin/forms/tab_main.tpl', 'admin_edit_form_main_tab_after_main_settings', '', '', ''),
(168, 'template', 'core', '/themes/default/admin/forms/tab_main.tpl', 'admin_edit_form_main_tab_button_row', '', '', ''),
(169, 'template', 'core', '/themes/default/admin/forms/tab_views.tpl', 'admin_edit_form_views_tab_button_row', '', '', ''),
(170, 'template', 'core', '/themes/default/admin/settings/tab_accounts.tpl', 'admin_settings_client_settings_bottom', '', '', ''),
(171, 'template', 'core', '/themes/default/admin/settings/tab_edit_admin_menu.tpl', 'admin_settings_admin_menu_top', '', '', ''),
(172, 'template', 'core', '/themes/default/admin/settings/tab_edit_client_menu.tpl', 'admin_settings_client_menu_top', '', '', ''),
(173, 'template', 'core', '/themes/default/admin/settings/tab_files.tpl', 'admin_settings_files_bottom', '', '', ''),
(174, 'template', 'core', '/themes/default/admin/settings/tab_main.tpl', 'admin_settings_main_tab_bottom', '', '', ''),
(175, 'template', 'core', '/themes/default/admin/settings/tab_menus.tpl', 'admin_settings_menus_top', '', '', ''),
(176, 'template', 'core', '/themes/default/admin/themes/index.tpl', 'admin_settings_themes_bottom', '', '', ''),
(177, 'template', 'core', '/themes/default/clients/account/tab_main.tpl', 'edit_client_main_top', '', '', ''),
(178, 'template', 'core', '/themes/default/clients/account/tab_main.tpl', 'edit_client_main_middle', '', '', ''),
(179, 'template', 'core', '/themes/default/clients/account/tab_main.tpl', 'edit_client_main_bottom', '', '', ''),
(180, 'template', 'core', '/themes/default/clients/account/tab_settings.tpl', 'edit_client_settings_top', '', '', ''),
(181, 'template', 'core', '/themes/default/clients/account/tab_settings.tpl', 'edit_client_settings_bottom', '', '', ''),
(182, 'template', 'core', '/themes/default/clients/forms/edit_submission.tpl', 'client_edit_submission_top', '', '', ''),
(183, 'template', 'core', '/themes/default/clients/forms/edit_submission.tpl', 'client_edit_submission_bottom', '', '', ''),
(184, 'template', 'core', '/themes/default/clients/forms/index.tpl', 'client_submission_listings_top', '', '', ''),
(185, 'template', 'core', '/themes/default/clients/forms/index.tpl', 'client_submission_listings_buttons1', '', '', ''),
(186, 'template', 'core', '/themes/default/clients/forms/index.tpl', 'client_submission_listings_buttons2', '', '', ''),
(187, 'template', 'core', '/themes/default/clients/forms/index.tpl', 'client_submission_listings_buttons3', '', '', ''),
(188, 'template', 'core', '/themes/default/clients/forms/index.tpl', 'client_submission_listings_buttons4', '', '', ''),
(189, 'template', 'core', '/themes/default/clients/forms/index.tpl', 'client_submission_listings_bottom', '', '', ''),
(190, 'template', 'core', '/themes/default/header.tpl', 'head_top', '', '', ''),
(191, 'template', 'core', '/themes/default/header.tpl', 'head_bottom', '', '', ''),
(192, 'template', 'core', '/themes/default/modules_header.tpl', 'modules_head_top', '', '', ''),
(193, 'template', 'core', '/themes/default/modules_header.tpl', 'modules_head_bottom', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `ft_hook_calls`
--

CREATE TABLE IF NOT EXISTS `ft_hook_calls` (
  `hook_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `hook_type` enum('code','template') NOT NULL DEFAULT 'code',
  `action_location` varchar(100) NOT NULL,
  `module_folder` varchar(255) NOT NULL,
  `function_name` varchar(255) NOT NULL,
  `hook_function` varchar(255) NOT NULL,
  `priority` tinyint(4) NOT NULL DEFAULT '50',
  PRIMARY KEY (`hook_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `ft_hook_calls`
--

INSERT INTO `ft_hook_calls` (`hook_id`, `hook_type`, `action_location`, `module_folder`, `function_name`, `hook_function`, `priority`) VALUES
(1, 'code', 'main', 'client_audit', 'ft_login', 'ca_log_change', 50),
(2, 'code', 'main', 'client_audit', 'ft_logout_user', 'ca_log_change', 50),
(3, 'code', 'end', 'client_audit', 'ft_add_client', 'ca_log_change', 50),
(4, 'code', 'end', 'client_audit', 'ft_admin_update_client', 'ca_log_change', 50),
(5, 'code', 'end', 'client_audit', 'ft_update_client', 'ca_log_change', 50),
(6, 'code', 'end', 'client_audit', 'ft_disable_client', 'ca_log_change', 50),
(7, 'code', 'end', 'client_audit', 'ft_delete_client', 'ca_log_change', 50),
(8, 'code', 'end', 'client_audit', 'ft_update_view', 'ca_log_change', 50),
(9, 'code', 'end', 'client_audit', 'ft_update_form_main_tab', 'ca_log_change', 50),
(10, 'code', 'start', 'client_audit', 'ft_delete_form', 'ca_log_change', 50),
(11, 'template', 'admin_submission_listings_bottom', 'export_manager', '', 'exp_display_export_options', 50),
(12, 'template', 'client_submission_listings_bottom', 'export_manager', '', 'exp_display_export_options', 50),
(13, 'template', 'admin_forms_list_bottom', 'form_backup', '', 'fb_display_create_form_backup_button', 50),
(14, 'code', 'end', 'hooks_manager', 'ft_create_blank_submission', 'hm_parse_code_hook', 50),
(15, 'code', 'end', 'hooks_manager', 'ft_create_blank_submission', 'hm_parse_code_hook', 50),
(16, 'code', 'end', 'hooks_manager', 'ft_delete_submission', 'hm_parse_code_hook', 50),
(17, 'code', 'end', 'hooks_manager', 'ft_process_form', 'hm_parse_code_hook', 50),
(18, 'code', 'end', 'hooks_manager', 'ft_delete_submission', 'hm_parse_code_hook', 50),
(19, 'code', 'end', 'hooks_manager', 'ft_delete_submission', 'hm_parse_code_hook', 50),
(20, 'code', 'end', 'hooks_manager', 'ft_create_blank_submission', 'hm_parse_code_hook', 50),
(21, 'code', 'end', 'hooks_manager', 'ft_process_form', 'hm_parse_code_hook', 50);

-- --------------------------------------------------------

--
-- Table structure for table `ft_list_groups`
--

CREATE TABLE IF NOT EXISTS `ft_list_groups` (
  `group_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `group_type` varchar(50) NOT NULL,
  `group_name` varchar(255) NOT NULL,
  `custom_data` text NOT NULL,
  `list_order` smallint(6) NOT NULL,
  PRIMARY KEY (`group_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `ft_list_groups`
--

INSERT INTO `ft_list_groups` (`group_id`, `group_type`, `group_name`, `custom_data`, `list_order`) VALUES
(1, 'field_types', 'Standard Fields', '', 1),
(2, 'field_types', 'Special Fields', '', 2),
(3, 'form_1_view_group', 'Views', '', 1),
(4, 'view_fields_1', 'Data', '1', 1),
(7, 'option_list_1', '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ft_menus`
--

CREATE TABLE IF NOT EXISTS `ft_menus` (
  `menu_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `menu` varchar(255) NOT NULL,
  `menu_type` enum('admin','client') NOT NULL DEFAULT 'client',
  PRIMARY KEY (`menu_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `ft_menus`
--

INSERT INTO `ft_menus` (`menu_id`, `menu`, `menu_type`) VALUES
(1, 'Administrator', 'admin'),
(2, 'Client Menu', 'client');

-- --------------------------------------------------------

--
-- Table structure for table `ft_menu_items`
--

CREATE TABLE IF NOT EXISTS `ft_menu_items` (
  `menu_item_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` mediumint(8) unsigned NOT NULL,
  `display_text` varchar(100) NOT NULL,
  `page_identifier` varchar(50) NOT NULL,
  `custom_options` varchar(255) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `is_submenu` enum('yes','no') NOT NULL DEFAULT 'no',
  `is_new_sort_group` enum('yes','no') NOT NULL DEFAULT 'yes',
  `list_order` smallint(5) unsigned DEFAULT NULL,
  PRIMARY KEY (`menu_item_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `ft_menu_items`
--

INSERT INTO `ft_menu_items` (`menu_item_id`, `menu_id`, `display_text`, `page_identifier`, `custom_options`, `url`, `is_submenu`, `is_new_sort_group`, `list_order`) VALUES
(1, 1, 'Forms', 'admin_forms', '', '/admin/forms/', 'no', 'yes', 1),
(2, 1, 'Add Form', 'add_form_choose_type', '', '/admin/forms/add/', 'yes', 'no', 2),
(3, 1, 'Option Lists', 'option_lists', '', '/admin/forms/option_lists/', 'yes', 'no', 3),
(4, 1, 'Clients', 'clients', '', '/admin/clients/', 'no', 'yes', 4),
(5, 1, 'Modules', 'modules', '', '/admin/modules/', 'no', 'yes', 5),
(6, 1, 'Themes', 'settings_themes', '', '/admin/themes/', 'no', 'yes', 6),
(7, 1, 'Settings', 'settings', '', '/admin/settings', 'no', 'yes', 7),
(8, 1, 'Main', 'settings_main', '', '/admin/settings/index.php?page=main', 'yes', 'no', 8),
(9, 1, 'Accounts', 'settings_accounts', '', '/admin/settings/index.php?page=accounts', 'yes', 'no', 9),
(10, 1, 'Files', 'settings_files', '', '/admin/settings/index.php?page=files', 'yes', 'no', 10),
(11, 1, 'Menus', 'settings_menus', '', '/admin/settings/index.php?page=menus', 'yes', 'no', 11),
(12, 1, 'Your Account', 'your_account', '', '/admin/account', 'no', 'yes', 12),
(13, 1, 'Logout', 'logout', '', '/index.php?logout', 'no', 'yes', 13),
(14, 2, 'Forms', 'client_forms', '', '/clients/index.php', 'no', 'yes', 1),
(15, 2, 'Account', 'client_account', '', '/clients/account/index.php', 'no', 'yes', 2),
(16, 2, 'Login Info', 'client_account_login', '', '/clients/account/index.php?page=main', 'yes', 'no', 3),
(17, 2, 'Settings', 'client_account_settings', '', '/clients/account/index.php?page=settings', 'yes', 'no', 4),
(18, 2, 'Logout', 'logout', '', '/index.php?logout', 'no', 'yes', 5);

-- --------------------------------------------------------

--
-- Table structure for table `ft_modules`
--

CREATE TABLE IF NOT EXISTS `ft_modules` (
  `module_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `is_installed` enum('yes','no') NOT NULL DEFAULT 'no',
  `is_enabled` enum('yes','no') NOT NULL DEFAULT 'no',
  `is_premium` enum('yes','no') NOT NULL DEFAULT 'no',
  `module_key` varchar(15) DEFAULT NULL,
  `origin_language` varchar(50) NOT NULL,
  `module_name` varchar(100) NOT NULL,
  `module_folder` varchar(100) NOT NULL,
  `version` varchar(50) DEFAULT NULL,
  `author` varchar(200) DEFAULT NULL,
  `author_email` varchar(200) DEFAULT NULL,
  `author_link` varchar(255) DEFAULT NULL,
  `description` mediumtext NOT NULL,
  `module_date` datetime NOT NULL,
  PRIMARY KEY (`module_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `ft_modules`
--

INSERT INTO `ft_modules` (`module_id`, `is_installed`, `is_enabled`, `is_premium`, `module_key`, `origin_language`, `module_name`, `module_folder`, `version`, `author`, `author_email`, `author_link`, `description`, `module_date`) VALUES
(1, 'yes', 'yes', 'no', '1', 'en_us', 'Client Audit', 'client_audit', '1.1.2', 'Encore Web Studios', 'formtools@encorewebstudios.com', 'http://www.encorewebstudios.com', 'This module keeps a paper trail of changes to all client accounts, from the moment they were created until they were deleted. It tracks all logins, logout, permission changes and account updates, which can helpful for security auditing purposes. It also provides a simple UI to browse all changes.', '2011-07-28 00:00:00'),
(2, 'yes', 'yes', 'no', '2', 'en_us', 'Database Integrity', 'database_integrity', '2.0.5', 'Encore Web Studios', 'formtools@encorewebstudios.com', 'http://www.encorewebstudios.com', 'This module checks the integrity of your Form Tools database. Any compatible modules share information with this module to let it know the proper structure of the database tables and fields.', '2011-09-10 00:00:00'),
(3, 'yes', 'yes', 'no', '3', 'en_us', 'Form Backup', 'form_backup', '1.1.1', 'Encore Web Studios', 'formtools@encorewebstudios.com', 'http://www.encorewebstudios.com', 'This module lets you backup an entire form, including individual components like Views, email templates and submission data. It''s also handy for making copies of forms if you want multiple, similar forms without having to add each separately.', '2011-08-28 00:00:00'),
(4, 'yes', 'yes', 'no', '4', 'en_us', 'Export Manager', 'export_manager', '2.0.7', 'Encore Web Studios', 'formtools@encorewebstudios.com', 'http://www.encorewebstudios.com', 'Define your own ways of exporting form submission data for view / download. Excel, Printer-friendly HTML, XML and CSV are included by default.', '2011-08-29 00:00:00'),
(5, 'yes', 'yes', 'no', '5', 'en_us', 'Hello Database!', 'hello_database', '1.0.3', 'Encore Web Studios', 'formtools@encorewebstudios.com', 'http://www.encorewebstudios.com', 'A simple "Hello World" module written for module developers to illustrate the installation, de-installation script and some simple database interaction.', '2011-05-26 00:00:00'),
(6, 'yes', 'yes', 'no', NULL, 'en_us', 'Hooks Manager', 'hooks_manager', '1.1.0', 'Encore Web Studios', 'formtools@encorewebstudios.com', 'http://www.encorewebstudios.com', 'This module is for users who need to supplement the Form Tools core code with their own functionality. It lets you embed your own HTML/PHP or execute your own code at specific points/events in Form Tools.', '2011-06-03 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `ft_module_client_audit_accounts`
--

CREATE TABLE IF NOT EXISTS `ft_module_client_audit_accounts` (
  `change_id` mediumint(8) unsigned NOT NULL,
  `changed_fields` mediumtext,
  `account_status` enum('active','disabled','pending') NOT NULL DEFAULT 'disabled',
  `ui_language` varchar(50) NOT NULL DEFAULT 'en_us',
  `timezone_offset` varchar(4) DEFAULT NULL,
  `sessions_timeout` varchar(10) NOT NULL DEFAULT '30',
  `date_format` varchar(50) NOT NULL DEFAULT 'M jS, g:i A',
  `login_page` varchar(50) NOT NULL DEFAULT 'client_forms',
  `logout_url` varchar(255) DEFAULT NULL,
  `theme` varchar(50) NOT NULL DEFAULT 'default',
  `menu_id` mediumint(8) unsigned NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`change_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ft_module_client_audit_accounts`
--

INSERT INTO `ft_module_client_audit_accounts` (`change_id`, `changed_fields`, `account_status`, `ui_language`, `timezone_offset`, `sessions_timeout`, `date_format`, `login_page`, `logout_url`, `theme`, `menu_id`, `first_name`, `last_name`, `email`, `username`, `password`) VALUES
(1, '', 'active', 'en_us', '0', '30', 'M jS y, g:i A', 'client_forms', 'http://www.indigodesign.me/game/current/formtools', 'default', 2, 'THE', 'MUSEUM', 'themuseum@themuseum.ca', 'THEMUSEUM', '5e95ada161b470cc3aaaab25906bc7cd');

-- --------------------------------------------------------

--
-- Table structure for table `ft_module_client_audit_account_settings`
--

CREATE TABLE IF NOT EXISTS `ft_module_client_audit_account_settings` (
  `change_id` mediumint(9) NOT NULL,
  `setting_name` varchar(255) NOT NULL,
  `setting_value` mediumtext NOT NULL,
  PRIMARY KEY (`change_id`,`setting_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ft_module_client_audit_account_settings`
--

INSERT INTO `ft_module_client_audit_account_settings` (`change_id`, `setting_name`, `setting_value`) VALUES
(1, 'client_notes', ''),
(1, 'company_name', ''),
(1, 'footer_text', ''),
(1, 'forms_page_default_message', '{$LANG.text_client_welcome}'),
(1, 'max_failed_login_attempts', ''),
(1, 'may_edit_date_format', 'no'),
(1, 'may_edit_footer_text', 'no'),
(1, 'may_edit_language', 'yes'),
(1, 'may_edit_logout_url', 'yes'),
(1, 'may_edit_max_failed_login_attempts', 'no'),
(1, 'may_edit_page_titles', 'no'),
(1, 'may_edit_sessions_timeout', 'no'),
(1, 'may_edit_theme', 'yes'),
(1, 'may_edit_timezone_offset', 'yes'),
(1, 'min_password_length', ''),
(1, 'num_failed_login_attempts', '0'),
(1, 'num_password_history', ''),
(1, 'page_titles', 'Form Tools - {$page}'),
(1, 'password_history', '5e95ada161b470cc3aaaab25906bc7cd'),
(1, 'required_password_chars', '');

-- --------------------------------------------------------

--
-- Table structure for table `ft_module_client_audit_changes`
--

CREATE TABLE IF NOT EXISTS `ft_module_client_audit_changes` (
  `change_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `change_date` datetime NOT NULL,
  `change_type` enum('account_created','account_deleted','admin_update','client_update','account_disabled_from_failed_logins','permissions','login','logout') CHARACTER SET latin1 NOT NULL,
  `status` enum('hidden','visible') NOT NULL DEFAULT 'visible',
  `account_id` mediumint(9) NOT NULL,
  PRIMARY KEY (`change_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `ft_module_client_audit_changes`
--

INSERT INTO `ft_module_client_audit_changes` (`change_id`, `change_date`, `change_type`, `status`, `account_id`) VALUES
(1, '2011-10-05 10:49:43', 'account_created', 'visible', 2),
(2, '2011-10-05 10:49:43', 'permissions', 'hidden', 2),
(3, '2011-10-05 10:50:25', 'login', 'visible', 2),
(4, '2011-10-05 10:50:48', 'logout', 'visible', 2),
(5, '2011-10-05 10:51:26', 'login', 'visible', 2),
(6, '2011-10-05 11:06:50', 'logout', 'visible', 2),
(7, '2011-10-05 12:08:22', 'login', 'visible', 2),
(8, '2011-10-12 15:01:59', 'login', 'visible', 2),
(9, '2011-10-19 14:40:22', 'login', 'visible', 2),
(10, '2011-11-23 17:49:35', 'login', 'visible', 2),
(11, '2011-12-06 16:12:08', 'login', 'visible', 2),
(12, '2011-12-08 11:58:54', 'login', 'visible', 2),
(13, '2011-12-08 11:59:00', 'logout', 'visible', 2),
(14, '2011-12-08 12:22:51', 'login', 'visible', 2),
(15, '2011-12-08 14:29:27', 'logout', 'visible', 2),
(16, '2011-12-08 14:29:37', 'login', 'visible', 2),
(17, '2011-12-08 15:11:25', 'logout', 'visible', 2),
(18, '2011-12-08 15:11:27', 'login', 'visible', 2),
(19, '2011-12-09 12:15:23', 'login', 'visible', 2);

-- --------------------------------------------------------

--
-- Table structure for table `ft_module_client_audit_client_permissions`
--

CREATE TABLE IF NOT EXISTS `ft_module_client_audit_client_permissions` (
  `change_id` mediumint(8) unsigned NOT NULL,
  `added_views` mediumtext,
  `removed_views` mediumtext,
  `added_forms` mediumtext,
  `removed_forms` mediumtext,
  `permissions` mediumtext NOT NULL,
  PRIMARY KEY (`change_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ft_module_client_audit_client_permissions`
--

INSERT INTO `ft_module_client_audit_client_permissions` (`change_id`, `added_views`, `removed_views`, `added_forms`, `removed_forms`, `permissions`) VALUES
(2, '', '', '1', '', '1:1|');

-- --------------------------------------------------------

--
-- Table structure for table `ft_module_export_groups`
--

CREATE TABLE IF NOT EXISTS `ft_module_export_groups` (
  `export_group_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `group_name` varchar(255) NOT NULL,
  `access_type` enum('admin','public','private') NOT NULL DEFAULT 'public',
  `form_view_mapping` enum('all','except','only') NOT NULL DEFAULT 'all',
  `forms_and_views` mediumtext,
  `visibility` enum('show','hide') NOT NULL DEFAULT 'show',
  `icon` varchar(100) NOT NULL,
  `action` enum('file','popup','new_window') NOT NULL DEFAULT 'popup',
  `action_button_text` varchar(255) NOT NULL DEFAULT 'Display',
  `popup_height` varchar(5) DEFAULT NULL,
  `popup_width` varchar(5) DEFAULT NULL,
  `headers` text,
  `smarty_template` mediumtext NOT NULL,
  `list_order` tinyint(4) NOT NULL,
  PRIMARY KEY (`export_group_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `ft_module_export_groups`
--

INSERT INTO `ft_module_export_groups` (`export_group_id`, `group_name`, `access_type`, `form_view_mapping`, `forms_and_views`, `visibility`, `icon`, `action`, `action_button_text`, `popup_height`, `popup_width`, `headers`, `smarty_template`, `list_order`) VALUES
(1, 'HTML / Printer-friendly', 'public', 'all', NULL, 'show', 'printer.png', 'popup', 'Display', '600', '800', '', '<html>\r\n<head>\r\n  <title>{$export_group_name}</title>\r\n\r\n  {* escape the CSS so it doesn''t confuse Smarty *}\r\n  {literal}\r\n  <style type="text/css">\r\n  body { margin: 0px; }\r\n  table, td, tr, div, span { \r\n    font-family: verdana; font-size: 8pt;\r\n  }\r\n  table { empty-cells: show }\r\n  #nav_row { background-color: #efefef; padding: 10px; }\r\n  #export_group_name { color: #336699; font-weight:bold }\r\n  .print_table { border: 1px solid #dddddd; }\r\n  .print_table th { \r\n    border: 1px solid #cccccc; \r\n    background-color: #efefef;\r\n    text-align: left;\r\n  }\r\n  .print_table td { border: 1px solid #cccccc; }\r\n  .one_item { margin-bottom: 15px; }\r\n  .page_break { page-break-after: always; }\r\n  </style>\r\n\r\n  <style type="text/css" media="print">\r\n  .no_print { display: none }\r\n  </style>\r\n  {/literal}\r\n\r\n</head>\r\n<body>\r\n\r\n<div id="nav_row" class="no_print">\r\n\r\n  <span style="float:right">{if $page_type != "file"}\r\n    {* if there''s more than one export type in this group, display the types in a dropdown *}\r\n    {if $export_types|@count > 1}\r\n      <select name="export_type_id" onchange="window.location=''{$same_page}?export_group_id={$export_group_id}&export_group_{$export_group_id}_results={$export_group_results}&export_type_id='' + this.value">\r\n      {foreach from=$export_types item=export_type}\r\n        <option value="{$export_type.export_type_id}" {if $export_type.export_type_id == $export_type_id}selected{/if}>{eval var=$export_type.export_type_name}</option>\r\n      {/foreach}\r\n      </select>\r\n    {/if}\r\n    {/if}\r\n    <input type="button" onclick="window.close()" value="{$LANG.word_close}" />\r\n    <input type="button" onclick="window.print()" value="{$LANG.word_print}" />\r\n  </span>\r\n\r\n  <span id="export_group_name">{eval var=$export_group_name}</span>\r\n</div>\r\n\r\n<div style="padding: 15px">\r\n  {$export_type_smarty_template}\r\n</div>\r\n\r\n</body>\r\n</html>', 1),
(2, 'Excel', 'public', 'all', NULL, 'show', 'xls.gif', 'new_window', 'Generate', '', '', 'Pragma: public\nCache-Control: max-age=0\nContent-Type: application/vnd.ms-excel; charset=utf-8\nContent-Disposition: attachment; filename={$filename}', '<html>\r\n<head>\r\n</head>\r\n<body>\r\n\r\n{$export_type_smarty_template}\r\n\r\n</body>\r\n</html>', 2),
(3, 'XML', 'public', 'all', NULL, 'hide', 'xml.jpg', 'new_window', 'Generate', '', '', '', '<?xml version="1.0" encoding="utf-8" ?>\r\n\r\n{$export_type_smarty_template}', 4),
(4, 'CSV', 'public', 'all', NULL, 'hide', 'csv.gif', 'new_window', 'Generate', '', '', 'Content-type: application/xml; charset="octet-stream"\r\nContent-Disposition: attachment; filename={$filename}', '{$export_type_smarty_template}', 3);

-- --------------------------------------------------------

--
-- Table structure for table `ft_module_export_group_clients`
--

CREATE TABLE IF NOT EXISTS `ft_module_export_group_clients` (
  `export_group_id` mediumint(8) unsigned NOT NULL,
  `account_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`export_group_id`,`account_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ft_module_export_types`
--

CREATE TABLE IF NOT EXISTS `ft_module_export_types` (
  `export_type_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `export_type_name` varchar(255) NOT NULL,
  `export_type_visibility` enum('show','hide') NOT NULL DEFAULT 'show',
  `filename` varchar(255) NOT NULL,
  `export_group_id` smallint(6) DEFAULT NULL,
  `smarty_template` text NOT NULL,
  `list_order` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`export_type_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `ft_module_export_types`
--

INSERT INTO `ft_module_export_types` (`export_type_id`, `export_type_name`, `export_type_visibility`, `filename`, `export_group_id`, `smarty_template`, `list_order`) VALUES
(1, 'Table format', 'show', 'submissions-{$M}.{$j}.html', 1, '<h1>{$form_name} - {$view_name}</h1>\r\n\r\n<table cellpadding="2" cellspacing="0" width="100%" class="print_table">\r\n<tr>\r\n  {foreach from=$display_fields item=column}\r\n    <th>{$column.field_title}</th>\r\n  {/foreach}\r\n</tr>\r\n{strip}\r\n{foreach from=$submissions item=submission}\r\n  {assign var=submission_id value=$submission.submission_id}\r\n  <tr>\r\n    {foreach from=$display_fields item=field_info}\r\n      {assign var=col_name value=$field_info.col_name}\r\n      {assign var=value value=$submission.$col_name}\r\n      <td>\r\n        {smart_display_field form_id=$form_id view_id=$view_id\r\n          submission_id=$submission_id field_info=$field_info\r\n          field_types=$field_types settings=$settings value=$value}\r\n      </td>\r\n    {/foreach}\r\n  </tr>\r\n{/foreach}\r\n{/strip}\r\n</table>', 1),
(2, 'One by one', 'show', 'submissions-{$M}.{$j}.html', 1, '<h1>{$form_name} - {$view_name}</h1>\r\n\r\n{strip}\r\n{foreach from=$submissions item=submission}\r\n  {assign var=submission_id value=$submission.submission_id}\r\n  <table cellpadding="2" cellspacing="0" width="100%" \r\n    class="print_table one_item">\r\n    {foreach from=$display_fields item=field_info}\r\n      {assign var=col_name value=$field_info.col_name}\r\n      {assign var=value value=$submission.$col_name}\r\n      <tr>\r\n        <th width="140">{$field_info.field_title}</th>\r\n        <td>\r\n          {smart_display_field form_id=$form_id view_id=$view_id\r\n            submission_id=$submission_id field_info=$field_info\r\n            field_types=$field_types settings=$settings value=$value}\r\n        </td>\r\n      </tr>\r\n    {/foreach}\r\n  </table>\r\n{/foreach}\r\n{/strip}', 2),
(3, 'One submission per page', 'show', 'submissions-{$M}.{$j}.html', 1, '<h1>{$form_name} - {$view_name}</h1>\r\n\r\n{foreach from=$submissions item=submission name=row}\r\n  {assign var=submission_id value=$submission.submission_id}\r\n  <table cellpadding="2" cellspacing="0" width="100%" \r\n    class="print_table one_item">\r\n    {foreach from=$display_fields item=field_info}\r\n      {assign var=col_name value=$field_info.col_name}\r\n      {assign var=value value=$submission.$col_name}\r\n      <tr>\r\n        <th width="140">{$field_info.field_title}</th>\r\n        <td>\r\n          {smart_display_field form_id=$form_id view_id=$view_id\r\n            submission_id=$submission_id field_info=$field_info\r\n            field_types=$field_types settings=$settings value=$value}\r\n        </td>\r\n      </tr>\r\n    {/foreach}\r\n  </table>\r\n\r\n  {if !$smarty.foreach.row.last}\r\n    <div class="no_print"><i>- {$LANG.phrase_new_page} -</i></div>\r\n    <br class="page_break" />\r\n  {/if}\r\n \r\n{/foreach}\r\n', 3),
(4, 'Table format', 'show', 'submissions-{$M}.{$j}.xls', 2, '<h1>{$form_name} - {$view_name}</h1>\r\n\r\n<table cellpadding="2" cellspacing="0" width="100%" class="print_table">\r\n<tr>\r\n  {foreach from=$display_fields item=column}\r\n    <th>{$column.field_title}</th>\r\n  {/foreach}\r\n</tr>\r\n{strip}\r\n{foreach from=$submissions item=submission}\r\n  {assign var=submission_id value=$submission.submission_id}\r\n  <tr>\r\n    {foreach from=$display_fields item=field_info}\r\n      {assign var=col_name value=$field_info.col_name}\r\n      {assign var=value value=$submission.$col_name}\r\n      <td>\r\n        {smart_display_field form_id=$form_id view_id=$view_id\r\n          submission_id=$submission_id field_info=$field_info\r\n          field_types=$field_types settings=$settings value=$value\r\n          escape="excel"}\r\n      </td>\r\n    {/foreach}\r\n  </tr>\r\n{/foreach}\r\n{/strip}\r\n</table>', 1),
(5, 'All submissions', 'show', 'form{$form_id}_{$datetime}.csv', 4, '{strip}\r\n  {foreach from=$display_fields item=column name=row}\r\n    {* workaround for absurd Microsoft Excel problem, in which the first\r\n       two characters of a file cannot be ID; see:\r\n       http://support.microsoft.com /kb/323626 *}\r\n    {if $smarty.foreach.row.first && $column.field_title == "ID"}\r\n      .ID\r\n    {else}\r\n      {$column.field_title|escape:''csv''}\r\n    {/if}\r\n    {if !$smarty.foreach.row.last},{/if}\r\n  {/foreach}\r\n{/strip}\r\n{foreach from=$submissions item=submission name=row}{strip}\r\n  {foreach from=$display_fields item=field_info name=col_row}\r\n    {assign var=col_name value=$field_info.col_name}\r\n    {assign var=value value=$submission.$col_name}\r\n    {smart_display_field form_id=$form_id view_id=$view_id\r\n      submission_id=$submission.submission_id field_info=$field_info\r\n      field_types=$field_types settings=$settings value=$value\r\n      escape="csv"}\r\n    {* if this wasn''t the last row, output a comma *}\r\n    {if !$smarty.foreach.col_row.last},{/if}\r\n  {/foreach}\r\n{/strip}\r\n{if !$smarty.foreach.row.last}\r\n{/if}\r\n{/foreach}', 1),
(6, 'All submissions', 'show', 'form{$form_id}_{$datetime}.xml', 3, '<export>\r\n  <export_datetime>{$datetime}</export_datetime>\r\n  <export_unixtime>{$U}</export_unixtime>\r\n  <form_info>\r\n    <form_id>{$form_id}</form_id>\r\n    <form_name><![CDATA[{$form_name}]]></form_name>\r\n    <form_url>{$form_url}</form_url>\r\n  </form_info>\r\n  <view_info>\r\n    <view_id>{$view_id}</view_id>\r\n    <view_name><![CDATA[{$view_name}]]></view_name>\r\n  </view_info>\r\n  <submissions>\r\n    {foreach from=$submissions item=submission name=row}      \r\n      <submission>\r\n       {foreach from=$display_fields item=field_info name=col_row}\r\n         {assign var=col_name value=$field_info.col_name}\r\n         {assign var=value value=$submission.$col_name}\r\n       <{$col_name}><![CDATA[{smart_display_field form_id=$form_id \r\n      view_id=$view_id submission_id=$submission.submission_id\r\n      field_info=$field_info field_types=$field_types \r\n      settings=$settings value=$value}]]></{$col_name}>\r\n        {/foreach}\r\n       </submission>\r\n    {/foreach}\r\n  </submissions>\r\n</export>', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ft_module_hello_database`
--

CREATE TABLE IF NOT EXISTS `ft_module_hello_database` (
  `row_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `random_number` smallint(5) DEFAULT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `ft_module_hello_database`
--

INSERT INTO `ft_module_hello_database` (`row_id`, `random_number`) VALUES
(1, 457),
(2, 799),
(3, 243),
(4, 455),
(5, 864),
(6, 931),
(7, 87),
(8, 217),
(9, 2),
(10, 23);

-- --------------------------------------------------------

--
-- Table structure for table `ft_module_hooks_manager_rules`
--

CREATE TABLE IF NOT EXISTS `ft_module_hooks_manager_rules` (
  `hook_id` mediumint(9) NOT NULL,
  `is_custom_hook` enum('yes','no') NOT NULL DEFAULT 'no',
  `status` enum('enabled','disabled') NOT NULL DEFAULT 'enabled',
  `rule_name` varchar(255) NOT NULL,
  `code` mediumtext NOT NULL,
  `hook_code_type` enum('na','php','html','smarty') NOT NULL DEFAULT 'na',
  PRIMARY KEY (`hook_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ft_module_hooks_manager_rules`
--

INSERT INTO `ft_module_hooks_manager_rules` (`hook_id`, `is_custom_hook`, `status`, `rule_name`, `code`, `hook_code_type`) VALUES
(20, 'no', 'disabled', 'Updating auto-increment field (ft_create_blank_submission)', 'global $g_table_prefix;\r\nif ($form_id == 1) {\r\n  $query = mysql_query("SELECT count(*) as c FROM {$g_table_prefix}form_{$form_id} WHERE is_finalized = ''yes''");\r\n  $result = mysql_fetch_assoc($query);\r\n  $num_submissions = $result["c"];\r\n  mysql_query("UPDATE {$g_table_prefix}form_{$form_id} SET auto_increment = $num_submissions WHERE submission_id = $new_submission_id");\r\n}', 'na'),
(19, 'no', 'disabled', 'Updating auto-increment field (ft_delete_submission)', 'global $g_table_prefix;\r\nif ($form_id == 1) {\r\n  $query = mysql_query("SELECT submission_id FROM {$g_table_prefix}form_{$form_id} WHERE is_finalized = ''yes'' ORDER BY submission_id ASC");\r\n  $counter = 1;\r\n  while ($row = mysql_fetch_assoc($query)) {\r\n    mysql_query("UPDATE {$g_table_prefix}form_{$form_id} SET auto_increment = $counter WHERE submission_id={$row[''submission_id'']}");\r\n    $counter++;\r\n  }\r\n}', 'na'),
(21, 'no', 'disabled', ' Updating auto-increment field (ft_process_form)', 'global $g_table_prefix;\r\nif ($form_id == 1) {\r\n  $query = mysql_query("SELECT count(*) as c FROM {$g_table_prefix}form_{$form_id} WHERE is_finalized = ''yes''");\r\n  $result = mysql_fetch_assoc($query);\r\n  $num_submissions = $result["c"];\r\n  mysql_query("UPDATE {$g_table_prefix}form_{$form_id} SET auto_increment = $num_submissions WHERE submission_id = $submission_id");\r\n}', 'na');

-- --------------------------------------------------------

--
-- Table structure for table `ft_module_menu_items`
--

CREATE TABLE IF NOT EXISTS `ft_module_menu_items` (
  `menu_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `module_id` mediumint(8) unsigned NOT NULL,
  `display_text` varchar(100) NOT NULL,
  `url` varchar(255) NOT NULL,
  `is_submenu` enum('yes','no') NOT NULL DEFAULT 'no',
  `list_order` smallint(6) NOT NULL,
  PRIMARY KEY (`menu_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `ft_module_menu_items`
--

INSERT INTO `ft_module_menu_items` (`menu_id`, `module_id`, `display_text`, `url`, `is_submenu`, `list_order`) VALUES
(1, 1, 'Client Audit', '{$module_dir}/index.php', 'no', 1),
(2, 1, 'Help', '{$module_dir}/help.php', 'yes', 2),
(3, 2, 'Database Integrity', '{$module_dir}/index.php', 'no', 1),
(4, 2, 'Help', '{$module_dir}/help.php', 'no', 2),
(5, 3, 'Form Backup', 'index.php', 'no', 1),
(6, 3, 'Settings', 'settings.php', 'yes', 2),
(7, 3, 'Help', 'help.php', 'yes', 3),
(8, 4, 'Export Manager', '{$module_dir}/index.php', 'no', 1),
(9, 4, 'Settings', '{$module_dir}/settings.php', 'yes', 2),
(10, 4, 'Reset to Defaults', '{$module_dir}/reset.php', 'yes', 3),
(11, 4, 'Help', '{$module_dir}/help.php', 'yes', 4),
(12, 5, 'Hello Database!', 'index.php', 'no', 1),
(13, 5, 'Settings', 'settings.php', 'no', 2),
(14, 6, 'Hooks Manager', 'index.php', 'no', 1),
(15, 6, 'Settings', 'settings.php', 'no', 2),
(16, 6, 'Help', 'help.php', 'no', 3);

-- --------------------------------------------------------

--
-- Table structure for table `ft_multi_page_form_urls`
--

CREATE TABLE IF NOT EXISTS `ft_multi_page_form_urls` (
  `form_id` mediumint(8) unsigned NOT NULL,
  `form_url` varchar(255) NOT NULL,
  `page_num` tinyint(4) NOT NULL DEFAULT '2',
  PRIMARY KEY (`form_id`,`page_num`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ft_new_view_submission_defaults`
--

CREATE TABLE IF NOT EXISTS `ft_new_view_submission_defaults` (
  `view_id` mediumint(9) NOT NULL,
  `field_id` mediumint(9) NOT NULL,
  `default_value` text NOT NULL,
  `list_order` smallint(6) NOT NULL,
  PRIMARY KEY (`view_id`,`field_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ft_option_lists`
--

CREATE TABLE IF NOT EXISTS `ft_option_lists` (
  `list_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `option_list_name` varchar(100) NOT NULL,
  `is_grouped` enum('yes','no') NOT NULL,
  `original_form_id` mediumint(8) unsigned DEFAULT NULL,
  PRIMARY KEY (`list_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `ft_option_lists`
--

INSERT INTO `ft_option_lists` (`list_id`, `option_list_name`, `is_grouped`, `original_form_id`) VALUES
(1, 'New Option List', 'no', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ft_public_form_omit_list`
--

CREATE TABLE IF NOT EXISTS `ft_public_form_omit_list` (
  `form_id` mediumint(8) unsigned NOT NULL,
  `account_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`form_id`,`account_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ft_public_view_omit_list`
--

CREATE TABLE IF NOT EXISTS `ft_public_view_omit_list` (
  `view_id` mediumint(8) unsigned NOT NULL,
  `account_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`view_id`,`account_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ft_sessions`
--

CREATE TABLE IF NOT EXISTS `ft_sessions` (
  `session_id` varchar(100) NOT NULL DEFAULT '',
  `session_data` text NOT NULL,
  `expires` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ft_settings`
--

CREATE TABLE IF NOT EXISTS `ft_settings` (
  `setting_id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `setting_name` varchar(100) NOT NULL,
  `setting_value` text NOT NULL,
  `module` varchar(100) NOT NULL DEFAULT 'core',
  PRIMARY KEY (`setting_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=57 ;

--
-- Dumping data for table `ft_settings`
--

INSERT INTO `ft_settings` (`setting_id`, `setting_name`, `setting_value`, `module`) VALUES
(1, 'program_version', '2.2.5', 'core'),
(2, 'release_date', '20120503', 'core'),
(3, 'release_type', 'main', 'core'),
(4, 'api_version', '1.1.4', 'core'),
(5, 'available_languages', 'en_us,English (US)', 'core'),
(6, 'clients_may_edit_date_format', 'no', 'core'),
(7, 'clients_may_edit_footer_text', 'no', 'core'),
(8, 'clients_may_edit_logout_url', 'yes', 'core'),
(9, 'clients_may_edit_max_failed_login_attempts', 'no', 'core'),
(10, 'clients_may_edit_page_titles', 'no', 'core'),
(11, 'clients_may_edit_sessions_timeout', 'no', 'core'),
(12, 'clients_may_edit_theme', 'yes', 'core'),
(13, 'clients_may_edit_timezone_offset', 'yes', 'core'),
(14, 'clients_may_edit_ui_language', 'yes', 'core'),
(15, 'default_client_menu_id', '2', 'core'),
(16, 'default_date_field_search_value', 'none', 'core'),
(17, 'default_date_format', 'M jS y, g:i A', 'core'),
(18, 'default_footer_text', '', 'core'),
(19, 'default_language', 'en_us', 'core'),
(20, 'default_login_page', 'client_forms', 'core'),
(21, 'default_logout_url', 'http://tedxuw.culturecraft.cc', 'core'),
(22, 'default_max_failed_login_attempts', '', 'core'),
(23, 'default_num_submissions_per_page', '10', 'core'),
(24, 'default_page_titles', 'Form Tools - {$page}', 'core'),
(25, 'default_sessions_timeout', '30', 'core'),
(26, 'default_theme', 'default', 'core'),
(27, 'default_timezone_offset', '0', 'core'),
(28, 'edit_submission_shared_resources_js', '$(function() {\r\n  $(".fancybox").fancybox();\r\n});\r\n', 'core'),
(29, 'edit_submission_shared_resources_css', '/* used in the "Highlight" setting for most field types */\r\n.cf_colour_red { \r\n  background-color: #990000;\r\n  color: white;\r\n}\r\n.cf_colour_orange {\r\n  background-color: orange; \r\n}\r\n.cf_colour_yellow {\r\n  background-color: yellow; \r\n}\r\n.cf_colour_green {\r\n  background-color: green;\r\n  color: white; \r\n}\r\n.cf_colour_blue {\r\n  background-color: #336699; \r\n  color: white; \r\n}\r\n\r\n/* field comments */\r\n.cf_field_comments {\r\n  font-style: italic;\r\n  color: #999999;\r\n  clear: both;\r\n}\r\n\r\n/* column layouts for radios & checkboxes */\r\n.cf_option_list_group_label {\r\n  font-weight: bold;  \r\n  clear: both;\r\n  margin-left: 4px;\r\n}\r\n.cf_option_list_2cols, .cf_option_list_3cols, .cf_option_list_4cols {\r\n  clear: both; \r\n}\r\n.cf_option_list_2cols .column { \r\n  width: 50%;\r\n  float: left; \r\n}\r\n.cf_option_list_3cols .column { \r\n  width: 33%;\r\n  float: left;\r\n}\r\n.cf_option_list_4cols .column { \r\n  width: 25%;\r\n  float: left;\r\n}\r\n\r\n/* Used for the date and time pickers */\r\n.cf_date_group img {\r\n  margin-bottom: -4px;\r\n  padding: 1px;\r\n}\r\n\r\n', 'core'),
(30, 'edit_submission_onload_resources', '<script src="{$g_root_url}/global/codemirror/js/codemirror.js"></script>|<script src="{$g_root_url}/global/scripts/jquery-ui-timepicker-addon.js"></script>|<script src="{$g_root_url}/global/fancybox/jquery.fancybox-1.3.4.pack.js"></script> |<link rel="stylesheet" href="{$g_root_url}/global/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />', 'core'),
(31, 'field_type_settings_shared_characteristics', 'field_comments:textbox,comments`textarea,comments`password,comments`dropdown,comments`multi_select_dropdown,comments`radio_buttons,comments`checkboxes,comments`date,comments`time,comments`phone,comments`code_markup,comments`file,comments`google_maps_field,comments`tinymce,comments|data_source:dropdown,contents`multi_select_dropdown,contents`radio_buttons,contents`checkboxes,contents|column_formatting:checkboxes,formatting`radio_buttons,formatting|maxlength_attr:textbox,maxlength|colour_highlight:textbox,highlight|folder_path:file,folder_path|folder_url:file,folder_url|permitted_file_types:file,folder_url|max_file_size:file,max_file_size|date_display_format:date,display_format|apply_timezone_offset:date,apply_timezone_offset', 'core'),
(32, 'file_upload_dir', '/home/hous9135/public_html/indigodesign.me/game/current/formtools/upload', 'core'),
(33, 'file_upload_filetypes', 'bmp,gif,jpg,jpeg,png,avi,mp3,mp4,doc,txt,pdf,xml,csv,swf,fla,xls,tif', 'core'),
(34, 'file_upload_url', 'http://www.indigodesign.me/game/current/formtools/upload', 'core'),
(35, 'file_upload_max_size', '200', 'core'),
(36, 'forms_page_default_message', '{$LANG.text_client_welcome}', 'core'),
(37, 'logo_link', 'http://www.formtools.org', 'core'),
(38, 'min_password_length', '', 'core'),
(39, 'num_clients_per_page', '10', 'core'),
(40, 'num_emails_per_page', '10', 'core'),
(41, 'num_forms_per_page', '10', 'core'),
(42, 'num_menus_per_page', '10', 'core'),
(43, 'num_modules_per_page', '10', 'core'),
(44, 'num_option_lists_per_page', '10', 'core'),
(45, 'num_password_history', '', 'core'),
(46, 'program_name', 'Form Tools', 'core'),
(47, 'required_password_chars', '', 'core'),
(48, 'timezone_offset', '0', 'core'),
(52, 'file_upload_url', 'http://www.indigodesign.me/game/current/formtools/upload', 'export_manager'),
(51, 'file_upload_dir', '/home/hous9135/public_html/indigodesign.me/game/current/formtools/upload', 'export_manager'),
(53, 'show_backup_form_button', 'yes', 'form_backup'),
(54, 'num_rules_per_page', '10', 'hooks_manager'),
(55, 'default_client_swatch', 'green', 'core'),
(56, 'core_version_upgrade_track', 'unknown,2.2.5-main-20120503', 'core');

-- --------------------------------------------------------

--
-- Table structure for table `ft_themes`
--

CREATE TABLE IF NOT EXISTS `ft_themes` (
  `theme_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `theme_folder` varchar(100) NOT NULL,
  `theme_name` varchar(50) NOT NULL,
  `uses_swatches` enum('yes','no') NOT NULL DEFAULT 'no',
  `swatches` mediumtext,
  `author` varchar(200) DEFAULT NULL,
  `author_email` varchar(255) DEFAULT NULL,
  `author_link` varchar(255) DEFAULT NULL,
  `theme_link` varchar(255) DEFAULT NULL,
  `description` mediumtext,
  `is_enabled` enum('yes','no') NOT NULL DEFAULT 'yes',
  `theme_version` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`theme_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `ft_themes`
--

INSERT INTO `ft_themes` (`theme_id`, `theme_folder`, `theme_name`, `uses_swatches`, `swatches`, `author`, `author_email`, `author_link`, `theme_link`, `description`, `is_enabled`, `theme_version`) VALUES
(1, 'classicgrey', 'Classic Grey', 'no', '', 'Encore Web Studios', NULL, NULL, 'http://themes.formtools.org/classicgrey/', 'A remodelling of the old grey-styled Form Tools 1.x theme.', 'yes', '1.1.3'),
(2, 'default', 'Default', 'yes', 'red,{$LANG.word_red}|orange,{$LANG.word_orange}|yellow,{$LANG.word_yellow}|green,{$LANG.word_green}|aquamarine,{$LANG.word_aquamarine}|blue,{$LANG.word_blue}|dark_blue,{$LANG.phrase_dark_blue}|purple,{$LANG.word_purple}|grey,{$LANG.word_grey}|light_brown,{$LANG.phrase_light_brown}', 'Benjamin Keen', NULL, NULL, 'http://themes.formtools.org', 'The default Form Tools theme. It''s a fixed-width theme requiring 1024 minimum width screens, with a few different colour swatches to choose from.', 'yes', '1.0.0');

-- --------------------------------------------------------

--
-- Table structure for table `ft_views`
--

CREATE TABLE IF NOT EXISTS `ft_views` (
  `view_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `form_id` mediumint(8) unsigned NOT NULL,
  `access_type` enum('admin','public','private','hidden') NOT NULL DEFAULT 'public',
  `view_name` varchar(100) NOT NULL,
  `view_order` smallint(6) NOT NULL DEFAULT '1',
  `is_new_sort_group` enum('yes','no') NOT NULL,
  `group_id` smallint(6) DEFAULT NULL,
  `num_submissions_per_page` smallint(6) NOT NULL DEFAULT '10',
  `default_sort_field` varchar(255) NOT NULL DEFAULT 'submission_date',
  `default_sort_field_order` enum('asc','desc') NOT NULL DEFAULT 'desc',
  `may_add_submissions` enum('yes','no') NOT NULL DEFAULT 'yes',
  `may_edit_submissions` enum('yes','no') NOT NULL DEFAULT 'yes',
  `may_delete_submissions` enum('yes','no') NOT NULL DEFAULT 'yes',
  `has_client_map_filter` enum('yes','no') NOT NULL DEFAULT 'no',
  `has_standard_filter` enum('yes','no') NOT NULL DEFAULT 'no',
  PRIMARY KEY (`view_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `ft_views`
--

INSERT INTO `ft_views` (`view_id`, `form_id`, `access_type`, `view_name`, `view_order`, `is_new_sort_group`, `group_id`, `num_submissions_per_page`, `default_sort_field`, `default_sort_field_order`, `may_add_submissions`, `may_edit_submissions`, `may_delete_submissions`, `has_client_map_filter`, `has_standard_filter`) VALUES
(1, 1, 'public', 'All submissions', 1, 'yes', 3, 10, 'submission_date', 'desc', 'yes', 'yes', 'yes', 'no', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `ft_view_columns`
--

CREATE TABLE IF NOT EXISTS `ft_view_columns` (
  `view_id` mediumint(9) NOT NULL,
  `field_id` mediumint(9) NOT NULL,
  `list_order` smallint(6) NOT NULL,
  `is_sortable` enum('yes','no') NOT NULL,
  `auto_size` enum('yes','no') NOT NULL DEFAULT 'yes',
  `custom_width` varchar(10) DEFAULT NULL,
  `truncate` enum('truncate','no_truncate') NOT NULL DEFAULT 'truncate',
  PRIMARY KEY (`view_id`,`field_id`,`list_order`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ft_view_columns`
--

INSERT INTO `ft_view_columns` (`view_id`, `field_id`, `list_order`, `is_sortable`, `auto_size`, `custom_width`, `truncate`) VALUES
(1, 18, 1, 'yes', 'no', '160', 'truncate'),
(1, 19, 2, 'yes', 'yes', '', 'truncate'),
(1, 2, 3, 'yes', 'yes', '', 'truncate'),
(1, 11, 4, 'yes', 'yes', '', 'truncate');

-- --------------------------------------------------------

--
-- Table structure for table `ft_view_fields`
--

CREATE TABLE IF NOT EXISTS `ft_view_fields` (
  `view_id` mediumint(8) unsigned NOT NULL,
  `field_id` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(9) DEFAULT NULL,
  `is_editable` enum('yes','no') NOT NULL DEFAULT 'yes',
  `is_searchable` enum('yes','no') NOT NULL DEFAULT 'yes',
  `list_order` smallint(5) unsigned DEFAULT NULL,
  `is_new_sort_group` enum('yes','no') NOT NULL,
  PRIMARY KEY (`view_id`,`field_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ft_view_fields`
--

INSERT INTO `ft_view_fields` (`view_id`, `field_id`, `group_id`, `is_editable`, `is_searchable`, `list_order`, `is_new_sort_group`) VALUES
(1, 14, 4, 'no', 'yes', 17, 'yes'),
(1, 13, 4, 'no', 'yes', 16, 'yes'),
(1, 12, 4, 'no', 'yes', 15, 'yes'),
(1, 11, 4, 'yes', 'yes', 14, 'yes'),
(1, 10, 4, 'yes', 'yes', 13, 'yes'),
(1, 9, 4, 'yes', 'yes', 12, 'yes'),
(1, 8, 4, 'yes', 'yes', 11, 'yes'),
(1, 7, 4, 'yes', 'yes', 10, 'yes'),
(1, 6, 4, 'yes', 'yes', 9, 'yes'),
(1, 5, 4, 'yes', 'yes', 8, 'yes'),
(1, 4, 4, 'yes', 'yes', 7, 'yes'),
(1, 3, 4, 'yes', 'yes', 6, 'yes'),
(1, 2, 4, 'yes', 'yes', 5, 'yes'),
(1, 19, 4, 'yes', 'yes', 4, 'yes'),
(1, 18, 4, 'yes', 'yes', 3, 'yes'),
(1, 17, 4, 'yes', 'yes', 2, 'yes'),
(1, 1, 4, 'no', 'yes', 1, 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `ft_view_filters`
--

CREATE TABLE IF NOT EXISTS `ft_view_filters` (
  `filter_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `view_id` mediumint(8) unsigned NOT NULL,
  `filter_type` enum('standard','client_map') NOT NULL DEFAULT 'standard',
  `field_id` mediumint(8) unsigned NOT NULL,
  `operator` enum('equals','not_equals','like','not_like','before','after') NOT NULL DEFAULT 'equals',
  `filter_values` mediumtext NOT NULL,
  `filter_sql` mediumtext NOT NULL,
  PRIMARY KEY (`filter_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ft_view_tabs`
--

CREATE TABLE IF NOT EXISTS `ft_view_tabs` (
  `view_id` mediumint(8) unsigned NOT NULL,
  `tab_number` tinyint(3) unsigned NOT NULL,
  `tab_label` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`view_id`,`tab_number`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ft_view_tabs`
--

INSERT INTO `ft_view_tabs` (`view_id`, `tab_number`, `tab_label`) VALUES
(1, 1, 'Data'),
(1, 2, ''),
(1, 3, ''),
(1, 4, ''),
(1, 5, ''),
(1, 6, '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
