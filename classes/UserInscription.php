<?php
require_once __DIR__ . "/exceptions/DuplicateEmailException.php";
require_once __DIR__ . "/exceptions/InvalidEmailException.php";
require_once __DIR__ . "/exceptions/InvalidDateException.php";
require_once __DIR__ . "/exceptions/InvalidAgeException.php";

class UserInscription
{
    private ?int $id;

    public function __construct(
        private string $name,
        private string $firstname,
        private string $birthdate,
        private string $email,
        private string $address,
        private string $mdp,
        private PDO $pdo
    ) {

        $stmt = $this->pdo->prepare("SELECT * FROM utilisateurs WHERE email=:email");
        $stmt->execute(['email' => $this->email]);
        $test = $stmt->fetch();
        if ($test !== false) {
            throw new DuplicateEmailException();
            redirect("index.php?erreur=6");
        }

        if (!$this->isEmailValid()) {
            throw new InvalidEmailException();
            redirect("index.php?erreur=7");
        }

        if (!$this->isDateValid()) {
            throw new InvalidDateException();
            redirect("index.php?erreur=8");
        }

        if (!$this->isMajeur()) {
            throw new InvalidAgeException();
            redirect("index.php?erreur=9");
        }
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getFirstname(): string
    {
        return $this->firstname;
    }

    public function getBirthdate(): string
    {
        return $this->birthdate;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getMdp(): string
    {
        return $this->mdp;
    }

    private function isEmailValid(): bool
    {
        return filter_var($this->email, FILTER_VALIDATE_EMAIL) !== false;
    }

    private function isDateValid(): bool
    {
        $date = strtotime($this->birthdate);
        return $date;
    }

    private function isMajeur(): bool
    {
        $today = date("Y-m-d");
        $date = $this->birthdate;
        $diff = date_diff(date_create($date), date_create($today));
        intval($diff->format("y"));
        $diff = intval($diff->format("%y"));
        return $diff >= 18 ? true : false;
    }

    public function userDbInscription()
    {
        $stmt = $this->pdo->prepare("INSERT INTO utilisateurs (name_u, firstname_u, naissance_u, email, address_u, mdp_u)
    VALUES (:nom,:firstname,:naissance,:email,:adresse,:mdp)");

        $stmt->execute(
            [
                'nom' => $this->name,
                'firstname' => $this->firstname,
                'naissance' => date('Y-m-d', strtotime($this->birthdate)),
                'email' => $this->email,
                'adresse' => $this->address,
                'mdp' => password_hash($this->mdp, PASSWORD_DEFAULT),
            ]
        );
    }
}
