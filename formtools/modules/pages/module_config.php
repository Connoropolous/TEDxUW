<?php

$STRUCTURE = array();
$STRUCTURE["tables"] = array();
$STRUCTURE["tables"]["module_pages"] = array(
  array(
    "Field"   => "page_id",
    "Type"    => "mediumint(8) unsigned",
    "Null"    => "NO",
    "Key"     => "PRI",
    "Default" => ""
  ),
  array(
    "Field"   => "page_name",
    "Type"    => "varchar(50)",
    "Null"    => "NO",
    "Key"     => "",
    "Default" => ""
  ),
  array(
    "Field"   => "access_type",
    "Type"    => "enum('admin','public','private')",
    "Null"    => "NO",
    "Key"     => "",
    "Default" => "admin"
  ),
  array(
    "Field"   => "content_type",
    "Type"    => "enum('html','php','smarty')",
    "Null"    => "NO",
    "Key"     => "",
    "Default" => "html"
  ),
  array(
    "Field"   => "use_wysiwyg",
    "Type"    => "enum('yes','no')",
    "Null"    => "NO",
    "Key"     => "",
    "Default" => "yes"
  ),
  array(
    "Field"   => "heading",
    "Type"    => "varchar(255)",
    "Null"    => "YES",
    "Key"     => "",
    "Default" => ""
  ),
  array(
    "Field"   => "content",
    "Type"    => "text",
    "Null"    => "YES",
    "Key"     => "",
    "Default" => ""
  )
);

$STRUCTURE["tables"]["module_pages_clients"] = array(
  array(
    "Field"   => "page_id",
    "Type"    => "mediumint(9) unsigned",
    "Null"    => "NO",
    "Key"     => "PRI",
    "Default" => ""
  ),
  array(
    "Field"   => "client_id",
    "Type"    => "mediumint(9) unsigned",
    "Null"    => "NO",
    "Key"     => "PRI",
    "Default" => ""
  )
);

$HOOKS = array();

$FILES = array(
  "add.php",
  "database_integrity.php",
  "edit.php",
  "help.php",
  "images/",
  "images/icon_pages.gif",
  "index.php",
  "lang/",
  "lang/en_us.php",
  "library.php",
  "module.php",
  "module_config.php",
  "page.php",
  "scripts/",
  "scripts/pages.js",
  "settings.php",
  "templates/",
  "templates/add.tpl",
  "templates/edit.tpl",
  "templates/help.tpl",
  "templates/index.tpl",
  "templates/page.tpl",
  "templates/settings.tpl",
  "templates/view.tpl",
  "view.php"
);