<?php

class Controller
{
    public static function render(string $filename, $data = [])
    {
        ob_start();
        require_once VIEWS . DIRECTORY_SEPARATOR . $filename;
        $content = ob_get_clean();
        require_once VIEWS . DIRECTORY_SEPARATOR . 'template.html.php';
    }
}
