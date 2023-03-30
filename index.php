<?php

require_once __DIR__ . "/pdo/db.php";
require_once __DIR__ . "/layout/header.php";
require_once __DIR__ . "/classes/ErrorMsg.php";
require_once __DIR__ . "/template/source.php";
require_once __DIR__ . "/classes/Game.php";
require_once __DIR__ . "/classes/ConnectedUser.php";
require_once __DIR__ . "/classes/GameAvailability.php";

if (isset($_SESSION['connected'])) {
    $connectedUser = new ConnectedUser($pdo);
?>
    <h2 class='text-white text-center m-5'>Bonjour <?php echo $connectedUser->getUserFirstname(); ?></h2>
<?php
}

if (isset($_GET['erreur'])) {
    errorDisplay();
}

require_once __DIR__ . "/template/search-form.php";
if (isset($_GET['type']) || isset($_GET['categories']) || isset($_GET['nom'])) {
    $games = search($_GET['type'], $_GET['categories'], $_GET['nom'], $pdo);
} else {
    $games = $pdo->query("SELECT * FROM jeux");
}
?>

<section class="container">
    <div class="row">
        <?php
        while ($game = $games->fetch()) {
            $gameId = intval($game['id_j'])
        ?>
            <div class="col-3 p-0">
                <div class="rounded-4 bg-white m-4 jeux">
                    <a href="fichejeux.php?id=<?php echo $gameId; ?>">
                        <img class="imgJeux w-100 m-0 border border-4 border-dark rounded-4 jeux" src="<?php echo SOURCE_IMG . $game['img_j']; ?>" alt="image du jeu <?php echo $game['name_j']; ?>">
                    </a>
                    <div class="p-2 text-center ">
                        <?php
                        $available = new GameAvailability($game['id_j'], $game['disponible'], $pdo);
                        $available->displayAvailability();
                        ?>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</section>
<?php
require_once __DIR__ . "/layout/footer.php";
