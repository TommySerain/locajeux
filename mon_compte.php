<?php
require_once __DIR__ . "/layout/header.php";
require_once __DIR__ . "/pdo/db.php";

if (!isset($_SESSION['connected'])) {
    redirect("index.php");
}
require_once __DIR__ . "/classes/ConnectedUser.php";
$user = new ConnectedUser($pdo);
$idU = $user->getUserId();

// TODO: créer une class jeux utilisateurs pour englober la query et peut-être modifier le template user-game-ocation
$games = $pdo->prepare("SELECT * FROM l_jeux_utilisateurs NATURAL JOIN jeux WHERE id_u=:identifiant");
$games->execute(
    [
        'identifiant' => $idU
    ]
);
?>
<section class="container text-white mt-5">
    <h1 class="text-center">Mon compte LocaJeux</h1>
    <div class="row g-5">
        <div class="col-12">
            <?php
            $user->displayAccount();
            ?>
        </div>
        <div class="col-12">
            <?php
            require_once __DIR__ . "/template/user-game-location.php";
            ?>
        </div>
    </div>
</section>
<?php
require_once __DIR__ . "/layout/footer.php";
