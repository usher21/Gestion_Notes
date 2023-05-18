<?php

namespace Model\Managers;

use Model\Database;
use Model\Entities\LevelSubject;

class LevelSubjectManager
{
    private $levelSubjects = [];

    public function addLevelSubject(LevelSubject $levelSubject)
    {
        $this->levelSubjects[] = $levelSubject;
    }

    public function getLevelSubjects() : array
    {
        return $this->levelSubjects;
    }

    public function loadLevelSubject()
    {
        $request = "SELECT * FROM  LevelSubject";
        $levelSubjects = Database::getInstance()->request($request);

        foreach ($levelSubjects as $levelSubject) {
            $levelSubjectObject = new LevelSubject(
                $levelSubject->subject_code,
                $levelSubject->level_id,
                $levelSubject->add_date ? explode(' ', $levelSubject->add_date)[0] : '',
                $levelSubject->remove_date ? explode(' ', $levelSubject->remove_date)[0] : '',
                $levelSubject->state
            );

            $this->addLevelSubject($levelSubjectObject);
        }
    }

    public function insert($subjectCode, $levelId, $addDate, $removeDate)
    {
        $request = "INSERT INTO LevelSubject(subject_code, level_id, add_date, remove_date) VALUES(?, ?, ?, ?)";
        return Database::getInstance()->request($request, [$subjectCode, $levelId, $addDate, $removeDate]);
    }
}
