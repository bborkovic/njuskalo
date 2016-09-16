<?php 

# Enable Error reporting
error_reporting(E_ALL ^ E_DEPRECATED);
// error_reporting(E_ALL);
ini_set('display_errors', 1);

// TimeZone
date_default_timezone_set('Europe/Zagreb');

defined('DS') ? null : define('DS' , DIRECTORY_SEPARATOR);
// defined('SITE_ROOT') ? null : define('SITE_ROOT', '/var/www/html/photo_gallery');
defined('SITE_ROOT') ? null : define('SITE_ROOT', '/var/www/html/njuskalo');
// defined('SITE_ROOT') ? null : define('SITE_ROOT', '/Library/WebServer/Documents/njuskalo');

defined('LIB_PATH') ? null : define('LIB_PATH', SITE_ROOT.DS.'includes');

// first load config 
require_once(LIB_PATH.DS."config.php");
require_once(LIB_PATH.DS."functions.php");
require_once(LIB_PATH.DS."error.php");
require_once(LIB_PATH.DS."session.php");
require_once(LIB_PATH.DS."pagination.php");

// database class
require_once(LIB_PATH.DS."database.php");
require_once(LIB_PATH.DS."database_object.php");


// all database related classes
require_once(LIB_PATH.DS."user.php");
require_once(LIB_PATH.DS."category.php");
require_once(LIB_PATH.DS."common_field.php");
require_once(LIB_PATH.DS."category_common_field.php");
require_once(LIB_PATH.DS."ad_common_field.php");
require_once(LIB_PATH.DS."photograph.php");
require_once(LIB_PATH.DS."item.php");

?>
