<?php
$games = new GamesDbFRomFile;

try {
    foreach ($games->getGames() as $game) {
        $extensionGame = $game['id_j_p'];
        if ($extensionGame === 0) {
            $extensionGame = null;
        }

        $statement = $pdo->prepare("INSERT INTO jeux (id_j, name_j, img_j, rules_j, loc_j, caution_j, id_j_p, id_t, id_c)
        VALUES (:id,:name,:img,:rules,:loc,:caution,:id_p,:id_t,:id_c)");
        $statement->execute(
            [
                'id' => $game['id_j'],
                'name' => $game['name_j'],
                'img' => $game['img_j'],
                'rules' => $game['rules_j'],
                'loc' => $game['loc_j'],
                'caution' => $game['caution_j'],
                'id_p' => $extensionGame,
                'id_t' => $game['id_t'],
                'id_c' => $game['id_c'],
            ]
        );
    };
} catch (PDOException $e) {
}
