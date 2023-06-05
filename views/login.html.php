<?php
    use Controller\Session;

    Session::init();
    
    if (Session::isLogged()) {
        header('Location:' . HOST . trim(ROOT_PATH['level']['list']));
    }
?>
<div class="bg-white shadow-xl w-4/6 bloc-contain rounded-lg flex relative left-1/2 -translate-x-1/2">
    <div class="h-full bg-slate-400 w-2/4 bg-[url('../assets/img/7749636.jpg')] bg-center bg-cover"></div>
    <div class="h-full w-2/4">
        <h1 class="text-4xl font-semibold text-center mt-20">Bienvenue</h1>
        <form method="post" action="<?= HOST . trim(ROOT_PATH['login']['check'], '/') ?>"
                class="w-full flex flex-col items-center mt-20"
                id="login-form">
            <div class="input-group w-3/4 mb-12">
                <label for="login" class="w-full text-xl mb-4 inline-block">Login</label>
                <input type="text" name="login"
                        id="login" class="w-full px-8 py-3 rounded-lg
                        border-2 border-slate-400"
                        placeholder="Login">
                <span class="text-red-700 text-base mt-2 block" id="login-error"></span>
            </div>

            <div class="input-group w-3/4">
                <label for="passwd" class="w-full text-xl mb-4 inline-block">Mot de passe</label>
                <input type="password" name="passwd"
                        id="passwd" class="w-full px-8 py-3
                        rounded-lg border-2 border-slate-400"
                        placeholder="Mot de passe">
                <span class="text-red-700 text-base mt-2 block" id="passwd-error"></span>
            </div>

            <span class="text-red-700 text-lg mt-4 block" id="incorrect"></span>
            <button type="submit" class="w-3/4 px-8 py-3
                                text-center mt-14 bg-cyan-950
                                rounded-lg text-white" name="btn-connect" id="btn-connect">
                Se connecter
            </button>
        </form>
    </div>
</div>

<script src="<?= HOST ?>js/Login.js"></script>
