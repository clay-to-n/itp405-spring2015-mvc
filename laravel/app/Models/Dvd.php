<?php namespace App\Models;

use Illuminate\Support\Facades\DB;

class Dvd {

    public static function search($term)
    {
        return DB::table('dvds')
            ->join('ratings', 'ratings.id', '=', 'dvds.rating_id')
            ->join('genres', 'genres.id', '=', 'dvds.genre_id')
            ->join('labels', 'labels.id', '=', 'dvds.label_id')
            ->join('sounds', 'sounds.id', '=', 'dvds.sound_id')
            ->join('formats', 'formats.id', '=', 'dvds.format_id')
            ->where('title', 'LIKE', '%' . $term . '%')
            ->orderBy('title', 'asc')
            ->get();
    }

    public static function getAllRatings()
    {
        return DB::table('ratings')->get();
    }

    public static function getAllGenres()
    {
        return DB::table('genres')->get();
    }
}
