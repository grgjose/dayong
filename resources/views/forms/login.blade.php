<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Dayong Providers Inc | Login Page</title>

    <!-- Site Icon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('storage/logo.ico') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" />
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Toast -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Karla:wght@200;300;400;500&display=swap" rel="stylesheet">
  </head>

  <body class="container-fluid">
    <div class="row">
        <div class="col-12 col-md-5 form-section">
          <div class="login-wrapper">
            <h2 class="login-title">Sign in</h2>
            <form action="/login" method="post" class="w-100" style="max-width: 23rem;">
              @csrf
              <div class="mb-3">
                <label for="username" class="visually-hidden">Email</label>
                <input type="text" name="username" id="username" class="form-control" placeholder="Username">
              </div>
              <div class="mb-3">
                <label for="password" class="visually-hidden">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Password">
              </div>
              <div class="form-floating mb-4">
                <div class="icheck-primary">
                  <input type="checkbox" name="remember_me" id="remember">
                  <label for="remember">
                    &nbsp; &nbsp; Remember Me
                  </label>
                </div>
              </div>
              <div class="d-flex justify-content-between align-items-center mb-5">
                <input name="login" id="login" class="btn btn-primary login-btn" type="submit" value="Login">
                <a href="#!" class="forgot-password-link">Password?</a>
              </div>
            </form>           
            <p class="login-wrapper-footer-text">Need an account? <a href="#!" class="text-reset text-decoration-underline">Request Account here</a></p>
          </div>

          <div class="forgot-password-wrapper" style="display: none;">
            <h2 class="login-title">Forgot Password</h2>
            <form action="/login" method="post" class="w-100" style="max-width: 23rem;">
              @csrf
              <div class="mb-3">
                <label for="username" class="visually-hidden">Email</label>
                <input type="text" name="username" id="username" class="form-control" placeholder="Username">
              </div>
              <div class="d-flex justify-content-between align-items-center mb-5">
                <input name="login" id="login" class="btn btn-primary login-btn" type="submit" value="Send Reset Link">
                <a href="#!" class="back-to-login">Back to Login</a>
              </div>
            </form>           
            <p class="login-wrapper-footer-text">Need an account? <a href="#!" class="text-reset text-decoration-underline">Request Account here</a></p>
          </div>

          <div class="register-wrapper" style="display: none;">
            <h2 class="login-title">Register</h2>
            <form action="/register" method="post" class="w-100" style="max-width: 23rem;">
              @csrf

              <div class="mb-3">
                <label for="username" class="visually-hidden">First Name</label>
                <input type="text" name="username" id="username" class="form-control" placeholder="First Name">
              </div>
              <div class="mb-3">
                <label for="username" class="visually-hidden">Middle Name</label>
                <input type="text" name="username" id="username" class="form-control" placeholder="Middle Name">
              </div>
              <div class="mb-3">
                <label for="username" class="visually-hidden">Last Name</label>
                <input type="text" name="username" id="username" class="form-control" placeholder="Last Name">
              </div>
              <div class="mb-3">
                <label for="username" class="visually-hidden">Email</label>
                <input type="text" name="username" id="username" class="form-control" placeholder="Email">
              </div>
              <div class="mb-3">
                <label for="password" class="visually-hidden">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Password">
              </div>
              <div class="mb-3">
                <label for="confirm_password" class="visually-hidden">Confirm Password</label>
                <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm Password">
              </div>
              <div class="form-floating mb-4">
                <div class="icheck-primary">
                  <input type="checkbox" name="remember_me" id="remember">
                  <label for="remember">
                    &nbsp; &nbsp; Remember Me
                  </label>
                </div>
              </div>
              <div class="d-flex justify-content-between align-items-center mb-5">
                <input name="login" id="login" class="btn btn-primary login-btn" type="submit" value="Login">
                <a href="#!" class="forgot-password-link">Password?</a>
              </div>
            </form>           
            <p class="login-wrapper-footer-text">Already have an account? <a href="#!" class="text-reset text-decoration-underline back-to-login">Login here</a></p>
          </div>

        </div>
        <div class="col-12 col-md-7 intro-section d-none d-md-flex">
          <div class="brand-wrapper">
            <h1>
              <a href="/?=1">
                <img src="{{ asset('img/logo.png') }}" 
                    alt="Logo" 
                    class="img-fluid"
                    style="max-width: 8rem;">
              </a>
            </h1>
          </div>
          <div class="intro-content-wrapper">
            <h1 class="intro-title">Welcome to <br> Dayong App!</h1>
            <p class="intro-text">to establish a bond among members, extend help in times of calamities, disaster and in case of death</p>
            <a href="#!" class="btn btn-read-more">Read more</a>
          </div>
          <div class="intro-section-footer">
            <na class="footer-nav">
              <a href="https://www.facebook.com/dsrdprovidersinc">Facebook</a>
              <a href="#!">Twitter</a>
              <a href="#!">Gmail</a>
            </na>
          </div>
        </div>
      </div>
    </div>
  </body>

  <!-- Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  <!-- jQuery -->
  <script src="{{ asset('admin_lte/plugins/jquery/jquery.min.js'); }}"></script>

  <!-- Toast -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

  <!-- Custom JS -->
  @include('plus.scripts');

</html>