<?php


function loginOrAccount()
{
    if (!empty($_SESSION)) {
?> <li>
            <a class="btn btn-success" href="mon_compte.php" aria-current="page">Mon compte</a>
        </li>
        <li>
            <form class=" m-0" action="" method="POST">
                <input type="submit" class="btn btn-success ms-3 " name="deconnexion" value="Déconnexion">
                <?php
                if (!empty($_POST)) {
                    $_SESSION = [];
                    session_destroy();
                    header('location: deconnexion.php');
                }
                ?>
            </form>
        </li>
    <?php
    } else {
    ?>
        <button id="btnCo" class="btn btn-success" aria-current="page">Connexion</button>
<?php
    }
};
