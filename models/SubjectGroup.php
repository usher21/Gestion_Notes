<?php

namespace Model;

use Model\Database;
use PDO;

class SubjectGroup
{
    private \PDO $db;

    public function __construct()
    {
        $database = new Database;
        $this->db = $database->getConnection();
    }

    public function list()
    {
        $request = "SELECT * FROM  SubjectGroup";
        $requestPrepared = $this->db->prepare($request);
        $requestPrepared->execute();
        return $requestPrepared->fetchAll(\PDO::FETCH_OBJ);
    }

    public function insert($label)
    {
        $this->db->beginTransaction();
        try {
            $request = "INSERT INTO SubjectGroup(label) VALUES(?)";
            $requestPrepared = $this->db->prepare($request);
            $requestPrepared->bindValue(1, $label);
            $requestPrepared->execute();
            $this->insertIntoSubjectGroupSchoolYear();
            $this->db->commit();
            return true;
        } catch (\PDOException $exception) {
            $this->db->rollBack();
            echo 'Erreur: ' . $exception->getMessage();
            return false;
        }
    }

    public function insertIntoSubjectGroupSchoolYear()
    {
        $request = "INSERT INTO
                        SubjectGroup_SchoolYear(id_subject_group, id_school_year)
                    VALUES
                        (
                            LAST_INSERT_ID(),
                            (
                                SELECT id FROM SchoolYear WHERE status = 1 LIMIT 1
                            )
                        )";
        $requestPrepared = $this->db->prepare($request);
        $requestPrepared->execute();
    }

    public function getLastInsertSubjectGroup()
    {
        $request = "SELECT * FROM SubjectGroup ORDER BY id DESC LIMIT 1";
        $requestPrepared = $this->db->prepare($request);
        $requestPrepared->execute();
        return $requestPrepared->fetch(\PDO::FETCH_OBJ);
    }

    public function findByLabel(string $label)
    {
        $request = "SELECT * FROM SubjectGroup WHERE label = ?";
        $requestPrepared = $this->db->prepare($request);
        $requestPrepared->bindValue(1, $label);
        $requestPrepared->execute();
        return $requestPrepared->fetch(\PDO::FETCH_OBJ);
    }
}
