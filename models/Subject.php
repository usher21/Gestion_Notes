<?php

namespace Model;

use Model\Database;

class Subject
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
                        Subject.id AS id,
                        Subject.code AS code,
                        Subject.label AS subject,
                        SubjectGroup.label AS subject_group,
                        SchoolYear.label AS school_year
                    FROM  Subject
                        JOIN SubjectGroup ON SubjectGroup.id = Subject.id_subject_group
                        JOIN Subject_SchoolYear ON Subject_SchoolYear.id_subject = Subject.id
                        JOIN SchoolYear ON SchoolYear.id = Subject_SchoolYear.id_school_year
                    WHERE
                        SchoolYear.id = (SELECT id FROM SchoolYear WHERE status = 1 LIMIT 1)";
        $requestPrepared = $this->db->prepare($request);
        $requestPrepared->execute();
        return $requestPrepared->fetchAll(\PDO::FETCH_OBJ);
    }

    public function findInClasse($idClasse)
    {
        $request = "SELECT
                        Subject.id AS id,
                        Subject.code AS code,
                        Subject.label AS subject,
                        Subject.id_subject_group AS subject_group,
                        Classe.label AS classe,
                        SchoolYear.label AS school_year
                    FROM Subject_Classe
                        JOIN Subject ON Subject.id = Subject_Classe.id_subject
                        JOIN Classe ON Classe.id = Subject_Classe.id_classe
                        JOIN Subject_SchoolYear ON Subject_SchoolYear.id_subject = Subject.id
                        JOIN SchoolYear ON SchoolYear.id = Subject_SchoolYear.id_school_year
                    WHERE
                        Classe.id = ? AND
                        SchoolYear.id = (SELECT id FROM SchoolYear WHERE status = 1 LIMIT 1)
                        AND subject_group is NOT NULL";

        $requestPrepared = $this->db->prepare($request);
        $requestPrepared->bindValue(1, $idClasse);
        $requestPrepared->execute();
        return $requestPrepared->fetchAll(\PDO::FETCH_OBJ);
    }

    public function groupBySubjectGroup($idClasse)
    {
        $request = "SELECT
                        COALESCE(SubjectGroup.label, 'Autre') AS 'subject_groups',
                        GROUP_CONCAT(Subject.label) AS 'subjects',
                        GROUP_CONCAT(Subject.id) AS id_subjects
                    FROM Subject_Classe
                        JOIN Subject ON Subject.id = Subject_Classe.id_subject
                        LEFT JOIN SubjectGroup ON Subject.id_subject_group = SubjectGroup.id
                        JOIN Classe ON Classe.id = Subject_Classe.id_classe
                        JOIN Subject_SchoolYear ON Subject_SchoolYear.id_subject = Subject.id
                        JOIN SchoolYear ON SchoolYear.id = Subject_SchoolYear.id_school_year
                    WHERE
                        Classe.id = ? AND
                        SchoolYear.id = (SELECT id FROM SchoolYear WHERE status = 1 LIMIT 1)
                    GROUP BY
                        COALESCE(SubjectGroup.label, 'Autre')";

        $requestPrepared = $this->db->prepare($request);
        $requestPrepared->bindValue(1, $idClasse);
        $requestPrepared->execute();
        return $requestPrepared->fetchAll(\PDO::FETCH_OBJ);
    }

    public function getByClasseId($label, $idClasse)
    {
        $request = "SELECT
                        Subject.id AS id,
                        Subject.code AS code,
                        Subject.label AS subject,
                        Classe.label AS classe,
                        SchoolYear.label AS school_year
                    FROM Subject_Classe
                        JOIN Subject ON Subject.id = Subject_Classe.id_subject
                        JOIN Classe ON Classe.id = Subject_Classe.id_classe
                        JOIN Subject_SchoolYear ON Subject_SchoolYear.id_subject = Subject.id
                        JOIN SchoolYear ON SchoolYear.id = Subject_SchoolYear.id_school_year
                    WHERE
                        Classe.id = ? AND Subject.label = ? AND
                        SchoolYear.id = (SELECT id FROM SchoolYear WHERE status = 1 LIMIT 1)";

        $requestPrepared = $this->db->prepare($request);
        $requestPrepared->bindValue(1, $idClasse);
        $requestPrepared->bindValue(2, $label);
        $requestPrepared->execute();
        return $requestPrepared->fetchAll(\PDO::FETCH_OBJ);
    }

    public function findByLabel($label)
    {
        $request = "SELECT
                        Subject.id AS id,
                        Subject.code AS code,
                        Subject.label AS subject,
                        Classe.label AS classe,
                        SubjectGroup.label AS subject_group,
                        SchoolYear.label AS school_year
                    FROM Subject_Classe
                        JOIN Subject ON Subject.id = Subject_Classe.id_subject
                        JOIN SubjectGroup ON SubjectGroup.id = Subject.id_subject_group
                        JOIN Classe ON Classe.id = Subject_Classe.id_classe
                        JOIN Subject_SchoolYear ON Subject_SchoolYear.id_subject = Subject.id
                        JOIN SchoolYear ON SchoolYear.id = Subject_SchoolYear.id_school_year
                    WHERE
                        Subject.label = ? AND
                        SchoolYear.id = (SELECT id FROM SchoolYear WHERE status = 1 LIMIT 1)";
        $requestPrepared = $this->db->prepare($request);
        $requestPrepared->bindValue(1, $label);
        $requestPrepared->execute();
        return $requestPrepared->fetch(\PDO::FETCH_OBJ);
    }

    public function findByCode($code)
    {
        $request = "SELECT
                        Subject.id AS id,
                        Subject.code AS code,
                        Subject.label AS subject,
                        Classe.label AS classe,
                        SubjectGroup.label AS subject_group,
                        SchoolYear.label AS school_year
                    FROM Subject_Classe
                        JOIN Subject ON Subject.id = Subject_Classe.id_subject
                        JOIN SubjectGroup ON SubjectGroup.id = Subject.id_subject_group
                        JOIN Classe ON Classe.id = Subject_Classe.id_classe
                        JOIN Subject_SchoolYear ON Subject_SchoolYear.id_subject = Subject.id
                        JOIN SchoolYear ON SchoolYear.id = Subject_SchoolYear.id_school_year
                    WHERE
                        Subject.code = ? AND
                        SchoolYear.id = (SELECT id FROM SchoolYear WHERE status = 1 LIMIT 1)";
        $requestPrepared = $this->db->prepare($request);
        $requestPrepared->bindValue(1, $code);
        $requestPrepared->execute();
        return $requestPrepared->fetch(\PDO::FETCH_OBJ);
    }

    public function findSubjectByCode(string $code)
    {
        $request = "SELECT
                        Subject.label AS subject,
                        Subject.code AS code
                    FROM
                        Subject
                    WHERE
                        Subject.code = ?";
        $requestPrepared = $this->db->prepare($request);
        $requestPrepared->bindValue(1, $code);
        $requestPrepared->execute();
        return $requestPrepared->fetch(\PDO::FETCH_OBJ);
    }

    public function insert($code, $label, $idSubjectGroup, $idClasse)
    {
        $this->db->beginTransaction();
        
        $id = $idSubjectGroup !== 0 ? $idSubjectGroup : null;

        try {
            $this->insertIntoSubject($code, $label, $id);
            $lastInsertID = $this->lastInsertId()->id;
            $this->insertIntoSubjectSchoolYear($lastInsertID);
            $this->insertIntoSubjectClasse($lastInsertID, $idClasse);
            $this->db->commit();
            return true;
        } catch (\PDOException $exception) {
            $this->db->rollBack();
            echo 'Erreur: ' . $exception->getMessage();
            return false;
        }
    }

    public function insertIntoSubject($code, $label, $idSubjectGroup)
    {
        $request = "INSERT INTO Subject(code, label, id_subject_group) VALUES(?, ?, ?)";
        $requestPrepared = $this->db->prepare($request);
        $requestPrepared->bindValue(1, $code);
        $requestPrepared->bindValue(2, $label);
        $requestPrepared->bindValue(3, $idSubjectGroup);
        $requestPrepared->execute();
    }

    public function insertIntoSubjectSchoolYear($idSubject)
    {
        $request = "INSERT INTO
                            Subject_SchoolYear(id_subject, id_school_year)
                        VALUES
                            (
                                ?,
                                (SELECT id FROM SchoolYear WHERE status = 1 LIMIT 1)
                            )";
        $requestPrepared = $this->db->prepare($request);
        $requestPrepared->bindValue(1, $idSubject);
        $requestPrepared->execute();
    }

    public function insertIntoSubjectClasse($idSubject, $idClasse)
    {
        $request = "INSERT INTO
                        Subject_Classe(id_subject, id_classe)
                    VALUES (?, ?)";
        $requestPrepared = $this->db->prepare($request);
        $requestPrepared->bindValue(1, $idSubject);
        $requestPrepared->bindValue(2, $idClasse);
        $requestPrepared->execute();
    }

    public function lastInsertId()
    {
        $request = "SELECT id FROM Subject WHERE id = LAST_INSERT_ID() LIMIT 1";
        $requestPrepared = $this->db->prepare($request);
        $requestPrepared->execute();
        return $requestPrepared->fetch(\PDO::FETCH_OBJ);
    }

    public function removeAssocWithClasse($idClasse, $idSubjects)
    {
        $request = "DELETE FROM Subject_Classe WHERE id_subject = ? AND id_classe = ?";
        $requestPrepared = $this->db->prepare($request);
        $requestPrepared->bindValue(2, $idClasse);

        $this->db->beginTransaction();
        try {
            foreach ($idSubjects as $idSubject) {
                $requestPrepared->bindValue(1, $idSubject);
                $requestPrepared->execute();
            }
            $this->db->commit();
            return true;
        } catch (\PDOException $exception) {
            $this->db->rollBack();
            echo 'Erreur: ' . $exception->getMessage();
            return false;
        }
    }
}
