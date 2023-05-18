<?php

namespace Model\Entities;

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
}
