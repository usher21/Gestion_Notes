<?php
    use Controller\Session;

    Session::init();

    if (!Session::isLogged()) {
        header('Location:' . HOST . trim(ROOT_PATH['login']['view'], '/'));
    }
?>
<main class="w-11/12">
    <header class="flex items-center justify-between w-11/12 m-auto">
        <h2 class="text-3xl text-cyan-900 text-center mt-8">Années scolaires</h2>
        <form action="<?= HOST . trim(ROOT_PATH['schoolyear']['add'], '/') ?>"
              method="POST" class="max-w-7xl flex">
            <div class="input-group max-w-3xl">
                <input type="text" name="label"
                    id="year_label" class="px-4 py-3 text-sm border-2 border-cyan-900 w-full"
                    placeholder="Ajouter une nouvelle année scolaire">
            </div>
            <button type="submit"
                    class="px-8 py-3 bg-cyan-950 text-white
                           rounded-lg rounded-tl-none rounded-bl-none ">
                Ajouter
            </button>
        </form>
    </header>

    <?php
    
    if (isset($_SESSION['error']) && !empty($_SESSION['error'])) {
        $error = $_SESSION['error'];
        echo <<<HTML
            <div class="bg-red-500 max-w-3xl text-xl font-semibold relative left-1/2 mx-4 py-3
                    rounded-lg text-center -z-10 -translate-x-1/2 text-white">
                $error
            </div>
HTML;
        unset($_SESSION['error']);
    }
    
    ?>

    <section class="w-11/12 rounded-lg shadow-lg
                    mx-auto mt-14
                    flex items-center flex-wrap px-10">
        <?php foreach ($schoolYears as $schoolYear) : ?>
            <div class="h-40 w-60 border border-cyan-950 relative
                        flex items-center justify-center text-4xl
                        <?= $schoolYear->status == 1 ? 'bg-green-700 text-white' : '' ?>
                        <?= $schoolYear->status == 0 ? 'hover:bg-cyan-900 hover:text-white' : '' ?>
                        cursor-pointer mr-16 my-16 shadow-lg rounded-lg"
                        id="year-container" data-id=<?= $schoolYear->id ?>>
                <?= $schoolYear->label ?>
                
                <a href="<?= HOST . trim(ROOT_PATH['schoolyear']['edit'], '/') ?>"
                   class="fa-solid fa-pen-to-square mr-4 absolute top-2 right-8
                          text-2xl text-yellow-500 hidden" id="edit-year">
                </a>

                <?php if($schoolYear->status == 0): ?>
                    <a href="<?= HOST . trim(trim(ROOT_PATH['schoolyear']['enable'], '{param}'), '/') . '/' ?><?= $schoolYear->id ?>"
                    class="absolute top-3 right-24 px-3 py-1 rounded-lg
                            text-sm text-cyan-950 bg-slate-200 hidden" id="enable-year">
                        activer
                    </a>

                    <a href="<?= HOST . trim(trim(ROOT_PATH['schoolyear']['delete'], '{param}'), '/') . '/' ?><?= $schoolYear->id ?>"
                       class="fa-solid fa-trash absolute top-2 right-2
                              text-2xl text-red-500 hidden" id="trash-icon">
                    </a>
                <?php endif ?>

                <input type="text" class="w-full px-1 py-4 text-center text-black text-xl
                               absolute top-16 border-0 hidden"
                               id="edit-year-input"
                               placeholder="Entrer la nouvelle année">
            </div>
        <?php endforeach ?>
    </section>

</main>

<script src="<?= HOST ?>js/schoolyear.js"></script>

