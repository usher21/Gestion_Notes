<?php
    use Controller\Session;

    Session::init();
    
    if (!Session::isLogged()) {
        header('Location:' . HOST .trim(ROOT_PATH['login']['view'], '/'));
    }
?>
<main class="w-11/12 max-h-max shadow-xl rounded-lg p-4">
    <header class="flex items-center justify-between px-4 my-3">
        <h1 class="text-2xl text-cyan-950 font-semibold">Liste des classe</h1>
        <button class="px-8 rounded-lg py-3 bg-cyan-950 text-white" id="add-classe">
            Ajouter une nouvelle classe
        </button>
    </header>

    <ul class="grid grid-cols-2 w-full mt-8 px-4">
        <li class="text-lg text-white bg-slate-600 py-3 border-r-2 px-3">Libellé</li>
        <li class="text-lg text-white bg-slate-600 py-3 px-3">Action</li>
    </ul>

    <?php foreach($classes as $classe): ?>
        <ul class="grid grid-cols-2 w-full px-4">
            <li class="text-lg text-cyan-950 py-3 border-r-2 px-3"><?= $classe->class_name ?></li>
            <li class="text-lg text-cyan-950 py-3 px-3 flex items-center justify-between"
                data-id="<?= $classe->id ?>" data-id-level="<?= $classe->id_level ?>">
                <div
                    class="flex items-center px-4 py-2 rounded-lg
                         bg-yellow-500 shadow-sm cursor-pointer edit-classe">
                    <i class="fa-solid fa-pen-to-square text-cyan-950 text-2xl mr-4"></i>
                    <button class="text-cyan-950 text-lg inline-block">Modifier</button>
                </div>
                <i class="fa-solid fa-ellipsis text-cyan-950 text-3xl mr-6 cursor-pointer"></i>
            </li>
        </ul>
    <?php endforeach ?>

</main>

<div class="modal-container hidden absolute top-0 w-full h-full items-center justify-center" id="edit-classe-modal">
    <span class="day" style="display: none;"></span>
    <form
        action="<?= HOST . trim(ROOT_PATH['classe']['add'], '/') ?>"
        method="POST"
        class="modal w-1/2 h-96 rounded-lg bg-white shadow-lg relative"
        id="class-form">

        <header class="modal-title text-2xl text-center my-3" id="modal-title">
            Ajout de classe
        </header>

        <section class="modal-body w-full flex justify-between px-6 mt-20">
            <div class="input-group w-2/5">
                <label for="classe-label" class="w-full text-lg inline-block">Libellé</label>
                <input
                    type="text"
                    name="label" id="classe-label"
                    class="w-80 px-8 py-2 my-4 rounded-lg border-2 border-slate-400"
                    placeholder="Libellé">
                <span id="alert-classe" class="text-red-700 text-sm hidden">
                    Veuillez remplir le libellé de la classe
                </span>
            </div>

            <div class="w-2/5 mr-8">
                <span class="text-lg">Séléctionner le niveau de cette classe</span>
                <select name="level_name" id="classe-select" class="w-96 px-4 py-2 mt-4">
                    <?php foreach ($levels as $level) : ?>
                        <option class="w-full" data-id="<?= $level->id_level ?>">
                            <?= $level->level_name ?>
                        </option>
                    <?php endforeach ?>
                </select>
                <input type="text" class="hidden" id="id_level" name="id_level">
                <input type="text" class="hidden" id="id" name="id">
            </div>
        </section>

        <footer class="modal-footer w-full flex justify-end items-center py-3 mt-20 px-12 absolute bottom-2">
            <button type="button" class="px-5 py-2 bg-red-700 text-white mr-10 rounded-lg" id="cancel">Annuler</button>
            <button type="submit" class="px-5 py-2 bg-green-700 text-white rounded-lg" id="save">Enregistrer</button>
        </footer>
    </form>
</div>

<script src="<?= HOST ?>js/classe.js"></script>

