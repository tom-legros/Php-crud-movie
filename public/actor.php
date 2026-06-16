<?php

declare(strict_types=1);

use Entity\Collection\MovieCollection;
use Entity\Exception\EntityNotFoundException;
use Entity\People;
use Entity\Collection\PeopleCollection;
use Html\WebPage;

if (!isset($_GET['peopleId']) || !ctype_digit($_GET['peopleId'])) {
    header('location: /');
    exit(302);
}

$peopleId = (int) $_GET['peopleId'];

try {
    $people = People::findById($peopleId);
} catch (EntityNotFoundException) {
    http_response_code(404);
    exit;
}

$vignette = $people->getAvatarById($people->getAvatarId());
$decodeVignette = base64_encode($vignette->getJpeg());

$MovieCollection = new MovieCollection();
$Movies = $MovieCollection->findByIdAvatar($peopleId);

$webPage = new WebPage();
$webPage->setTitle("Films - {$people->getName()}");
$webPage->appendCssUrl('/css/style.css');
$webPage->appendCssUrl('/css/actor.css');

$Actors = (new PeopleCollection())->findAll();

$content  = '<a class="back-link" href="/">&#8592; Retour à l\'accueil</a>';
$content .= '<div class="header"><h1>'.$webPage->getTitle().'</h1></div>';
$content .= '<div class="content">';
$content .= '<div class="actor">';
$content .= '<img class="actor-vignette" src="data:image/jpeg;base64,' . $decodeVignette . '" alt="' . $people->getName() . '">';
$content .= '<div class="actor-info">';
$content .= '<div class="actor-name">'.$people->getName().'</div>';
$content .= '<div class="actor-place">'.$people->getPlaceOfBirth().'</div>';
$content .= '<div class="actor-dates">'.$people->getBirthday().' - '.$people->getDeathday().'</div>';
$content .= '<div class="actor-biography">'.$people->getBiography().'</div>';
$content .= '</div></div>';

foreach ($Movies as $movie) {
    $PosterMovie = $movie->getPosterById($movie->getPosterId());
    $decodePoster = base64_encode($PosterMovie->getJpeg());

    $content .= '<a class="cast-card" href="/movie.php?movieId=' . $movie->getId() . '">';
    $content .= '<img class="cast-avatar" src="data:image/jpeg;base64,' . $decodePoster . '" alt="' . $movie->getTitle() . '">';
    $content .= '<div class="cast-info">';
    $content .= '<div class="cast-title">';
    $content .= '<span>' . $movie->getTitle() . '</span>';
    $content .= '<span class="cast-date">' . $movie->getReleaseDate() . '</span>';
    $content .= '</div>';
    $content .= '<span class="cast-role">' . $movie->getRole() . '</span>';
    $content .= '</div>';
    $content .= '</a>';
}
$webPage->appendContent($content);
echo $webPage->toHTML();