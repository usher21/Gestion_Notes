<main class="w-full h-screen pt-28">
    <header class="flex items-center justify-between px-4 my-3">
        <h1 class="text-2xl text-cyan-950">Liste des niveaux</h1>
        <button class="px-8 rounded-lg py-3 bg-cyan-950 text-white" id="add-new-level">Ajouter un niveau</button>
    </header>
    
    <section class="w-full">
        <ul class="grid grid-cols-4 w-full mt-8">
            <li class="text-lg text-white bg-slate-600 py-3 border-r-2 px-3">#</li>
            <li class="text-lg text-white bg-slate-600 py-3 border-r-2 px-3">Libellé</li>
            <li class="text-lg text-white bg-slate-600 py-3 border-r-2 px-3">Groupe</li>
            <li class="text-lg text-white bg-slate-600 py-3 border-r-2 px-3">Action</li>
        </ul>

        <?php foreach ($levels as $level) : ?>
            <ul class="grid grid-cols-4 w-full">
                <li class="text-lg text-cyan-950 py-3 border-r-2 px-3"><?= $level->id_level ?></li>
                <li class="text-lg text-cyan-950 py-3 border-r-2 px-3"><?= $level->level ?></li>
                <li class="text-lg text-cyan-950 py-3 border-r-2 px-3"><?= $level->group_name ?></li>
                <li class="text-lg text-cyan-950 py-3 px-3 flex items-center justify-between">
                    <div
                        class="flex items-center px-4 py-2 rounded-lg bg-yellow-500 shadow-sm cursor-pointer"
                        id="btn-edit">
                        <i class="fa-solid fa-pen-to-square text-cyan-950 text-2xl mr-4"></i>
                        <button class="text-cyan-950 text-lg inline-block">Modifier</button>
                    </div>
                    <i class="fa-solid fa-ellipsis text-cyan-950 text-3xl mr-6 cursor-pointer"></i>
                </li>
            </ul>
        <?php endforeach ?>
    </section>

</main>

<div class="modal-container hidden absolute top-0 w-full h-full flex items-center justify-center">
    <span class="day" style="display: none;"></span>
    <div class="modal w-1/2 h-2/5 rounded-lg bg-white shadow-lg">
        <header class="modal-title text-2xl text-center my-3">Ajouter un nouveau</header>

        <main class="modal-body flex justify-between px-6 mt-8 overflow-scroll">
            <section class="modal-body-section w-2/5">
                <div class="input-group w-full mb-12">
                    <label for="" class="w-full text-lg mb-4 inline-block">Libellé</label>
                    <input
                        type="text"
                        name="" id=""
                        class="w-full px-8 py-2 rounded-lg border-2 border-slate-400"
                        placeholder="Nom">
                </div>

                <div class="niveau w-2/5">
                    <span class="text-lg">Goupe de niveau</span>
                    <select name="" id="" class="w-80 px-4 py-2 mt-4">
                        <option class="w-full">Choisir un groupe de niveau</option>
                        <option class="w-full">Enseignement primaire</option>
                        <option class="w-full">Enseignement secondaire inférieur</option>
                        <option class="w-full">Enseignement secondaire supérieur</option>
                    </select>
                </div>

            </section>
        </main>

        <footer class="modal-footer w-full flex justify-end items-center py-3 mt-4 px-12">
            <button class="cancel px-5 py-2 bg-red-700 text-white mr-10 rounded-lg">Annuler</button>
            <button class="save px-5 py-2 bg-green-700 text-white rounded-lg">Enregistrer</button>
        </footer>
    </div>
</div>
