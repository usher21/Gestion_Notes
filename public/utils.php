<?php

use Controller\Session;

Session::init();

function dd($data)
{
    echo '<pre>';
    print_r($data);
    echo '</pre>';
}

function navItem(string $page, string $pageName)
{
    $bgColor = "bg-cyan-900";
    $textColor = "text-white";
    $host = HOST;

    if (
        strtolower(explode('/', trim($_SERVER['REQUEST_URI'], '/'))[0])
        ===
        strtolower(explode('/', trim($page, '/'))[0])
    ) {
        return <<<HTML
        <li class="px-8 py-2 inline-block $bgColor hover:cursor-pointer nav-item">
            <i class="fa-sharp fa-regular fa-screen-users"></i>
            <a href="$host$page" class="no-underline $textColor text-lg">$pageName</a>
        </li>
HTML;
    }

    return <<<HTML
        <li class="px-8 py-2 inline-block hover:text-white hover:cursor-pointer hover:bg-cyan-900 nav-item">
            <i class="fa-sharp fa-regular fa-screen-users"></i>
            <a href="$host$page"
               class="no-underline text-inherit text-lg">
               $pageName
            </a>
        </li>
HTML;
}
