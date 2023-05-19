<?php

function dd($data)
{
    echo '<pre>';
    print_r($data);
    echo '</pre>';
}

function navItem(string $page, string $pageName)
{
    $bgColor = "bg-cyan-600";
    $textColor = "text-white";

    if ('/' . explode('/', trim($_SERVER['REQUEST_URI'], '/'))[0] === $page) {
        return <<<HTML
        <li class="px-8 py-2 inline-block rounded-lg $bgColor bg-cyan-600 nav-item">
            <a href="http://localhost:8000$page/list" class="no-underline $textColor text-lg">$pageName</a>
        </li>
HTML;
    }

    return <<<HTML
        <li class="px-8 py-2 inline-block rounded-lg hover:bg-cyan-600 nav-item">
            <a href="http://localhost:8000$page/list" class="no-underline text-black text-lg">$pageName</a>
        </li>
HTML;
}
