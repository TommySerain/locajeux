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
$gameId = intval($_GET['id']);
$userId = $_SESSION['id_u'];
if (!isGameInGet($gameId, $pdo)) {
    redirect("index.php");
}
require_once __DIR__ . "/classes/ReturnGame.php";
$majJeu = new ReturnGame($gameId, $userId, $pdo);

redirect("mon_compte.php");
