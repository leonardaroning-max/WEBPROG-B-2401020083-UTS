@extends('layouts.app')

@section('content')
<h2 class="mb-4">{{ $genreName }} Movies</h2>
<div class="row">
    @foreach($films as $film)
    <div class="col-md-3 mb-4">
        <div class="card h-100 shadow-sm">
            <img src="{{ $image . $film['poster_path'] }}" class="card-img-top" alt="{{ $film['title'] }}">
            <div class="card-body">
                <h5 class="card-title">{{ $film['title'] }}</h5>
                <p class="card-text">Rating: {{ $film['vote_average'] }}</p>
                <a href="{{ route('movie.detail', $film['id']) }}" class="btn btn-primary btn-sm">Watch</a>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
