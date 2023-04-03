<?php

class AverageNote
{
    private float $note;
    public function __construct(
        private int $gameId,
    ) {
    }

    public function getNote($pdo)
    {
        $calc = $pdo->prepare("SELECT note FROM l_jeux_utilisateurs WHERE id_j=:gameId;");
        $calc->execute(
            [
                'gameId' => $this->gameId
            ]
        );
        $i = 0;
        $total = 0;
        while ($moy = $calc->fetch()) {
            $i += 1;
            $total += $moy['note'];
        }
        if ($i !== 0) {
            $this->note = round($total / $i, 1);
            return $this->note;
        }
        $this->note = 0.0;
        return $this->note;
    }
}
