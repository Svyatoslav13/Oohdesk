<?php

namespace MySQL;

class Connection
{
    private const HOST = 'localhost';
    private const DEFAULT_DB = 'oohdesk';
    private const PORT = 3306;
    private const USER = 'root';
    private const PASSWORD = '21112864';

    public $db;

    public function __construct()
    {
        if (!isset($this->db))
        $this->db = new \mysqli(self::HOST, self::USER, self::PASSWORD, self::DEFAULT_DB, self::PORT);
    }

    public function getDB(): \mysqli
    {
        return $this->db;
    }

    public function q(string $sql): array
    {
        $result = [];
        $query = $this->getDB()->query($sql);
        if ($query instanceof \mysqli_result) {
            while ($row = $query->fetch_array()) {
                $result[] = $row;
            }
            $query->free();
        }
        return $result;
    }
}