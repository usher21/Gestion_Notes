<?php

namespace Model;

use Model\Database;

class Level
{
    private \PDO $db;

    public function __construct()
    {
        $database = new Database;
        $this->db = $database->getConnection();
    }

    public function list()
    {
        $request = "SELECT
                        Level.id as id_level,
                        Level.label as level_name
                    FROM
                        Level, SchoolYear_Level
                    WHERE SchoolYear_Level.id_level = Level.id AND
                    SchoolYear_Level.id_school_year = (SELECT id FROM SchoolYear WHERE status = 1 LIMIT 1)
                    ORDER BY Level.id ASC";

        $requestPrepared = $this->db->prepare($request);

        if ($requestPrepared->execute()) {
            return $requestPrepared->fetchAll(\PDO::FETCH_OBJ);
        }

        return [];
    }

    public function insert($label)
    {
        $this->db->beginTransaction();
        try {
            $request = "INSERT INTO Level (label) VALUES(?)";
            $requestPrepared = $this->db->prepare($request);
            $requestPrepared->bindValue(1, $label);
            $requestPrepared->execute();

            $request = "INSERT INTO
                            SchoolYear_Level(id_school_year, id_level)
                            VALUES
                                (
                                    (
                                        SELECT id
                                        FROM
                                            SchoolYear
                                        WHERE
                                            status = 1 LIMIT 1
                                    ),
                                    LAST_INSERT_ID()
                                )";
            $requestPrepared = $this->db->prepare($request);
            $requestPrepared->execute();
            $this->db->commit();
            return true;
        } catch (\PDOException $exception) {
            echo 'Erreur: ' . $exception->getMessage();
            $this->db->rollBack();
            return false;
        }
    }

    public function lastInsertId()
    {
        $request = "SELECT id FROM Level WHERE id = LAST_INSERT_ID()";
        $requestPrepared = $this->db->prepare($request);

        if ($requestPrepared->execute()) {
            return $requestPrepared->fetch(\PDO::FETCH_OBJ);
        }

        return 0;
    }

    public function findByLabel($levelLabel)
    {
        $request = "SELECT label FROM Level WHERE label = ?";

        $requestPrepared = $this->db->prepare($request);
        $requestPrepared->bindValue(1, $levelLabel);
        $requestPrepared->execute();

        return $requestPrepared->fetch(\PDO::FETCH_OBJ);
    }

    public function getClassNameById($idLevel)
    {
        $request = "SELECT label FROM Level WHERE id = ?";
        $requestPrepared = $this->db->prepare($request);
        $requestPrepared->bindValue(1, $idLevel);
        $requestPrepared->execute();
        return $requestPrepared->fetch(\PDO::FETCH_OBJ);
    }

    public function getLevelNameByClassId($idClasse)
    {
        $request = "SELECT
                        Level.label AS label,
                        Level.id AS id
                    FROM
                        Classe JOIN Level ON Level.id = Classe.id_level
                        WHERE Classe.id = ?";
        $requestPrepared = $this->db->prepare($request);
        $requestPrepared->bindValue(1, $idClasse);
        $requestPrepared->execute();
        return $requestPrepared->fetch(\PDO::FETCH_OBJ);
    }
}
