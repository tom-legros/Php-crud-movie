<?php

declare(strict_types=1);


namespace Entity;

use Database\MyPdo;
use Entity\Image;

class Movie
{
    private int $id;
    private int $posterId;
    private string $originalLanguage;
    private ?string $originalTitle;
    private string $overview;
    private string $releaseDate;
    private  int $runtime;
    private ?string $tagline;
    private string $title;


    private function __construct() {}


    public function getOriginalLanguage(): string
    {
        return $this->originalLanguage;
    }

    public function setOriginalLanguage(string $originalLanguage): void
    {
        $this->originalLanguage = $originalLanguage;
    }

    public function getPosterId(): ?int
    {
        return $this->posterId;
    }

    public function setPosterId(?int $posterId): void
    {
        $this->posterId = $posterId;
    }

    public function getOriginalTitle(): string
    {
        return $this->originalTitle;
    }

    public function setOriginalTitle(string $originalTitle): void
    {
        $this->originalTitle = $originalTitle;
    }

    public function getOverview(): string
    {
        return $this->overview;
    }

    public function setOverview(string $overview): void
    {
        $this->overview = $overview;
    }

    public function getReleaseDate(): string
    {
        return $this->releaseDate;
    }

    public function setReleaseDate(string $releaseDate): void
    {
        $this->releaseDate = $releaseDate;
    }

    public function getRuntime(): int
    {
        return $this->runtime;
    }

    public function setRuntime(int $runtime): void
    {
        $this->runtime = $runtime;
    }

    public function getTagline(): string
    {
        return $this->tagline;
    }

    public function setTagline(string $tagline): void
    {
        $this->tagline = $tagline;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setMovieId(?int $id): void
    {
        $this->id = $id;
    }
    public function getPosterById(int $posterId): Image
    {
        {$stmt = MyPdo::getInstance()->prepare(
                <<<'SQL'
        SELECT id,jpeg
        FROM image
        WHERE id = :id
        SQL
            );
            $stmt->execute([':id' => $posterId]);

            $ligne = $stmt->fetch(\PDO::FETCH_ASSOC);

            $poster = new image();
            $poster->setImageId($ligne['id']);
            $poster->setJpeg(($ligne['jpeg']));

            return $poster;
        }


    }
}

