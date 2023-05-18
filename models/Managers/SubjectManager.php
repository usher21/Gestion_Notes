<?php

namespace Model\Managers;

use Model\Database;
use Model\Entities\Subject;

class SubjectManager
{
    private $subjects = [];

    public function addSubject(Subject $subject)
    {
        $this->subjects[] = $subject;
    }

    public function getSubjects() : array
    {
        return $this->subjects;
    }

    public function loadSubject()
    {
        $request = "SELECT * FROM  Subject";
        $subjects = Database::getInstance()->request($request);

        foreach ($subjects as $subject) {
            $subjectObject = new Subject($subject->code, $subject->label, $subject->id_subject_group);
            $this->addSubject($subjectObject);
        }
    }

    public function insert($code, $label, $idSubjectGroup)
    {
        $request = "INSERT INTO Subject(code, label, id_subject_group) VALUES(?, ?, ?)";
        return Database::getInstance()->request($request, [$code, $label, $idSubjectGroup]);
    }
}
