<?php

namespace Controller;

use Model\Level;
use Model\Student;
use Controller\Session;
use Model\Classe;

Session::init();

class StudentController
{
    private Student $student;
    private Level $level;
    private Classe $classe;

    public function __construct()
    {
        $this->student = new Student;
        $this->level = new Level;
        $this->classe = new Classe;
    }

    public function list()
    {
        ob_start();
        $students = $this->student->list();
        $levels = $this->level->list();
        require_once VIEWS . DIRECTORY_SEPARATOR . 'students.html.php';
        $content = ob_get_clean();
        require_once VIEWS . DIRECTORY_SEPARATOR . 'template.html.php';
    }

    public function add()
    {
        $id = $_POST['id_classe'];
        
        if (isset($_POST)) {
            extract($_POST);
        
            $filename = null;
            $fileBlob = null;
        
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $filename = basename($_FILES['image']['name']);
                $fileBlob = $_FILES['image']['tmp_name'];
            }
        
            if (!empty($number)) {
                $type = 'INTERNE';
                $numberValue = $number;
            } else {
                $type = 'EXTERNE';
                $numberValue = -1;
            }
        
            $this->student->insert(
                $firstname, $lastname, $type, $numberValue, $birth_date ?? null,
                $birth_place, $sex == 'm' ? 1 : 0, $id_classe,
                ['filename' => $filename, 'fileblob' => $fileBlob]
            );
        
            header('Location:' . HOST . trim(trim(ROOT_PATH['student']['in-classe'], '{param}'), '/') . '/' . $id);
        }
    }

    public function getByClasse($id)
    {
        ob_start();
        $students = $this->student->getByClasse($id);
        $classeName = $this->classe->getClasseNameById($id)->label;
        $levelName = $this->level->getLevelNameByClassId($id);
        require_once VIEWS . DIRECTORY_SEPARATOR . 'studentsInClasse.php';
        $content = ob_get_clean();
        require_once VIEWS . DIRECTORY_SEPARATOR . 'template.html.php';
    }
}

