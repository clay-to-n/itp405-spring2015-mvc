<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;

class RottenTomatoes {

    /**
     * Searches Rotten Tomatoes for the requested movie
     *
     * @param String $dvd_title
     * @return Array with keys:     'runtime'
     *                              'critic_score'
     *                              'audience_score'
     *                              'cast'
     *                              'poster'
     */
    public static function search($dvd_title)
    {
        $title = urlencode($dvd_title);

        if (Cache::has("rt-$title")) {
            return Cache::get("rt-$title");
        }

        $url = 'http://api.rottentomatoes.com/api/public/v1.0/movies.json?page=1&apikey=87xywyzasfagv6thadkr86fm&q=';
        $url .= $title;
        $jsonString = file_get_contents($url);
        $response = json_decode($jsonString, true);
        $film = NULL;
        foreach($response['movies'] as $movie) {
            if (strcasecmp($movie['title'], $dvd_title) == 0) {
                $cast = '';
                foreach($movie['abridged_cast'] as $castMember) {
                    $cast .= $castMember['name'] . ', ';
                }
                $cast = substr($cast, 0, -2);
                $film = array(
                    'runtime'           => $movie['runtime'],
                    'critic_score'      => $movie['ratings']['critics_score'],
                    'audience_score'    => $movie['ratings']['audience_score'],
                    'cast'              => $cast,
                    'poster'            => $movie['posters']['thumbnail']
                );
                break;
            }
        }
        Cache::put("rt-$title", $film, 60);

        return $film;
    }
}