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

    public static function getHistory(int $id): array
    {
        $db = new Connection();

        return $db->q('SELECT from_unixtime(history.time) AS time
                            , states.state
                         FROM history
                        INNER JOIN states
                           ON states.id = history.state_id
                        WHERE plane_id = ' . $id
        );
    }
}