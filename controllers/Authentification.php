<?php

namespace Controller;

use Model\Admin;
use Controller\Session;
use Model\SchoolYear;

class Authentification
{
    private $schoolYearModel;

    public function __construct()
    {
        $this->schoolYearModel = new SchoolYear;
    }

    public function view()
    {
        ob_start();
        require_once VIEWS . '/login.html.php';
        $content = ob_get_clean();
        require_once VIEWS . '/template.html.php';
    }

    public function check()
    {
        if (
            isset($_POST['login']) && !empty($_POST['login']) &&
            isset($_POST['passwd']) && !empty($_POST['passwd'])
        ) {
            $admin = Admin::get($_POST['login'], $_POST['passwd']);
            if ($admin) {
                Session::init();
                $currentYear = $this->schoolYearModel->getActiveYear();
                $_SESSION['user_login'] = $admin->login;
                $_SESSION['user_passwd'] = $admin->passwd;
                $_SESSION['current_year'] = $currentYear;
                header('Location:' . HOST . trim(ROOT_PATH['level']['list'], '/'));
            }
        }
    }

    public function verify()
    {
        if (
            isset($_POST['login']) && !empty($_POST['login']) &&
            isset($_POST['passwd']) && !empty($_POST['passwd'])
        ) {
            $admin = Admin::get($_POST['login'], $_POST['passwd']);
            if ($admin) {
                echo json_encode(
                    [
                        'message' => 'Identifiant existant',
                        'data' => $admin,
                        'ok' => true
                    ]
                );
            } else {
                echo json_encode(
                    [
                        'message' => 'Identifiant ou mot de passe incorrect',
                        'data' => $admin,
                        'ok' => false
                    ]
                );
            }
        }
    }

    public function disconnect()
    {
        Session::init();
        Session::clean();
        header('Location:' . HOST . trim(ROOT_PATH['login']['view'], '/'));
    }
}

