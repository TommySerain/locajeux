<?php
// TODO:vérifier les signatures de fonctions
// TODO: vérifier le nommage des fonctions
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
            <a class="btn btn-success mx-3" href="deconnexion.php">Déconnexion</a>
        </li>
    <?php
    } else {
    ?>
        <button id="btnCo" class="btn btn-success" aria-current="page">Connexion / inscription</button>
    <?php
    }
};

function redirectDeconnexion(array $session): void
{
    $session = [];
    session_destroy();
    header("Refresh: 1; URL=index.php");
}

function redirectInscription(): void
{
    header("Refresh: 1; URL=index.php");
}


function search(string $type, string $cat, string $name, PDO $pdo): object
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
        $joinRequest[] = " ";
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

function datePlusOneWeek(): string
{
    return date('Y-m-d', strtotime("+7 days", strtotime(date('Y-m-d'))));
}

function dateToFrenchFormat(string $date): string
{
    return date('d-m-Y', strtotime($date));
}

function CalculateAverageNote(int $gameId, PDO $pdo): float
{
    $calc = $pdo->prepare("SELECT note FROM l_jeux_utilisateurs WHERE id_j=:gameId;");
    $calc->execute(
        [
            'gameId' => $gameId
        ]
    );
    $i = 0;
    $total = 0;
    while ($moy = $calc->fetch()) {
        $i += 1;
        $total += $moy['note'];
    }
    if ($i !== 0) {
        return round($total / $i, 1);
    }
    return 0;
}

function errorDisplay(): void
{
    $error = new ErrorMsg;
    ?>
    <section class="container text-center text-danger my-5">
        <p>Une erreur est survenue : <?php echo $error->getErrorMsg($_GET['erreur']) ?></p>
    </section>
<?php
}

