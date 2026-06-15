<?php

declare(strict_types=1);

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Movie;

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
}

