<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <title>Dayong Providers Inc | Login Page</title>
  <!-- MDB icon -->
  <link rel="icon" href="img/mdb-favicon.ico" type="image/x-icon" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" />
  <!-- Google Fonts Roboto -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <!-- Toast -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />
</head>

<style>
  @media (max-width: 760px) {
    .h-custom-2 {
      height: 100vh;
      width:  100vw;  
    }

    .h-custom-3{
      margin-top: 120px !important;
    }
  }

  @media (min-width: 760px) {
    .h-custom-3{
      margin-top: 180px !important;
    }
  }
</style>
<body>
  <!-- Start your project here-->
  <section style="height: 100%;">
    <div class="container-fluid">
      <div class="row">

        <div class="col-md-6 col-sm-12 h-custom-2 justify-content">

          <div class="d-flex justify-content-evenly h-custom-3">
            <span class="h1 fw-bold mb-0">
              <img src="{{asset('img/logo.png')}}" alt="Logo" style="width: 10rem; height: 10rem;">
            </span>
          </div>

          <div class="d-flex justify-content-evenly px-5 ms-xl-2 mt-3 pt-3 pt-xl-0 mt-xl-n2">

            <form action="/login" method="post" style="width: 23rem;">
              @csrf
              <h2 class="d-flex justify-content-evenly text-center fw-normal mb-3 pb-3" style="letter-spacing: 1px;">
                DAYONG APP
              </h2>

              <div class="form-floating mb-4">
                <input type="text" id="form2Example18" class="form-control" name="username" placeholder="Username"/>
                <label class="form-label" for="form2Example18">Username</label>
              </div>

              <div class="form-floating mb-4">
                <input type="password" id="form2Example28" class="form-control" name="password" placeholder="Password" />
                <label class="form-label" for="form2Example28">Password</label>
              </div>

              <div class="form-floating mb-4">
                <div class="icheck-primary">
                  <input type="checkbox" name="remember_me" id="remember">
                  <label for="remember">
                    &nbsp; &nbsp; Remember Me
                  </label>
                </div>
              </div>

              <div class="d-flex justify-content-evenly pt-1 mb-4">
                <input type="submit" class="btn btn-outline-info btn-lg" value="Log In" />
              </div>
              
              <p class="d-flex justify-content-evenly small mb-5 pb-lg-2"><a class="text-muted" href="#!">Forgot password?</a></p>
              <!--p>Don't have an account? <a href="#!" class="link-info">Register here</a></p-->

            </form>

          </div>

        </div>

        <div class="col-md-6 col-sm-12" style="height: 100%; padding: 0px !important;">
          <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/img3.webp" alt="Login image" class="w-100 vh-100" style="object-fit: cover; object-position: left; width: 100%;">
        </div>

      </div>
    </div>
  </section>

  <script type="text/javascript"></script>

  <!-- Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  <!-- jQuery -->
  <script src="{{ asset('admin_lte/plugins/jquery/jquery.min.js'); }}"></script>

  <!-- Toast -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

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
</body>
</html>