<?php

namespace Controller;

use Model\Level;
use Model\Classe;
use Model\SchoolYearClasse;
use Controller\ResponseController;

class ClasseController
{
    private $classModel;
    private $levelModel;
    private $schoolYearClasse;

    private const LIST_CLASSE_URL = 'Location:'. HOST;
    private string $path;

    public function __construct()
    {
        $this->classModel = new Classe;
        $this->levelModel= new Level;
        $this->schoolYearClasse = new SchoolYearClasse;
        $this->path = trim(trim(ROOT_PATH['classe']['by-level'], '{param}'), '/');
    }

    public function list()
    {
        ob_start();
        $classes = $this->classModel->list();
        $levels = $this->levelModel->list();
        require_once VIEWS . DIRECTORY_SEPARATOR . 'classes.html.php';
        $content = ob_get_clean();
        require_once VIEWS . DIRECTORY_SEPARATOR . 'template.html.php';
    }

    public function insert()
    {
        if (
            isset($_POST['label']) && !empty($_POST['label']) &&
            isset($_POST['id_level']) && !empty($_POST['id_level'])
        ) {
            $this->classModel->insert($_POST['label'], $_POST['id_level']);
            $lastClasseId = $this->classModel->lastInsertId();
            $this->schoolYearClasse->insert(1, $lastClasseId->id);
            header(self::LIST_CLASSE_URL . $this->path . '/' . $_POST['id_level']);
        }
    }

    public function edit()
    {
        if (
            isset($_POST['id']) && !empty($_POST['id']) &&
            isset($_POST['label']) && !empty($_POST['label']) &&
            isset($_POST['id_level']) && !empty($_POST['id_level'])
        ) {
            $this->classModel->edit($_POST['id'], $_POST['label'], $_POST['id_level']);
            header(self::LIST_CLASSE_URL . $this->path . '/' . $_POST['id_level']);
        }
    }

    public function getByLevel($id)
    {
        $classes = $this->classModel->getByLevel($id);
        
        if (!empty($classes)) {
            ResponseController::generate(
                http_response_code(),
                "Données récupérées avec succès",
                $classes
            );
        } else {
            ResponseController::generate(
                204,
                "Aucune classe pour ce niveau",
                $classes
            );
        }
    }

    public function byLevelId($id)
    {
        ob_start();
        $classes = $this->classModel->getByLevel($id);
        $levelName = $this->levelModel->getClassNameById($id)->label;
        require_once VIEWS . DIRECTORY_SEPARATOR . 'classesInLevel.php';
        $content = ob_get_clean();
        require_once VIEWS . DIRECTORY_SEPARATOR . 'template.html.php';
    }
}


