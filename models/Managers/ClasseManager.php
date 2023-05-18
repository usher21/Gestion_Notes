<?php

namespace Model\Managers;

use Model\Database;
use Model\Entities\Classe;

class ClasseManager
{
    private $classes = [];

    public function addClasse(Classe $classe)
    {
        $this->classes[] = $classe;
    }

    public function getClasses(): array
    {
        return $this->classes;
    }

    public function loadClasses()
    {
        $request = "SELECT * FROM  Classe";
        $classes = Database::getInstance()->request($request);

        foreach ($classes as $classe) {
            $classeObject = new Classe(
                $classe->id,
                $classe->label,
                $classe->size,
                $classe->place_number,
                $classe->id_level
        );

            $this->addClasse($classeObject);
        }
    }

    public function insert($label, $size, $placeNumber, $idLevel)
    {
        $request = "INSERT INTO Classe (label, size, place_number, id_level) VALUES(?, ?, ?, ?)";
        return Database::getInstance()->request($request, [$label, $size, $placeNumber, $idLevel]);
    }
}
