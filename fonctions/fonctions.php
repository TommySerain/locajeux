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
                <input type="submit" class="btn btn-success ms-3 " name="deconnexion" value="Déconnexion">
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
{ //TODO:deconnexion avec un lien et procéder à déconnexion dans deconnexion.php
    $session = [];
    session_destroy();
    redirect("index.php");
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
