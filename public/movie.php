<?php
declare(strict_types=1);

namespace Entity;
namespace Html;

use Entity\Exception\EntityNotFoundException;
use Entity\Movie;
use Html\WebPage;

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

$poster = $movie->getPosterById($movie->getPosterID());
$decodePoster = base64_encode($poster->getJpeg());

$webPage = new WebPage();
$webPage->setTitle("Films - {$movie->getTitle()}");
$webPage->appendCssUrl('/css/style.css');
$webPage->appendCssUrl('/css/movie.css');

$content  = '<div class="header"><h1>'.$webPage->getTitle().'</h1></div>';
$content .= '<div class="content">';
$content .= '<div class="movie">';
$content .= '<img class="movie-poster"'.'src="data:image/jpeg;base64,' . $decodePoster . '"' .' alt="' . $movie->getTitle() . '">';
$content .= '<div class="movie-info">';
$content .= '<div class="movie-title-row">';
$content .= '<span class="movie-title">'.$movie->getTitle() .'</span>';
$content .= '<span class="movie-date">' .$movie->getReleaseDate().'</span>';
$content .= '</div>';
$content .= '<div class="movie-original-title">' .$movie->getOriginalTitle().'</div>';
$content .= '<div class="movie-tagline">'.$movie->getTagline(). '</div>';
$content .= '<div class="movie-overview">'.$movie->getOverview().'</div>';
$content .= '</div>'.'</div>'.'</div>';

$webPage->appendContent($content);
echo $webPage->toHTML();
