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

if (!isGameInGet($gameId, $pdo)) {
    redirect("index.php");
};
require_once __DIR__ . "/classes/Game.php";
$game = new Game($gameId, $pdo);
if (!$game->isAvailable()) {
    redirect("fichejeux.php?id=$gameId");
};

require_once __DIR__ . "/classes/LocationJeu.php";
$majJeu = new LocationJeu($gameId, $userId, $dateLoc, $dateDispo, $pdo);

redirect("mon_compte.php");
