<!DOCTYPE html>
<html>
<head>
    <title>Dvd Search Results</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1>All {{ $genre_name }} DVD's</h1>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Title</th>
            <th>Rating</th>
            <th>Label</th>
            <th>Sound</th>
            <th>Format</th>
            <th>Release Date</th>
            <th>Reviews</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($results as $result)
            <tr>
                <td>{{ $result->title }}</td>
                <td>{{ $result->rating->rating_name }}</td>
                <td>{{ $result->label->label_name }}</td>
                <td>{{ $result->sound->sound_name }}</td>
                <td>{{ $result->format->format_name }}</td>
                <td>{{ date("M d, Y", strtotime($result->release_date)) }}</td>
                <td><a href="{{ url(('dvds/' . $result->id)) }}">Reviews</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</body>
</html>