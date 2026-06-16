<?php
declare(strict_types=1);

namespace Entity;
namespace Html;

use Entity\Exception\EntityNotFoundException;
use Entity\Movie;
use Entity\Collection\PeopleCollection;
use Html\WebPage;

if (!isset($_GET['movieId']) || !ctype_digit($_GET['movieId'])) {
    header('location: /');
    exit(302);
}

$movieId = (int) $_GET['movieId'];

try {
    $movie = Movie::findById($movieId);
} catch (EntityNotFoundException) {
    http_response_code(404);
    exit;
}

$poster = $movie->getPosterById($movie->getPosterID());
$decodePoster = base64_encode($poster->getJpeg());

$peopleCollection = new PeopleCollection();
$actors = $peopleCollection->findByIdMovie($movieId);

$webPage = new WebPage();
$webPage->setTitle("Films - {$movie->getTitle()}");
$webPage->appendCssUrl('/css/style.css');
$webPage->appendCssUrl('/css/movie.css');

$content  = '<div class="header"><h1>'.$webPage->getTitle().'</h1></div>';
$content .= '<div class="content">';
$content .= '<div class="movie">';
$content .= '<img class="movie-poster" src="data:image/jpeg;base64,' . $decodePoster . '" alt="' . $movie->getTitle() . '">';
$content .= '<div class="movie-info">';
$content .= '<div class="movie-title-row">';
$content .= '<span class="movie-title">'.$movie->getTitle().'</span>';
$content .= '<span class="movie-date">'.$movie->getReleaseDate().'</span>';
$content .= '</div>';
$content .= '<div class="movie-original-title">'.$movie->getOriginalTitle().'</div>';
$content .= '<div class="movie-tagline">'.$movie->getTagline().'</div>';
$content .= '<div class="movie-overview">'.$movie->getOverview().'</div>';
$content .= '</div>';
$content .= '</div>';

$content .= '<div class="cast-list">';
foreach ($actors as $actor) {
    $actorAvatar = $actor->getAvatarById($actor->getAvatarId());
    $decodeAvatar = base64_encode($actorAvatar->getJpeg());

    $content .= '<a class="cast-card" href="/actor.php?peopleId=' . $actor->getId() . '">';
    $content .= '<img class="cast-avatar" src="data:image/jpeg;base64,' . $decodeAvatar . '" alt="' . $actor->getName() . '">';
    $content .= '<div class="cast-info">';
    $content .= '<span class="cast-role">' . $actor->getRole() . '</span>';
    $content .= '<span class="cast-name">' . $actor->getName() . '</span>';
    $content .= '</div>';
    $content .= '</a>';
}
$content .= '</div>';

$content .= '</div>';

$webPage->appendContent($content);
echo $webPage->toHTML();