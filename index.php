<?php

use MySQL\Connection;
use Views\SchedulePlanes;

require_once  __DIR__ . '/autoload.php';
    $conn = new Connection();
    $conn->db->query('INSERT INTO planes');
    var_dump($conn->db->query("SELECT * FROM planes")->fetch_row());

    // $test = new SchedulePlanes(['template' => 'schedule']);

    // var_dump($test->getTemplate());
?>

