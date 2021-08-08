<?php

namespace Views;

use Models\Plane as ModelsPlane;

class Plane extends View
{
    public $template;
    public $test;

    public function get_planes()
    {
        return ModelsPlane::getPlanes();
    }

    public function get_history($id)
    {
        return ModelsPlane::getHistory($id);
    }
}