<?php
declare(strict_types=1);

use Entity\Movie;
use Entity\Image;
use Entity\Collection\MovieCollection;
use Entity\Collection\GenreCollection;
use Html\AppWebPage;

$webPage = new AppWebPage();

$genres = (new GenreCollection())->findAll();

if (isset($_GET['genreId']) && ctype_digit($_GET['genreId'])) {
    $genreId = (int) $_GET['genreId'];
    $movies = (new MovieCollection())->findByGenre($genreId);
} else {
    $genreId = null;
    $movies = (new MovieCollection())->findAll();
}

$list = '<div class="filter">';
$list .= '<form method="get">';
$list .= '<select name="genreId" onchange="this.form.submit()">';
$list .= '<option value="">-- Tous les genres --</option>';
foreach ($genres as $genre) {
    $selected = ($genreId === $genre->getId()) ? 'selected' : '';
    $list .= '<option value="' . $genre->getId() . '" ' . $selected . '>' . $genre->getName() . '</option>';
}
$list .= '</select>';
$list .= '</form>';
$list .= '</div>';

$list .= '<div class="list">';
foreach ($movies as $movie) {
    $id = $movie->getId();
    $title = $movie->getTitle();
    $poster = $movie->getPosterById($movie->getPosterId());
    $decodePoster = base64_encode($poster->getJpeg());
    $list .= '<div class="poster-movie"><img src="data:image/jpeg;base64,' . $decodePoster . '" alt="' . $title . '"><a href="movie.php?movieId=' . $id . '">' . $title . '</a></div>';
}
$list .= '</div>';

$content = $list;

$webPage->setTitle('Films');
$webPage->appendContent($content);
echo $webPage->toHTML();
