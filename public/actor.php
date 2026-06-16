<?php

declare(strict_types=1);

use Entity\People;
use Entity\Collection\PeopleCollection;
use Html\AppWebPage;


$webPage = new AppWebPage('Film - Nom Acteur');

$Actors = (new PeopleCollection())->findAll();

foreach ($Actors as $people) {
    $name = $people->getName();
    $placeOfBirth = $people->getPlaceOfBirth();
    $birthday = $people->getBirthday();
    $deathday = $people->getDeathday();
    $biography = $people->getBiography();
    $vignette = $people->getVignetteById($people->getAvatarId());
    $decodePoster = base64_encode($vignette->getJpeg());
    $list .= "<p><img src=\"data:image/jpeg;base64,{$decodeVignette}\"><a href=\"https:http://localhost:8000/actor.php?avatarId={$id}\">{$title}</a></p>";
}
$content = <<<HTML
<div class="actor-info">
    <img src="">
    <div>nom, lieu, dates, bio</div>
</div>

<div class="filmography">
    <a href="index.php?id=X">
        <img src="poster">
        <span>Titre</span>
        <span>Date</span>
        <span>Rôle</span>
    </a>
    ...
</div>
HTML;

$webPage->appendContent($content);
echo $webPage->toHTML();
