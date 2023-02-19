<?php

function debug($data, bool $die = false)
{
    echo "<pre>" . print_r($data,true) . "</pre>";

    if ($die) {
        die;
    }
}

function h(string $str): string
{
    return htmlspecialchars($str);
}
?>