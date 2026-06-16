<?php
declare(strict_types=1);

namespace Entity;
namespace Html;

use Entity\Movie;
use Entity\Collection\MovieCollection;
use Html\AppWebPage;

if (!isset($_GET['movieId']) || !ctype_digit($_GET['movieId'])) {
    header('location: /');

    exit(302);
}

$MovieId = (int) $_GET['movieId'];