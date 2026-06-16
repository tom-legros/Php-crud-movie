<?php

namespace Entity\Collection;

use Database\MyPdo;
use Entity\People;

class PeopleCollection{
    public function findAll(): array
    {
        $stmt = MyPdo::getInstance()->prepare(
            <<<'SQL'
            SELECT avatarId,name,birthday,deathday,biography,placeOfBirth
            FROM people
            WHERE id IS NOT NULL
            ORDER BY name ASC
SQL
        );
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, People::class);
    }
}