<?php

namespace Model\Entities;

class Classe
{
    public function __construct(
        private int $id,
        private string $label,
        private int $size,
        private int $placeNumber,
        private int $idLevel
    ) {
    }

    public function getId()
    {
        return $this->id;
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function getSize()
    {
        return $this->size;
    }

    public function getPlaceNumber()
    {
        return $this->placeNumber;
    }

    public function getIdLevel()
    {
        return $this->idLevel;
    }
}
