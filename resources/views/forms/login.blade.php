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
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Toast -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Karla:wght@200;300;400;500&display=swap" rel="stylesheet">
  </head>

  <style>

    body {
      background-color: #fff;
      font-family: sans-serif;
    }

    h1 > a {
      text-decoration:none;
      color:#fff !important;
    }
    
    .intro-section {
      background-image: url({{ asset('img/login_bg.jpg') }});
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center;
      padding: 75px 95px;
      min-height: 100vh;
      display: -webkit-box;
      display: flex;
      -webkit-box-orient: vertical;
      -webkit-box-direction: normal;
      flex-direction: column;
      color: #ffffff;
    }

    @media (max-width: 991px) {
      .intro-section {
        padding-left: 50px;
        padding-right: 50px;
      }
    }

    @media (max-width: 767px) {
      .intro-section {
        padding: 28px;
      }
    }
    
    @media (max-width: 575px) {
      .intro-section {
        min-height: auto;
      }
    }

    .brand-wrapper .logo {
      height: 35px;
    }

    @media (max-width: 767px) {
      .brand-wrapper {
        margin-bottom: 35px;
      }
    }

    .intro-content-wrapper {
      width: 410px;
      max-width: 100%;
      margin-top: auto;
      margin-bottom: auto;
    }

    .intro-content-wrapper .intro-title {
      font-size: 40px;
      font-weight: bold;
      margin-bottom: 17px;
    }

    .intro-content-wrapper .intro-text {
      font-size: 19px;
      line-height: 1.37;
    }

    .intro-content-wrapper .btn-read-more {
      background-color: #fff;
      padding: 13px 30px;
      border-radius: 0;
      font-size: 16px;
      font-weight: bold;
      color: #000;
    }

    .intro-content-wrapper .btn-read-more:hover {
      background-color: transparent;
      border: 1px solid #fff;
      color: #fff;
    }

    @media (max-width: 767px) {
      .intro-section-footer {
        margin-top: 35px;
      }
    }

    .intro-section-footer .footer-nav a {
      font-size: 20px;
      font-weight: bold;
      color: inherit;
    }

    @media (max-width: 767px) {
      .intro-section-footer .footer-nav a {
        font-size: 14px;
      }
    }

    .intro-section-footer .footer-nav a + a {
      margin-left: 30px;
    }

    .form-section {
      display: -webkit-box;
      display: flex;
      -webkit-box-align: center;
      align-items: center;
      -webkit-box-pack: center;
      justify-content: center;
    }

    @media (max-width: 767px) {
      .form-section {
        padding: 35px;
      }
    }

    .login-wrapper {
      width: 300px;
      max-width: 100%;
    }

    @media (max-width: 575px) {
      .login-wrapper {
        width: 100%;
      }
    }

    .login-wrapper .form-control {
      border: 0;
      border-bottom: 1px solid #e7e7e7;
      border-radius: 0;
      font-size: 14px;
      font-weight: bold;
      padding: 15px 10px;
      margin-bottom: 7px;
    }

    .login-wrapper .form-control::-webkit-input-placeholder {
      color: #b0adad;
    }

    .login-wrapper .form-control::-moz-placeholder {
      color: #b0adad;
    }

    .login-wrapper .form-control:-ms-input-placeholder {
      color: #b0adad;
    }

    .login-wrapper .form-control::-ms-input-placeholder {
      color: #b0adad;
    }

    .login-wrapper .form-control::placeholder {
      color: #b0adad;
    }

    .login-title {
      font-size: 30px;
      font-weight: bold;
      margin-bottom: 30px;
    }

    .login-btn {
      padding: 13px 30px;
      background-color: #000;
      border-radius: 0;
      font-size: 20px;
      font-weight: bold;
      color: #fff;
    }

    .login-btn:hover {
      border: 1px solid #000;
      background-color: transparent;
      color: #000;
    }

    .forgot-password-link {
      font-size: 14px;
      color: #080808;
      text-decoration: underline;
    }

    .social-login-title {
      font-size: 15px;
      color: #919aa3;
      display: -webkit-box;
      display: flex;
      margin-bottom: 23px;
    }

    .social-login-title::before, .social-login-title::after {
      content: "";
      background-image: -webkit-gradient(linear, left top, left bottom, from(#f4f4f4), to(#f4f4f4));
      background-image: linear-gradient(#f4f4f4, #f4f4f4);
      -webkit-box-flex: 1;
      flex-grow: 1;
      background-size: calc(100% - 20px) 1px;
      background-repeat: no-repeat;
    }

    .social-login-title::before {
      background-position: center left;
    }

    .social-login-title::after {
      background-position: center right;
    }

    .social-login-links {
      text-align: center;
      margin-bottom: 32px;
    }

    .social-login-link img {
      width: 40px;
      height: 40px;
      -o-object-fit: contain;
      object-fit: contain;
    }

    .social-login-link + .socia-login-link {
      margin-left: 16px;
    }

    .login-wrapper-footer-text {
      font-size: 14px;
      text-align: center;
    }

  </style>

  <body class="container-fluid">
    <div class="row">
        <div class="col-sm-6 col-md-5 form-section">
          <div class="login-wrapper">
            <h2 class="login-title">Sign in</h2>
            <form action="/login" method="post" style="width: 23rem;">
              @csrf
              <div class="form-group">
                <label for="username" class="sr-only">Email</label>
                <input type="text" name="username" id="username" class="form-control" placeholder="Username">
              </div>
              <div class="form-group mb-3">
                <label for="password" class="sr-only">Password</label>
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
                <input name="login" id="login" class="btn login-btn" type="submit" value="Login">
                <a href="#!" class="forgot-password-link">Password?</a>
              </div>
            </form>           
            <p class="login-wrapper-footer-text">Need an account? <a href="#!" class="text-reset">Request Account here</a></p>
          </div>
        </div>
        <div class="col-sm-6 col-md-7 intro-section">
          <div class="brand-wrapper">
            <h1><a href="/?=1"><img src="{{asset('img/logo.png')}}" alt="Logo" style="width: 8rem; height: 8rem;"></a></h1>
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


  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>      
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <!-- Custom scripts -->
  @if(session()->has('error_msg'))
      <script>
        
        toastr.options = {
          "closeButton": true,
          "debug": false,
          "newestOnTop": true,
          "progressBar": true,
          "positionClass": "toast-top-center",
          "preventDuplicates": false,
          "onclick": null,
          "showDuration": "300",
          "hideDuration": "1000",
          "timeOut": "3000",
          "extendedTimeOut": "1000",
          "showEasing": "swing",
          "hideEasing": "linear",
          "showMethod": "fadeIn",
          "hideMethod": "fadeOut"
        }

        toastr.error('{{ session('error_msg') }}', 'ERROR MESSAGE');
      </script>
  @endif
</html>