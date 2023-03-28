<?php
// TODO: ajouter les commentaires
require_once __DIR__ . "/pdo/db.php";
require_once __DIR__ . "/fonctions/fonctions.php";


$id = intval($_GET['id']);

$stmt = $pdo->prepare("SELECT * FROM jeux NATURAL JOIN types NATURAL JOIN categories WHERE id_j=:id");
$stmt->execute(
    [
        'id' => $id
    ]
);

$game = $stmt->fetch();

if ($game === false) {
    redirect("index.php");
};

require_once __DIR__ . "/layout/header.php";
require_once __DIR__ . "/classes/Game.php";
require_once __DIR__ . "/template/source.php";

$idp = $game['id_j_p'];
$jeu = new GAME(
    intval($game['id_j']),
    $game['name_j'],
    $game['img_j'],
    $game['rules_j'],
    intval($game['loc_j']),
    intval($game['caution_j']),
    intval($game['id_j_p']),
    intval($game['id_t']),
    intval($game['id_c']),
    $game['disponible']
);

?>
<section class="container text-center">
    <h1 class="m-5 text-white">- <?php echo $jeu->getName(); ?> -</h1>
    <h2 class="fs-4 text-white">Note des utilisateurs : <?php echo CalculateAverageNote($jeu->getId(), $pdo); ?></h2>
    <img class="rounded-5 w-25 mb-5 " src="<?php echo SOURCE_IMG . $jeu->getPicture(); ?>" alt=""><br>
    <a href="<?php echo SOURCE_RULES . $jeu->getRules(); ?>" class="text-decoration-none  fw-bold fs-2 mb-5" target="_blank">Règles PDF</a>
    <div class="my-5 mx-auto text-center bg-white w-50 rounded-4 fw-bold p-3">
        <h2>Infos</h2>
        <div class="d-flex justify-content-around">
            <p>Prix de location : <?php echo $jeu->getLocP(); ?> €</p>
            <p>Caution : <?php echo $jeu->getCautP(); ?> €</p>
        </div>
        <div class="d-flex justify-content-around">
            <p>Type : <?php echo $game['name_t']; ?> </p>
            <p>Catégorie : <?php echo $game['name_c']; ?> </p>
        </div>
        <?php
        if ($game['id_j_p'] !== null) {
            $stmt2 = $pdo->prepare("SELECT * FROM jeux WHERE id_j=:id");
            $stmt2->execute(
                [
                    'id' => $idp
                ]
            );
            $gamep = $stmt2->fetch() ?>
            <p> Ce jeu est une extension de <a class="text-decoration-none " href="fichejeux.php?id=<?php echo $gamep['id_j']; ?>"><?php echo $gamep['name_j']; ?></a></p>
        <?php
        }
        $stmt3 = $pdo->prepare("SELECT * FROM jeux WHERE id_j_p=:id ");
        $stmt3->execute(
            [
                'id' => $id
            ]
        );
        $game3 = $stmt3->fetch();
        if ($game3) { ?>
            <p>Pour ce jeu nous avons l'extension : <a class="text-decoration-none " href="fichejeux.php?id=<?php echo $game3['id_j']; ?>"><?php echo $game3['name_j']; ?></a></p>
        <?php
        }
        ?>
    </div>
</section>

<?php

if (isset($_SESSION['connected'])) { ?>
    <?php
    if ($jeu->isAvailable()) {
    ?>
        <div class="d-flex justify-content-center">
            <a href="location.php?id=<?php echo $jeu->getId() ?>" class="btn btn-success mb-5">Louer</a>
        </div>
    <?php
    }
}

$coms = $pdo->prepare("SELECT com, firstname_u FROM l_jeux_utilisateurs
                        NATURAL JOIN utilisateurs
                        WHERE id_j=:gameId
                        AND com IS NOT NULL");
$coms->execute(
    [
        'gameId' => $jeu->getId()
    ]
);
while ($com = $coms->fetch()) { ?>
    <section class="container bg-white rounded-4 mb-5 p-4">
        <div class="row">
            <p class="text-end">Utilisateur : <?php echo $com['firstname_u']; ?></p>
            <p>Commentaire : </p>
            <p class="fw-bold"><?php echo $com['com']; ?></p>
        </div>
    </section>
<?php }

require_once __DIR__ . "/layout/footer.php";
