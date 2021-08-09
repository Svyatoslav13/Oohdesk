<?php

use Views\Plane AS PlaneView;

require_once  __DIR__ . '/autoload.php';

$t = new PlaneView([
    'template' => 'planes'
]);
echo $t->render();

?>

