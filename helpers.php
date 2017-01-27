<?php

function config($key, $default = null) {
    $config = require_once(__DIR__."config.php");
    if(array_key_exists($key, $config)) {
       return $config[$key];
    }
    return $default;
}