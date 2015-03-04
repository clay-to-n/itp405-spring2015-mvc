<!DOCTYPE html>
<html>
<head>
    <!-- jQuery might be overkill for this tiny app but we need it for bootstrap-select -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css">

    <script src="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>

    <link href="/css/create.css" rel="stylesheet">

    <title>Add DVD</title>
</head>

<body>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger" role="alert"> {{ $error }} </div>
            @endforeach
            @if (Session::has('success'))
                <div class="alert alert-success" role="alert"> {{ Session::get('success') }} </div>
            @endif
            <h1>Add a DVD</h1>
            <br/>
            <form method="post" class="dvd-create" action="{{ url('dvds') }}">
                <div class="input-group dvd-create">

                    <input type="hidden"  name="_token" value="{{ csrf_token() }}">

                    <input type="text" class="form-control" name="title" placeholder="DVD Title">

                    <span>
                        <select name="genre_id" class="selectpicker" data-live-search="true" data-width="100%">
                            <option value="">
                                Genres
                            </option>
                            @foreach($genres as $genre)
                                <option value="{{ $genre->id }}"> {{ $genre->genre_name }}</option>;
                            @endforeach
                        </select>
                        <select name="rating_id" class="selectpicker" data-live-search="true" data-width="100%">
                            <option value="">
                                Ratings
                            </option>
                            @foreach($ratings as $rating)
                                <option value="{{ $rating->id }}"> {{ $rating->rating_name }}</option>;
                            @endforeach
                        </select>
                        <select name="label_id" class="selectpicker" data-live-search="true" data-width="100%">
                            <option value="">
                                Labels
                            </option>
                            @foreach($labels as $label)
                                <option value="{{ $label->id }}"> {{ $label->label_name }}</option>;
                            @endforeach
                        </select>
                        <select name="sound_id" class="selectpicker" data-live-search="true" data-width="100%">
                            <option value="">
                                Sound Formats
                            </option>
                            @foreach($sounds as $sound)
                                <option value="{{ $sound->id }}"> {{ $sound->sound_name }}</option>;
                            @endforeach
                        </select>
                        <select name="format_id" class="selectpicker" data-live-search="true" data-width="100%">
                            <option value="">
                                Formats
                            </option>
                            @foreach($formats as $format)
                                <option value="{{ $format->id }}"> {{ $format->format_name }}</option>;
                            @endforeach
                        </select>
                    </span>

                    <button class="btn btn-default" type="submit" name="submit" style="width:100%">
                        Add DVD
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>

</html>