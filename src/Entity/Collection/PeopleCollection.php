<?php

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Movie;
use Entity\People;

class PeopleCollection{
    public function findAll(): array
    {
        $stmt = MyPdo::getInstance()->prepare(
            <<<'SQL'
            SELECT avatarId,name,birthday,deathday,biography,placeOfBirth,id
            FROM people
            WHERE avatarId IS NOT NULL
            ORDER BY name ASC
SQL
        );
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, People::class);
    }
    public function findByIdMovie(int $movieId): array
    {
        $stmt = MyPdo::getInstance()->prepare(
            <<<'SQL'
        SELECT p.avatarId, p.name, p.birthday, p.deathday,
               p.biography, p.placeOfBirth, p.id, c.role
        FROM people p
        JOIN cast c ON c.peopleId = p.id
        WHERE p.avatarId IS NOT NULL
        AND c.movieId = :movieId
        ORDER BY c.orderIndex ASC
        SQL
        );
        $stmt->execute([':movieId' => $movieId]);

        $lignes = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $acteurs = [];

        foreach ($lignes as $ligne) {
            $people = People::findById($ligne['id']);
            $people->setRole($ligne['role']);
            $acteurs[] = $people;
        }

        return $acteurs;
    }

}