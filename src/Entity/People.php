<?php

declare(strict_types=1);

namespace Entity;

use Entity\Exception\EntityNotFoundException;
use Database\MyPdo;

class People
{
    private int $avatarId;
    private string $name;
    private string $birthday;
    private ?string $deathday;
    private string $biography;
    private string $placeOfBirth;

    private function __construct()
    {
    }

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

    public function getBirthday(): string
    {
        return $this->birthday;
    }

    public function setBirthday(string $birthday): void
    {
        $this->birthday = $birthday;
    }

    public function getDeathday(): ?string
    {
        return $this->deathday;
    }

    public function setDeathday(?string $deathday): void
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

    public static function findById(int $id): self
    {
        $stmt = MyPdo::getInstance()->prepare(
            <<<'SQL'
            SELECT id, avatarId, name, birthday, deathday, biography, placeOfBirth
            FROM People
            WHERE id = :id
            SQL
        );
        $stmt->execute([':id' => $id]);
        $ligne = $stmt->fetch(\PDO::FETCH_ASSOC);
        if (false === $ligne) {
            throw new EntityNotFoundException(
                sprintf("L'id n'as pas éte trouve", $id)
            );
        }
        $people = new self();
        $people->id = $ligne['id'];
        $people->name = $ligne['name'];
        $people->birthday = $ligne['birthday'];
        $people->deathday = $ligne['deathday'];
        $people->biography = $ligne['biography'];
        $people->placeOfBirth = $ligne['placeOfBirth'];

        return $people;
    }
}
