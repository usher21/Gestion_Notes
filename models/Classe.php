<?php

namespace Model;

use Model\Database;
use PDO;

class Classe
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
                        Classe.id as id,
                        Classe.id_level as id_level,
                        Classe.label as class_name
                    From Classe
                    JOIN SchoolYear_Classe ON Classe.id = SchoolYear_Classe.id_classe
                    AND SchoolYear_Classe.id_school_year = (SELECT id FROM SchoolYear WHERE status = 1 LIMIT 1)";

        $requestPrepared = $this->db->prepare($request);
        
        if ($requestPrepared->execute()) {
            return $requestPrepared->fetchAll(\PDO::FETCH_OBJ);
        }

        return [];
    }

    public function insert($label, $idLevel)
    {
        $this->db->beginTransaction();
        try {
            $request = "INSERT INTO Classe (label, id_level) VALUES(?, ?)";
            $requestPrepared = $this->db->prepare($request);
            $requestPrepared->bindValue(1, $label);
            $requestPrepared->bindValue(2, $idLevel);
            $requestPrepared->execute();
            
            $request = "INSERT INTO
                            SchoolYear_Classe(id_school_year, id_classe)
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
        $request = "SELECT id FROM Classe WHERE id = LAST_INSERT_ID()";
        $requestPrepared = $this->db->prepare($request);

        if ($requestPrepared->execute()) {
            return $requestPrepared->fetch(\PDO::FETCH_OBJ);
        }

        return 0;
    }

    public function edit($id, $label, $idLevel)
    {
        $request = "UPDATE Classe SET label = ?, id_level = ? WHERE id = ?";

        $requestPrepared = $this->db->prepare($request);
        $requestPrepared->bindValue(1, $label);
        $requestPrepared->bindValue(2, $idLevel);
        $requestPrepared->bindValue(3, $id);

        return $requestPrepared->execute();
    }
    
    public function getByLevel($idLevel)
    {
        $request = "SELECT
                        Classe.label as classe,
                        Classe.id as id_classe,
                        Classe.id_level as id_level,
                        Level.label as level
                    FROM
                        Classe JOIN Level ON Classe.id_level = Level.id
                        JOIN SchoolYear_Classe ON Classe.id = SchoolYear_Classe.id_classe
                        WHERE Level.id = ? AND SchoolYear_Classe.id_school_year =
                        (SELECT id FROM SchoolYear WHERE status = 1 LIMIT 1)";
        
        $requestPrepared = $this->db->prepare($request);
        $requestPrepared->bindValue(1, $idLevel);

        if ($requestPrepared->execute()) {
            return $requestPrepared->fetchAll(\PDO::FETCH_OBJ);
        }

        return [];
    }

    public function getClasseNameById($id)
    {
        $request = "SELECT label FROM Classe WHERE id = ?";
        $requestPrepared = $this->db->prepare($request);

        $requestPrepared->bindValue(1, $id);
        $requestPrepared->execute();
        return $requestPrepared->fetch(\PDO::FETCH_OBJ);
    }
}
