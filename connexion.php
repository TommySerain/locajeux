<?php
session_start();
require_once __DIR__ . "/fonctions/fonctions.php";

if (empty($_POST)) {
    redirect("index.php?erreur=1");
}

if (empty($_POST['email']) || empty($_POST['mdp_u'])) {
    redirect("index.php?erreur=2");
}

$uMdp = $_POST['mdp_u'];
$uMail = $_POST['email'];
require_once __DIR__ . "/pdo/db.php";
require_once __DIR__ . "/classes/UserConnect.php";

$connectedU=new UserConnect($pdo, $uMail, $uMdp);

if (!str_contains($_SERVER["HTTP_REFERER"], "index.php")) {
    redirect("$_SERVER[HTTP_REFERER]");
}

redirect("mon_compte.php");
