<?php

namespace Controller;

use Model\Student;

class StudentController
{
    public function list()
    {
        ob_start();
        $students = Student::list();
        require_once VIEWS . DIRECTORY_SEPARATOR . 'students.html.php';
        $content = ob_get_clean();
        require_once VIEWS . DIRECTORY_SEPARATOR . 'template.html.php';
    }
}
