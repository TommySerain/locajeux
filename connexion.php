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

$stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE email=:email");
$stmt->execute(
    [
        'email' => $uMail,
    ]
);

$user = $stmt->fetch();
$uMdpH = $user['mdp_u'];

if (password_verify($uMdp, $uMdpH) === false) {
    redirect("index.php?erreur=3");
}

$_SESSION = [
    'id_u' => $user['id_u'],
    'connected' => true
];

// var_dump($_SERVER);
if(!str_contains($_SERVER["HTTP_REFERER"],"index.php")){
    redirect("$_SERVER[HTTP_REFERER]");
}

redirect("mon_compte.php");