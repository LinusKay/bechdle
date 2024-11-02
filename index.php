<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Text:ital@0;1&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=star" />
    <title>Bechdle</title>
    <style>
        .material-symbols-outlined {
            font-variation-settings:
            'FILL' 0,
            'wght' 400,
            'GRAD' 0,
            'opsz' 24;
            display:inline-block;
        }
        :root {
            --background-colour: #212326; 
        }
        @media (prefers-color-scheme: dark) {
            :root {
                /* Dark theme variables */
                --background-colour: #212326;
            }
        }
        @media (prefers-color-scheme: light) {
            :root {
                /* Light theme variables */
                --background-colour: cornflowerblue;
            }
        }
        @keyframes fadein {
            from {
                opacity:0;
                margin-top:10vh;
            }
            to {
                opacity:1;
                margin-top:5vh;
            }
        }
        body {
            background-color: var(--background-colour);
            color: white;
            text-align: center;
            font-size:20px;
            animation: fadein 1s ease;
            margin-top:5vh;
        }
        h1 {
            font-size:50px;
            font-family: "DM Serif Text", serif;
            margin-bottom:10px;
        }
        p {
            font-family: "Roboto", sans-serif;
        }
        .button {
            padding:10px;
            border-radius:10px;
            border: none;
            width:175px;
            background: #111;
            color:white;
            cursor:pointer;
            font-size:0.7em;
        }
        .button-pass:hover {
            background: cornflowerblue;
        }
        .button-fail:hover {
            background: #FE6847;
        }
        .poster {
            width:250px;
        }
        .backdrop {
            width:100vw;
            height:35vh;
            position:absolute;
            z-index: -1;
            overflow:hidden;
            top:0;
            left:0;
        }
        .backdrop img {
            width:100%;
            filter: blur(10px);
            margin-top:-150px;
        }
        .correct {
            color: green;
        }
        .incorrect {
            color:#FE6847;
        }
        .rating {
            margin-top:0;
        }
        .title-box {
            position: absolute;
            top: 10px;
            left: 20px;
            margin:0;
            padding:0;
            opacity:0.7;
        }
        .page-title {
            font-family: "DM Serif Text", serif;
            color: white;
            font-size:45px;
            margin:0;
            padding:0;
        }
        .subtitle {
            font-size:20px;
            font-family: "DM Serif Text", serif;
            margin:0;
            padding:0;
            text-align: left;
            margin-top:-20px;
            opacity:0.7;
        }
        .title-box a {
            text-decoration: none;
            color:white;
        }
        .title-box:hover {
            opacity:1;
        }
        .overview {
            opacity:0.7;
            max-width:700px;
            margin:auto;
        }
        .rating-low {
            color:red;
        }
        .rating-mid {
            color:yellow;
        }
        .rating-high {
            color:green;
        }
        .rating-kino {
            color:gold;
        }
    </style>
</head>
<body>
    <?php
        // bechdeltest data
        $movieDataFile = "movie.json";
        $movieDataJson = file_get_contents($movieDataFile);
        $movieData = json_decode($movieDataJson, true); 
        $movieTitle = $movieData["title"];
        $movieYear = $movieData["year"];
        $movieScore = $movieData["rating"];
        $moviePass = $movieScore > 2 ? 'pass' : 'fail';
        $movieImdbId = $movieData["imdbid"];

        // the movie db data based on bechdeltest IMDB id 
        $apiKey = "I NEARLY PUSHED THIS";
        $apiUrl = "https://api.themoviedb.org/3/find/tt$movieImdbId?api_key=$apiKey&external_source=imdb_id";
        $response = file_get_contents($apiUrl);
        $movieDataTmdb = json_decode($response, true)["movie_results"][0];
        $movieRating = $movieDataTmdb["vote_average"];
        $movieRatingTier = "high";
        if($movieRating < 4) { $movieRatingTier = "low"; }
        else if($movieRating >= 4 && $movieRating < 7) { $movieRatingTier = "mid"; }
        else if($movieRating >= 7 && $movieRating < 9) { $movieRatingTier = "high"; }
        else if($movieRating >= 9) { $movieRatingTier = "kino"; }
        $movieImage = $movieDataTmdb["poster_path"];
        $movieBackdrop = $movieDataTmdb["backdrop_path"];
        $movieId = $movieDataTmdb["id"];
        $movieOverview = $movieDataTmdb["overview"];
        // print_r($movieDataTmdb);

        $answerSubmitted = '';
        $correct = false;
        $message = 'You answered <span class="incorrect">incorrectly</span>!';
        // Check if the form was submitted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['pass'])) {
                $answerSubmitted = 'pass';
            } elseif (isset($_POST['fail'])) {
                $answerSubmitted = 'fail';
            }
            if($answerSubmitted == $moviePass) {
                $correct = true;
                $message = 'You answered <span class="correct">correctly</span>!';
            }
        }
    ?>
    <div class="title-box">
        <a href="https://bonesfor.sale">
            <p class="page-title">bechdle</p>
            <p class="subtitle">by libus</p>
        </a>
    </div>
    <div class="backdrop"><img src="https://image.tmdb.org/t/p/w780/<?php echo $movieBackdrop; ?>"></div>
    <a href="https://www.themoviedb.org/movie/<?php echo $movieId; ?>" target="_blank">
        <img class="poster" src="https://image.tmdb.org/t/p/w600_and_h900_bestv2/<?php echo $movieImage; ?>">
    </a>
    <h1 class="movie-title"><?php echo "$movieTitle ($movieYear)"; ?></h1>
    <p class="rating rating-<?php echo $movieRatingTier;?>"><span class="material-symbols-outlined">star</span><?php echo $movieRating; ?>/10</p>
    <p class="overview"><?php echo $movieOverview; ?></p>
    <p>Does this movie pass the Bechdel Test?</p>
    <form method="post">
        <button class="button button-pass" type="submit" name="pass" value="pass">PASS</button>
        <button class="button button-fail" type="submit" name="fail" value="fail">FAIL</button>
    </form>
    <?php 
    if($answerSubmitted) {
        echo "<p>$message</p>";
        echo "<p>This movie passed $movieScore out of 3 criteria</p>";
    }
    ?>

</body>
</html>