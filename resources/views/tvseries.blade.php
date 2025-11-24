@extends('layouts.app')

@section('content')
<h2 class="mb-4">Popular TV Series</h2>
<div class="row">
    @foreach($series as $tv)
    <div class="col-md-3 mb-4">
        <div class="card h-100 shadow-sm">
            <img src="{{ $image . $tv['poster_path'] }}" class="card-img-top" alt="{{ $tv['name'] }}">
            <div class="card-body">
                <h5 class="card-title">{{ $tv['name'] }}</h5>
                <a href="#" class="btn btn-primary btn-sm">Watch</a>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
