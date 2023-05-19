<?php

namespace Model;

use Model\Database;

class LevelSubject
{
    public function __construct(
        private string $subjectCode,
        private int $levelId,
        private string $addDate,
        private string $removeDate,
        private string $state
    ) {
    }

    public function getSubjectCode()
    {
        return $this->subjectCode;
    }

    public function getLevelId()
    {
        return $this->levelId;
    }

    public function getAddDate()
    {
        return $this->addDate;
    }

    public function getRemoveDate()
    {
        return $this->removeDate;
    }

    public function getState()
    {
        return $this->state;
    }

    public static function list()
    {
        $request = "SELECT * FROM  Subject";
        return Database::getInstance()->request($request);
    }

    public static function insert($code, $label, $idSubjectGroup)
    {
        $request = "INSERT INTO Subject(code, label, id_subject_group) VALUES(?, ?, ?)";
        return Database::getInstance()->request($request, [$code, $label, $idSubjectGroup]);
    }
}
