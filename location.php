<?php

require_once __DIR__ . "/fonctions/fonctions.php";

if (empty($_GET)) {
    redirect("index.php");
}
require_once __DIR__ . "/pdo/db.php";

$id = intval($_GET['id']);
$stmt = $pdo->prepare("SELECT * FROM jeux
NATURAL JOIN categories
WHERE id_j=:id");
$stmt->execute(
    [
        'id' => $id
    ]
);

$game = $stmt->fetch();

if (!$game['disponible']) {
    redirect('fichejeux.php?id=' . $game['id_j']);
}

require_once __DIR__ . "/layout/header.php";

if (!isset($_SESSION['connected'])) {
    redirect("index.php");
}

if ($game['id_j_p'] !== NULL) {
    $stmt = $pdo->prepare("SELECT jeux.*, categories.*, parent.name_j AS nom_p FROM jeux
    NATURAL JOIN categories
    INNER JOIN jeux AS parent ON jeux.id_j_p=parent.id_j
    WHERE jeux.id_j=:id");
    $stmt->execute(
        [
            'id' => $id
        ]
    );

    $game = $stmt->fetch();
}

?>
<div class="text-center bg-white mx-auto w-75 my-5 p-5 rounded-3">
    <p class="fs-2">Voulez-vous louer <?php echo $game['name_j'] ?> ? </p>
    <p class="fs-2">Si vous décidez de le louer il faudra le rendre au plus tard le</p>
    <p class="fs-2 fw-bold text-danger"><?php echo $date = dateToFrenchFormat(datePlusOneWeek()); ?></p>
    <?php
    if ($game['name_c'] === "Extension") {
    ?>
        <p class="fs-2 mt-5">Attention il s'agît d'une extension du jeu <a class="text-decoration-none fw-bold" href="fichejeux.php?id=<?php echo $game['id_j_p']; ?>"><?php echo $game['nom_p']; ?>.</a></p>
        <p class="fs-2">Vous en aurez besoin pour utiliser cette extension</p>
    <?php
    }
    ?>
    <a class="btn btn-success" href="location-traitement.php?id=<?php echo $id; ?>">Louer</a>
</div>

<?php
require_once __DIR__ . "/layout/footer.php";
