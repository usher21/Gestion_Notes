<?php

namespace Model\Entities;

class SubjectGroup
{
    public function __construct(
        private int $id,
        private string $label
    ) {
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function getId()
    {
        return $this->id;
    }
}
