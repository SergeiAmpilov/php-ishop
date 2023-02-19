<?php
/**
 * @var $errno \amp\ErrorHandler
 * @var $errstr \amp\ErrorHandler
 * @var $errfile \amp\ErrorHandler
 * @var $errline \amp\ErrorHandler
 * @var $responseCode \amp\ErrorHandler
  * */
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ошибка</title>
</head>
<body>
    <h1>Произошла ошибка</h1>
    <p>Code: <?= $errno ?></p>
    <p>Text: <?= $errstr ?></p>
    <p>File: <?= $errfile ?></p>
    <p>Line: <?= $errline ?></p>
    <p>Resp Code: <?= $responseCode ?></p>
</body>
</html>

<style>
    body {
        background-color: #404040;
        color: rosybrown;
    }
</style>