<?php

namespace Models;

use MySQL\Connection;

class Plane
{
    public static function getPlanes()
    {
        $conn = new Connection();

        return $conn->db->query("
            SELECT *
              FROM planes_states AS ps
             INNER JOIN planes
                ON planes.id = ps.plane_id
             INNER JOIN states
                ON states.id = ps.state_id")->fetch_all();
    }
}