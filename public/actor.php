<?php

declare(strict_types=1);

use Entity\People;
use Entity\Collection\PeopleCollection;
use Html\AppWebPage;


$webPage = new AppWebPage('Film - Nom Acteur');
foreach ($Actors as $actor) {
    $name = $actor->getName();
    $placeOfBirth = $actor->getPlaceOfBirth();
    $birthday = $actor->getBirthday();
    $deathday = $actor->getDeathday();
    $biography = $actor->getBiography();
    $poster = $actor->getPosterById($actor->getPosterID());
    $decodePoster = base64_encode($poster->getJpeg());
    $list .= "<p><img src=\"data:image/jpeg;base64,{$decodePoster}\"><a href=\"https:http://localhost:8000/actor.php?avatarId={$id}\">{$title}</a></p>";
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
