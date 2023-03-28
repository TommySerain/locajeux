<?php

require_once __DIR__ . "/pdo/db.php";
require_once __DIR__ . "/layout/header.php";
require_once __DIR__ . "/classes/ErrorMsg.php";
require_once __DIR__ . "/template/source.php";
require_once __DIR__ . "/classes/Game.php";

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

if (isset($_GET['erreur'])) { ?>
    <div class="error">
        <p class="text-center text-danger m-5"> Une erreur est survenue :
            <?php
            $msg = new ErrorMsg;
            echo $msg->getErrorMsg(intval($_GET['erreur']));
            ?>
        </p>
    </div>
<?php }

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
                        <img class="imgJeux w-100 m-0 border border-4  border-dark rounded-4 jeux" src="<?php echo SOURCE_IMG . $game['img_j']; ?>" alt="">
                    </a>
                    <div class="p-2 text-center ">
                        <?php if ($game['disponible']) { ?>
                            <p class="my-auto fw-bold">Disponible</p>
                        <?php } else {
                            $date = $pdo->prepare("SELECT date_dispo FROM l_jeux_utilisateurs WHERE id_j=:idJ AND date_dispo IS NOT NULL");
                            $date->execute(
                                [
                                    'idJ' => $gameId
                                ]
                            );
                            $date = $date->fetch();
                        ?>
                            <p class="my-auto fw-bold">Date de disponibilité : </p>
                            <p class="my-auto fw-bold text-danger"><?php echo dateToFrenchFormat($date['date_dispo']); ?></p>
                        <?php } ?>
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
