<?php
declare(strict_types=1);

namespace Entity;
namespace Html;

use Entity\Exception\EntityNotFoundException;
use Entity\Movie;
use Entity\Collection\MovieCollection;
use Html\AppWebPage;

if (!isset($_GET['movieId']) || !ctype_digit($_GET['movieId'])) {
    header('location: /');

    exit(302);
}

$MovieId = (int) $_GET['movieId'];

try {
    $movie = Movie::findById($MovieId);
} catch (EntityNotFoundException) {
    http_response_code(404);

    exit;
}

$webPage = new AppWebPage();
$webPage->setTitle("{$movie->getTitle()}");
$webPage->appendContent("<h1>{$movie->getreleaseDate()}</h1>");
$webPage->appendContent("<h1>{$movie->getOriginalTitle()}</h1>");
$webPage->appendContent("<h1>{$movie->gettagline()}</h1>");
$webPage->appendContent("<h1>{$movie->getOverview()}</h1>");

echo $webPage->toHTML();



