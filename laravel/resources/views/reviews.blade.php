<!DOCTYPE html>
<html>
    <head>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

        <script src="/js/bootstrap-rating-input.min.js"></script>
        <link rel="stylesheet" href="/css/reviews.css">
        
        <title>{{ $dvd->title }} Reviews</title>
    </head>
    <body>
    <div class="container">
        <hr/>
        <div class="row">
            <div class="col-md-3 col-md-offset-1">
                <div class="row">
                    <h1 class="pull-right">{{ $dvd->title }}</h1>
                </div>
                @if($tomatoes_data)
                    <div class="row">
                        <img src="{{$tomatoes_data['poster']}}" class="pull-right">
                    </div>
                @endif
            </div>
            <div class="col-md-7">

                <table class="table">
                    <thead>
                        <tr>
                          <th>Genre</th>
                          <th>Rating</th>
                          <th>Label</th>
                          <th>Sound</th>
                          <th>Format</th>
                          <th>Release Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                          <td>{{ $dvd->genre_name }}</td>
                          <td>{{ $dvd->rating_name }}</td>
                          <td>{{ $dvd->label_name }}</td>
                          <td>{{ $dvd->sound_name }}</td>
                          <td>{{ $dvd->format_name }}</td>
                          <td>{{ date("M d, Y", strtotime($dvd->release_date)) }}</td>
                        </tr>
                    </tbody>
                </table>
                @if($tomatoes_data)
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Critic Score</th>
                            <th>Audience Score</th>
                            <th>Runtime</th>
                            <th>Abridged Cast</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{ $tomatoes_data['critic_score'] }}</td>
                            <td>{{ $tomatoes_data['audience_score'] }}</td>
                            <td>{{ $tomatoes_data['runtime'] }} m</td>
                            <td>{{ $tomatoes_data['cast'] }}</td>
                        </tr>
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
        <hr/>
        <div class="row">
            <form method="post" action="{{ url('dvds/' . $dvd->id) }}">
                <div class="form-group col-md-6 col-md-offset-3">
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger" role="alert"> {{ $error }} </div>
                    @endforeach
                    @if (Session::has('success'))
                        <div class="alert alert-success" role="alert"> {{ Session::get('success') }} </div>
                    @endif
                    <h3>Submit a Review</h3>

                    <input type="hidden"  name="_token" value="{{ csrf_token() }}">
                    <div class="review-title">
                        <input type="text" class="form-control" name="title" placeholder="Review Title" value="{{ Request::old('title') }}">
                    </div>
                    <div id="review-stars">
                        Rating: 
                        <span>
                            <input type="number" data-max="10" data-min="1" name="rating" id="some_id" class="rating" value="{{ Request::old('rating') }}" />
                        </span>
                    </div>
                    <textarea class="form-control review-text" rows="5" name="description" placeholder="What did you think about {{ $dvd->title }} ?">{{ Request::old('description') }}</textarea>
                    <div class="text-right">
                        <button class="btn btn-primary" type="submit" style="width:20%">
                            Submit
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="row">           
            <h3>Reviews</h3>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @if(count($reviews) == 0)
                   <tr> <td>No reviews have been posted.</td></tr>
                @endif

                @foreach ($reviews as $review)
                    <tr>
                      <td class="col-md-2">
                          <p>
                          <?php
                            for ($i = 0; $i < 10; $i++) {
                                if ($i < $review->rating)
                                    echo ('<i class="glyphicon glyphicon-star"></i>');
                                else
                                    echo ('<i class="glyphicon glyphicon-star-empty"></i>');
                            }
                          ?>
                          </p>
                      </td>
                      <td><strong>{{ $review->title }}</strong><br/>{{ $review->description }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        
    </div> <!-- container -->
    </body>
</html>