# Bechdle

Guess if the daily movie passes the Bechdel test.

1. It has to have at least two named women in it
2. Who talk to each other
3. About something besides a man

A site i made for a friend based on a joke whilst watching Underworld and scrolling [Bechdel Test Movie List](https://bechdeltest.com/). It's spelt wrong on purpose, to mimic other daily -dle puzzle/guessing games. 

## Data

Data from the Bechdel list is downloaded to `getAllMovies.json`, (up to date as of November 3rd, 2024), to avoid slamming their limited bandwidth. The IMDB IDs from this data is then referenced live against The Movie Database (TMDB), since IMDB are less accessible. 

Bechdel Test Movie List |
[Website](https://bechdeltest.com/) |
[API](https://bechdeltest.com/api/v1/doc)

The Movie Database (TMDB) |
[Website](https://www.themoviedb.org) |
[API](https://developer.themoviedb.org/docs/getting-started)
[Live Website](https://bonesfor.sale/bechdle/)

![Website Preview](https://bonesfor.sale/bechdle/bechdle-preview.png "Website Preview")

# Hosting/Developing
* Set `$apiKey` within `index.php` to your The Movie DB [API key](https://developer.themoviedb.org/docs/getting-started).

* Run `pickmovie.php` to select a new movie

## Source Data