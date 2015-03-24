<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Dvd extends Model {

    //protected $fillable = array('title', 'rating_id', 'genre_id', 'format_id', 'sound_id', 'label_id');

    public static function search($search)
    {
        $search = (object) $search;

        $query = DB::table('dvds')
            ->join('ratings', 'ratings.id', '=', 'dvds.rating_id')
            ->join('genres', 'genres.id', '=', 'dvds.genre_id')
            ->join('labels', 'labels.id', '=', 'dvds.label_id')
            ->join('sounds', 'sounds.id', '=', 'dvds.sound_id')
            ->join('formats', 'formats.id', '=', 'dvds.format_id')
            ->select('*', 'dvds.id');

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
            ->join('formats', 'formats.id', '=', 'dvds.format_id')
            ->select('*', 'dvds.id')
            ->where('dvds.id', $id);
        
        return $query->first();
    }

    public static function validate($dvd)
    {

    }

    public static function getAllRatings()
    {
        return DB::table('ratings')->get();
    }

    public static function getAllGenres()
    {
        return DB::table('genres')->get();
    }

    public static function getAllLabels()
    {
        return DB::table('labels')->get();
    }

    public static function getAllSounds()
    {
        return DB::table('sounds')->get();
    }

    public static function getAllFormats()
    {
        return DB::table('formats')->get();
    }

    public function review()
    {
        return $this->hasMany('App\Models\Review');
    }

    public function rating()
    {
        return $this->belongsTo('App\Models\Rating');
    }

    public function format()
    {
        return $this->belongsTo('App\Models\Format');
    }

    public function genre()
    {
        return $this->belongsTo('App\Models\Genre');
    }

    public function label()
    {
        return $this->belongsTo('App\Models\Label');
    }

    public function sound()
    {
        return $this->belongsTo('App\Models\Sound');
    }
}
