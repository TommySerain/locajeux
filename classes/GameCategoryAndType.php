<?php

class GameCategoryAndType
{
    private array $ArrayGame;
    public function __construct(
        private int $idGame,
        private PDO $pdo
    ) {
        $stmt = $this->pdo->prepare("SELECT * FROM jeux NATURAL JOIN types NATURAL JOIN categories WHERE id_j=:id");
        $stmt->execute(
            [
                'id' => $this->idGame
            ]
        );
        $this->ArrayGame = $stmt->fetch();
    }

    public function getArrayGame(): array
    {
        return $this->ArrayGame;
    }

    public function getGameCategoryName(): string
    {
        return $this->ArrayGame['name_c'];
    }
    public function getGameTypeName(): string
    {
        return $this->ArrayGame['name_t'];
    }
}
