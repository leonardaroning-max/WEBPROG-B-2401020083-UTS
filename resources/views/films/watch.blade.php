@extends('layouts.app')

@section('content')
<a href="{{ url()->previous() }}" class="btn btn-secondary mb-3">
    ← Back
</a>

<h3>{{ $film->title }}</h3>

@if($film->trailer)
    <div class="ratio ratio-16x9">
        <iframe src="{{ $film->trailer }}" allowfullscreen></iframe>
    </div>
@else
    <p>Trailer tidak tersedia</p>
@endif
@endsection
