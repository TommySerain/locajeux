<?php
require_once __DIR__ . "/layout/header.php";
require_once __DIR__ . "/pdo/db.php";

if (!isset($_SESSION['connected'])) {
    redirect("index.php");
}

$idU = $_SESSION['id_u'];
$user = $pdo->prepare("SELECT * FROM utilisateurs WHERE id_u=:identifiant");
$user->execute(
    [
        'identifiant' => $idU
    ]
);

$user = $user->fetch();
$games = $pdo->prepare("SELECT * FROM l_jeux_utilisateurs NATURAL JOIN jeux WHERE id_u=:identifiant");
$games->execute(
    [
        'identifiant' => $user['id_u']
    ]
);
?>
<section class="container text-white mt-5">
    <h1 class="text-center">Mon compte LocaJeux</h1>
    <div class="row g-5">
        <div class="col-12">
            <?php
            displayAccount($user);
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
