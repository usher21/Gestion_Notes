<?php

namespace Model;

use Model\Database;

class Student
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
                        firstname,
                        lastname,
                        type, birth_date, birth_place,
                        number, state, sex,
                        Student.id as id,
                        Classe.id as id_classe,
                        Classe.label as classe,
                        Level.label as level,
                        Level.id as id_level
                    FROM
                        Student
                        JOIN Registration ON Student.id = Registration.id_student
                        JOIN Classe ON Classe.id = Registration.id_classe
                        JOIN Level ON Level.id = Classe.id_level
                        JOIN SchoolYear ON SchoolYear.id = Registration.id_school_year
                    WHERE
                        Registration.id_school_year = (SELECT id FROM SchoolYear WHERE status = 1 LIMIT 1)";

        $requestPrepared = $this->db->prepare($request);

        if ($requestPrepared->execute()) {
            return $requestPrepared->fetchAll(\PDO::FETCH_OBJ);
        }

        return [];
    }

    public function insert($firstName, $lastName, $type, $number, $birthDate, $birthPlace, $sex, $idClasse, $photo)
    {
        $this->db->beginTransaction();
        try {
            $this->insertStudent($firstName, $lastName, $type, $number, $birthDate, $birthPlace, $sex, $photo);
            $request = "INSERT INTO
                            Registration(id_classe, id_school_year, id_student)
                        VALUES (
                                    :id_classe,
                                    (
                                        SELECT id FROM SchoolYear WHERE status = 1 LIMIT 1
                                    ),
                                    LAST_INSERT_ID()
                                )";
            $requestPrepared = $this->db->prepare($request);
            $requestPrepared->bindParam(":id_classe", $idClasse);
            $requestPrepared->execute();
            $this->db->commit();
            return true;
        } catch (\Exception $exception) {
            echo 'Erreur: ' . $exception->getMessage();
            $this->db->rollBack();
            die();
        }
    }

    public function insertStudent($firstName, $lastName, $type, $number, $birthDate, $birthPlace, $sex, $photo)
    {
        $photoValue = null;
        $birthDateValue = null;

        if (!empty($photo) && !empty($photo['fileblob'])) {
            if (move_uploaded_file($photo['fileblob'], ROOT . 'assets/img/' . $photo['filename'])) {
                $photoValue = $photo['filename'];
            } else {
                die("Impossible d'uploader l'image '" . $photo['filename'] . "'");
            }
        }

        if (!empty($birthDate)) {
            $birthDateValue = $birthDate;
        }

        $request = "INSERT INTO Student(firstname, lastname, type, number, birth_date, birth_place, sex, photo)
                    VALUES(:firstname, :lastname, :type, :number, :birth_date, :birth_place, :sex, :photo)";
        $requestPrepared = $this->db->prepare($request);
        $requestPrepared->bindParam(":firstname", $firstName);
        $requestPrepared->bindParam(":lastname", $lastName);
        $requestPrepared->bindParam(":type", $type);
        $requestPrepared->bindParam(":number", $number);
        $requestPrepared->bindParam(":birth_date", $birthDateValue);
        $requestPrepared->bindParam(":birth_place", $birthPlace);
        $requestPrepared->bindParam(":sex", $sex);
        $requestPrepared->bindParam(":photo", $photoValue);
        $requestPrepared->execute();
    }

    public function getByClasse($id)
    {
        $request = "SELECT
                        firstname, lastname, Classe.label as classe
                    FROM
                        Registration
                            JOIN Student ON Registration.id_student = Student.id
                            JOIN Classe ON Registration.id_classe = Classe.id
                            JOIN SchoolYear ON Registration.id_school_year = SchoolYear.id
                            WHERE Classe.id = ? AND Registration.id_school_year =
                            (SELECT id FROM SchoolYear WHERE status = 1 LIMIT 1)";

        $requestPrepared = $this->db->prepare($request);

        $requestPrepared->bindParam(1, $id);
        $requestPrepared->execute();
        return $requestPrepared->fetchAll(\PDO::FETCH_OBJ);
    }
}
