<?php

declare(strict_types=1);

use Entity\People;
use Entity\Collection\PeopleCollection;
use Html\AppWebPage;

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

$webPage = new WebPage();
$webPage->setTitle("Films - {$people->getName()}");
$webPage->appendCssUrl('/css/style.css');
//$webPage->appendCssUrl('/css/actor.css');

$Actors = (new PeopleCollection())->findAll();

$content  = '<div class="header"><h1>'.$webPage->getTitle().'</h1></div>';
$content .= '<div class="content">';
$content .= '<div class="actor">';
$content .= '<img class="actor-vignette" src="data:image/jpeg;base64,' . $decodeVignette . '" alt="' . $people->getName() . '">';
$content .= '<div class="actor-info">';
$content .= '<div class="actor-name">'.$people->getName().'</div>';
$content .= '<div class="actor-place">'.$people->getPlaceOfBirth().'</div>';
$content .= '<div class="actor-dates">'.$people->getBirthday()->format('d/m/Y').' - '.$people->getDeathday()->format('d/m/Y').'</div>';
$content .= '<div class="actor-biography">'.$people->getBiography().'</div>';
$content .= '</div></div>';


$webPage->appendContent($content);
echo $webPage->toHTML();
