<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $movie['title'] }} - Detail</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-dark text-white">

    <div class="container py-5">

        <!-- Tombol kembali -->
        <a href="{{ url()->previous() }}" class="btn btn-secondary mb-4">⬅ Back</a>

        <div class="row">
            <!-- Poster -->
            <div class="col-md-4">
                <img src="https://image.tmdb.org/t/p/w500{{ $movie['poster_path'] }}"
                     class="img-fluid rounded shadow" alt="Poster">
            </div>

            <!-- Detail -->
            <div class="col-md-8">
                <h1>{{ $movie['title'] }}</h1>

                @if(!empty($movie['backdrop_path']))
                    <img src="https://image.tmdb.org/t/p/w780{{ $movie['backdrop_path'] }}"
                         class="img-fluid rounded mb-3 shadow" alt="Backdrop">
                @endif

                <p class="mt-3">{{ $movie['overview'] }}</p>

                <p><strong>Release Date:</strong> {{ $movie['release_date'] }}</p>
                <p><strong>Rating:</strong> ⭐ {{ $movie['vote_average'] }}/10</p>
            </div>
        </div>

        <hr class="border-light my-4">

        <!-- Trailer -->
        <h2 class="mb-3">Trailer</h2>

        @if (!empty($trailers) && count($trailers) > 0)
            @foreach ($trailers as $trailer)
                <div class="ratio ratio-16x9 mb-4">
                    <iframe 
                        src="https://www.youtube.com/embed/{{ $trailer['key'] }}"
                        title="{{ $trailer['name'] }}"
                        allowfullscreen
                        class="rounded shadow">
                    </iframe>
                </div>
            @endforeach
        @else
            <p class="text-muted">No trailers available.</p>
        @endif

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
