<?php

namespace Controller;

use Model\SchoolYear;
use Controller\Session;

class SchoolYearController
{
    private const LIST_SCHOOLYEAR_URL = 'Location:' . HOST;

    private $schoolYearModel;
    private string $path;

    public function __construct()
    {
        $this->schoolYearModel = new SchoolYear;
        $this->path = trim(ROOT_PATH['schoolyear']['list'], '/');
    }

    public function list()
    {
        ob_start();
        $schoolYears = $this->schoolYearModel->list();
        require_once VIEWS . DIRECTORY_SEPARATOR . 'schoolyear.html.php';
        $content = ob_get_clean();
        require_once VIEWS . DIRECTORY_SEPARATOR . 'template.html.php';
    }

    public function insert()
    {
        $validYear = "/^\d{4}-\d{4}$/";
        
        if (!preg_match($validYear, $_POST['label'])) {
            Session::init();
            $_SESSION['error'] = "L'année " .
                                    $_POST['label'] .
                                 " n'est pas valide -> Format valide yyyy-xxxx";
            header(self::LIST_SCHOOLYEAR_URL . $this->path);
            return;
        }

        if (
            isset($_POST['label']) && !empty($_POST['label']) &&
            !$this->exists($_POST['label'])
        ) {
            $this->schoolYearModel->insert($_POST['label']);
        } else {
            Session::init();
            $_SESSION['error'] = "L'année " . $_POST['label'] . " existe déjà";
        }

        header(self::LIST_SCHOOLYEAR_URL . $this->path);
    }

    public function delete()
    {
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            if ($this->schoolYearModel->delete($_GET['id'])) {
                header(self::LIST_SCHOOLYEAR_URL . $this->path);
            }
        }
    }

    public function edit()
    {
        if (
            isset($_GET['id']) && !empty($_GET['id']) &&
            isset($_GET['label']) && !empty($_GET['label']) &&
            !$this->exists($_GET['label'])
        ) {
            $this->schoolYearModel->edit($_GET['id'], $_GET['label']);
            header(self::LIST_SCHOOLYEAR_URL . $this->path);
        }

        Session::init();
        $_SESSION['error'] = "L'année " . $_GET['label'] . " existe déjà";
        header(self::LIST_SCHOOLYEAR_URL . $this->path);
    }

    public function exists($label)
    {
        $label = $this->schoolYearModel->findByLabel($label);

        if ($label->label) {
            return true;
        }

        return false;
    }

    public function enable($id)
    {
        if (isset($id) && !empty($id)) {
            Session::init();
            $currentYear = $_SESSION['current_year']->id;
            $this->schoolYearModel->updateState($currentYear, 0);
            $this->schoolYearModel->updateState($id, 1);
            unset($_SESSION['current_year']);
            $currentYearObject = $this->schoolYearModel->getActiveYear();
            $_SESSION['current_year'] = $currentYearObject;
            header(self::LIST_SCHOOLYEAR_URL . $this->path);
        }
    }
}
