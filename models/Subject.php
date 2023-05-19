<?php

namespace Model;

use Model\Database;

class Subject
{
    public function __construct(
        private string $subjectCode,
        private string $label,
        private int $idSubjectGroup
    ) {
    }

    public function getSubjectCode()
    {
        return $this->subjectCode;
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function getIdSubjectGroup()
    {
        return $this->idSubjectGroup;
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
