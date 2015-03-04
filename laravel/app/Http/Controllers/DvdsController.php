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
	 * Show the create page to the user
	 *
	 * @return Response
	 */
	public function create()
	{
		$ratings = Dvd::getAllRatings();
		$genres = Dvd::getAllGenres();
        $labels = Dvd::getAllLabels();
        $sounds = Dvd::getAllSounds();
        $formats = Dvd::getAllFormats();

		return view('create', [
			'genres' => $genres,
			'ratings' => $ratings,
            'labels' => $labels,
            'sounds' => $sounds,
            'formats' => $formats,
		]);
	}

	/**
	 * Create the DVD based on create page input
	 *
	 * @return Redirect
	 */
	public function postDvd(Request $request)
	{
		$dvd = new Dvd();
		$dvd->title = $request->input('title');
		$dvd->genre_id = $request->input('genre_id');
		$dvd->rating_id = $request->input('rating_id');
		$dvd->label_id = $request->input('label_id');
		$dvd->sound_id = $request->input('sound_id');
		$dvd->format_id = $request->input('format_id');

		if ($dvd->save()) {

			return redirect('dvds/create')->with('success', 'Your DVD has been created.');
		}
		else {
			return redirect('dvds/create')
				->withInput();
		}
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
	 *
	 * @return Redirect
	 */
	public function postReview(Request $request, $id)
	{
		// We don't need to validate the id, there is no way to send a bad id to this function
		$validation = Review::validate($request->all());

		if ($validation->passes()) {
			 Review::insert([
				'dvd_id' => $id,
				'title' => $request->input('title'),
				'rating' => $request->input('rating'),
				'description' => $request->input('description')
			]);
			return redirect('dvds/' . $id)->with('success', 'Your review has been posted.');
		}
		else {
			return redirect('dvds/' . $id)
				->withInput()
				->withErrors($validation);
		}
	}

	/**
	 * Show all dvds in the specified genre
	 *
	 * @return Response
	 */
	public function genreResults($genreName)
	{
		$results = Dvd::with('label', 'rating', 'format', 'sound', 'genre')
			->whereHas('genre', function($query) use ($genreName)
			{
				$query->where('genre_name', '=', $genreName);
			})
			->get();

		return view('genre_results', [
			'genre_name' => $genreName,
			'results' => $results
		]);
	}

}
