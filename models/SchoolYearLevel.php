<?php

namespace Model;

use Model\Database;

class SchoolYearLevel
{
    private \PDO $db;

    public function __construct()
    {
        $database = new Database;
        $this->db = $database->getConnection();
    }

    public function list()
    {
        $request = "SELECT * From SchoolYear_Level";
        $requestPrepared = $this->db->prepare($request);
        
        if ($requestPrepared->execute()) {
            return $requestPrepared->fetchAll(\PDO::FETCH_OBJ);
        }

        return [];
    }

    public function insert($idSchoolYear, $idLevel)
    {
        $request = "INSERT INTO SchoolYear_Level (id_school_year, id_level) VALUES(?, ?)";
        $requestPrepared = $this->db->prepare($request);
        
        $requestPrepared->bindValue(1, $idSchoolYear);
        $requestPrepared->bindValue(2, $idLevel);

        return $requestPrepared->execute();
    }

    public function delete($idSchoolYear)
    {
        $request = "DELETE FROM SchoolYear_Level WHERE id_school_year = ?";

        $requestPrepared = $this->db->prepare($request);
        $requestPrepared->bindValue(1, $idSchoolYear);

        return $requestPrepared->execute();
    }
}
