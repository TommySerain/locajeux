<?php
// TODO:refactoriser le code (peut être en mettant chaque partie en template)
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
$nbJeuxLoues = 0

?>
<section class="container text-white mt-5">
    <h1 class="text-center">Mon compte LocaJeux</h1>
    <div class="row g-5">
        <div class="col-6">
            <?php
            displayAccount($user);
            ?>
        </div>
        <div class="col-6">
            <div class="row bg-white justify-content-center text-dark py-5 rounded-4 mt-5">
                <h2 class="text-center mb-5">Les jeux que j'ai loué</h2>
                <div>
                    <?php
                    while ($game = $games->fetch()) {
                        $nbJeuxLoues += 1;
                        $dateDispo = $game['date_dispo'];
                        $dateLoc = $game['date_loc'];
                    ?>
                        <div class="d-flex justify-content-between mb-3">
                            <a class="fs-5 fw-bold mb-0 text-decoration-none" href="fichejeux.php?id=<?php echo $game['id_j']; ?>"><?php echo $game['name_j']; ?></a>
                            <?php
                            if ($dateDispo) { ?>
                                <p class="fs-5 fw-bold mb-0"><?php echo dateToFrenchFormat($dateDispo); ?></p>
                            <?php }
                            ?>
                            <p class="fs-5 fw-bold mb-0"><?php echo dateToFrenchFormat($dateLoc); ?></p>
                            <?php
                            if ($game['date_dispo']) { ?>
                                <a class="btn btn-success" href="rendre.php?id=<?php echo $game['id_j']; ?>">Rendre le jeu</a>
                                <?php
                            } else {
                                if (!$game['note'] && !$game['com']) { ?>
                                    <a class="btn btn-success" id='btnNote' href="note-com.php?id=<?php echo $game['id_j']; ?>">Noter / Commenter</a>
                                <?php
                                } else {
                                    $notes = $pdo->prepare("SELECT note FROM l_jeux_utilisateurs WHERE id_u=:userId AND id_j=:gameId AND note IS NOT NULL;");
                                    $notes->execute(
                                        [
                                            'userId' => $idU,
                                            'gameId' => $game['id_j']
                                        ]
                                    );
                                    $note = $notes->fetch();
                                ?>
                                    <p class="fs-5 fw-bold mb-0">Ta note : <?php echo $note['note']; ?></p>
                            <?php }
                            }
                            ?>
                        </div>
                    <?php }
                    ?>
                    <p class="fs-5 fw-bold mb-0">Nombre de jeux que j'ai loué : <?php echo $nbJeuxLoues; ?></p>
                </div>
            </div>
        </div>
    </div>

</section>

<?php
require_once __DIR__ . "/layout/footer.php";
