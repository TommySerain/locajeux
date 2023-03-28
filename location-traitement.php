<?php
session_start();
require_once __DIR__ . "/fonctions/fonctions.php";

if (!isset($_GET['id'])) {
    redirect("index.php");
}
require_once __DIR__ . "/pdo/db.php";
$userId = $_SESSION['id_u'];
$dateLoc = date('Y-m-d');
$dateDispo = datePlusOneWeek();
$gameId = intval($_GET['id']);

$stmt = $pdo->prepare("SELECT * FROM jeux WHERE id_j=:id");
$stmt->execute(
    [
        "id" => $gameId
    ]
);
$game = $stmt->fetch();
if ($game === false) {
    redirect("index.php");
};
if (!$game['disponible']) {
    redirect("fichejeux.php?id=$gameId");
};

$majJeu = $pdo->prepare("UPDATE jeux SET disponible=0 WHERE id_j=:id");
$majJeu->execute(
    [
        'id' => $gameId
    ]
);

$majJeu = $pdo->prepare("INSERT INTO l_jeux_utilisateurs (id_j, id_u, date_loc, date_dispo)
    VALUES (:gameId, :userId, :dateLoc, :dateDispo)");
$majJeu->execute(
    [
        'gameId' => $gameId,
        'userId' => $userId,
        'dateLoc' => "$dateLoc",
        'dateDispo' => "$dateDispo"
    ]
);

redirect("mon_compte.php");
