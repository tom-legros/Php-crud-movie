<?php

namespace Entity\Collection;

use Entity\Genre;

class GenreCollection
{
    public function findAll(): array
    {
        $stmt = MyPdo::getInstance()->prepare(
            <<<'SQL'
            SELECT name,id
            FROM Genre
            WHERE id IS NOT NULL
            ORDER BY id ASC
            SQL
        );
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, Genre::class);
    }
}