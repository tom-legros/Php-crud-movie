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
    $decodePoster = base64_encode($poster->getJpeg());
    $list .= "<p><img src=\"data:image/jpeg;base64,{$decodePoster}\"><a href=\"https:http://localhost:8000/movie.php\">{$title}</a></p>";
}
$content = $list;

$webPage->setTitle("Films");
$webPage->appendContent($content);
echo $webPage->toHTML();
