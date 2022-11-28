  <!doctype html>
  <html lang="en">

  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- <link href="/static/favicon.ico" rel="icon"> -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
      integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="../custom.css"> -->

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <title>Default title</title>
  </head>

  <body>
    <nav class="navbar navbar-expand-md navbar-light bg-light">
      <a class="navbar-brand" href="index.php">Navbar</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
        aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <!-- <li class="nav-item active">
      <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item"> <a class="nav-link" href="#">Features</a>
      </li>
      <li class="nav-item">
      <a class="nav-link" href="#">Pricing</a>
      </li> -->

          <!-- Ensure user is not admin -->
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
          <li class="nav-item"> <a href="login.php" class="nav-link">Log in</a> </li>
          <li class="nav-item"> <a href="register.php" class="nav-link">Register</a> </li>
        </ul>
      </div>
    </nav>



    <main class="container py-5">
      <form action="" method="post" class="container" style="max-width: var(--breakpoint-md);">
        @csrf
        <div class="card">
          <h4 class="card-header">Login</h4>
          <div class="card-body">
            <div class="form-group row">
              <label class="col-md-3 col-form-label" for="inputEmail_">Email</label>
              <div class="col-md-9">
                <input type="email" class="form-control" id="inputEmail_" name="email"
                  autocomplete="off">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-md-3 cold-form-label" for="inputPassword4">Password</label>
              <div class="col-md-9">
                <input type="password" class="form-control" id="inputPassword4" name="password">
              </div>
            </div>
            <div class="form-group">
              <div class="custom-control custom-checkbox">
                <input class="custom-control-input" type="checkbox" id="c99">
                <label class="custom-control-label" for="c99">
                  Remember me
                </label>
              </div>
            </div>
            <div class="form-group">Don't have an account yet? <a href="./register.php">Sign up</a> </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary">Sign in</button>
            </div>
          </div>
        </div>
      </form>

    </main>

    <!-- <footer class="small text-center text-muted">
  Data provided for free by <a href="https://iextrading.com/developer">IEX</a>. View <a href="https://iextrading.com/api-exhibit-a/">IEX’s Terms of Use</a>.
  </footer> -->

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.min.js"
      integrity="sha384-i61gTtaoovXtAbKjo903+O55Jkn2+RtzHtvNez+yI49HAASvznhe9sZyjaSHTau9" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
      integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"
      integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous">
    </script>
    <script src="assets/script.js"></script>
  </body>

  </html>
