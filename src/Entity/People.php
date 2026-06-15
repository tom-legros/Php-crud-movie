<?php

declare(strict_types=1);

namespace Entity;

use Database\MyPdo;

class People
{
    private int $avatarId;
    private string $name;
    private \DateTime $birthday;
    private \DateTime $deathday;
    private string $biography;
    private string $placeOfBirth;

    private function __construct() {}

    public function getAvatarId(): int
    {
        return $this->avatarId;
    }

    public function setAvatarId(int $avatarId): void
    {
        $this->avatarId = $avatarId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getBirthday(): \DateTime
    {
        return $this->birthday;
    }

    public function setBirthday(\DateTime $birthday): void
    {
        $this->birthday = $birthday;
    }

    public function getDeathday(): \DateTime
    {
        return $this->deathday;
    }

    public function setDeathday(\DateTime $deathday): void
    {
        $this->deathday = $deathday;
    }

    public function getPlaceOfBirth(): string
    {
        return $this->placeOfBirth;
    }

    public function setPlaceOfBirth(string $placeOfBirth): void
    {
        $this->placeOfBirth = $placeOfBirth;
    }

    public function getBiography(): string
    {
        return $this->biography;
    }

    public function setBiography(string $biography): void
    {
        $this->biography = $biography;
    }



}

