<?php


/**
 * Helper function to return a list of files that are missing from the Core.
 *
 * @return array
 */
function sc_check_core_files()
{
  global $g_root_dir;

  if (!is_file("$g_root_dir/global/misc/config_core.php"))
    return array();

  require("$g_root_dir/global/misc/config_core.php");

  if (!isset($FILES))
    continue;

  $missing_files = array();
  foreach ($FILES as $file)
  {
  	// ignore the install/ folder folder + files
  	if (preg_match("/^install/", $file))
  	  continue;

  	if (!is_file("$g_root_dir/$file") && !is_dir("$g_root_dir/$file"))
  	  $missing_files[] = $file;
  }

  return $missing_files;
}


/**
 * Helper function to look at all installed themes and see which are compatible with the File Verification
 * test (i.e. which have a theme_config.php file defined in the root).
 */
function sc_get_compatible_themes()
{
  global $g_root_dir;

  $theme_list = ft_get_themes();

  $compatible_themes = array();
  foreach ($theme_list as $theme_info)
  {
    $theme_folder = $theme_info["theme_folder"];

    if (is_file("$g_root_dir/themes/$theme_folder/theme_config.php"))
      $compatible_themes[] = $theme_info;
  }

  return $compatible_themes;
}



function sc_check_module_files($module_folder)
{
  global $g_root_dir;

  $file = "$g_root_dir/modules/$module_folder/module_config.php";
  if (!is_file($file))
    return array();

  require($file);

  if (!isset($FILES))
    continue;

  $missing_files = array();
  $root = "modules/$module_folder";
  foreach ($FILES as $file)
  {
  	if (!is_file("$g_root_dir/$root/$file") && !is_dir("$g_root_dir/$root/$file"))
  	  $missing_files[] = "$root/$file";
  }

  return $missing_files;
}


function sc_check_theme_files($theme_folder)
{
  global $g_root_dir;

  $file = "$g_root_dir/themes/$theme_folder/theme_config.php";
  if (!is_file($file))
    return array();

  require($file);

  if (!isset($FILES))
    continue;

  $missing_files = array();
  $root = "themes/$theme_folder";
  foreach ($FILES as $file)
  {
  	if (!is_file("$g_root_dir/$root/$file") && !is_dir("$g_root_dir/$root/$file"))
  	  $missing_files[] = "$root/$file";
  }

  return $missing_files;
}
