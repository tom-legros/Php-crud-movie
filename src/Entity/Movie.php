<?php

declare(strict_types=1);


namespace Entity;

use Database\MyPdo;
use Entity\Exception\EntityNotFoundException;
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
    private ?string $role = null;

    private function __construct() {}
    public static function create(int $id,string $originalLanguage,string $overview,string $releaseDate,int $runtime,?string $title ): static
    {
        $movie = new self();
        $movie->setMovieId($id);
        $movie->setoriginalLanguage($originalLanguage);
        $movie->setoverview($overview);
        $movie->setreleaseDate($releaseDate);
        $movie->setruntime($runtime);
        $movie->settitle($title);
        return $movie;
    }
    public function delete(): static
    {
        $stmt = MyPdo::getInstance()->prepare(
            <<<'SQL'
        DELETE FROM movie
        WHERE id = :id
        SQL
        );
        $stmt->execute([':id' => $this->id]);
        $this->setMovieId(null);

        return $this;
    }
    protected function update(): static
    {
        $stmt = MyPdo::getInstance()->prepare(
            <<<'SQL'
        UPDATE movie
        SET originalLanguage = :originalLanguage
        SET overview = :overview
        SET releaseDate = :releaseDate
        SET runtime = :runtime
        SET $title = :title
        WHERE id = :id
        SQL
        );
        $stmt->execute([':originalLanguage' => $this->originalLanguage,':overview' => $this->overview,':releaseDate' => $this->releaseDate,':runtime' => $this->runtime,':title' => $this->title,':id' => $this->id]);

        return $this;
    }
    protected function insert(): static
    {
        $stmt = MyPdo::getInstance()->prepare(
            <<<'SQL'
        INSERT INTO movie (originalLanguage,overview,releaseDate,runtime,title)
        VALUES (:originalLanguage,:overview,:releaseDate,:runtime,:title)
        SQL
        );
        $stmt->execute([':originalLanguage' => $this->originalLanguage,':overview' => $this->overview,':releaseDate' => $this->releaseDate,':runtime' => $this->runtime,':title' => $this->title]);
        $this->setMovieId((int) MyPdo::getInstance()->lastInsertId());

        return $this;
    }




    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(?string $role): void
    {
        $this->role = $role;
    }


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

    public function getTagline(): ?string
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
    public function getPosterById(int $PosterId): Image
    {
        {$stmt = MyPdo::getInstance()->prepare(
                <<<'SQL'
        SELECT id,jpeg
        FROM image
        WHERE id = :id
        SQL
            );
            $stmt->execute([':id' => $PosterId]);

            $ligne = $stmt->fetch(\PDO::FETCH_ASSOC);

            $poster = new image();
            $poster->setImageId($ligne['id']);
            $poster->setJpeg(($ligne['jpeg']));

            return $poster;
        }
    }
        public static function findById(int $id): self
    {
        $stmt = MyPdo::getInstance()->prepare(
            <<<'SQL'
            SELECT posterId,originalLanguage,originalTitle,overview,releaseDate,runtime,tagline,title,id
            FROM movie 
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
        $movie = new self();
        $movie->id = $ligne['id'];
        $movie->posterId = $ligne['posterId'];
        $movie->originalLanguage = $ligne['originalLanguage'];
        $movie->originalTitle = $ligne['originalTitle'];
        $movie->overview = $ligne['overview'];
        $movie->releaseDate = $ligne['releaseDate'];
        $movie->runtime = $ligne['runtime'];
        $movie-> tagline= $ligne['tagline'];
        $movie-> title= $ligne['title'];


        return $movie;
    }

}

