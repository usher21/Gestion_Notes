<main class="w-full h-screen pt-28">
    <header class="flex items-center justify-between px-4 my-3">
        <h1 class="text-2xl text-cyan-950">Liste des élèves</h1>
        <button class="px-8 rounded-lg py-3 bg-cyan-950 text-white" id="add-new-student">Ajouter un nouveau
            élève</button>
    </header>

    <?php

    use Model\Managers\StudentManager;

    $studentManager = new StudentManager;
    $studentManager->loadStudents();
    $students = $studentManager->getStudents();
    
    ?>

    <ul class="grid grid-cols-6 w-full mt-8">
        <li class="text-lg text-white bg-slate-600 py-3 border-r-2 px-3">Nom</li>
        <li class="text-lg text-white bg-slate-600 py-3 border-r-2 px-3">Prénom</li>
        <li class="text-lg text-white bg-slate-600 py-3 border-r-2 px-3">Niveau</li>
        <li class="text-lg text-white bg-slate-600 py-3 border-r-2 px-3">Classe</li>
        <li class="text-lg text-white bg-slate-600 py-3 border-r-2  px-3">Type</li>
        <li class="text-lg text-white bg-slate-600 py-3 px-3">Action</li>
    </ul>

    <?php foreach($students as $student): ?>
        <ul class="grid grid-cols-6 w-full">
            <li class="text-lg text-cyan-950 py-3 border-r-2 px-3"><?= $student->getLastName() ?></li>
            <li class="text-lg text-cyan-950 py-3 border-r-2 px-3"><?= $student->getFirstName() ?></li>
            <li class="text-lg text-cyan-950 py-3 border-r-2 px-3"><?= $student->getLevelName() ?></li>
            <li class="text-lg text-cyan-950 py-3 border-r-2 px-3"><?= $student->getClassName() ?></li>
            <li class="text-lg text-cyan-950 py-3 border-r-2 px-3"><?= $student->getType() ?></li>
            <li class="text-lg text-cyan-950 py-3 px-3 flex items-center justify-between">
                <div class="flex items-center px-4 py-2 rounded-lg bg-yellow-500 shadow-sm cursor-pointer btn-edit">
                    <i class="fa-solid fa-pen-to-square text-cyan-950 text-2xl mr-4"></i>
                    <button class="text-cyan-950 text-lg inline-block">Modifier</button>
                </div>
                <i class="fa-solid fa-ellipsis text-cyan-950 text-3xl mr-6 cursor-pointer"></i>
            </li>
        </ul>
    <?php endforeach ?>

</main>

<div class="modal-container hidden absolute top-0 w-full h-full flex items-center justify-center">
    <span class="day" style="display: none;"></span>
    <div class="modal w-1/2 h-2/3 rounded-lg bg-white shadow-lg">
        <header class="modal-title text-2xl text-center my-3">Modification d'un élève</header>

        <main class="modal-body flex justify-between px-6 mt-8 overflow-scroll">
            <section class="modal-body-section w-2/5">
                <div class="input-group w-full mb-12">
                    <label for="" class="w-full text-lg mb-4 inline-block">Nom</label>
                    <input
                        type="text"
                        name="" id=""
                        class="w-full px-8 py-2 rounded-lg border-2 border-slate-400"
                        placeholder="Nom">
                </div>

                <div class="input-group w-full mb-12">
                    <label for="" class="w-full text-lg mb-4 inline-block">Prénom</label>
                    <input
                        type="text"
                        name="" id=""
                        class="w-full px-8 py-2 rounded-lg border-2 border-slate-400"
                        placeholder="Prénom">
                </div>

                <div class="niveau w-2/5">
                    <span class="text-lg">Niveau</span>
                    <select name="" id="" class="w-80 px-4 py-2 mt-4">
                        <option class="w-full">CI</option>
                        <option class="w-full">CP</option>
                        <option class="w-full">CE1</option>
                        <option class="w-full">CE2</option>
                        <option class="w-full">CM1</option>
                        <option class="w-full">CM2</option>
                        <option class="w-full">6e</option>
                    </select>
                </div>

            </section>

            <section class="modal-body-section">
                <div class="niveau w-2/5 mt-3">
                    <span class="text-lg">Classe</span>
                    <select name="" id="" class="w-96 px-4 py-2 mt-4">
                        <option class="w-full">CI A</option>
                        <option class="w-full">CI A</option>
                        <option class="w-full">CP B</option>
                        <option class="w-full">CE1 A</option>
                        <option class="w-full">CE2 C</option>
                        <option class="w-full">CM1 A</option>
                        <option class="w-full">CM2 B</option>
                        <option class="w-full">6e B</option>
                    </select>
                </div>

                <div class="niveau w-2/5 mt-12">
                    <span class="text-lg">Type</span>
                    <select name="" id="" class="w-96 px-4 py-2 mt-4">
                        <option class="w-full">Interne</option>
                        <option class="w-full">Externe</option>
                    </select>
                </div>

            </section>
        </main>

        <footer class="modal-footer w-full flex justify-end items-center py-3 mt-32 px-12">
            <button class="cancel px-5 py-2 bg-red-700 text-white mr-10 rounded-lg">Annuler</button>
            <button class="save px-5 py-2 bg-green-700 text-white rounded-lg">Enregistrer</button>
        </footer>
    </div>
</div>