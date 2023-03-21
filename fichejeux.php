<?php
require_once __DIR__ . "/layout/header.php";
require_once __DIR__ . "/pdo/db.php";
$id = intval($_GET['id']);

$stmt = $pdo->prepare("SELECT * FROM jeux NATURAL JOIN types NATURAL JOIN categories WHERE id_j=:id");
$stmt->execute(
    [
        'id' => $id
    ]
);
$game = $stmt->fetch();
$idp = $game['id_j_p'];
// var_dump($game);
?>
<section class="container text-center">
    <h1 class="m-5"><?php echo $game['name_j']; ?></h1>
    <img class="rounded-5 w-25 mb-5 " src="<?php echo $game['img_j']; ?>" alt=""><br>
    <a href="<?php echo $game['rules_j']; ?>" class="text-decoration-none text-white fs-2 mb-5">Règles PDF</a>
    <div class="my-5 mx-auto text-center bg-white w-50 rounded-4 fw-bold">
        <h2>Infos</h2>
        <div class="d-flex justify-content-around">
            <p>Prix de location : <?php echo $game['loc_j']; ?> €</p>
            <p>Caution : <?php echo $game['caution_j']; ?> €</p>
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

            <p> Ce jeu est une extension de <a href="fichejeux.php?id=<?php echo $gamep['id_j']; ?>"><?php echo $gamep['name_j']; ?></a></p>
        <?php
        }
        $stmt3 = $pdo->prepare("SELECT * FROM jeux WHERE id_j_p=:id ");
        $stmt3->execute(
            [
                'id' => $id
            ]
        );
        $game3=$stmt3->fetch();
        var_dump($game3);
        ?>
    </div>

</section>





<?php
require_once __DIR__ . "/layout/footer.php";
