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
            <div class="row bg-white justify-content-center text-dark py-5 rounded-4 mt-5">
                <h2 class="text-center mb-5">Mes infos</h2>
                <div class="d-flex justify-content-around text-center mb-5">
                    <p class="fs-5 fw-bold">Nom <br><?php echo $user['name_u']; ?></p>
                    <p class="fs-5 fw-bold">Prénom <br><?php echo $user['firstname_u']; ?></p>
                </div>
                <div class="d-flex justify-content-around text-center">
                    <p class="fs-5 fw-bold">Date de naissance <br><?php echo date_format(date_create($user['naissance_u']), "d/m/Y"); ?></p>
                    <p class="fs-5 fw-bold">Email <br><?php echo $user['email']; ?></p>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="row bg-white justify-content-center text-dark py-5 rounded-4 mt-5">
                <h2 class="text-center mb-5">Les jeux que j'ai loué</h2>
                <div>
                    <?php
                    while ($game = $games->fetch()) {
                        $nbJeuxLoues += 1
                    ?>
                        <div class="d-flex justify-content-between mb-3">
                            <p class="fs-5 fw-bold mb-0"><?php echo $game['name_j']; ?></p>
                            <p class="fs-5 fw-bold mb-0"><?php echo $game['date_dispo']; ?></p>
                            <p class="fs-5 fw-bold mb-0"><?php echo $game['date_loc']; ?></p>
                            <?php
                            if ($game['date_dispo']) { ?>
                                <a class="btn btn-success" href="rendre.php?id=<?php echo $game['id_j'] ;?>">Rendre le jeu</a>
                            <?php
                            }else{
                                if(!$game['note']){?>
                                    <a class="btn btn-success" href="">Noter le jeu</a>
                                <?php
                                }
                                if(!$game['com']){?>
                                    <a class="btn btn-success" href="">Commenter le jeu</a>
                                <?php
                                }
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
