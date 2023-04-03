<?php
require_once __DIR__ . "/layout/header.php";
require_once __DIR__ . "/pdo/db.php";

if (!isset($_SESSION['connected'])) {
    redirect("index.php");
}
require_once __DIR__ . "/classes/ConnectedUser.php";
$user = new ConnectedUser($pdo);
$idU = $user->getUserId();

$games=rentedByUser($idU,$pdo);
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
