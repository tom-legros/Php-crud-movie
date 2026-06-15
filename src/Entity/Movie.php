<?php

declare(strict_types=1);


namespace Entity;

use Database\MyPdo;

class F
{
    private ?int $id;
    private string $name;

    private function __construct() {}

    public static function create(string $name, ?int $id = null): static
    {
        $artist = new self();
        $artist->setId($id);
        $artist->setName($name);

        return $artist;
    }
