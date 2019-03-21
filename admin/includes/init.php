<?php
/* 
 * Initialization file
 */



defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
define('SITE_ROOT',  DS . 'var' . DS . 'www' . DS . 'html' . DS . 'CMS');

defined('INCLUDES_PATH') ? null : define('INCLUDES_PATH', SITE_ROOT . DS . 'admin' . DS . 'includes');

require_once(INCLUDES_PATH.DS."functions.php");
require_once(INCLUDES_PATH.DS."new_config.php");
require_once(INCLUDES_PATH.DS."database.php");
require_once(INCLUDES_PATH.DS."db_object.php");
require_once(INCLUDES_PATH.DS."photo.php");
require_once(INCLUDES_PATH.DS."user.php");
require_once(INCLUDES_PATH.DS."session.php");
require_once(INCLUDES_PATH.DS."comment.php");
require_once(INCLUDES_PATH.DS."pagination.php");
require_once(INCLUDES_PATH.DS."counter.php");


?>