<?php


class USER
{
    private ?int $id;

    public function __construct(
        private string $name,
        private string $firstname,
        private string $birthdate,
        private string $email,
        private string $address,
        private string $mdp,

    ) {

    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }
    public function setName($name): USER
    {
        $this->name = $name;
        return $this;
    }

    public function getFirstname(): string
    {
        return $this->firstname;
    }
    public function setFirstname($firstname): USER
    {
        $this->firstname = $firstname;
        return $this;
    }

    public function getBirthdate(): string
    {
        return $this->birthdate;
    }
    public function setBirthdate($birthdate): USER
    {
        $this->birthdate = $birthdate;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
    public function setEmail($email): USER
    {
        $this->email = $email;
        return $this;
    }

    public function getAddress(): string
    {
        return $this->address;
    }
    public function setAddress($address): USER
    {
        $this->address = $address;
        return $this;
    }

    public function getMdp(): string
    {
        return $this->mdp;
    }
    public function setMdp($mdp): USER
    {
        $this->mdp = $mdp;
        return $this;
    }
}
