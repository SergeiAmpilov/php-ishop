<?php

define('DEBUG', true);              /* show or hide errors. set false for production */
define('ROOT', dirname(__DIR__));   /* main folder of application */
define('WWW', ROOT . '/public');    /* path to main puvlic folder */
define('APP', ROOT . '/app');
define('CORE', ROOT . '/vendor/amp');
define('HELPERS', ROOT . '/vendor/amp/helpers');
define('CASHE', ROOT . '/tmp/cache');
define('LOGS', ROOT . '/tmp/logs');
define('CONFIG', ROOT . '/config');
define('LAYOUT', 'ishop');          /* main site template */
define('PATH', 'http://php-ishop.loc'); /* main www link of application */
define('ADMIN', 'http://php-ishop.loc/admin');
define('NO_IMAGE', 'uploads/no-image.jpg'); /* default image */

require_once(ROOT . '/vendor/autoload.php');
require_once(HELPERS . '/functions.php');
require_once(CONFIG . '/routes.php');