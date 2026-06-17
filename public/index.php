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
    $id = $movie->getId();
    $title = $movie->getTitle();
    $poster = $movie->getPosterById($movie->getPosterID());
    $decodePoster = base64_encode($poster->getJpeg());
    $list .= "<div class=\"poster-movie\"><img src=\"data:image/jpeg;base64,{$decodePoster}\" alt=\"{$title}\"><span><a href=\"movie.php?movieId={$id}\">{$title}</a></span></div>";
}
$list .= '</div>';
$content = $list;

$webPage->setTitle("Films");
$webPage->appendContent($content);
echo $webPage->toHTML();
