<?php

namespace Controllers;

use MySQL\Connection;
use Views\Plane as PlaneView;
use Models\Plane as ModelsPlane;

class Plane extends BaseController
{
    public static function POST_fly()
    {

        $db = new Connection();
        $id = intval($_POST['id']);

        $state_id = $db->q("
            SELECT states.id
              FROM planes_states AS ps
             INNER JOIN states
                ON ps.state_id = states.id
             WHERE ps.plane_id = {$id}
        ")[0]['id'];

        if ($state_id == 1) {
            if (session_status() !== PHP_SESSION_ACTIVE) {
                session_start();
            }
            // var_dump($_SESSION);
            // TODO SQL inject protection
            // TODO relocate SQL in save procedures
            $db->q("UPDATE planes_states SET state_id = 2 WHERE plane_id = " . $id);
            if (!isset($_SESSION['fly'])) {
                $_SESSION['fly'] = true;
    
                $db->q("UPDATE planes_states SET state_id = 3 WHERE plane_id = " . $id);
                sleep(10);
                $db->q("UPDATE planes_states SET state_id = 4 WHERE plane_id = " . $id);
                unset($_SESSION['fly']);
    
            } else {
                // self::sendResponseJSON(['error' => true]);
            }
            $state = $db->q("
                SELECT states.state
                  FROM planes_states AS ps
                 INNER JOIN states
                    ON ps.state_id = states.id
                 WHERE ps.plane_id = {$id}
            ")[0]['state'];
            self::sendResponseJSON(['state' => $state]);
        } else {
            self::sendResponseJSON(['state' => 'Уже взлетел']);
        }

    }

    public static function GET_history()
    {
        $id = $_GET['id'];

        $history = ModelsPlane::getHistory($id);
        self::sendResponseJSON($history);
    }
}