<?php

namespace Models;

use MySQL\Connection;

class Plane
{
    public static function getPlanes()
    {
        $db = new Connection();

        return $db->q("
            SELECT planes.id
                 , planes.name
                 , states.state AS status
              FROM planes_states AS ps
             INNER JOIN planes
                ON planes.id = ps.plane_id
             INNER JOIN states
                ON states.id = ps.state_id");
    }
}