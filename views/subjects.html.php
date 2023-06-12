<?php
    use Controller\Session;

    Session::init();

    if (!Session::isLogged()) {
        header('Location:' . HOST . trim(ROOT_PATH['login']['view'], '/'));
    }
?>

<main class="w-11/12 rounded-xl p-10 shadow-xl mx-auto">
    <h1 class="text-4xl font-semibold text-cyan-800">Gestion des disciplines</h1>

    <section class="container mt-14">

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
                <span class="text-red-600 text-sm mt-2" id="classe-error"></span>
            </div>
        </div>

        <div class="select-group w-full flex justify-between items-center mt-8">
            <div class="select-subject-group w-2/5">
                <span class="text-lg w-full">Groupe discipline</span>
                <select name="subject-group" id="select-subject-group" class="w-full px-4 py-2 mt-4">
                    <option selected>Choisir un groupe</option>
                    <option id="new-subject-group" data-info="new-group">Nouveau</option>
                    <?php foreach($subjectGroups as $subjectGroups) : ?>
                        <option class="w-full" data-id="<?= $subjectGroups->id ?>">
                            <?= $subjectGroups->label ?>
                        </option>
                    <?php endforeach ?>
                    <option class="w-full" data-id="0" id="other-group">
                        Autre
                    </option>
                </select>
                <span class="text-red-600 text-sm mt-2 block" id="empty-subject-group"></span>
            </div>

            <div class="select-classe w-2/5">
                <label for="subject" class="text-lg w-full">Discipline</label>
                <div class="input-group flex w-full mt-4">
                    <input type="text" name="subject" id="subject" placeholder="Ex : Physique Chimie"
                           class="w-11/12 px-4 py-2 border-2 border-cyan-800 rounded-l-xl">
                    <button type="button" id="add-new-subject"
                            class="px-4 py-2 bg-cyan-800 text-white text-lg rounded-r-xl w-1/6">
                            Ajouter
                    </button>
                </div>
                <span class="text-red-600 text-sm mt-3 block" id="subject-error"></span>
            </div>
        </div>

    </section>

    <div class="border-t-2 mt-8"></div>

    <section class="mt-8">
        <h3 class="text-3xl font-medium text-cyan-800" id="subject-title"></h3>
        <h3 class="text-lg text-red-700 mt-2 hidden" id="deleted-info">
            Vous pouvez décocher une discipline pour la retirer de la classe
        </h3>
        <section class="w-full p-14 bg-slate-100 rounded-xl mt-8 flex items-center flex-wrap gap-3" id="subject-group-container">

            <!-- <div class="subject-container max-h-96 relative pt-8 px-3 pb-4 mb-12 ml-12 w-80 bg-white rounded-xl">
                <legend class="absolute -top-6 text-xl bg-slate-100 p-2 rounded-xl">Langue et communication</legend>
                <div class="mb-2 flex">
                    <input type="checkbox" name="" id="" class="w-8">
                    <label for="" class="text-lg">Vocabulaire littérature littérature littérature littérature</label>
                </div>

                <div class="mb-2">
                    <input type="checkbox" name="" id="" class="w-8">
                    <label for="" class="text-lg">Écriture</label>
                </div>

                <div>
                    <input type="checkbox" name="" id="" class="w-8">
                    <label for="" class="text-lg">Art et littérature</label>
                </div>
            </div> -->

            <div class="text-xl text-cyan-700 text-center w-full flex item-center justify-center">
                Choisir une classe pour afficher ses discipline ici
            </div>

        </section>
        <section class="flex items-center justify-end mt-12">
            <button class="px-8 py-2 bg-cyan-800 text-white text-lg rounded-lg disabled:bg-cyan-800/50" id="btn-update">Mettre à jour</button>
        </section>
    </section>
</main>

<div class="absolute top-0 left-0 z-10 w-full h-full bg-black/20 flex justify-center hidden" id="subject-group-form-container">
    <form action="<?= HOST . trim(ROOT_PATH['subject-group']['add'], '/') ?>"
          class="w-96 h-1/4 max-h-max bg-white rounded-xl mt-12 p-4 relative"
          id="subject-group-form">
        <span class="text-2xl text-slate-600 w-8 h-8 absolute top-2 right-4 cursor-pointer
                     rounded-full bg-slate-200 flex items-center justify-center
                     hover:outline-none focus:outline-none"
              id="closeModal">
            &times;
        </span>
        <div class="input-group mt-4">
            <label for="subject-group" class="w-full text-xl">Libellé: </label>
            <input type="text" name="subject-group" id="subject-group"
                   placeholder="Ex : Langue et communication"
                   class="w-full px-8 py-2 border-2 border-cyan-800 mt-4 rounded-lg">
            <span class="text-red-600 text-sm mt-4 block" id="subject-group-error"></span>
        </div>
        <div class="w-full flex justify-end">
            <button type="submit" class="px-6 py-2 bg-cyan-800 text-white mt-8 rounded-lg">
                Valider
            </button>
        </div>
    </form>
</div>

<div
    class="alert -left-3/4 max-w-2xl flex items-center justify-between fixed bottom-8 p-6
           rounded-lg bg-white shadow-2xl border-l-4 border-green-500">
    <i class="fa-sharp fa-solid fa-circle-check mr-4 text-green-500 text-2xl"></i>
    <div class="flex flex-col">
        <h3 class="text-lg font-semibold" id="title">Licence 1: mise à jour efféctuée</h3>
        <span class="text-sm" id="content">Des disciplines ont étés supprimées depuis cette classe</span>
    </div>
    <span class="text-3xl text-red-700/80 ml-4 cursor-pointer" id="closeAlert">&times;</span>
</div>

<script src="<?= HOST ?>js/subject/main.js" type="module"></script>

