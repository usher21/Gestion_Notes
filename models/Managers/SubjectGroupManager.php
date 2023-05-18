<?php

namespace Model\Managers;

use Model\Database;
use Model\Entities\SubjectGroup;

class SubjectGroupManager
{
    private $subjectGroups = [];

    public function addSubjectGroup(SubjectGroup $subjectGroup)
    {
        $this->subjectGroups[] = $subjectGroup;
    }

    public function getSubjectGroups() : array
    {
        return $this->subjectGroups;
    }

    public function loadSubjectGroup()
    {
        $request = "SELECT * FROM  SubjectGroup";
        $subjectGroups = Database::getInstance()->request($request);

        foreach ($subjectGroups as $subjectGroup) {
            $subjectGroupObject = new SubjectGroup($subjectGroup->id, $subjectGroup->label);
            $this->addSubjectGroup($subjectGroupObject);
        }
    }

    public function insert($label)
    {
        $request = "INSERT INTO SubjectGroup(label) VALUES(?)";
        return Database::getInstance()->request($request, [$label]);
    }
}
