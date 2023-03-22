<?php


function loginOrAccount()
{
    if (!empty($_SESSION)) {
?> <li>
            <a class="btn btn-success" href="mon_compte.php" aria-current="page">Mon compte</a>
        </li>
        <li>
            <form class=" m-0" action="" method="POST">
                <input type="submit" class="btn btn-success ms-3 " name="deconnexion" value="Déconnexion">
                <?php
                if (!empty($_POST)) {
                    $_SESSION = [];
                    session_destroy();
                    header('location: deconnexion.php');
                }
                ?>
            </form>
        </li>
    <?php
    } else {
    ?>
        <button id="btnCo" class="btn btn-success" aria-current="page">Connexion</button>
<?php
    }
};

function search($type, $cat, $name, $pdo)
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
    $request = "SELECT * FROM jeux $join WHERE $where;";
    $stmt = $pdo->prepare($request);
    $stmt->execute(
        $executeRequest
    );
    return $stmt;
}
