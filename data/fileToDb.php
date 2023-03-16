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
        
        $statement=$pdo->prepare("INSERT INTO jeux (id_j,name_j, img_j, rules_j, loc_j, caution_j, id_t, id_c)
        VALUES (:id,:name,:img,:rules,:loc,:caution,:id_t,:id_c)");
        $statement->execute(
            [
                'id'=>$idGame,
                'name'=>$nameGame,
                'img'=>$PictureGame,
                'rules'=>$rulesGame,
                'loc'=>$locGame,
                'caution'=>$cautionGame,
                'id_t'=>$typeGame,
                'id_c'=>$catGame,
            ]
        );
        $stmt= $pdo->query("SELECT * FROM jeux");
    };
} catch (PDOException $e) {
    
}
// $statement=$pdo->query("INSERT INTO jeux (id_j,name_j, img_j, rules_j, loc_j, caution_j, id_t, id_c)
//         VALUES ('$idGame','$nameGame','$PictureGame','$rulesGame',$locGame,$cautionGame,$typeGame,$catGame)");
//         $stmt= $pdo->query("SELECT * FROM jeux");