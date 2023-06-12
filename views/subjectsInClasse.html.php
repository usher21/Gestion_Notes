<?php
    use Controller\Session;

    Session::init();

    if (!Session::isLogged()) {
        header('Location:' . HOST . trim(ROOT_PATH['login']['view'], '/'));
    }
    $idClasse = explode('/', $_SERVER['REQUEST_URI'])[count(explode('/', $_SERVER['REQUEST_URI'])) - 1];
?>

<main class="w-11/12 max-h-max">
    <header class="flex items-center justify-between px-4 my-3 mb-12 w-1/2 p-4">
        <h1 class="text-2xl text-cyan-950 font-semibold">Coefficients/Pondérations</h1>
        <a href="<?= HOST . trim(trim(ROOT_PATH['student']['in-classe'], '{param}'), '/') . '/' . $idClasse ?>"
           class="text-lg font-semibold underline underline-offset-4 px-10 py-1 bg-cyan-700 text-white">
            <?= $className ?>
        </a>
    </header>

    <section class="w-10/12 mx-auto bg-white rounded-xl shadow-xl">
        <header class="grid grid-cols-[1fr_1fr_1fr_150px] w-full">
            <div class="bg-slate-300 py-3 border-r-2 px-3 text-lg text-cyan-950 font-bold">Disciplines</div>
            <div class="bg-slate-300 py-3 border-r-2 px-3 text-lg text-cyan-950 font-bold">Ressource</div>
            <div class="bg-slate-300 py-3 border-r-2 px-3 text-lg text-cyan-950 font-bold">Examen</div>
            <div class="bg-slate-300 py-3 border-r-2 px-3 text-lg text-cyan-950 font-bold">Action</div>
        </header>

        <section class="subjects-container">
        <?php foreach($subjects as $subject) : ?>
            <div class="grid grid-cols-[1fr_1fr_1fr_150px] w-full border-b-2"
                 data-id="<?= $subject->id_subject_classe ?>" data-selector="container-<?= $subject->id ?>">
                
                <div class="py-3 border-r-2 px-3 text-lg text-cyan-950">
                    <?= $subject->subject ?>
                </div>
                
                <div class="py-3 border-r-2 px-3 text-lg text-cyan-950">
                    <input type="number" name="" id="" value="<?= $subject->ressource ?>"
                           data-type="ressource" data-current="<?= $subject->ressource ?>"
                           class="px-4 py-1 border-2 rounded-lg border-cyan-900 w-1/2">
                </div>
                
                <div class="py-3 border-r-2 px-3 text-lg text-cyan-950">
                    <input type="number" name="" id="" value="<?= $subject->examen ?>"
                           data-type="exam" data-current="<?= $subject->examen ?>"
                           class="px-4 py-1 border-2 rounded-lg border-cyan-900 w-1/2">
                </div>

                <div class="py-3 border-r-2 px-3 text-lg text-cyan-950 flex items-center justify-center">
                    <span class="text-3xl text-red-700 cursor-pointer delete-subject
                                 hover:px-6 hover:py-1 hover:text-white hover:bg-red-600"
                          data-id="<?= $subject->id ?>" data-classe="<?= $idClasse ?>">
                        &times;
                    </span>
                </div>
            
            </div>
        <?php endforeach ?>
        </section>
    </section>
    <div class="w-full flex items-center justify-center mt-8">
        <button class="px-6 py-2 bg-cyan-900 text-white rounded-lg" id="btn-update">Mettre à jour</button>
    </div>
</main>

<script src="<?= HOST . 'js/subjectInClasse.js' ?>" type="module"></script>
