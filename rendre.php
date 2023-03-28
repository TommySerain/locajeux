<?php

session_start();
require_once __DIR__ . "/fonctions/fonctions.php";
if (!isset($_SESSION['connected'])) {
    redirect("index.php");
}
if (!isset($_GET['id'])) {
    redirect("index.php");
}

require_once __DIR__ . "/pdo/db.php";
$stmt = $pdo->prepare("SELECT * FROM jeux WHERE id_j=:gameId");
$stmt->execute(
    [
        'gameId' => intval($_GET['id'])
    ]
);
$game = $stmt->fetch();
if ($game === false) {
    redirect("index.php");
}

$userId = $_SESSION['id_u'];
$gameId = $_GET['id'];

$majJeu = $pdo->prepare("UPDATE jeux SET disponible=1 WHERE id_j=:gameId");
$majJeu->execute(
    [
        'gameId' => $gameId
    ]
);
$majDateDispo = $pdo->prepare("UPDATE l_jeux_utilisateurs SET date_dispo=NULL WHERE id_j=:gameId AND id_u=:userId");
$majDateDispo->execute(
    [
        'gameId' => $gameId,
        'userId' => $userId
    ]
);

redirect("mon_compte.php");
