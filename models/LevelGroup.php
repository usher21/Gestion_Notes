<?php

namespace Model;

use Model\Database;

class LevelGroup
{
    public function __construct(
        private int $id,
        private string $label
    ) { }
    
    public function getID() : int
    {
        return $this->id;
    }

    public function getLabel() : string
    {
        return $this->label;
    }

    public static function list()
    {
        $request = "SELECT * FROM  LevelGroup";
        return Database::getInstance()->request($request);
    }

    public static function insert($label)
    {
        $request = "INSERT INTO LevelGroup(label) VALUES (?)";
        return Database::getInstance()->request($request, [$label]);
    }
}
