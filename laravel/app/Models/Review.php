<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class Review extends Model {

    public static function validate($input)
    {
        return Validator::make($input, [
            'title' => 'required',
            'rating' => 'required | integer',
            'description' => 'required'
        ]);
    }

    public static function insert($data)
    {
        return DB::table('reviews')->insert($data);
    }

    public static function getByDvdId($id)
    {
        $query = DB::table('reviews')
            ->where('dvd_id', 'LIKE', $id);

        return $query->get();
    }

    public function dvd()
    {
        return $this->belongsTo('App\Models\Dvd');
    }
}