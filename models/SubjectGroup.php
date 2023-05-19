<?php

namespace Model;

use Model\Database;

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

    public static function list()
    {
        $request = "SELECT * FROM  SubjectGroup";
        return Database::getInstance()->request($request);
    }

    public static function insert($label)
    {
        $request = "INSERT INTO SubjectGroup(label) VALUES(?)";
        return Database::getInstance()->request($request, [$label]);
    }
}
