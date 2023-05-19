<?php

class Session
{
    public function init()
    {
        if (!session_id()) {
            session_start();
            session_regenerate_id();
        }
    }

    /*--------------------------------------------------------------------------------------------------*/

    public function cleanSession()
    {
        session_unset();
        session_destroy();
    }

    /*--------------------------------------------------------------------------------------------------*/

    public function isLogged(): bool
    {
        if (
            isset($_SESSION['user_phone']) &&
            !empty($_SESSION['user_phone']) &&
            isset($_SESSION['user_passwd']) &&
            !empty($_SESSION['user_passwd'])
        ) {
            return true;
        }
        
        return false;
    }
}
