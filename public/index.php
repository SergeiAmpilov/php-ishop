<?php 

if (PHP_MAJOR_VERSION < 8) {
  die('Need PHP version 8+ on server. Your version is ' . PHP_MAJOR_VERSION);
}

require_once dirname(__DIR__). '/config/init.php';

new \amp\App();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <h1>Hello world</h1> 
</body>
</html>


<style>
    body {
        background-color: #404040;
        color: wheat;
    }
</style>