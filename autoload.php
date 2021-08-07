<?php
spl_autoload_register(function ($class) {
    $class_name = str_replace('\\', '/', $class);
    require_once __DIR__ . '/' . $class_name . '.php';
});


