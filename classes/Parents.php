<?php
require_once __DIR__ . "/Game.php";

class Parents extends Game
{
    protected array|false $gameExt;
    public function __construct(
        protected ?int $idGame,
        protected PDO $pdo
    ) {
        $stmt = $pdo->prepare("SELECT * FROM jeux WHERE id_j_p=:id ");
        $stmt->execute(
            [
                'id' => $idGame
            ]
        );
        $this->gameExt = $stmt->fetch();
    }

    public function getGameExt()
    {
        if ($this->gameExt)
            return $this->gameExt;
    }
}
