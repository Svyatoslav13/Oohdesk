<?php

namespace MySQL;

class Connection
{
    private const HOST = 'localhost';
    private const DEFAULT_DB = 'oohdesk';
    private const PORT = 3306;
    private const USER = 'user';
    private const PASSWORD = 'password';

    public $db;

    public function __construct()
    {
        $this->db = new \mysqli(self::HOST, self::USER, self::PASSWORD, self::DEFAULT_DB, self::PORT);
    }

    public function getDB()
    {

    }
}