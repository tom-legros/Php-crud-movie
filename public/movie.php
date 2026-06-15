<?php

declare(strict_types=1);

use Entity\Movie;
use Entity\Collection\MovieCollection;
use Html\AppWebPage;

$webPage = new AppWebPage();

$Movies = (new MovieCollection())->findAll();

$list = '';
foreach ($Movies as $movie) {
    $title = $webPage->$movie->getTitle();
    $id = $movie->getId();
    $list .= "<p>{$id}{$title}</p>";
}
$content = <<<HTML
<div class="list">
{$list}
</div>
HTML;

$webPage->setTitle("Films");
$webPage->appendContent($content);
echo $webPage->toHTML();
