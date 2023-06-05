<?php

namespace Controller;

class Session
{
    public static function init()
    {
        if (!session_id()) {
            session_start();
            session_regenerate_id();
        }
    }

    /*--------------------------------------------------------------------------------------------------*/

    public static function clean()
    {
        session_unset();
        session_destroy();
    }

    /*--------------------------------------------------------------------------------------------------*/

    public static function isLogged(): bool
    {
        if (
            isset($_SESSION['user_login']) &&
            !empty($_SESSION['user_login']) &&
            isset($_SESSION['user_passwd']) &&
            !empty($_SESSION['user_passwd'])
        ) {
            return true;
        }
        
        return false;
    }
}
