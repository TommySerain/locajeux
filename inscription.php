<?php
//TODO:inscription avec un lien et procéder à l'inscription dans inscription.php
//TODO:créer une class USER
session_start();
require_once __DIR__ . "/fonctions/fonctions.php";


if (empty($_POST)) {
    redirect("index.php?erreur=4");
}

if (
    empty($_POST['nom']) ||
    empty($_POST['prenom']) ||
    empty($_POST['birthdate']) ||
    empty($_POST['mail']) ||
    empty($_POST['adresse']) ||
    empty($_POST['mdp'])
) {
    redirect("index.php?erreur=5");
}

require_once __DIR__ . "/classes/User.php";

$user = new USER(
    $_POST['nom'],
    $_POST['prenom'],
    $_POST['birthdate'],
    $_POST['mail'],
    $_POST['adresse'],
    $_POST['mdp']
);
$nom = $user->getName();
$prenom = $user->getFirstname();
$birthdate = $user->getBirthdate();
$email = $user->getEmail();
$adresse = $user->getAddress();
$mdp = $user->getMdp();

require_once __DIR__ . "/pdo/db.php";
require_once __DIR__ . "/classes/ErrorMsg.php";

$stmt=$pdo->prepare("SELECT * FROM utilisateurs WHERE email=:email");
$stmt->execute(['email'=>$email]);
$test=$stmt->fetch();
if($test!==false){
    redirect("index.php?erreur=6");
}


$stmt = $pdo->prepare("INSERT INTO utilisateurs (name_u, firstname_u, naissance_u, email, address_u, mdp_u)
    VALUES (:nom,:firstname,:naissance,:email,:adresse,:mdp)");

    $stmt->execute(
        [
            'nom' => $nom,
            'firstname' => $prenom,
            'naissance' => date('Y-m-d', strtotime($birthdate)),
            'email' => $email,
            'adresse' => $adresse,
            'mdp' => password_hash($mdp, PASSWORD_DEFAULT),
        ]
    );


redirect("index.php");
