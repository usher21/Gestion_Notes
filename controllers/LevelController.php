<?php

namespace Controller;

use Model\Level;
use Controller\Session;

class LevelController
{
    private $levelModel;

    public function __construct()
    {
        $this->levelModel = new Level;
    }

    public function list()
    {
        ob_start();
        $levels = $this->levelModel->list();
        require_once VIEWS . DIRECTORY_SEPARATOR . 'levels.html.php';
        $content = ob_get_clean();
        require_once VIEWS . DIRECTORY_SEPARATOR . 'template.html.php';
    }

    public function insert()
    {
        if (isset($_POST['label']) && !empty($_POST['label'])) {
            if ($this->exists($_POST['label'])) {
                Session::init();
                $_SESSION['error'] = "Le niveau '" . $_POST['label'] . "' existe déjà";
            } else {
                $this->levelModel->insert($_POST['label']);
            }

            header('Location:' . HOST . trim(ROOT_PATH['level']['list'], '/'));
        }
    }

    public function exists($label)
    {
        $label = $this->levelModel->findByLabel($label);

        if ($label->label) {
            return true;
        }

        return false;
    }
}

