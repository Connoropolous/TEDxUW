<?php

/**
 * Smarty plugin
 * -------------------------------------------------------------
 * File:     function.smart_display_field
 * Type:     function
 * Name:     smart_display_field
 * Purpose:  This function functionally does the same as the Core dispay_custom_field Smarty function,
 *           except that it's designed to display the field values in bulk. To speed things up, it caches
 *           as much info as it can, to reduce DB queries etc.
 * -------------------------------------------------------------
 */
function smarty_function_smart_display_field($params, &$smarty)
{
	$value = ft_generate_viewable_field($params);

	// additional code for CSV encoding
  if (isset($params["escape"]))
  {
    if ($params["escape"] == "csv")
    {
      $value = preg_replace("/\"/", "\"\"", $value);
      if (strstr($value, ","))
        $value = "\"$value\"";
    }
    if ($params["escape"] == "excel")
    {
      $value = preg_replace("/(\n\r|\n)/", "<br style=\"mso-data-placement:same-cell;\" />", $value);
    }
  }

  echo $value;
}
