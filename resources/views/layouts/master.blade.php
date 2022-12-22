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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
    integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
  <!-- <link rel="stylesheet" href="../custom.css"> -->

  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

  <title> Title -- @yield('title') </title>

  @stack('styles')
</head>

<body>

  <nav class="navbar navbar-expand-md navbar-light bg-light">
    <a class="navbar-brand" href="/">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
      aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
            aria-expanded="false">
            Browse Movies
          </a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="#">New Arrival</a>
            <a class="dropdown-item" href="#">Coming Soon</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
            aria-expanded="false">
            Manage Bookings
          </a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="#">Current Bookings</a>
            <a class="dropdown-item" href="#">Booking history</a>
          </div>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a href="logout" class="nav-link">Log Out</a>
        </li>
        <li class="nav-item">
          <!-- <a href="#" class="nav-link"><i class="bi bi-person-circle"></i></a> -->
          <!-- <a href="#" class="nav-link px-0 bi bi-person-circle"></a> -->
          <!-- <a href="#" class="nav-brand"><i class="bi bi-person-circle"></i></a> -->
          <a href="edit_profile.php" class="d-none d-md-block nav-link py-0
            align-middle"
            style="font-size: 1.7rem;">
            <i class="d-inline-block bi bi-person-circle" width="25px"></i>
          </a>
          <a href="edit_profile.php" class="d-md-none nav-link">Edit Profile</a>
        </li>
      </ul>
    </div>
  </nav>

  @if ($errors->any())
    <header>
      <div class="alert alert-danger border text-center" role="alert">
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
      <div class="alert alert-primary border text-center" role="alert">
        {{ $content }}
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

  <main class="container py-5">
    @yield('main')
  </main>

  <!-- <footer class="small text-center text-muted">
Data provided for free by <a href="https://iextrading.com/developer">IEX</a>. View <a href="https://iextrading.com/api-exhibit-a/">IEX’s Terms of Use</a>.
</footer> -->

  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.min.js"
    integrity="sha384-i61gTtaoovXtAbKjo903+O55Jkn2+RtzHtvNez+yI49HAASvznhe9sZyjaSHTau9" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
    integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"
    integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
  <script src="assets/script.js"></script>

  @stack('scripts')
</body>

</html>
