<?php

namespace Model;

use Model\Database;

class SchoolYear
{
    private \PDO $db;

    public function __construct()
    {
        $database = new Database;
        $this->db = $database->getConnection();
    }

    public function getActiveYear()
    {
        $request = "SELECT * FROM SchoolYear ORDER BY status DESC LIMIT 1";

        $requestPrepared = $this->db->prepare($request);

        if ($requestPrepared->execute()) {
            return $requestPrepared->fetch(\PDO::FETCH_OBJ);
        }

        return [];
    }

    public function list()
    {
        $request = "SELECT * FROM SchoolYear";

        $requestPrepared = $this->db->prepare($request);

        if ($requestPrepared->execute()) {
            return $requestPrepared->fetchAll(\PDO::FETCH_OBJ);
        }

        return [];
    }

    public function insert($label)
    {
        $request = "INSERT INTO SchoolYear (label) VALUES(?)";
        $requestPrepared = $this->db->prepare($request);

        $requestPrepared->bindValue(1, $label);

        return $requestPrepared->execute();
    }

    public function lastInsertYear()
    {
        $request = "SELECT * FROM SchoolYear ORDER BY id DESC LIMIT 1";
        $requestPrepared = $this->db->prepare($request);

        if ($requestPrepared->execute()) {
            return $requestPrepared->fetch(\PDO::FETCH_OBJ);
        }

        return null;
    }

    public function delete($idSchoolYear)
    {
        $this->db->beginTransaction();

        try {
            $this->deleteSchoolYearClasse($idSchoolYear);
            $this->deleteSchoolYearLevel($idSchoolYear);
            $request = "DELETE FROM SchoolYear WHERE id = $idSchoolYear";
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

    public function deleteSchoolYearClasse($idSchoolYear)
    {
        $request = "DELETE FROM SchoolYear_Classe WHERE id_school_year = ?";
        $requestPrepared = $this->db->prepare($request);
        $requestPrepared->bindValue(1, $idSchoolYear);
        $requestPrepared->execute();
    }

    public function deleteSchoolYearLevel($idSchoolYear)
    {
        $request = "DELETE FROM SchoolYear_Level WHERE id_school_year = ?";
        $requestPrepared = $this->db->prepare($request);
        $requestPrepared->bindValue(1, $idSchoolYear);
        $requestPrepared->execute();
    }

    public function findByLabel($schoolYearLabel)
    {
        $request = "SELECT label FROM SchoolYear WHERE label = ?";
        
        $requestPrepared = $this->db->prepare($request);
        $requestPrepared->bindValue(1, $schoolYearLabel);
        
        if ($requestPrepared->execute()) {
            return $requestPrepared->fetch(\PDO::FETCH_OBJ);
        }

        return null;
    }

    public function edit($idSchoolYear, $label)
    {
        $request = "UPDATE SchoolYear SET label = ? WHERE id = ?";

        $requestPrepared = $this->db->prepare($request);
        $requestPrepared->bindValue(1, $label);
        $requestPrepared->bindValue(2, $idSchoolYear);
        
        if ($requestPrepared->execute()) {
            return true;
        }

        return false;
    }

    public function updateState($id, $status)
    {
        $request = "UPDATE SchoolYear SET status = ? WHERE id = ?";
        
        $requestPrepared = $this->db->prepare($request);
        $requestPrepared->bindValue(1, $status);
        $requestPrepared->bindValue(2, $id);
        
        if ($requestPrepared->execute()) {
            return true;
        }

        return false;
    }
}
