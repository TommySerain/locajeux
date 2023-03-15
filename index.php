<?php
require_once __DIR__."/classes/GamesDb.php";
require_once __DIR__."/layout/header.php";
$dsn = "mysql:host=host.docker.internal;port=3306;dbname=locajeux;charset=utf8mb4";  //le port 3306 est celui par défaut donc on n'est pas obligé de le renseigner
try {
    $pdo= new PDO($dsn, "locajeux", "a7]ZMlUaYrM(_c.!");
} catch (PDOException $e) {
    die('Une erreur est survenue : '. $e->getCode().' - ' . $e->getMessage());
}

$games= new GamesDb;
// var_dump($games);
?>
<section class="container-fluid">
<div class="row">

<?php
foreach ($games->getGames() as $game) {?>
    <div class="col-3 p-0">
        <div class="border border-2 border-danger m-4">
            <img class="imgJeux w-100 m-0" src="<?php echo $game->getPicture() ;?>" alt="">
        </div>
    </div>
<?php
$idGame=$game->getId();
$nameGame=$game->getName();
$PictureGame=$game->getPicture();
$rulesGame=$game->getRules();
$typeGame=$game->getType();
$catGame=$game->getCategory();
$locGame=$game->getLocP();
$cautionGame=$game->getCautP();


$statement=$pdo->query("INSERT INTO jeux (id_j,name_j, img_j, rules_j, loc_j, caution_j, id_t, id_c)
VALUES ('$idGame','$nameGame','$PictureGame','$rulesGame',$locGame,$cautionGame,$typeGame,$catGame)");
var_dump($idGame);
var_dump($nameGame);
}?>

</div>
</section>

<?php
require_once __DIR__."/layout/footer.php";