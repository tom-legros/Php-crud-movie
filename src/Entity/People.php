<?php

declare(strict_types=1);

namespace Entity;


use Entity\Image;
use Entity\Exception\EntityNotFoundException;
use Database\MyPdo;

class  People
{
    private int $id;
    private ?int $avatarId;
    private ?string $name;
    private ?string $birthday;
    private ?string $deathday;
    private ?string $biography;
    private ?string $placeOfBirth;
    private ?string $role = null;


    private function __construct()
    {
    }
    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(?string $role): void
    {
        $this->role = $role;
    }

    public function getAvatarId(): ?int
    {
        return $this->avatarId;
    }

    public function setAvatarId(?int $avatarId): void
    {
        $this->avatarId = $avatarId;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getBirthday(): ?string
    {
        return $this->birthday;
    }

    public function setBirthday(?string $birthday): void
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

    public function getPlaceOfBirth(): ?string
    {
        return $this->placeOfBirth;
    }

    public function setPlaceOfBirth(?string $placeOfBirth): void
    {
        $this->placeOfBirth = $placeOfBirth;
    }

    public function getBiography(): ?string
    {
        return $this->biography;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setBiography(?string $biography): void
    {
        $this->biography = $biography;
    }
    public function getAvatarById(int $avatarId): Image
    {
        {$stmt = MyPdo::getInstance()->prepare(
            <<<'SQL'
        SELECT id,jpeg
        FROM image
        WHERE id = :id
        SQL
        );
            $stmt->execute([':id' => $avatarId]);

            $ligne = $stmt->fetch(\PDO::FETCH_ASSOC);

            $vignette = new image();
            $vignette->setImageId($ligne['id']);
            $vignette->setJpeg(($ligne['jpeg']));

            return $vignette;
        }
    }
    public static function findById(int $id): self
    {
        $stmt = MyPdo::getInstance()->prepare(
            <<<'SQL'
        SELECT avatarId, name, birthday, deathday, biography, placeOfBirth
        FROM people
        WHERE id = :id
        SQL
        );
        $stmt->execute([':id' => $id]);
        $ligne = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (false === $ligne) {
            throw new EntityNotFoundException(
                sprintf("L'id n'a pas été trouvé : %d", $id)
            );
        }

        $people = new self();
        $people->id = $id;
        $people->avatarId = $ligne['avatarId'];
        $people->name = $ligne['name'];
        $people->birthday = $ligne['birthday'];
        $people->deathday = $ligne['deathday'];
        $people->biography = $ligne['biography'];
        $people->placeOfBirth = $ligne['placeOfBirth'];

        return $people;
    }
}