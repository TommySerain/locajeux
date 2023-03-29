<?php
$games = new GamesDbFRomFile;

try {
    foreach ($games->getGames() as $game) {
        $extensionGame = $game->getIdP();
        if ($extensionGame === 0) {
            $extensionGame = null;
        }

        $statement = $pdo->prepare("INSERT INTO jeux (id_j, name_j, img_j, rules_j, loc_j, caution_j, id_j_p, id_t, id_c)
        VALUES (:id,:name,:img,:rules,:loc,:caution,:id_p,:id_t,:id_c)");
        $statement->execute(
            [
                'id' => $game->getId(),
                'name' => $game->getName(),
                'img' => $game->getPicture(),
                'rules' => $game->getRules(),
                'loc' => $game->getLocP(),
                'caution' => $game->getCautP(),
                'id_p' => $extensionGame,
                'id_t' => $game->getType(),
                'id_c' => $game->getCategory(),
            ]
        );
    };
} catch (PDOException $e) {
}
