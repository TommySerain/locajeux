<?php
$games = new GamesDbFRomFile;
var_dump($games);
try {
    foreach ($games as $game) {
        $extensionGame = $game['6'];
        // var_dump($game);
        // var_dump($extensionGame);
        if ($extensionGame === 0) {
            $extensionGame = null;
        }
        // TODO:Supprimer filetoDb, initDB et gamesDbFromFile si je ne trouve pas une solution facilement
        $statement = $pdo->prepare("INSERT INTO jeux (id_j, name_j, img_j, rules_j, loc_j, caution_j, id_j_p, id_t, id_c)
        VALUES (:id,:name,:img,:rules,:loc,:caution,:id_p,:id_t,:id_c)");
        $statement->execute(
            [
                'id' => $game['0'],
                'name' => $game['1'],
                'img' => $game['2'],
                'rules' => $game['3'],
                'loc' => $game['4'],
                'caution' => $game['5'],
                'id_p' => $extensionGame,
                'id_t' => $game['7'],
                'id_c' => $game['8'],
            ]
        );
    };
} catch (PDOException $e) {
}
