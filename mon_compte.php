<?php



require_once __DIR__ . "/layout/header.php";
require_once __DIR__ . "/pdo/db.php";


if (!isset($_SESSION['connected'])) {
    header('Location: index.php');
    exit;
}

$idU = $_SESSION['id_u'];
$stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE id_u=:identifiant");
$stmt->execute(
    [
        'identifiant' => $idU
    ]
);

$user = $stmt->fetch();

?>
<section class="text-white mt-5 container">
    <h1 class="text-center">Mon compte LocaJeux</h1>
    <div class="row bg-white justify-content-center text-dark py-5 rounded-4 mt-5">
        <h2 class="text-center">Mes infos</h2>
        <div class="d-flex justify-content-around">
            <h3 class="">Nom : <?php echo $user['name_u']; ?></h3>
            <h3 class="">Prénom : <?php echo $user['firstname_u']; ?></h3>
        </div>
        <div class="d-flex justify-content-around">
            <h3 class="">Date de naissance : <?php echo $user['naissance_u']; ?></h3>
            <h3 class="">Email : <?php echo $user['email']; ?></h3>
        </div>
    </div>
</section>



<?php
require_once __DIR__ . "/layout/footer.php";
