<?php

namespace Model;

use Model\Database;

class Classe
{
    public function __construct(
        private int $id,
        private string $label,
        private int $size,
        private int $placeNumber,
        private int $idLevel
    ) {
    }

    public function getId()
    {
        return $this->id;
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function getSize()
    {
        return $this->size;
    }

    public function getPlaceNumber()
    {
        return $this->placeNumber;
    }

    public function getIdLevel()
    {
        return $this->idLevel;
    }

    public static function list()
    {
        $request = "SELECT * FROM  Classe";
        return Database::getInstance()->request($request);
    }

    public static function insert($label, $size, $placeNumber, $idLevel)
    {
        $request = "INSERT INTO Classe (label, size, place_number, id_level) VALUES(?, ?, ?, ?)";
        return Database::getInstance()->request($request, [$label, $size, $placeNumber, $idLevel]);
    }
}
