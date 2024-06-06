<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  {{-- <?= $this->meta ?> --}}

  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- <link href="/static/favicon.ico" rel="icon"> -->

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="/assets/bootstrap.min.css">
  <!-- <link rel="stylesheet" href="../custom.css"> -->

  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

  <title> Title -- @yield('title') </title>

  @stack('styles')
</head>

<body>

  <nav class="navbar navbar-expand-md navbar-light bg-light">
    <a class="navbar-brand" href="/"> UOB Cinema </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
      aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      @if (session()->missing('isAdmin') || !session('isAdmin'))
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="/search" class="nav-link">
              Search movies
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-search ml-1" viewBox="0 0 16 16">
                <path
                  d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
              </svg>
            </a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
              aria-expanded="false">
              Browse Movies
            </a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="/new_arrival">New Arrival</a>
              <a class="dropdown-item" href="/coming_soon">Coming Soon</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
              aria-expanded="false">
              Manage Bookings
            </a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="/current_bookings">Current Bookings</a>
              <a class="dropdown-item" href="/booking_history">Booking history</a>
            </div>
          </li>
        </ul>
      @endif
      <ul class="navbar-nav ml-auto">
        @if (session()->has('isAdmin'))
          <li class="nav-item">
            <a href="logout" class="nav-link">Log Out</a>
          </li>
          @if (!session('isAdmin'))
            <li class="nav-item">
              <a href="/edit_profile" class="d-none d-md-block nav-link py-0
            align-middle"
                style="font-size: 1.7rem;">
                <i class="d-inline-block bi bi-person-circle" width="25px"></i>
              </a>
              <a href="edit_profile.php" class="d-md-none nav-link">Edit Profile</a>
            </li>
          @endif
        @else
          <li class="nav-item">
            <a href="/login" class="nav-link"> Log in </a>
          </li>
          <li class="nav-item">
            <a href="/register" class="nav-link"> Register </a>
          </li>
        @endif
      </ul>
    </div>
  </nav>

  @if ($errors->any())
    <header>
      <div class="alert alert-danger border text-center mb-0" role="alert">
        @foreach ($errors->all() as $error)
          @if (!$loop->first)
            <br>
          @endif
          {{ $error }}
        @endforeach
      </div>
    </header>
  @endif

  @if (session()->has('message'))
    @php
      if (gettype(session('message')) == 'array') {
          [$content, $code] = session('message');
      } else {
          $content = session('message');
      }
    @endphp

    <header>
      <div class="alert alert-primary alert-dismissible fade show border text-center mb-0" role="alert">
        {{ $content }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    </header>
  @endif


  {{-- <?php if ("" !== $this->alert_message) { ?>
    <header>
      <div class="alert alert-primary border text-center" role="alert">
        <?= $this->alert_message ?>
      </div>
    </header>

  <?php } ?> --}}

  @if (isset($without_container) && $without_container)
    @yield('main')
  @else
    <main class="container py-5">
      @yield('main')
    </main>
  @endif


  <!-- <footer class="small text-center text-muted">
Data provided for free by <a href="https://iextrading.com/developer">IEX</a>. View <a href="https://iextrading.com/api-exhibit-a/">IEX’s Terms of Use</a>.
</footer> -->

  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.min.js"
    integrity="sha384-i61gTtaoovXtAbKjo903+O55Jkn2+RtzHtvNez+yI49HAASvznhe9sZyjaSHTau9" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
    integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="assets/bootstrap.min.js"></script>
  <script src="assets/script.js"></script>

  @stack('scripts')
</body>

</html>
