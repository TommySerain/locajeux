<?php
require_once __DIR__ . "/Game.php";

class GamesDbFromFile
{
    private array $game;
    private int $id;
    private string $name;
    private string $picture;
    private string $rules;
    private int $locP;
    private int $cautP;
    private int $idP;
    private int $type;
    private int $category;
    private const GAMES_FILE = __DIR__ . "/../data/jeux.txt";

    public function __construct()
    {
        $gamesContent = file(self::GAMES_FILE,  FILE_IGNORE_NEW_LINES);
        // var_dump($gamesContent);
        foreach ($gamesContent as $line) {
            $this->game = explode(",", $line);
            [$id, $name, $picture, $rules, $locP, $cautP, $idP, $type, $category] = $this->game;
            $this->id = intval($id);
            $this->name = $name;
            $this->picture = $picture;
            $this->rules = $rules;
            $this->locP = intval($locP);
            $this->cautP = intval($cautP);
            $this->idP = intval($idP);
            $this->type = intval($type);
            $this->category = intval($category);
            // $this->game =
            //     [
            //         "id_j" => $this->id,
            //         "name_jeu" => $this->name,
            //         "img_j" => $this->picture,
            //         "rules_j" => $this->rules,
            //         "loc_j" => $this->locP,
            //         "caution_j" => $this->cautP,
            //         "id_j_p" => $this->idP,
            //         "id_t" => $this->type,
            //         "id_c" => $this->category
            //     ];
        }
    }

    public function getGames(): array
    {
        return $this->game;
    }
}
