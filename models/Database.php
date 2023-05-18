<?php

namespace Model;

use PDOException;

class Database
{
    const HOSTNAME = '127.0.0.1';
    const DB_NAME = 'Gestion_Note';
    const USERNAME = 'mar';
    const PASSWORD = '#Coding221';

    private $db;
    private $options = [
        \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
        \PDO::ATTR_EMULATE_PREPARES => false
    ];

    public function __construct()
    {
        try {
            $dsn = 'mysql:host=' . self::HOSTNAME . ';dbname=' . self::DB_NAME;
            $this->db = new \PDO($dsn, self::USERNAME, self::PASSWORD, $this->options);
        } catch (PDOException $exception) {
            echo 'Impossible de se connecter à la base de donnée -> ' . $exception->getMessage();
        }
    }

    public function request(string $request, $data = [])
    {
        $requestPrepared = $this->db->prepare($request);

        for ($i = 0; $i < count($data); $i++) {
            $requestPrepared->bindValue($i + 1, $data[$i]);
        }

        if ($requestPrepared->execute()) {
            return $requestPrepared->fetchAll(\PDO::FETCH_OBJ);
        }

        return [];
    }

    public static function getInstance()
    {
        return new Database();
    }
}
