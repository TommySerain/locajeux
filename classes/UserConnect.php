<?php

class UserConnect
{
    private array $user;

    public function __construct(
        private PDO $pdo,
        private string $email,
        private string $mdp
    ) {
        $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE email=:email");
        $stmt->execute(
            [
                'email' => $this->email,
            ]
        );

        $this->user = $stmt->fetch();
        $uMdpH = $this->user['mdp_u'];

        if (password_verify($this->mdp, $uMdpH) === false) {
            redirect("index.php?erreur=3");
        }
        $_SESSION = [
            'id_u' => $this->user['id_u'],
            'connected' => true
        ];
    }
}
