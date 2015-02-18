<?php namespace App\Models;

use Illuminate\Support\Facades\DB;

class Dvd {

    public function search($term)
    {
        return DB::table('dvds')
            ->join('artists', 'ratings.id', '=', 'songs.rating_id')
            ->join('genres', 'genres.id', '=', 'songs.genre_id')
            ->where('title', 'LIKE', '%' . $term . '%')
            ->orderBy('title', 'asc')
            ->get();
    }
}