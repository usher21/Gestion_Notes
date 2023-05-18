<?php

namespace Model\Entities;

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
}
