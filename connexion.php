<?php
session_start();
require_once __DIR__ . "/fonctions/fonctions.php";

if (empty($_POST) || empty($_POST['email']) || empty($_POST['mdp_u'])) {
    redirect("index.php");
}
require_once __DIR__ . "/pdo/db.php";
//TODO:mot de passe haché
$stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE email=:email AND mdp_u=:mdp_u");
$stmt->execute(
    [
        'email' => $_POST['email'],
        'mdp_u' => $_POST['mdp_u']
    ]
);

$user = $stmt->fetch();
if (!$user) {
    redirect("index.php?erreur=1"); //TODO:class Erreur ?
}

$_SESSION = [
    'id_u' => $user['id_u'],
    'connected' => true
];

redirect("index.php");
