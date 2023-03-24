<?php


require_once __DIR__ . "/classes/exceptions/DuplicateEmailException.php";
require_once __DIR__ . "/pdo/db.php";
require_once __DIR__ . "/layout/header.php";


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
try {
    $user = new USER(
        $_POST['nom'],
        $_POST['prenom'],
        $_POST['birthdate'],
        $_POST['mail'],
        $_POST['adresse'],
        $_POST['mdp'],
        $pdo
    );
} catch (DuplicateEmailException $e) {
    redirect("index.php?erreur=6");
}

$nom = $user->getName();
$prenom = $user->getFirstname();
$birthdate = $user->getBirthdate();
$email = $user->getEmail();
$adresse = $user->getAddress();
$mdp = $user->getMdp();



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
inscription();
?>
<h1 class="text-center text-white m-5"> Inscription réussie</h1>
<?php
require_once __DIR__ . "/layout/header.php";
