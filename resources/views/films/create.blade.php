@extends('layouts.app')

@section('content')
<h3>Tambah Film</h3>

<form action="{{ route('films.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label>Judul Film</label>
        <input type="text" name="title" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Poster (URL)</label>
        <input type="text" name="poster" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Rating</label>
        <input type="number" step="0.1" name="rating" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Trailer YouTube (Embed URL)</label>
        <input type="text" name="trailer" class="form-control"
               placeholder="https://www.youtube.com/embed/XXXX">
    </div>

    <button class="btn btn-success">Simpan</button>
</form>
@endsection
