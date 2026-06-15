<?php

declare(strict_types=1);

use Entity\People;
use Entity\Collection\PeopleCollection;
use Html\AppWebPage;


$webPage = new AppWebPage('Film - Nom Acteur');

$content = <<<HTML
<div class="actor-info">
    <img src="">
    <div>nom, lieu, dates, bio</div>
</div>

<div class="filmography">
    <a href="movie.php?id=X">
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
