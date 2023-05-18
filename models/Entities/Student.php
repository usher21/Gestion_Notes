<?php

namespace Model\Entities;

use DateTime;

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
}
