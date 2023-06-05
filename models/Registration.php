<?php

namespace Model;

use Model\Database;

class Registration
{
    private \PDO $db;

    public function __construct()
    {
        $database = new Database;
        $this->db = $database->getConnection();
    }

    public function insert($idClasse, $idStudent)
    {
        $request = "INSERT INTO
                        Registration (id_classe, id_school_year, id_student)
                    VALUES
                        (:id_classe, (SELECT id FROM SchoolYear WHERE status = 1 LIMIT 1), :id_student)";
        $requestPrepared = $this->db->prepare($request);
        $requestPrepared->bindParam(':id_classe', $idClasse);
        $requestPrepared->bindParam(':id_student', $idStudent);

        return $requestPrepared->execute();
    }
}

