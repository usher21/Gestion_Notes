<?php

namespace Model\Managers;

use Model\Database;

class AdminManager
{
    public function get($phone, $password)
    {
        $request = "SELECT * FROM Admin WHERE phone = ? AND password = ?";
        return Database::getInstance()->request($request, [$phone, $password]);
    }
}
