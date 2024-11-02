<?php
    $moviesDataFile = "getAllMovies.json";
    $moviesDataJson = file_get_contents($moviesDataFile);
    $moviesData = json_decode($moviesDataJson, true);
    $movie = $moviesData[array_rand($moviesData, 1)];
    $movieJson = json_encode($movie, JSON_PRETTY_PRINT);
    $outputFilePath = "movie.json";
    file_put_contents($outputFilePath, $movieJson)
?>