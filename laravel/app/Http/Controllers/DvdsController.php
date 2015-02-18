<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DvdsController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| DVDs Controller
	|--------------------------------------------------------------------------
	|
	| This controller lets you search through DVDs
	|
	*/

	/**
	 * Show the search page to the user
	 *
	 * @return Response
	 */
	public function search()
	{
		$ratings = DB::table('ratings')->get();
		$genres = DB::table('genres')->get();
		return view('search', [
			'genres' => $genres,
			'ratings' => $ratings
		]);
	}

	/**
	 * Show the results of a search to the user
	 *
	 * @return Response
	 */
	public function results(Request $request)
	{
		dd ($request);

		if (!$request->input('song_title')) {
			return redirect('/songs/search');
		}
		$query = new SongQuery();
		$songs = $query->search($request->input('song_title'));

		return view('results', [
			'song_title' => $request->input('song_title'),
			'songs' => $songs
		]);
	}

}
