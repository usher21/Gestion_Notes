<?php

namespace Model\Managers;

use Model\Database;
use Model\Entities\Level;

class LevelManager
{
    private $levels = [];

    public function addLevel(Level $level)
    {
        $this->levels[] = $level;
    }

    public function getLevels() : array
    {
        return $this->levels;
    }

    public function loadLevels()
    {
        $request = "SELECT
                        Level.id as id_level,
                        Level.label as level,
                        LevelGroup.id as id_group,
                        LevelGroup.label as group_name
                        FROM  Level
                        JOIN LevelGroup ON LevelGroup.id = Level.id_group";
        $levels = Database::getInstance()->request($request);

        foreach ($levels as $level) {
            $levelObject = new Level($level->id_level, $level->level, $level->id_group, $level->group_name);
            $this->addLevel($levelObject);
        }
    }

    public function insert($label, $idGroup)
    {
        $request = "INSERT INTO Level (label, id_group) VALUES(?, ?)";
        return Database::getInstance()->request($request, [$label, $idGroup]);
    }
}
