<?php

namespace Model;

use Model\Database;

class Student
{
    public function __construct(
        private int $id,
        private string $firstName,
        private string $lastName,
        private string $type,
        private int $number,
        private $birthDate,
        private int $idLevel,
        private int $idClasse,
        private string $state,
        private string $className,
        private string $levelName
    ) {
    }

    public function getId()
    {
        return $this->id;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getNumber()
    {
        return $this->number;
    }

    public function getBirthDate()
    {
        return $this->birthDate;
    }

    public function getIdLevel()
    {
        return $this->idLevel;
    }

    public function getIdClasse()
    {
        return $this->idClasse;
    }

    public function getState()
    {
        return $this->state;
    }

    public function getClassName()
    {
        return $this->className;
    }

    public function getLevelName()
    {
        return $this->levelName;
    }


    public static function list()
    {
        $request = "SELECT
                        firstname,
                        lastname,
                        type, birth_date,
                        number, state,
                        Student.id id,
                        Classe.id id_classe,
                        Classe.label as classe,
                        Level.label as level,
                        Level.id as id_level
                        FROM
                            Student
                        JOIN Classe ON Classe.id = Student.id_classe
                        JOIN Level ON Level.id = Student.id_level";
                        
        return Database::getInstance()->request($request);
    }

    public static function insert($firstName, $lastName, $idLevel, $idClasse, $type, $birthDate)
    {
        $request = "INSERT INTO Student(firstname, lastname, id_level, id_classe, type, birth_date)
                    VALUES(?, ?, ?, ?, ?, ?)";
        $bindValues = [$firstName, $lastName, $idLevel, $idClasse, $type, $birthDate];
        return Database::getInstance()->request($request, $bindValues);
    }
}
