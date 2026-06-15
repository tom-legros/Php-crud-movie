<?php

declare(strict_types=1);

use Entity\Movie;
use Entity\Collection\MovieCollection;
use Html\AppWebPage;

if (!isset($_GET['artistId']) || !ctype_digit($_GET['artistId'])) {
    header('location: /');

    exit(302);
}

$artistId = (int) $_GET['artistId'];
$movie = "";
$webPage = new AppWebPage();
$webPage->setTitle("Albums de {$movie->getTitle()}");
$webPage->appendContent("<h1>{$movie->getTille()}</h1>");


echo $webPage->toHTML();
