<?php

class Game
{
    private array $game;
    private string $name;
    private string $picture;
    private string $rules;
    private int $locP;
    private int $cautP;
    private ?int $idP;
    private int $type;
    private int $category;
    private bool $available = true;

    public function __construct(
        private int $gameId,
        private PDO $pdo
    ) {
        $stmt = $this->pdo->prepare("SELECT * FROM jeux WHERE id_j=:id");
        $stmt->execute(
            [
                "id" => $this->gameId
            ]
        );
        $this->game = $stmt->fetch();
        $this->name = $this->game['name_j'];
        $this->picture = $this->game['img_j'];
        $this->rules = $this->game['rules_j'];
        $this->locP = $this->game['loc_j'];
        $this->cautP = $this->game['caution_j'];
        $this->idP = $this->game['id_j_p'];
        $this->type = $this->game['id_t'];
        $this->category = $this->game['id_c'];
        $this->available = $this->game['disponible'];
    }

    public function getGame(): array
    {
        return $this->game;
    }

    public function getId(): int
    {
        return $this->gameId;
    }

    public function getLocP(): int
    {
        return $this->locP;
    }
    public function setLocP($locP): int
    {
        if ($locP !== "") {
            return $this->locP = $locP;
        }
    }

    public function getCautP(): int
    {
        return $this->cautP;
    }
    public function setCautP($cautP): int
    {
        if ($cautP !== "") {
            return $this->cautP = $cautP;
        }
    }

    public function getIdP(): int
    {
        if ($this->idP === NULL) {
            return 0;
        }
        return $this->idP;
    }
    public function setIdP($idP): int
    {
        if ($idP !== "") {
            return $this->idP = $idP;
        }
    }

    public function getName(): string
    {
        return $this->name;
    }
    public function setName($name): string
    {
        if ($name !== "") {
            return $this->name = $name;
        }
    }

    public function getType(): string
    {
        return $this->type;
    }
    public function setType($type): string
    {
        if ($type !== "") {
            return $this->type = $type;
        }
    }

    public function getCategory(): string
    {
        return $this->category;
    }
    public function setCategory($category): string
    {
        if ($category !== "") {
            return $this->category = $category;
        }
    }

    public function getPicture(): string
    {
        return $this->picture;
    }
    public function setPicture($picture): string
    {
        if ($picture !== "") {
            return $this->picture = $picture;
        }
    }

    public function getRules(): string
    {
        return $this->rules;
    }
    public function setRules($rules): string
    {
        if ($rules !== "") {
            return $this->rules = $rules;
        }
    }

    public function getAvailable($availabe): bool
    {
        return $this->available;
    }
    public function setAvailable($available): bool
    {
        if ($available !== "") {
            return $this->available = $available;
        }
    }

    public function isAvailable(): bool
    {
        if ($this->available) {
            return true;
        }
        return false;
    }

    public function isExtension(): bool
    {
        if ($this->getIdP() !== 0) {
            return true;
        } else {
            return false;
        }
    }
}
