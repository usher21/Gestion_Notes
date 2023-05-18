<?php

namespace Model\Entities;

class Level
{
    public function __construct(
        private int $id,
        private string $label,
        private int $idGroup,
        private string $groupName
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function getIdGroup(): int
    {
        return $this->idGroup;
    }

    public function getGroupName()
    {
        return $this->groupName;
    }
}
