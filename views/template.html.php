<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/utils.php' ?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Accueil</title>
    <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST']?>/css/style.css">
    <script src="http://<?= $_SERVER['HTTP_HOST']?>/js/script.js" defer></script>
</head>

<body>
    <header class="min-w-full w-full bg-white fixed shadow-lg">
        <nav class="flex items-center px-28 py-5">
            <img
                src="<?= $_SERVER['HTTP_HOST']?>/views/assets/img/7749636.jpg"
                alt=""
                class="w-12 cursor-pointer rounded-full">

            <ul class="flex-1 text-center list-none">
                <?= navItem('/home', 'Accueil') ?>
                <?= navItem('/student', 'Élèves') ?>
                <?= navItem('/classe', 'Classes') ?>
                <?= navItem('/level', 'Niveaux') ?>
            </ul>

            <div class="border-2 w-11 h-11 flex items-center justify-center border-cyan-950 rounded-full">
                <i class="fa-solid fa-user text-black cursor-pointer text-3xl"></i>
            </div>
        </nav>
    </header>

    <?= $content ?>
    <?php // require_once $_SERVER['DOCUMENT_ROOT']. '/../views/html' . $_SERVER['REQUEST_URI'] . '.html.php' ?>

</body>

</html>
