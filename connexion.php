<?php
session_start();

if (empty($_POST) || empty($_POST['email']) || empty($_POST['mdp_u'])) {
    header("Location: index.php");
    exit;
    //TODO: une fonction redirect
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
    header("Location: index.php?erreur=1");
    exit;
}

$_SESSION = [
    'id_u' => $user['id_u'],
    'connected' => true
];

header("Location: index.php");
exit;
