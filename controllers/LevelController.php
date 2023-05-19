<?php

namespace Controller;

use Model\Level;

class LevelController
{
    public function list()
    {
        ob_start();
        $levels = Level::list();
        require_once VIEWS . DIRECTORY_SEPARATOR . 'levels.html.php';
        $content = ob_get_clean();
        require_once VIEWS . DIRECTORY_SEPARATOR . 'template.html.php';
    }
}
