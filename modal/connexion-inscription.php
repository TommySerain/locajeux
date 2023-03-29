<section id="modalCo" class=" vw-100 bg-dark bg-opacity-50 my-auto is-invisible">
    <div class="container bg-light vw-75 mx-auto mt-3 rounded-5 p-3 pb-5 text-end">
        <a id="connexionClose">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" fill="currentColor" class="bi bi-x-circle pb-1" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
            </svg>
        </a>
        <div class="row text-center">
            <div id="connexion" class="col-6 px-5 align-self-center">
                <h2>Connexion</h2>
                <form action="connexion.php" class="d-flex flex-column" method="POST">
                    <div class="d-flex align-items-center">
                        <label class="mt-3 me-3 w-25" for="mail">Email</label>
                        <input class="form-control mt-3" type="email" name="email" id="mail" required>
                    </div>
                    <div class="d-flex align-items-center">
                        <label class="mt-3 me-3 w-25" for="mdp_u">Mot de passe</label>
                        <input class="form-control mt-3" type="password" name="mdp_u" id="mdp_u" required>
                    </div>
                    <input class="btn btn-success d-block w-25 mx-auto mt-3" type="submit" value="Connexion">
                </form>
            </div>
            <div id="inscription" class="col-6 px-5">
                <h2>Inscription</h2>
                <p>Attention il faut être majeur pour s'inscrire</p>
                <form action="inscription.php" class="d-flex flex-column" method="POST">
                    <div class="d-flex align-items-center">
                        <label class="mt-3 me-3 w-25" for="nom">Nom</label>
                        <input class="form-control mt-3" type="text" name="nom" id="nom" required>
                    </div>
                    <div class="d-flex align-items-center">
                        <label class="mt-3 me-3 w-25" for="prenom">Prénom</label>
                        <input class="form-control mt-3" type="text" name="prenom" id="prenom" required>
                    </div>
                    <div class="d-flex align-items-center">
                        <label class="mt-3 me-3 w-25" for="birthdate">date de naissance</label>
                        <input class="form-control mt-3" type="date" name="birthdate" id="birthdate" required>
                    </div>
                    <div class="d-flex align-items-center">
                        <label class="mt-3 me-3 w-25" for="mail">Email</label>
                        <input class="form-control mt-3" type="email" name="mail" id="mail" required>
                    </div>
                    <div class="d-flex align-items-center">
                        <label class="mt-3 me-3 w-25" for="adresse">Adresse</label>
                        <input class="form-control mt-3" type="text" name="adresse" id="adresse" required>
                    </div>
                    <div class="d-flex align-items-center">
                        <label class="mt-3 me-3 w-25" for="mdp">Mot de passe</label>
                        <input class="form-control mt-3" type="password" name="mdp" id="mdp" required>
                    </div>
                    <input class="btn btn-success d-block w-25 mx-auto mt-3" type="submit" value="Inscription">
                </form>
            </div>
        </div>
    </div>
</section>