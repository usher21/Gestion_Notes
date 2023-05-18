<?php

namespace Model\Managers;

use Model\Database;
use Model\Entities\LevelGroup;

class LevelGroupManager
{
    private $levelGroups = [];

    public function addLevel(LevelGroup $levelGroup)
    {
        $this->levelGroups[] = $levelGroup;
    }

    public function getLevelGroups() : array
    {
        return $this->levelGroups;
    }

    public function loadLevelsGroup()
    {
        $request = "SELECT * FROM  LevelGroup";
        $levelsGroup = Database::getInstance()->request($request);

        foreach ($levelsGroup as $levelGroup) {
            $levelGroupObject = new LevelGroup($levelGroup->id, $levelGroup->label);
            $this->addLevel($levelGroupObject);
        }
    }

    public function insert($label)
    {
        $request = "INSERT INTO LevelGroup(label) VALUES (?)";
        return Database::getInstance()->request($request, [$label]);
    }
}
