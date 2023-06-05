<?php

namespace Model;

use Controller\Exception\FileNotFoundException;

class Database
{
    private const DB_FILE = __DIR__ . "/../config/settings.ini";

    private $db;

    private $options = [
        \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
        \PDO::ATTR_EMULATE_PREPARES => false,
        \PDO::ATTR_PERSISTENT => true
    ];

    public function __construct()
    {
        if (!$settings = parse_ini_file(self::DB_FILE)) {
            throw new FileNotFoundException("Impossible d'ouvrir " . self::DB_FILE . ' -> fichier introuvable !');
        }

        try {
            $dsn = 'mysql:host=' . $settings['hostname'] . ';dbname=' . $settings['schema'];
            $this->db = new \PDO($dsn, $settings['username'], $settings['passwd'], $this->options);
        } catch (\PDOException $exception) {
            echo 'Impossible de se connecter à la base de donnée -> ' . $exception->getMessage();
        }
    }

    public function getConnection()
    {
        return $this->db;
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
