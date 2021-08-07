<?php

namespace MySQL;

class Query
{
    public $conn;
    public $db;

    public function __construct()
    {
        $this->conn = new Connection();
        $this->db = $this->conn->db;
    }

    public function qq(string $sql)
    {
        return $this->db->query($sql)->fetch_all();
    }
}