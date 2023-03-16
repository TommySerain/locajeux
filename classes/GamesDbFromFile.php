<?php
require_once __DIR__."/Game.php";

class GamesDbFromFile
{
    private array $game;
    private const GAMES_FILE = __DIR__."/../data/jeux.txt";
    
    public function __construct()
    {
        $gamesContent = file(self::GAMES_FILE,  FILE_IGNORE_NEW_LINES);
        // var_dump($gamesContent);
        
        foreach ($gamesContent as $line){
            $gameInfos = explode(",",$line);
            [$id, $name, $picture, $rules, $locP, $cautP, $idP, $type, $category] = $gameInfos;
            // var_dump($gameInfos);
            $this->game []= new Game (
                intval($id),
                $name,
                $picture,
                $rules,
                intval($locP),
                intval($cautP),
                intval($idP),
                intval($type),
                intval($category),
            );
            
        }
    }

    public function getGames():array
    {
        return $this->game;
    }
}