<?php namespace App\Models;

use Illuminate\Support\Facades\DB;

class Dvd {

    public static function search($search)
    {
        $search = (object) $search;

        $query = DB::table('dvds')
            ->join('ratings', 'ratings.id', '=', 'dvds.rating_id')
            ->join('genres', 'genres.id', '=', 'dvds.genre_id')
            ->join('labels', 'labels.id', '=', 'dvds.label_id')
            ->join('sounds', 'sounds.id', '=', 'dvds.sound_id')
            ->join('formats', 'formats.id', '=', 'dvds.format_id');

        // Sorry this is a mess but I could not get conditional queries to work without doing it this way

        // Search by rating and genre
        if (isset($search->rating_id) && ($search->rating_id != -1) && isset($search->genre_id) && ($search->genre_id != -1)) {
            return $query->where('title', 'LIKE', '%' . $search->title . '%')
                ->where('rating_id', 'LIKE', $search->rating_id)
                ->where('genre_id', 'LIKE', $search->genre_id)
                ->orderBy('title', 'asc')
                ->get();
        }
        // Search by rating
        if (isset($search->rating_id) && ($search->rating_id != -1)) {
            return $query->where('title', 'LIKE', '%' . $search->title . '%')
                ->where('rating_id', 'LIKE', $search->rating_id)
                ->orderBy('title', 'asc')
                ->get();
        }
        // Search by genre
        if (isset($search->genre_id) && ($search->genre_id != -1)) {
            return $query->where('title', 'LIKE', '%' . $search->title . '%')
                ->where('genre_id', 'LIKE', $search->genre_id)
                ->orderBy('title', 'asc')
                ->get();
        }

        return $query->where('title', 'LIKE', '%' . $search->title . '%')
            ->orderBy('title', 'asc')
            ->get();
    }
  
    public static function getById($id)
    {
       $query = DB::table('dvds')
        ->join('ratings', 'ratings.id', '=', 'dvds.rating_id')
        ->join('genres', 'genres.id', '=', 'dvds.genre_id')
        ->join('labels', 'labels.id', '=', 'dvds.label_id')
        ->join('sounds', 'sounds.id', '=', 'dvds.sound_id')
        ->join('formats', 'formats.id', '=', 'dvds.format_id');
        
        return $query->where('dvds.id', 1)->first();
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
