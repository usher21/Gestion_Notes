<?php

namespace Model;

use Model\Database;

class SchoolYearClasse
{
    private \PDO $db;

    public function __construct()
    {
        $database = new Database;
        $this->db = $database->getConnection();
    }

    public function list()
    {
        $request = "SELECT * From SchoolYear_Classe";
        $requestPrepared = $this->db->prepare($request);
        
        if ($requestPrepared->execute()) {
            return $requestPrepared->fetchAll(\PDO::FETCH_OBJ);
        }

        return [];
    }

    public function insert($idSchoolYear, $idClasse)
    {
        $request = "INSERT INTO SchoolYear_Classe (id_school_year, id_classe) VALUES(?, ?)";
        $requestPrepared = $this->db->prepare($request);
        
        $requestPrepared->bindValue(1, $idSchoolYear);
        $requestPrepared->bindValue(2, $idClasse);

        return $requestPrepared->execute();
    }
    
    public function delete($idSchoolYear)
    {
        $request = "DELETE FROM SchoolYear_Classe WHERE id_school_year = ?";

        $requestPrepared = $this->db->prepare($request);
        $requestPrepared->bindValue(1, $idSchoolYear);

        return $requestPrepared->execute();
    }
}
