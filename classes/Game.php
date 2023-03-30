<?php

class Game
{
    public function __construct(
        private int $id,
        private string $name,
        private string $picture,
        private string $rules,
        private int $locP,
        private int $cautP,
        private int $idP,
        private int $type,
        private int $category,
        private bool $available = true
    ) {
    }

    public function getId(): int
    {
        return $this->id;
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

    public function isExtension():bool
    {
        if($this->idP!==0){
            return true;
        }else{
            return false;
        }
    }
}
