<?php

namespace Controllers;

abstract class BaseController
{
    public static function sendResponseJSON(array $data): void
    {
        header('Content-Type: application/json');
        echo json_encode($data);
    }
}