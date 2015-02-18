<!DOCTYPE html>
<html>
<head>
    <!-- jQuery might be overkill for this tiny app but we need it for bootstrap-select -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css">

    <script src="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>

    <link href="/css/search.css" rel="stylesheet">

    <title>Song Search</title>
</head>

<body>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">

            <form method="post" class="dvd-search" action="{{ url("dvds") }}">
                <div class="input-group dvd-search">

                    <input type="hidden"  name="_token" value="{{ csrf_token() }}">

                    <input type="text" class="form-control" name="title" placeholder="DVD Title">

                    <span>
                        <select name="genre_id" class="selectpicker" data-live-search="true" data-width="100%">
                            <option value="-1">
                                All Genres
                            </option>
                            <?php
                            foreach($genres as $genre){
                                echo "<option value=" . $genre->id . ">" . $genre->genre_name . "</option>";
                            }
                            ?>
                        </select>
                        <select name="rating_id" class="selectpicker" data-live-search="true" data-width="100%">
                            <option value="-1">
                                All Ratings
                            </option>
                            <?php
                            foreach($ratings as $rating){
                                echo "<option value=" . $rating->id . ">" . $rating->rating_name . "</option>";
                            }
                            ?>
                        </select>
                    </span>

                    <button class="btn btn-default" type="submit" name="submit" style="width:100%">
                        Search
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
</body>

</html>