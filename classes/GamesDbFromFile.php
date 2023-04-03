<?php
require_once __DIR__ . "/Game.php";

class GamesDbFromFile
{
    private array $game;
    private const GAMES_FILE = __DIR__ . "/../data/jeux.txt";

    public function __construct()
    {
        $gamesContent = file(self::GAMES_FILE,  FILE_IGNORE_NEW_LINES);
        // var_dump($gamesContent);
        // TODO:ATTENTION DEPUIS LA MODIFICATION DELA CLASS GAME IL FAUT REFAIRE CETTE CLASS SIMPLEMENT AVEC UN TABLEAU AU LIEU D'UN NEW GAME
        foreach ($gamesContent as $line) {
            $gameInfos = explode(",", $line);
            [$id, $name, $picture, $rules, $locP, $cautP, $idP, $type, $category] = $gameInfos;
            // var_dump($gameInfos);
            $this->game =
                [
                    "id_j" => intval($id),
                    "name_jeu" => $name,
                    "img_j" => $picture,
                    "rules_j" => $rules,
                    "loc_j" => intval($locP),
                    "caution_j" => intval($cautP),
                    "id_j_p" => intval($idP),
                    "id_t" => intval($type),
                    "id_c" => intval($category)
                ];
        }
    }

    public function getGames(): array
    {
        return $this->game;
    }
}
