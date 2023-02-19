<?php 

if (PHP_MAJOR_VERSION < 8) {
  die('Need PHP version 8+ on server. Your version is ' . PHP_MAJOR_VERSION);
}

require_once dirname(__DIR__). '/config/init.php';

new \amp\App();
?>
