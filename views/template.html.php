<?php

use Controller\Session;

Session::init();
require_once $_SERVER['DOCUMENT_ROOT'] . '/utils.php';

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&
            family=Roboto:wght@300;400;500;700;900&family=Tilt+Warp&display=swap"
          rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Accueil</title>
    <link rel="stylesheet" href="<?= HOST ?>css/style.css">
    <!-- <link rel="stylesheet" href="<?= HOST ?>css/tailwind.css"> -->
</head>

<body class="font-poppins">

    <?php if (Session::isLogged()) : ?>
        <header class="min-w-full w-full bg-white fixed shadow-lg">
            <nav class="flex justify-between items-center pl-28 pr-8 py-5">
                <img
                    src="<?= HOST ?>assets/img/7749636.jpg"
                    alt="logo breukh'S School"
                    class="w-12 cursor-pointer rounded-full">

                <div class="text-center text-white text-lg font-semibold bg-cyan-700 px-3 py-1">
                    <?= $_SESSION['current_year']->label ?>
                </div>

                <a href="<?= HOST . trim(ROOT_PATH['login']['disconnect'], '/') ?>"
                    class="bg-red-700 text-lg text-white rounded-lg px-5 py-2">
                    Se déconnecter
                </a>
            </nav>
        </header>
    <?php endif ?>

    <div class="flex w-full max-h-max min-h-screen pt-28">
        <?php if (Session::isLogged()) : ?>
            <aside class="w-72 min-h-screen border-r-2">
                <header class="text-2xl text-cyan-950 font-bold text-center my-10">
                    Menu
                </header>
                <ul class="flex flex-col text-left list-none">
                    <?= navItem(trim(ROOT_PATH['schoolyear']['list'], '/'), 'Annèe scolaire') ?>
                    <?= navItem(trim(ROOT_PATH['student']['list'], '/'), 'Élèves') ?>
                    <?= navItem(trim(ROOT_PATH['classe']['list'], '/'), 'Classes') ?>
                    <?= navItem(trim(ROOT_PATH['level']['list'], '/'), 'Niveaux') ?>
                    <?= navItem(trim(ROOT_PATH['subject']['view'], '/'), 'Discipline') ?>
                </ul>
            </aside>

        <?php endif ?>
            
        <?= $content ?>
            
    </div>

</body>

</html>

