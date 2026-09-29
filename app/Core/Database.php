<?php

class Database
{
    private $host;
    private $dbname;
    private $username;
    private $password;
    private $charset;

    private $pdo;

    public function __construct()
    {
        $config = require ROOT_PATH . '/config/database.php';

        $this->host = $config['host'];
        $this->dbname = $config['dbname'];
        $this->username = $config['username'];
        $this->password = $config['password'];
        $this->charset = $config['charset'];

        $this->connect();
    }

    private function connect()
    {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->dbname};charset={$this->charset}";

            $this->pdo = new PDO(
                $dsn,
                $this->username,
                $this->password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
            );

        } catch (PDOException $e) {
            die("Database gagal terhubung: " . $e->getMessage());
        }
    }

    public function getConnection()
    {
        return $this->pdo;
    }
}