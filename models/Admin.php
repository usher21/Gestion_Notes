<?php

namespace Model;

use Model\Database;

class Admin
{
    public static function get($login, $password)
    {
        $request = "SELECT * FROM Admin WHERE login = ? AND passwd = ?";
        $database = new Database;
        $db = $database->getConnection();
        $requestPrepared = $db->prepare($request);

        $requestPrepared->bindValue(1, $login);
        $requestPrepared->bindValue(2, $password);
        $requestPrepared->execute();
        return $requestPrepared->fetch(\PDO::FETCH_OBJ);
    }
}
