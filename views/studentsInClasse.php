<?php
    use Controller\Session;

    Session::init();

    if (!Session::isLogged()) {
        header('Location:' . HOST . trim(ROOT_PATH['login']['view'], '/'));
    }
?>
<main class="w-11/12 max-h-max">
    <header class="flex items-center justify-between px-4 my-3 mb-12">
        <h1 class="text-2xl text-cyan-950 font-semibold" id="mine">
            Liste des élèves de la classe <?= $classeName ?>
        </h1>
        <button class="px-8 rounded-lg py-3 bg-cyan-950 text-white" id="add-new-student">
            Ajouter un nouveau élève
        </button>
    </header>

    <?php foreach ($students as $student) : ?>
        <ul class="grid grid-cols-2 w-full even:bg-slate-300">
            <li class="text-lg text-cyan-950 py-3 border-r-2 px-3"><?= $student->firstname ?></li>
            <li class="text-lg text-cyan-950 py-3 border-r-2 px-3"><?= $student->lastname ?></li>
        </ul>
    <?php endforeach ?>

</main>

<div class="hidden absolute top-0 w-full min-h-max h-full max-h-max
            items-center justify-center bg-black/40" id="modal-container">
    <form action="<?= HOST . trim(ROOT_PATH['student']['add'], '/') ?>" id="registration-form"
          enctype="multipart/form-data" method="POST"
          class="modal w-1/2 min-h-max max-h-max h-max bg-white shadow-lg rounded-2xl">
        <header class="text-2xl px-8 mt-6 relative font-semibold
                       rounded-t-2xl text-slate-700"
                id="modal-title">
            Ajout d'un élève
            <span class="text-2xl text-slate-600 w-10 h-10 absolute top-0 right-4 cursor-pointer
                         rounded-full bg-slate-200 flex items-center justify-center"
                   id="closeModal">
                &times;
            </span>
        </header>

        <div class="py-3 w-full flex items-center justify-center" id="img-container">
            <div class="img rounded-full w-36 h-36 border-2 border-slate-100 relative"
                 id="image-container">
                <img
                    src="<?= HOST ?>assets/img/default.jpg"
                    alt="Default Student Image"
                    class="w-full h-full object-cover cursor-pointer rounded-full">
                <div class="bg-black/50 absolute w-full h-full top-0 left-0 cursor-pointer hover:opacity-80
                            rounded-full flex items-center justify-center text-center text-white"
                            id="choose-image">
                    Choisir une image
                </div>
            </div>
            <input type="file" id="upload-file"
                   accept="image/jpg; image/png; image/jpeg"
                   name="image" class="hidden">
        </div>

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

            <div class="group w-full flex justify-between items-center">
                <div class="level-group w-2/5">
                    <span class="text-lg w-full">Niveau</span>
                    <input type="text" class="w-full px-8 py-2 my-4 rounded-lg border-2"
                           disabled placeholder="<?= $levelName->label ?>" value="">
                    <input type="hidden" class="hidden"
                           id="id_level" name="id_level"
                           value="<?= $levelName->id ?>">
                </div>

                <div class="classe-group w-2/5">
                    <span class="text-lg w-full">Classe</span>
                    <input type="text" class="w-full px-8 py-2 my-4 rounded-lg border-2"
                           disabled placeholder="<?= $classeName ?>" value="">
                    <input type="hidden" class="hidden"
                           id="id_classe" name="id_classe"
                           value="<?= explode('/', $_SERVER['REQUEST_URI'])[count(explode('/', $_SERVER['REQUEST_URI'])) - 1] ?>">
                </div>
            </div>

        </div>

        <footer class="w-full flex justify-end rounded-b-2xl items-center
                       bg-white mb-6 mt-10 pr-6"
                       id="modal-footer">
            <!-- <button type="button" class="px-5 py-2 bg-slate-700 text-white mr-10 rounded-lg" id="cancel">
                Annuler
            </button> -->
            <button type="submit" class="px-5 py-3 bg-slate-700 w-72 text-white rounded-lg" id="save">
                Enregistrer
            </button>
        </footer>
    </form>
</div>

<script src="<?= HOST ?>js/studentInClasse.js"></script>

