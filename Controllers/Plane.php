<?php

namespace Controllers;

use Models\Plane as ModelsPlane;
use Views\Plane as PlaneView;

class Plane
{
    public static function GET_planeInfo()
    {
        var_dump(ModelsPlane::getPlanes());
        $t = new PlaneView([
            'template' => 'planes',
            'test' => 'testtest'
        ]);
        echo $t->render();
    }

    public static function POST_fly()
    {
        sleep(5);
        header('Content-Type: application/json');
        echo json_encode(['response' => true]);
    }
}