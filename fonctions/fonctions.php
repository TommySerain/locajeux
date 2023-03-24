<?php

function redirect($page): void
{
    header("location: $page");
    exit;
}

function menuConnexionOuMonCompte(): void
{
    if (isset($_SESSION['connected'])) {
?>
        <li>
            <a class="btn btn-success" href="mon_compte.php" aria-current="page">Mon compte</a>
        </li>
        <li>
            <form class=" m-0" action="" method="POST">
                <a class="btn btn-success mx-3" href="deconnexion.php">Déconnexion</a>
            </form>
            <?php
            if (isset($_POST['deconnexion'])) {
                deconnexion($_SESSION);
            } ?>
        </li>
    <?php
    } else {
    ?>
        <button id="btnCo" class="btn btn-success" aria-current="page">Connexion</button>
<?php
    }
};

function deconnexion(array $session): void
{
    $session = [];
    session_destroy();
    header("Refresh: 1; URL=index.php");
}


function search($type, $cat, $name, $pdo): object
{
    $joinRequest = [];
    $whereRequest = [];
    $executeRequest = [];
    if (!empty($type)) {
        $joinRequest[] = "NATURAL JOIN types";
        $whereRequest[] = "name_t=:type";
        $executeRequest['type'] = $type;
    }
    if (!empty($cat)) {
        $joinRequest[] = "NATURAL JOIN categories";
        $whereRequest[] = "name_c=:cat";
        $executeRequest['cat'] = $cat;
    }
    if (!empty($name)) {
        $whereRequest[] = "name_j LIKE :nom";
        $executeRequest['nom'] = '%' . $name . '%';
    }
    $where = implode(' AND ', $whereRequest);
    $join = implode(' ', $joinRequest);
    if ($join !== "") {
        $request = "SELECT * FROM jeux $join WHERE $where;";
    } else {
        $request = "SELECT * FROM jeux ;";
    }
    $stmt = $pdo->prepare($request);
    $stmt->execute(
        $executeRequest
    );
    return $stmt;
}
require_once __DIR__ . "/../classes/ErrorMsg.php";
function getErrorMsgForInscription(int $code): string
{
    switch ($code) {
        case ErrorMsg::CONNECTION_EMPTY:
            return "Merci de remplir tous les champs de connexion";
            break;
        case ErrorMsg::MAIL_OR_PASS_CONNECTION_EMPTY:
            return "Email ou mot de passe non-reseignés";
            break;
        case ErrorMsg::PASSWORD_OR_MAIL_INCORECT:
            return "Email ou mot de passe incorect";
            break;
        case ErrorMsg::INSCRIPTION_EMPTY:
            return "Merci de remplir tous les champs d'inscription";
            break;
        case ErrorMsg::BLANKS_FIELD:
            return "Tous les champs inscriptions sont obligatoires";
            break;
        case ErrorMsg::DUPLICATE_EMAIL:
            return "Cet email est déjà inscrit sur Locajeux";
            break;

        default:
            return "Contactez l'administrateur de l'application";
    }
}
