<?php

class GameAvailability
{

    public function __construct(
        private int $gameId,
        private bool $dispo,
        private PDO $pdo
    ) {
    }

    public function displayAvailability(): void
    {
        if ($this->dispo) {
?>
            <p class="my-auto fw-bold pb-4">Disponible</p>
        <?php } else {
            $date = $this->pdo->prepare("SELECT date_dispo FROM l_jeux_utilisateurs WHERE id_j=:idJ AND date_dispo IS NOT NULL");
            $date->execute(
                [
                    'idJ' => $this->gameId
                ]
            );
            $date = $date->fetch();
        ?>
            <p class="my-auto fw-bold">Date de disponibilité : </p>
            <p class="my-auto fw-bold text-danger"><?php echo dateToFrenchFormat($date['date_dispo']); ?></p>
<?php }
    }

    public function getGameId(): int
    {
        return $this->gameId;
    }

    public function getDispo(): bool
    {
        return $this->dispo;
    }
}
