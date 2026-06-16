<?php

declare(strict_types=1);

use Entity\People;
use Entity\Collection\PeopleCollection;
use Html\AppWebPage;


$webPage = new AppWebPage('Film - Nom Acteur');

$Actors = (new PeopleCollection())->findAll();

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
//$content = <<<HTML
//<div class="actor-info">
//    <img src="">
//    <div>nom, lieu, dates, bio</div>
//</div>
//
//<div class="filmography">
//    <a href="index.php?id=X">
//        <img src="poster">
//        <span>Titre</span>
//        <span>Date</span>
//        <span>Rôle</span>
//    </a>
//    ...
//</div>
//HTML;

$content = $list;
$webPage->appendContent($content);
echo $webPage->toHTML();
