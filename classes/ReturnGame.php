<?php

class ReturnGame
{
    public function __construct(
        private int $gameId,
        private int $userId,
        private PDO $pdo
    ) {
        $majJeu = $this->pdo->prepare("UPDATE jeux SET disponible=1 WHERE id_j=:gameId");
        $majJeu->execute(
            [
                'gameId' => $this->gameId
            ]
        );
        $majDateDispo = $pdo->prepare("UPDATE l_jeux_utilisateurs SET date_dispo=NULL WHERE id_j=:gameId AND id_u=:userId");
        $majDateDispo->execute(
            [
                'gameId' => $this->gameId,
                'userId' => $this->userId
            ]
        );
    }

    public function getGameId(): int
    {
        return $this->gameId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }
}
