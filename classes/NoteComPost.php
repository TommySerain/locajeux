<?php

class NoteComPost
{
    public function __construct(
        private int $note,
        private string $com,
        private int $userId,
        private int $gameId,
        private PDO $pdo
    ) {
        $noteComs = $this->pdo->prepare("UPDATE l_jeux_utilisateurs
                            SET note=:note, com=:com
                            WHERE id_u=:userId
                            AND id_j=:gameId
                            AND note IS NULL
                            AND com IS NULL
                            AND date_dispo IS NULL;");
        $noteComs->execute(
            [
                'note' => $this->note,
                'com' => $this->com,
                'userId' => $this->userId,
                'gameId' => $this->gameId
            ]
        );
    }
}
