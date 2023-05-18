<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Accueil</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body class="body-home">
    <header class="min-w-full w-full bg-white fixed shadow-lg">
        <nav class="flex items-center px-28 py-5">

            <img src="../assets/img/7749636.jpg" alt="" class="w-12 cursor-pointer rounded-full">

            <ul class="flex-1 text-center list-none">
                <li class="px-8 py-2 inline-block rounded-lg bg-cyan-600 nav-item">
                    <a href="home.html" class="no-underline text-white text-lg">Accueil</a>
                </li>
                <li class="px-8 py-2 inline-block rounded-lg hover:bg-cyan-600 nav-item">
                    <a href="students.html" class="no-underline text-black text-lg">Élèves</a>
                </li>
                <li class="px-8 py-2 inline-block rounded-lg hover:bg-cyan-600 nav-item">
                    <a href="classes.html" class="no-underline text-black text-lg">Classes</a>
                </li>
                <li class="px-8 py-2 inline-block rounded-lg hover:bg-cyan-600 nav-item">
                    <a href="levels.html" class="no-underline text-black text-lg">Niveaux</a>
                </li>
            </ul>

            <div class="border-2 w-11 h-11 flex items-center justify-center border-cyan-950 rounded-full">
                <i class="fa-solid fa-user text-black cursor-pointer text-3xl"></i>
            </div>
        </nav>
    </header>

    <main class="pt-24">
        <div class="flex items-center justify-between w-full">
            <a></a>
            <h2 class="text-3xl text-cyan-900 text-center ml-48 mt-8">Années scolaires</h2>
            <button class="px-8 rounded-lg py-3 mr-8 bg-cyan-950 text-white">Ajouter une nouvelle année scolaire</button>
        </div>
        <section class="w-4/5 border-2 mx-auto mt-14 flex items-center flex-wrap px-10">
            <div class="w-72 h-72 border border-cyan-900 flex items-center justify-center text-6xl hover:bg-cyan-900 hover:text-white cursor-pointer mr-16 my-16">
                2023
            </div>

            <div class="w-72 h-72 border border-cyan-900 flex items-center justify-center text-6xl hover:bg-cyan-900 hover:text-white cursor-pointer mr-16 my-16">
                2022
            </div>

            <div class="w-72 h-72 border border-cyan-900 flex items-center justify-center text-6xl hover:bg-cyan-900 hover:text-white cursor-pointer mr-16 my-16">
                2021
            </div>

            <div class="w-72 h-72 border border-cyan-900 flex items-center justify-center text-6xl hover:bg-cyan-900 hover:text-white cursor-pointer mr-16 my-16">
                2020
            </div>

            <div class="w-72 h-72 border border-cyan-900 flex items-center justify-center text-6xl hover:bg-cyan-900 hover:text-white cursor-pointer mr-16 my-16">
                2019
            </div>
        </section>
    </main>

    <div class="modal-container hidden absolute top-0 w-full h-full items-center justify-center" id="modal-container">
        <span class="day" style="display: none;"></span>
        <div class="modal w-1/2 h-2/3 rounded-lg bg-white shadow-lg">
            <header class="modal-title text-2xl text-center my-3">Ajouter un année scolaire</header>
            
            <section class="modal-body flex justify-between px-6 mt-8 overflow-scroll">
                <section class="modal-body-section w-2/5">
                    <div class="input-group w-full mb-12">
                        <label for="" class="w-full text-lg mb-4 inline-block">Nom</label>
                        <input type="text" name="" id="" class="w-full px-8 py-2 rounded-lg border-2 border-slate-400" placeholder="Nom">
                    </div>

                    <div class="input-group w-full mb-12">
                        <label for="" class="w-full text-lg mb-4 inline-block">Prénom</label>
                        <input type="text" name="" id="" class="w-full px-8 py-2 rounded-lg border-2 border-slate-400" placeholder="Prénom">
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
                        <span class="text-lg">Classe</span>
                        <select name="" id="" class="w-96 px-4 py-2 mt-4">
                            <option class="w-full">Interne</option>
                            <option class="w-full">Externe</option>
                        </select>
                    </div>
                    
                </section>
            </section>

            <footer class="modal-footer w-full flex justify-end items-center py-3 mt-32 px-12">
                <button class="cancel px-5 py-2 bg-red-700 text-white mr-10 rounded-lg">Annuler</button>
                <button class="save px-5 py-2 bg-green-700 text-white rounded-lg">Enregistrer</button>
            </footer>
        </div>
    </div>
</body>

</html>