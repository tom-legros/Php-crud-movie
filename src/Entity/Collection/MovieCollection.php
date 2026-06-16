<?php

declare(strict_types=1);

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Movie;
use Entity\People;

class MovieCollection{
    public function findAll(): array
    {
        $stmt = MyPdo::getInstance()->prepare(
            <<<'SQL'
            SELECT posterId,originalLanguage,originalTitle,overview,releaseDate,runtime,tagline,title,id
            FROM movie
            WHERE id IS NOT NULL
            ORDER BY title ASC
SQL
        );
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, Movie::class);
    }

    public function findByIdAvatar(int $peopleId): array
    {
        $stmt = MyPdo::getInstance()->prepare(
            <<<'SQL'
        SELECT m.posterId,m.originalLanguage,m.originalTitle,m.overview,m.releaseDate,m.runtime,m.tagline,m.title,m.id,c.role
        FROM movie m 
        JOIN cast c ON c.movieId = m.id
        WHERE m.posterId IS NOT NULL
        AND c.peopleId = :peopleId
        ORDER BY c.orderIndex ASC
        SQL
        );
        $stmt->execute([':peopleId' => $peopleId]);

        $lignes = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $moovies = [];

        foreach ($lignes as $ligne) {
            $movie = Movie::findById($ligne['id']);
            $movie->setRole($ligne['role']);
            $moovies[] = $movie;
        }

        return $moovies;
    }
}

