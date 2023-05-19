<main class="w-full h-screen pt-28">
    <header class="flex items-center justify-between px-4 my-3">
        <h1 class="text-2xl text-cyan-950">Liste des classe</h1>
        <button class="px-8 rounded-lg py-3 bg-cyan-950 text-white" id="add-classe">Ajouter une nouvelle classe</button>
    </header>

    <ul class="grid grid-cols-4 w-full mt-8">
        <li class="text-lg text-white bg-slate-600 py-3 border-r-2 px-3">Libellé</li>
        <li class="text-lg text-white bg-slate-600 py-3 border-r-2 px-3">Effectif</li>
        <li class="text-lg text-white bg-slate-600 py-3 border-r-2 px-3">Nombre de place</li>
        <li class="text-lg text-white bg-slate-600 py-3 px-3">Action</li>
    </ul>

    <?php foreach($classes as $classe): ?>
        <ul class="grid grid-cols-4 w-full">
            <li class="text-lg text-cyan-950 py-3 border-r-2 px-3"><?= $classe->label ?></li>
            <li class="text-lg text-cyan-950 py-3 border-r-2 px-3"><?= $classe->size ?></li>
            <li class="text-lg text-cyan-950 py-3 border-r-2 px-3"><?= $classe->place_number ?></li>
            <li class="text-lg text-cyan-950 py-3 px-3 flex items-center justify-between">
                <div
                    class="flex items-center px-4 py-2 rounded-lg bg-yellow-500 shadow-sm cursor-pointer"
                    id="edit-classe">
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
    <div class="modal w-1/2 h-2/3 rounded-lg bg-white shadow-lg">
        <header class="modal-title text-2xl text-center my-3">Modification d'une classe</header>

        <section class="modal-body flex justify-center px-6 mt-8 overflow-scroll">
            <section class="modal-body-section w-2/5">
                <div class="input-group w-full mb-12">
                    <label for="" class="w-full text-lg mb-4 inline-block">Libellé</label>
                    <input
                        type="text"
                        name="" id=""
                        class="w-full px-8 py-2 rounded-lg border-2 border-slate-400"
                        placeholder="Libellé">
                </div>

                <div class="input-group w-full mb-12">
                    <label for="" class="w-full text-lg mb-4 inline-block">Effectif</label>
                    <input
                        type="text"
                        name="" id=""
                        class="w-full px-8 py-2 rounded-lg border-2 border-slate-400"
                        placeholder="Effectif">
                </div>

                <div class="input-group w-full mb-12">
                    <label for="" class="w-full text-lg mb-4 inline-block">Nombre de place</label>
                    <input
                        type="text"
                        name="" id=""
                        class="w-full px-8 py-2 rounded-lg border-2 border-slate-400"
                        placeholder="Nombre de place">
                </div>

            </section>

        </main>

        <footer class="modal-footer w-full flex justify-end items-center py-3 mt-20 px-12">
            <button class="cancel px-5 py-2 bg-red-700 text-white mr-10 rounded-lg">Annuler</button>
            <button class="save px-5 py-2 bg-green-700 text-white rounded-lg">Enregistrer</button>
        </footer>
    </div>
</div>
