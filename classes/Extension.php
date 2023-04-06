<?php
require_once __DIR__ . "/Game.php";

class Extension extends Game
{
    protected array $gameParent;
    public function __construct(
        protected ?int $idP,
        protected PDO $pdo
    ) {
        $stmt = $pdo->prepare("SELECT * FROM jeux WHERE id_j=:id");
        $stmt->execute(
            [
                'id' => $idP
            ]
        );
        $this->gameParent = $stmt->fetch();
    }

    public function getGameParent(): mixed
    {
        return $this->gameParent;
    }
}
