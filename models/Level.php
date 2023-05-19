<?php

namespace Model;

use Model\Database;

class Level
{
    public function __construct(
        private int $id,
        private string $label,
        private int $idGroup,
        private string $groupName
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function getIdGroup(): int
    {
        return $this->idGroup;
    }

    public function getGroupName()
    {
        return $this->groupName;
    }

    public static function list()
    {
        $request = "SELECT
                        Level.id as id_level,
                        Level.label as level,
                        LevelGroup.id as id_group,
                        LevelGroup.label as group_name
                        FROM  Level
                        JOIN LevelGroup ON LevelGroup.id = Level.id_group";
        return Database::getInstance()->request($request);
    }

    public static function insert($label, $idGroup)
    {
        $request = "INSERT INTO Level (label, id_group) VALUES(?, ?)";
        return Database::getInstance()->request($request, [$label, $idGroup]);
    }
}
