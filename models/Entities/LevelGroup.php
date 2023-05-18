<?php

namespace Model\Entities;

class LevelGroup
{
    public function __construct(
        private int $id,
        private string $label
    ) { }
    
    public function getID() : int
    {
        return $this->id;
    }

    public function getLabel() : string
    {
        return $this->label;
    }
}
