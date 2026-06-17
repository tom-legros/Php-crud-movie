<?php

namespace Entity\Collection;

use Entity\Movie;
use Database\MyPdo;
use Entity\Genre;

class GenreCollection
{
    public function findAll(): array
    {
        $stmt = MyPdo::getInstance()->prepare(
            <<<'SQL'
            SELECT name,id
            FROM genre
            WHERE id IS NOT NULL
            ORDER BY id ASC
            SQL
        );
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, Genre::class);
    }

    public function findByGenre(int $genreId): array
    {
        $stmt = MyPdo::getInstance()->prepare(
            <<<'SQL'
        SELECT m.posterId, m.originalLanguage, m.originalTitle, m.overview,
               m.releaseDate, m.runtime, m.tagline, m.title, m.id
        FROM movie m
        JOIN movie_genre mg ON mg.movieId = m.id
        WHERE m.posterId IS NOT NULL
        AND mg.genreId = :genreId
        ORDER BY m.title ASC
        SQL
        );
        $stmt->execute([':genreId' => $genreId]);

        return $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, Movie::class);
    }
}

