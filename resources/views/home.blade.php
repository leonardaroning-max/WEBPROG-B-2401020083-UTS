@extends('layouts.app')

@section('content')
<h2 class="mb-4">Popular Movies</h2>
<div class="row">

    {{-- ============================= --}}
    {{-- FILM DARI DATABASE (CRUD) --}}
    {{-- ============================= --}}
    @foreach($dbFilms as $film)
    <div class="col-md-3 mb-4">
        <div class="card h-100 shadow-sm border-success">
            <img src="{{ $film->poster }}"
                 class="card-img-top"
                 alt="{{ $film->title }}">

            <div class="card-body">
                <h5 class="card-title">{{ $film->title }}</h5>
                <p class="card-text">Rating: {{ $film->rating }}</p>

                {{-- WATCH (TRAILER YOUTUBE DARI DATABASE) --}}
                <a href="{{ route('films.watch', $film->id) }}"
                   class="btn btn-secondary btn-sm">
                   Watch
                </a>

                    </button>
                </form>
            </div>
        </div>
    </div>
    @endforeach


    {{-- ============================= --}}
    {{-- FILM DARI TMDB (API) --}}
    {{-- ============================= --}}
    @foreach($tmdbFilms as $film)
    <div class="col-md-3 mb-4">
        <div class="card h-100 shadow-sm">
            <img src="{{ $image . $film['poster_path'] }}"
                 class="card-img-top"
                 alt="{{ $film['title'] }}">

            <div class="card-body">
                <h5 class="card-title">{{ $film['title'] }}</h5>
                <p class="card-text">Rating: {{ $film['vote_average'] }}</p>

                {{-- WATCH (DETAIL + TRAILER TMDB) --}}
                <a href="{{ route('movie.detail', $film['id']) }}"
                   class="btn btn-primary btn-sm">
                   Watch
                </a>
            </div>
        </div>
    </div>
    @endforeach

</div>
@endsection
