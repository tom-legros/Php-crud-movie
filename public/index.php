<?php

declare(strict_types=1);

use Entity\Movie;
use Entity\Image;
use Entity\Collection\MovieCollection;
use Html\AppWebPage;

$webPage = new AppWebPage();

$Movies = (new MovieCollection())->findAll();

$list = '';
foreach ($Movies as $movie) {
    $title = $movie->getTitle();
    $poster = $movie->getPosterById($movie->getPosterID());
    $list .= "<p>{$poster}{$title}</p>";
}
$content = <<<HTML
<div class="list">
{$list}
</div>
HTML;

$webPage->setTitle("Films");
$webPage->appendContent($content);
echo $webPage->toHTML();
