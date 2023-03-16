<?php
$games= new GamesDbFRomFile;

$stmt= $pdo->query("SELECT * FROM jeux");


try {
    foreach ($games->getGames() as $game) {
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
        $stmt= $pdo->query("SELECT * FROM jeux");
    };
} catch (PDOException $e) {
    
}
