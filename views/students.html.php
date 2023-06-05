<?php
    use Controller\Session;

    Session::init();

    if (!Session::isLogged()) {
        header('Location:' . HOST . trim(ROOT_PATH['login']['view'], '/'));
    }
?>
<main class="w-11/12 max-h-max">
    <header class="flex items-center justify-between px-4 my-3">
        <h1 class="text-2xl text-cyan-950 font-semibold" id="mine">Liste des élèves</h1>
        <button class="px-8 rounded-lg py-3 bg-cyan-950 text-white" id="add-new-student">
            Ajouter un nouveau élève
        </button>
    </header>

    <ul class="grid grid-cols-4 w-full mt-8 px-4">
        <li class="text-lg text-white bg-slate-600 py-3 border-r-2 px-3">Prénom</li>
        <li class="text-lg text-white bg-slate-600 py-3 border-r-2 px-3">Nom</li>
        <li class="text-lg text-white bg-slate-600 py-3 border-r-2 px-3">Classe</li>
        <li class="text-lg text-white bg-slate-600 py-3 px-3">Action</li>
    </ul>

    <?php foreach ($students as $student) : ?>
        <ul class="grid grid-cols-4 w-full px-4">
            <li class="text-lg text-cyan-950 py-3 border-r-2 px-3"><?= $student->firstname ?></li>
            <li class="text-lg text-cyan-950 py-3 border-r-2 px-3"><?= $student->lastname ?></li>
            <li class="text-lg text-cyan-950 py-3 border-r-2 px-3"><?= $student->classe ?></li>
            <li class="text-lg text-cyan-950 py-3 px-3 flex items-center justify-between">
                <div class="flex items-center px-4 py-2 rounded-lg
                          bg-yellow-500 shadow-sm cursor-pointer"
                     id="btn-edit">
                    <i class="fa-solid fa-pen-to-square text-cyan-950 text-2xl mr-4"></i>
                    <button class="text-cyan-950 text-lg inline-block">Modifier</button>
                </div>
                <i class="fa-solid fa-ellipsis text-cyan-950 text-3xl mr-6 cursor-pointer"></i>
            </li>
        </ul>
    <?php endforeach ?>

</main>

<div class="modal-container hidden absolute top-0 w-full h-full items-center justify-center">
    <form action="<?= HOST . trim(ROOT_PATH['student']['add'], '/') ?>" method="POST" id="registration-form"
            class="modal w-1/2 min-h-max max-h-max rounded-lg bg-white shadow-lg">
        <header class="modal-title text-2xl mb-3 flex items-center justify-center text-white">Ajout d'un élève</header>

        <div class="modal-body px-6 mt-8 h-2/3">
            <div class="input-group flex items-center justify-between">
                <div class="w-2/5 mb-8">
                    <label for="lastname" class="w-full text-lg mb-4 inline-block">Nom</label>
                    <input type="text" name="lastname"
                            id="lastname" class="w-full px-8 py-2 rounded-lg border-2 border-slate-400"
                            placeholder="Nom">
                    <span class="lastname-error text-red-600 text-sm mt-2"></span>
                </div>

                <div class="w-2/5 mb-8">
                    <label for="firstname" class="w-full text-lg mb-4 inline-block">Prénom</label>
                    <input type="text" name="firstname" id="firstname"
                            class="w-full px-8 py-2 rounded-lg border-2 border-slate-400"
                            placeholder="Prénom">
                    <span class="firstname-error text-red-600 text-sm mt-2"></span>
                </div>
            </div>

            <div class="input-group flex items-center justify-between">
                <div class="w-2/5 mb-8">
                    <label for="birth_date" class="w-full text-lg mb-4 inline-block">Date de naissance</label>
                    <input type="date" name="birth_date"
                            id="birth_date" class="w-full px-8 py-2 rounded-lg border-2 border-slate-400"
                            placeholder="Date de naissance">
                </div>

                <div class="w-2/5 mb-8">
                    <label for="birth_place" class="w-full text-lg mb-4 inline-block">Lieu de naissance</label>
                    <input type="text" name="birth_place" id="birth_place"
                            class="w-full px-8 py-2 rounded-lg border-2 border-slate-400"
                            placeholder="Lieu de naissance">
                </div>
            </div>

            <div class="input-group flex items-center justify-between">
                <div class="w-2/5 mb-8">
                    <label for="number" class="w-full text-lg mb-4 inline-block">Numéro</label>
                    <input type="text" name="number"
                            id="number" class="w-full px-8 py-2 rounded-lg border-2 border-slate-400"
                            placeholder="Numéro">
                </div>

                <div class="w-2/5 mb-8">
                    <label for="sex" class="w-full text-lg mb-4 inline-block">Sexe</label>
                    <div class="sex-group flex items-center">
                        <div class="sex-group-input  mr-6">
                            <input type="radio" name="sex" id="male" value="m">
                            <label for="male" class="text-lg mb-4">Masculin</label>
                        </div>
                        <div class="sex-group-input">
                            <input type="radio" name="sex" id="female" value="f">
                            <label for="female" class="text-lg mb-4">Féminin</label>
                        </div>
                    </div>
                    <span class="sex-error text-red-600 text-sm mt-2"></span>
                </div>
            </div>

            <div class="select-group w-full flex justify-between items-center">
                <div class="select-level w-2/5">
                    <span class="text-lg w-full">Niveau</span>
                    <select name="level" id="select-level" class="w-full px-4 py-2 mt-4">
                        <option selected>Choisir un niveau</option>
                        <?php foreach($levels as $level) : ?>
                            <option class="w-full" data-id="<?= $level->id_level ?>">
                                <?= $level->level_name ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                    <span class="level-error text-red-600 text-sm mt-2"></span>
                </div>

                <div class="select-classe w-2/5">
                    <span class="text-lg w-full">Classe</span>
                    <select name="classe" id="select-classe" class="w-full px-4 py-2 mt-4">
                        <option class="w-full">Choisir une classe</option>
                    </select>
                    <span class="classe-error text-red-600 text-sm mt-2"></span>
                </div>
            </div>

            <input type="hidden" class="hidden" name="id_classe" id="id_classe" value="">
        </div>

        <footer class="modal-footer w-full flex justify-end items-center py-3 px-12 h-1/6">
            <button type="button" class="px-5 py-2 bg-red-700 text-white mr-10 rounded-lg" id="cancel">Annuler</button>
            <button type="submit" class="px-5 py-2 bg-green-700 text-white rounded-lg" id="save">Enregistrer</button>
        </footer>
    </form>
</div>

<script src="<?= HOST . 'js/student.js' ?>"></script>

