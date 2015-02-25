<?php namespace App\Http\Controllers;

use App\Models\Review;
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
		$dvd = Dvd::getById($id);
		$reviews = Review::getByDvdId($id);

		return view('reviews', [
			'dvd' => $dvd,
			'reviews' => $reviews
		]);
	}

	/**
	 * Post a new review of a DVD
	 */
	public function postReview(Request $request, $id)
	{
		// We don't need to validate the id, there is no way to send a bad id to this function
		$validation = Review::validate($request->all());

		if ($validation->passes()) {
			 Review::create([
				'dvd_id' => $id,
				'title' => $request->input('title'),
				'rating' => $request->input('rating'),
				'description' => $request->input('description')
			]);
			return redirect('dvds/' . $id)->with('success', 'Review created successfully');
		}
		else {
			return redirect('dvds/' . $id)
				->withInput()
				->withErrors($validation);
		}
	}

}
