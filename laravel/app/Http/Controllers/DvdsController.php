<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Dvd;

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
		$ratings = Dvd::getAllRatings();
		$genres = Dvd::getAllGenres();

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
		$results = Dvd::search([
			'title' => $request->input('title'),
			'genre_id' => $request->input('genre_id'),
			'rating_id' => $request->input('rating_id')
		]);

		return view('results', [
			'title' => $request->input('title'),
			'results' => $results
		]);
	}
  
    /**
	 * Show the reviews of a particular DVD
	 *
	 * @return Response
	 */
	public function reviews(Request $request, $id)
	{
		$results = Dvd::getById($id);

		return view('reviews', [
			'title' => $id,//$request->input('title'),
			'result' => $results
		]);
	}

}
