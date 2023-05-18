<?php

namespace Model\Entities;

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
}
