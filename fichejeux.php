<?php
// TODO: factoriser
require_once __DIR__ . "/pdo/db.php";
require_once __DIR__ . "/fonctions/fonctions.php";
$idGame = intval($_GET['id']);

if (!isGameInGet($idGame, $pdo)) {
    redirect("index.php");
};

require_once __DIR__ . "/layout/header.php";
require_once __DIR__ . "/classes/Game.php";
require_once __DIR__ . "/classes/GameCategoryAndType.php";
require_once __DIR__ . "/template/source.php";
$game = new GameCategoryAndType($idGame, $pdo);

$jeu = new GAME($idGame, $pdo);
$jeutab = $jeu->getGame();

require_once __DIR__ . "/classes/AverageNote.php";
$idp = $jeu->getIdP();
$note = new AverageNote($jeu->getId());
?>

<h1 class="m-5 text-white text-center">- <?php echo $jeu->getName(); ?> -</h1>
<?php
if ($note->getNote($pdo) === 0.0) { ?>
    <h2 class="fs-4 text-white text-center">Note des utilisateurs : non noté</h2>
<?php } else {
?>
    <h2 class="fs-4 text-white text-center">Note des utilisateurs : <?php echo $note->getNote($pdo); ?></h2>
<?php } ?>

<img class="rounded-5 w-25 mb-5 d-block mx-auto" src="<?php echo SOURCE_IMG . $jeu->getPicture(); ?>" alt=""><br>
<a href="<?php echo SOURCE_RULES . $jeu->getRules(); ?>" class="text-decoration-none d-flex justify-content-center fw-bold fs-2 mb-5" target="_blank">Règles PDF</a>
<section class="my-5 mx-auto text-center bg-white w-50 rounded-4 fw-bold p-3">
    <h2>Infos</h2>
    <div class="d-flex justify-content-around">
        <p>Prix de location : <?php echo $jeu->getLocP(); ?> €</p>
        <p>Caution : <?php echo $jeu->getCautP(); ?> €</p>
    </div>
    <div class="d-flex justify-content-around">
        <p>Type : <?php echo $game->getGameTypeName(); ?> </p>
        <p>Catégorie : <?php echo $game->getGameCategoryName(); ?> </p>
    </div>

    <?php
    require_once __DIR__ . "/classes/Extension.php";
    if ($jeu->isExtension()) {
        $gameParent = new Extension($idp, $pdo);
        $gameParent = $gameParent->getGameParent();
    ?>
        <p> Ce jeu est une extension de <a class="text-decoration-none" href="fichejeux.php?id=<?php echo $gameParent['id_j']; ?>"><?php echo $gameParent['name_j']; ?></a></p>
    <?php
    }
    require_once __DIR__ . "/classes/Parents.php";
    $gameExt = new Parents($idGame, $pdo);
    $gameExt = $gameExt->getGameExt();
    if ($gameExt) { ?>
        <p>Pour ce jeu nous avons l'extension : <a class="text-decoration-none " href="fichejeux.php?id=<?php echo $gameExt['id_j']; ?>"><?php echo $gameExt['name_j']; ?></a></p>
    <?php
    }
    ?>
</section>

<?php
if (isset($_SESSION['connected'])) { ?>
    <?php
    if ($jeu->isAvailable()) {
    ?>
        <div class="d-flex justify-content-center">
            <a href="location.php?id=<?php echo $jeu->getId() ?>" class="btn btn-success mb-5">Louer</a>
        </div>
<?php
    }
}

$coms = $pdo->prepare("SELECT com, firstname_u FROM l_jeux_utilisateurs
                        NATURAL JOIN utilisateurs
                        WHERE id_j=:gameId
                        AND com IS NOT NULL");
$coms->execute(
    [
        'gameId' => $jeu->getId()
    ]
);

require_once __DIR__ . "/classes/Com.php";
while ($com = $coms->fetch()) {
    $commentaire = new Com($com['firstname_u'], $com['com']);
    $commentaire->displayCom();
}

require_once __DIR__ . "/layout/footer.php";
