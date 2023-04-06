<?php

class LocationJeu

{

    public function __construct(
        private int $gameId,
        private int $userId,
        private string $dateLoc,
        private string $dateDispo,
        private PDO $pdo,
    ) {

        $majJeu = $this->pdo->prepare("UPDATE jeux SET disponible=0 WHERE id_j=:id");
        $majJeu->execute(
            [
                'id' => $this->gameId
            ]
        );

        $majJeu = $this->pdo->prepare("INSERT INTO l_jeux_utilisateurs (id_j, id_u, date_loc, date_dispo)
            VALUES (:gameId, :userId, :dateLoc, :dateDispo)");
        $majJeu->execute(
            [
                'gameId' => $this->gameId,
                'userId' => $this->userId,
                'dateLoc' => "$this->dateLoc",
                'dateDispo' => "$this->dateDispo"
            ]
        );
    }

    public function getDateDispo(): string
    {
        return $this->dateDispo;
    }

    public function getDateLoc(): string
    {
        return $this->dateLoc;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getGameId(): int
    {
        return $this->gameId;
    }
}
