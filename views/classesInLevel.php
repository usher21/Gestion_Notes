<?php
    use Controller\Session;

    Session::init();
    
    if (!Session::isLogged()) {
        header('Location:' . HOST . trim(ROOT_PATH['login']['view'], '/'));
    }
?>
<main class="w-3/5 ml-96 max-h-max shadow-xl rounded-lg p-4">
    <header class="flex items-center justify-between px-4 my-3 mb-12">
        <h1 class="text-2xl text-cyan-950 font-semibold">Liste des classe <?= strtolower($levelName) . 's' ?></h1>
        <button class="px-8 rounded-lg py-3 bg-cyan-950 text-white" id="add-classe">
            Ajouter une nouvelle classe
        </button>
    </header>

    <?php foreach($classes as $classe): ?>
        <div class="grid grid-cols-1 w-full even:bg-slate-300">
            <a href="<?= HOST .  trim(trim(ROOT_PATH['student']['in-classe'], '{param}'), '/') ?>/<?= $classe->id_classe ?>"
            class="text-lg text-cyan-950 py-3 px-3">
                <?= $classe->classe ?>
            </a>
        </div>
    <?php endforeach ?>

</main>

<form
    action="<?= HOST . trim(ROOT_PATH['classe']['add'], '/') ?>"
    method="POST" id="form"
    class="modal w-80 -right-80 duration-100 absolute h-80 rounded-lg shadow-lg p-3 opacity-0">

    <span class="absolute right-3 top-3 bg-red-700 w-10 rounded-md text-xl h-6 cursor-pointer
                 flex items-center justify-center text-white"
          id="closeModal">
        &times;
    </span>

    <div class="input-group mt-6 w-full">
        <label for="classe-label" class="w-full text-xl inline-block">Libellé</label>
        <input
            type="text" name="label" id="classe-label" placeholder="Libellé"
            class="w-full px-8 py-2 my-4 rounded-lg border-2 border-slate-400">
        <span id="alert-classe" class="text-red-700 text-sm hidden">
            Veuillez remplir le libellé de la classe
        </span>
        <label for="classe-label" class="w-full text-xl inline-block">Niveau</label>
        <input type="text" class="w-full px-8 py-2 my-4 rounded-lg border-2"
               disabled placeholder="<?= $levelName ?>" value="">
        <input type="hidden" class="hidden" id="id_level" name="id_level"
               value="<?= explode('/', $_SERVER['REQUEST_URI'])[count(explode('/', $_SERVER['REQUEST_URI'])) - 1] ?>">
    </div>

    <button type="submit"
            class="px-5 py-3 bg-slate-700 w-full text-white rounded-md mt-3"
            id="btn-save">
        Enregistrer
    </button>
</div>

<script src="<?= HOST ?>js/classInLevel.js"></script>

