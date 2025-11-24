<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'My Movie') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="{{ route('home') }}">My Movie</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">

        <li class="nav-item">
          <a class="nav-link" href="{{ route('home') }}">Home</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="{{ route('tvseries') }}">TV Series</a>
        </li>

        <!-- GENRE DROPDOWN MENU -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button"
             data-bs-toggle="dropdown">
             Genre
          </a>

          <ul class="dropdown-menu dropdown-menu-dark">
            @foreach ($genres as $genre)
              <li>
                <a class="dropdown-item"
                   href="{{ route('genre', strtolower($genre['name'])) }}">
                   {{ $genre['name'] }}
                </a>
              </li>
            @endforeach
          </ul>
        </li>

        <li class="nav-item">
          <form class="d-flex" action="{{ route('search') }}" method="GET">
            <input class="form-control me-2" type="search" name="query" placeholder="Search">
            <button class="btn btn-outline-light" type="submit">Search</button>
          </form>
        </li>

      </ul>
    </div>
  </div>
</nav>

<div class="container my-4">
    @yield('content')
</div>
<footer class="bg-dark text-white text-center py-3 mt-5">
    &copy; {{ date('Y') }} My Movie. All rights reserved.
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

