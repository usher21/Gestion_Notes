<?php
    use Controller\Session;

    Session::init();

    if (!Session::isLogged()) {
        header('Location:' . HOST . trim(ROOT_PATH['login']['view'], '/'));
    }
?>
<main class="w-5/6 h-full shadow-xl rounded-lg p-4">
    <?php if(isset($_SESSION['error'])) : ?>
            <div class="bg-red-700 max-w-xl text-xl font-semibold relative left-1/2 mx-4 py-2
                    rounded-lg text-center -z-10 -translate-x-1/2 text-white">
                <?= $_SESSION['error'] ?>
            </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif ?>
    <header class="flex items-center justify-between px-4 my-3">
        <h1 class="text-2xl text-cyan-950 font-semibold">Liste des niveaux</h1>
        <button class="px-8 rounded-lg py-3 bg-cyan-950 text-white" id="add-level">
            Ajouter un niveau
        </button>
    </header>
    
    <section class="w-full mt-12">
        <?php foreach ($levels as $level) : ?>
            <div class="grid grid-cols-1 w-full odd:bg-slate-300">
                <a href="<?= HOST . trim(trim(ROOT_PATH['classe']['by-level'], '{param}'), '/')?>/<?= $level->id_level ?>"
                    class="text-lg text-cyan-950 py-3 px-3
                        hover:bg-slate-400 hover:cursor-pointer">
                        <?= $level->level_name ?>
                </a>
            </div>
        <?php endforeach ?>
    </section>

</main>

<form
    action="<?= HOST . trim(ROOT_PATH['level']['add'], '/') ?>"
    method="POST" id="form"
    class="modal w-80 -right-80 duration-100 absolute h-52 rounded-lg shadow-lg p-3 opacity-0">

    <span class="absolute right-3 top-3 bg-red-700 w-10 rounded-md text-xl h-6 cursor-pointer
                 flex items-center justify-center text-white"
          id="closeModal">
        &times;
    </span>

    <div class="input-group mt-6 w-full">
        <label for="level-label" class="w-full text-xl inline-block">Libellé</label>
        <input
            type="text"
            name="label" id="level-label"
            class="w-full px-8 py-2 my-4 rounded-lg border-2 border-slate-400"
            placeholder="Libellé">
        <span id="alert-level" class="text-red-700 text-sm hidden">
            Veuillez remplir le libellé du niveau
        </span>
    </div>

    <button type="submit"
            class="px-5 py-3 bg-slate-700 w-full text-white rounded-md"
            id="save">
        Enregistrer
    </button>
</div>

<script src="<?= HOST ?>js/level.js"></script>

