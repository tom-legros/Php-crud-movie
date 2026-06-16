<?php

declare(strict_types=1);

use Entity\People;
use Entity\Collection\PeopleCollection;
use Html\AppWebPage;


$webPage = new WebPage();
$webPage->setTitle("Films - {$people->getName()}");
$webPage->appendCssUrl('/css/style.css');
$webPage->appendCssUrl('/css/actor.css');

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

foreach ($Actors as $people) {
    $id = $people->getid();
    $name = $people->getName();
    $placeOfBirth = $people->getPlaceOfBirth();
    $birthday = $people->getBirthday();
    $deathday = $people->getDeathday();
    $biography = $people->getBiography();
    $vignette = $people->getAvatarById($people->getAvatarId());
    $decodeVignette = base64_encode($vignette->getJpeg());
    $list .= "<p><img src=\"data:image/jpeg;base64,{$decodeVignette}\"><a href=\"actor.php?avatarId={$id}\">{$name}</a></p>";
}

$content = $list;
$webPage->appendContent($content);
echo $webPage->toHTML();
