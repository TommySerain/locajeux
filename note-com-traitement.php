<?php
session_start();
require_once __DIR__ . "/fonctions/fonctions.php";

if (!isset($_GET['id']) || (!isset($_POST['note']) && !isset($_POST['com']))) {
    redirect("index.php");
}

require_once __DIR__ . "/pdo/db.php";
$userId = $_SESSION['id_u'];
$gameId = intval($_GET['id']);

if (empty($_POST['note']) || empty($_POST['com'])) {
    redirect("note-com.php?id=$gameId&erreur=11");
}

if ($_POST['note'] !== '1' && $_POST['note'] !== '2' && $_POST['note'] !== '3' && $_POST['note'] !== '4' && $_POST['note'] !== '5') {
    redirect("note-com.php?id=$gameId&erreur=10");
}

if (strlen(($_POST['com'])) > 200) {
    redirect("note-com.php?id=$gameId&erreur=12");
}

$verif = $pdo->prepare("SELECT * FROM jeux WHERE id_j=:id");
$verif->execute(
    [
        "id" => $gameId
    ]
);
$game = $verif->fetch();
if ($game === false) {
    redirect("index.php");
};
$note = intval($_POST['note']);
$com = $_POST['com'];
$noteComs = $pdo->prepare("UPDATE l_jeux_utilisateurs
                            SET note=:note, com=:com
                            WHERE id_u=:userId
                            AND id_j=:gameId
                            AND note IS NULL
                            AND com IS NULL
                            AND date_dispo IS NULL;");
$noteComs->execute(
    [
        'note' => $note,
        'com' => $com,
        'userId' => $userId,
        'gameId' => $gameId
    ]
);
redirect("mon_compte.php");
