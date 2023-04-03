<?php

class Note
{
    private array $noteTab;
    private int $note;
    public function __construct(
        private int $idUser,
        private int $idGame,
        private PDO $pdo
    ) {
        $notes = $this->pdo->prepare("SELECT note FROM l_jeux_utilisateurs WHERE id_u=:userId AND id_j=:gameId AND note IS NOT NULL;");
        $notes->execute(
            [
                'userId' => $this->idUser,
                'gameId' => $this->idGame
            ]
        );
        $this->noteTab = $notes->fetch();
    }
    public function getNoteTab(): array
    {
        return $this->noteTab;
    }

    public function getNote(): int
    {
        $this->note = $this->noteTab['note'];
        return $this->note;
    }
}
