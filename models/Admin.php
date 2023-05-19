<?php

namespace Model;

use Model\Database;

class Admin
{
    public function __construct(
        private string $fisrtName,
        private string $lastName,
        private string $email,
        private string $phone,
        private string $password
    ) {
    }

    public function getFisrtName()
    {
        return $this->fisrtName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public static function connect($phone, $password)
    {
        $request = "SELECT * FROM Admin WHERE phone = ? AND password = ?";
        return Database::getInstance()->request($request, [$phone, $password]);
    }
}
