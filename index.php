<?php

require_once __DIR__ . "/pdo/db.php";
require_once __DIR__ . "/layout/header.php";
// require_once __DIR__ . "/classes/GamesDbFromFile.php";
// require_once __DIR__ . "/data/fileToDb.php"; TODO: créer une page spécifque innitDB


if (isset($_SESSION['connected'])) {
    $stmt_user = $pdo->prepare('SELECT * FROM utilisateurs WHERE id_u=:id ');
    $stmt_user->execute(
        [
            'id' => $_SESSION['id_u']
        ]
    );
    $connectedUser = $stmt_user->fetch();
?>
    <h2 class='text-white text-center m-5'>Bonjour <?php echo $connectedUser['firstname_u']; ?></h2>
<?php
}


require_once __DIR__ . "/search-form.php";

if (isset($_GET['type']) || isset($_GET['categories']) || isset($_GET['nom'])) {
    $games=search($_GET['type'], $_GET['categories'], $_GET['nom'], $pdo);
} else {
    $games = $pdo->query('SELECT * FROM jeux');
}
?>
<section class="container">
    <div class="row">
        <?php
        while ($game = $games->fetch()) {
        ?>
            <div class="col-3 p-0">
                <div class="rounded-4 m-4 jeux">
                    <a href="fichejeux.php?id=<?php echo $game['id_j']; ?>">
                        <img class="imgJeux w-100 m-0 border border-4  border-dark rounded-4 jeux" src="<?php echo $game['img_j']; ?>" alt="">
                    </a>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</section>
<?php


require_once __DIR__ . "/layout/footer.php";
