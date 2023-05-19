<?php

namespace Controller;

use Model\Classe;

class ClasseController
{
    public function list()
    {
        ob_start();
        $classes = Classe::list();
        require_once VIEWS . DIRECTORY_SEPARATOR . 'classes.html.php';
        $content = ob_get_clean();
        require_once VIEWS . DIRECTORY_SEPARATOR . 'template.html.php';
    }
}
