<?php
// directory for include autoload
$dir = explode('/', __DIR__);
array_pop($dir);
$new_dir = implode('/', $dir);

require_once $new_dir . '/' . 'autoload.php';

$http_method = $_SERVER['REQUEST_METHOD'];

$uri = $_SERVER['REQUEST_URI'];
$uri_parts = explode('/', $uri);

$class = $uri_parts[3];
$method = $uri_parts[4];

try {
    $refClass = new ReflectionClass('Controllers\\' . $class);
    $refMethod = $http_method . '_' . $method;

    if ($refClass->hasMethod($refMethod)) {
        $refClass->getMethod($refMethod)->invoke(null);
    } else {
        throw new Exception('Method ' . $refMethod . ' does not exists in class ' . $refClass->getName());
    }
} catch (Throwable $ex) {
    var_dump($ex->getMessage());
}