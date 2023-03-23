<?php

if (!empty($_POST) && $_POST['nom'] !== null && $_POST['prenom'] !== null && $_POST['birthdate'] !== null && $_POST['mail'] !== null && $_POST['adresse'] !== null && $_POST['mdp'] !== null) {

    try {
        $stmt = $pdo->prepare("INSERT INTO utilisateurs (name_u, firstname_u, naissance_u, email, address_u, mdp_u)
    VALUES (:name,:firstname,:naissance,:email,:adresse,:mdp)");
        $stmt->execute(
            [
                'name' => $_POST['nom'],
                'firstname' => $_POST['prenom'],
                'naissance' => date('Y-m-d', strtotime($_POST['birthdate'])),
                'email' => $_POST['mail'],
                'adresse' => $_POST['adresse'],
                'mdp' => $_POST['mdp'],
            ]
        );
    } catch (PDOException $e) { ?>
        <h2 class="tex-white"><?php echo $e->getmessage() ?></h2>
<?php
    }
    header("Location: index.php");
}
