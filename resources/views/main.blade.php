<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dayong Providers Inc. | {{ $header_title }}</title>
    <!-- Site Icon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('storage/logo.ico') }}">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{asset('admin_lte/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset('admin_lte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('admin_lte/dist/css/adminlte.min.css')}}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('admin_lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'); }}">
    <link rel="stylesheet" href="{{ asset('admin_lte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css'); }}">
    <link rel="stylesheet" href="{{ asset('admin_lte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css'); }}">
    <!-- Toast -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />
    <!-- Chosen (For Select Multiple UI) -->
    <link rel="stylesheet" href="{{ asset('admin_lte/chosen/chosen.css'); }}">
    <link rel="stylesheet" href="{{ asset('admin_lte/chosen/chosen.min.css'); }}">

    <script src="https://code.highcharts.com/maps/highmaps.js"></script>
    <script src="https://code.highcharts.com/maps/modules/exporting.js"></script>
  </head>

  <style>
    
    .fill {
      display: flex;
      justify-content: center;
      align-items: center;
      overflow: hidden
    }

    .fill img {
      flex-shrink: 0;
      min-width: 100%;
      min-height: 100%
    }

    .chosen-container-single .chosen-single {
        border-radius: 3px;
        height: calc(2rem + 2px);
        padding-top: 5px;
        font-size: 15px;
    }

    #container3 {
      height: 500px;
      min-width: 310px;
      max-width: 800px;
      margin: 0 auto;
    }

    .loading {
      margin-top: 10em;
      text-align: center;
      color: gray;
    }
    
  </style>

  <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">

    <div class="wrapper">

      <!-- Preloader -->
      @isset($greet_icon)
        <div class="preloader flex-column justify-content-center align-items-center">
          <img class="animation__wobble" src="{{asset('img/logo.png')}}" alt="Logo" height="120" width="120">
        </div>
      @endisset

      <!-- Navbar -->
      <nav class="main-header navbar navbar-expand navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
            <a href="/dashboard" class="nav-link">Home</a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
            <a href="/profile" class="nav-link">My Profile</a>
          </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
          <!-- Navbar Search>
          <li class="nav-item">
            <a class="nav-link" data-widget="navbar-search" href="#" role="button">
              <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block">
              <form class="form-inline">
                <div class="input-group input-group-sm">
                  <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                  <div class="input-group-append">
                    <button class="btn btn-navbar" type="submit">
                      <i class="fas fa-search"></i>
                    </button>
                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </li -->

          <!-- Messages Dropdown Menu -->
          <li class="nav-item dropdown" style="display: none;">
            <a class="nav-link" data-toggle="dropdown" href="#">
              <i class="far fa-comments"></i>
              <span class="badge badge-danger navbar-badge">3</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              <a href="#" class="dropdown-item">
                <!-- Message Start -->
                <div class="media">
                  <img src="{{asset('admin_lte/dist/img/user1-128x128.jpg')}}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                  <div class="media-body">
                    <h3 class="dropdown-item-title">
                      Brad Diesel
                      <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                    </h3>
                    <p class="text-sm">Call me whenever you can...</p>
                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                  </div>
                </div>
                <!-- Message End -->
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item">
                <!-- Message Start -->
                <div class="media">
                  <img src="{{asset('admin_lte/dist/img/user8-128x128.jpg')}}" alt="User Avatar" class="img-size-50 img-circle mr-3">
                  <div class="media-body">
                    <h3 class="dropdown-item-title">
                      John Pierce
                      <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                    </h3>
                    <p class="text-sm">I got your message bro</p>
                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                  </div>
                </div>
                <!-- Message End -->
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item">
                <!-- Message Start -->
                <div class="media">
                  <img src="{{asset('admin_lte/dist/img/user3-128x128.jpg')}}" alt="User Avatar" class="img-size-50 img-circle mr-3">
                  <div class="media-body">
                    <h3 class="dropdown-item-title">
                      Nora Silvester
                      <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                    </h3>
                    <p class="text-sm">The subject goes here</p>
                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                  </div>
                </div>
                <!-- Message End -->
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
            </div>
          </li>
          <!-- Notifications Dropdown Menu -->
          <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
              <i class="far fa-bell"></i>
              <!-- span class="badge badge-warning navbar-badge">15</span -->
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              <span class="dropdown-item dropdown-header">0 Notifications</span>
              <div class="dropdown-divider"></div>
              <!-- a href="#" class="dropdown-item">
                <i class="fas fa-envelope mr-2"></i> 4 new messages
                <span class="float-right text-muted text-sm">3 mins</span>
              </a -->
              <!-- div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item">
                <i class="fas fa-users mr-2"></i> 8 friend requests
                <span class="float-right text-muted text-sm">12 hours</span>
              </a-->
              <!-- div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item">
                <i class="fas fa-file mr-2"></i> 3 new reports
                <span class="float-right text-muted text-sm">2 days</span>
              </a -->
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
              <i class="fas fa-expand-arrows-alt"></i>
            </a>
          </li>
          <!--li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
              <i class="fas fa-th-large"></i>
            </a>
          </li-->
        </ul>
      </nav>
      <!-- /.navbar -->

      <!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="/" class="brand-link">
          <img src="{{asset('img/logo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light">DAYONG APP</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image fill">
              <img src="{{asset('storage/profile_pic/'.$my_user["profile_pic"])}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
              <a href="/profile" class="d-block">{{ $my_user->fname.' '.$my_user->lname; }}</a>
            </div>
          </div>

          <!-- SidebarSearch Form -->
          <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
              <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-sidebar">
                  <i class="fas fa-search fa-fw"></i>
                </button>
              </div>
            </div>
          </div>

          <!-- Sidebar Menu -->
          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              <!-- Add icons to the links using the .nav-icon class
                  with font-awesome or any other icon font library -->
              <li class="nav-item">
                <a href="/dashboard" class="nav-link">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    Dashboard
                    <!-- span class="badge badge-info right">2</!-->
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/entries" class="nav-link">
                  <i class="nav-icon fas fa-coins"></i>
                  <p>
                    Collection
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/new-sales" class="nav-link">
                  <i class="nav-icon fas fa-comment-dollar"></i>
                  <p>
                    New Sales
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/members" class="nav-link">
                  <i class="nav-icon fas fa-users-cog"></i>
                  <p>
                    Members
                  </p>
                </a>
              </li>
              <!-- li class="nav-item">
                <a href="/audit" class="nav-link disabled">
                  <i class="nav-icon fas fa-book"></i>
                  <p>
                    Audit (Disabled Temporarily)
                  </p>
                </a>
              </li -->
              <li class="nav-item">
                <a href="/fidelity" class="nav-link">
                  <i class="nav-icon fas fa-hand-holding-usd"></i>
                  <p>
                    Fidelity
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/reports" class="nav-link">
                  <i class="nav-icon fas fa-flag"></i>
                  <p>
                    Reports
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/attendance" class="nav-link">
                  <i class="nav-icon fas fa-address-book"></i>
                  <p>
                    Attendance Tracker
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link" onclick="$('#logoutForm').submit();">
                  <i class="nav-icon fas fa-power-off"></i>
                  <p>
                    Logout
                  </p>
                </a>
              </li>
              <form action="/logout" method="post" id="logoutForm" style="display: none;">
                @csrf
              </form>
              @if($my_user->usertype == 1)
              <li class="nav-header">ADDITIONAL SETTINGS</li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-cogs"></i>
                  <p>
                    SETTINGS
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item  tab-2">
                    <a href="/branch" class="nav-link">
                      <i class="fas fa-code-branch nav-icon"></i>
                      <p>Branches</p>
                    </a>
                  </li>
                  <li class="nav-item tab-2">
                    <a href="/program" class="nav-link">
                      <i class="fas fa-medal nav-icon"></i>
                      <p>Programs</p>
                    </a>
                  </li>
                  <li class="nav-item  tab-2">
                    <a href="/user-accounts" class="nav-link">
                      <i class="fas fa-user-friends nav-icon"></i>
                      <p>Users</p>
                    </a>
                  </li>
                  <li class="nav-item  tab-2">
                    <a href="/matrix" class="nav-link">
                      <i class="fas fa-percent nav-icon"></i>
                      <p>Incentives Matrix</p>
                    </a>
                  </li>
                  <li class="nav-item  tab-2">
                    <a href="/excel-collection" class="nav-link">
                      <i class="fas fa-donate nav-icon"></i>
                      <p>Excel Collection</p>
                    </a>
                  </li>
                  <li class="nav-item  tab-2">
                    <a href="/excel-new-sales" class="nav-link">
                      <i class="fas fa-user-cog nav-icon"></i>
                      <p>Excel New Sales</p>
                    </a>
                  </li>
                </ul>
              </li>
              @endif
            </ul>
          </nav>
          <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0">{{ $header_title; }}</h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">{{ $header_title; }}</li>
                </ol>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main Content -->
        @include($subview)
        
      </div>
      <!-- /.content-wrapper -->

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
      </aside>
      <!-- /.control-sidebar -->

      <!-- Main Footer -->
      <footer class="main-footer">
        <strong>Copyright &copy; 2023-2024 <a href="/">Dayong Providers Inc.</a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
          <b>Version</b> 1.0.0
        </div>
      </footer>
    </div>

    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="{{asset('admin_lte/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap -->
    <script src="{{asset('admin_lte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- overlayScrollbars -->
    <script src="{{asset('admin_lte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('admin_lte/dist/js/adminlte.js')}}"></script>

    <!-- PAGE PLUGINS -->
    <!-- jQuery Mapael -->
    <script src="{{asset('admin_lte/plugins/jquery-mousewheel/jquery.mousewheel.js')}}"></script>
    <script src="{{asset('admin_lte/plugins/raphael/raphael.min.js')}}"></script>
    <script src="{{asset('admin_lte/plugins/jquery-mapael/jquery.mapael.min.js')}}"></script>
    <script src="{{asset('admin_lte/plugins/jquery-mapael/maps/usa_states.min.js')}}"></script>
    <!-- ChartJS -->
    <script src="{{asset('admin_lte/plugins/chart.js/Chart.min.js')}}"></script>

    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('admin_lte/dist/js/demo.js')}}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{asset('admin_lte/dist/js/pages/dashboard2.js')}}"></script>

    <!-- DataTables  & Plugins -->
    <script src="{{ asset('admin_lte/plugins/datatables/jquery.dataTables.min.js'); }}"></script>
    <script src="{{ asset('admin_lte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js'); }}"></script>
    <script src="{{ asset('admin_lte/plugins/datatables-responsive/js/dataTables.responsive.min.js'); }}"></script>
    <script src="{{ asset('admin_lte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js'); }}"></script>
    <script src="{{ asset('admin_lte/plugins/datatables-buttons/js/dataTables.buttons.min.js'); }}"></script>
    <script src="{{ asset('admin_lte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js'); }}"></script>
    <script src="{{ asset('admin_lte/plugins/jszip/jszip.min.js'); }}"></script>
    <script src="{{ asset('admin_lte/plugins/pdfmake/pdfmake.min.js'); }}"></script>
    <script src="{{ asset('admin_lte/plugins/pdfmake/vfs_fonts.js'); }}"></script>
    <script src="{{ asset('admin_lte/plugins/datatables-buttons/js/buttons.html5.min.js'); }}"></script>
    <script src="{{ asset('admin_lte/plugins/datatables-buttons/js/buttons.print.min.js'); }}"></script>
    <script src="{{ asset('admin_lte/plugins/datatables-buttons/js/buttons.colVis.min.js'); }}"></script>

    <!-- Chosen (For Select Multiple UI) -->
    <script src="{{ asset('admin_lte/chosen/chosen.jquery.js'); }}"></script>
    <script src="{{ asset('admin_lte/chosen/chosen.jquery.min.js'); }}"></script>

    <!-- Toast -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <!-- Custom Scripts -->
    <script src="{{asset('js/importfiles.js')}}"></script>
    <script src="{{asset('admin_lte/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
    <script> $(function () { bsCustomFileInput.init(); }); </script>

    <script>

      $(document).ready(function (){
      
        $(".chosen-select").chosen({
          no_results_text: "Oops, nothing found!",
          width: "100%"
        });

        $('#normalTable').DataTable({
          "paging": true,
          "lengthChange": true,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "responsive": true,
        "buttons": ["excel", "pdf", "print"]
        }).buttons().container().appendTo('#normalTable .col-md-6:eq(0)');

        $('#anotherNormalTable').DataTable({
          "paging": true,
          "lengthChange": true,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "responsive": true,
        "buttons": ["excel", "pdf", "print"]
        }).buttons().container().appendTo('#normalTable .col-md-6:eq(0)');



      });

      // Active Navbar UI
      $(document).ready(function(){
        var pathname = window.location.pathname;
        pathname = pathname.substring(1, pathname.length);
        
        $("a[href='/"+ pathname +"']").parent().addClass(" menu-open");
        $("a[href='/"+ pathname +"']").addClass(" active");

        switch(pathname){
          case "branch":
          case "program":
          case "user-accounts":
          case "excel-collection":
          case "excel-new-sales":
            $("a[href='/"+ pathname +"']").parent().parent().parent().addClass("menu-is-opening");
            $("a[href='/"+ pathname +"']").parent().parent().parent().addClass("menu-open");
            $("a[href='/"+ pathname +"']").attr("style", "width: 93%;")
            break;
        }



        $(".wrapper").removeAttr("style");
      });

    </script>

    <script>

      $("#store_password").on("keyup", function(){
        checkPassword();
      });

      $("#store_confirm_password").on("keyup", function(){
        checkPassword();
      });

      $("#store_password").click(function(){
        checkPassword();
      });

      $("#store_confirm_password").click(function(){
        checkPassword();
      });

      function checkPassword(){
            var x = $("#store_password").val();
            var y = $("#store_confirm_password").val();
            if(x != y){
              $("#store_btn").attr("disabled", true);
              $("#pass_ok").attr("style", "display: none; color: #90EE90;");
              $("#pass_ng").attr("style", "color: #FF474C;");
            } else {
              $("#store_btn").removeAttr("disabled");
              $("#pass_ok").attr("style", "color: #90EE90;");
              $("#pass_ng").attr("style", "display: none; color: #FF474C;");
            }
      }

      $("#edit_store_password").on("keyup", function(){
        checkPasswordEdit();
      });

      $("#edit_store_confirm_password").on("keyup", function(){
        checkPasswordEdit();
      });

      $("#edit_store_password").click(function(){
        checkPasswordEdit();
      });

      $("#edit_store_confirm_password").click(function(){
        checkPasswordEdit();
      });

      function checkPasswordEdit(){
            var x = $("#edit_store_password").val();
            var y = $("#edit_store_confirm_password").val();
            if(x != y){
              $("#edit_store_btn").attr("disabled", true);
              $("#edit_pass_ok").attr("style", "display: none; color: #90EE90;");
              $("#edit_pass_ng").attr("style", "color: #FF474C;");
            } else {
              $("#edit_store_btn").removeAttr("disabled");
              $("#edit_pass_ok").attr("style", "color: #90EE90;");
              $("#edit_pass_ng").attr("style", "display: none; color: #FF474C;");
            }
      }

    </script>

    <script>
      
      (async () => {

      const topology = await fetch(
          'https://code.highcharts.com/mapdata/countries/ph/ph-all.topo.json'
      ).then(response => response.json());

      // Prepare demo data. The data is joined to map using value of 'hc-key'
      // property by default. See API docs for 'joinBy' for more info on linking
      // data and map.
      const data = [
          ['ph-mn', 10], ['ph-4218', 11], ['ph-tt', 12], ['ph-bo', 13],
          ['ph-cb', 14], ['ph-bs', 15], ['ph-2603', 16], ['ph-su', 17],
          ['ph-aq', 18], ['ph-pl', 19], ['ph-ro', 20], ['ph-al', 21],
          ['ph-cs', 22], ['ph-6999', 23], ['ph-bn', 24], ['ph-cg', 25],
          ['ph-pn', 26], ['ph-bt', 27], ['ph-mc', 28], ['ph-qz', 29],
          ['ph-es', 30], ['ph-le', 31], ['ph-sm', 32], ['ph-ns', 33],
          ['ph-cm', 34], ['ph-di', 35], ['ph-ds', 36], ['ph-6457', 37],
          ['ph-6985', 38], ['ph-ii', 39], ['ph-7017', 40], ['ph-7021', 41],
          ['ph-lg', 42], ['ph-ri', 43], ['ph-ln', 44], ['ph-6991', 45],
          ['ph-ls', 46], ['ph-nc', 47], ['ph-mg', 48], ['ph-sk', 49],
          ['ph-sc', 50], ['ph-sg', 51], ['ph-an', 52], ['ph-ss', 53],
          ['ph-as', 54], ['ph-do', 55], ['ph-dv', 56], ['ph-bk', 57],
          ['ph-cl', 58], ['ph-6983', 59], ['ph-6984', 60], ['ph-6987', 61],
          ['ph-6986', 62], ['ph-6988', 63], ['ph-6989', 64], ['ph-6990', 65],
          ['ph-6992', 66], ['ph-6995', 67], ['ph-6996', 68], ['ph-6997', 69],
          ['ph-6998', 70], ['ph-nv', 71], ['ph-7020', 72], ['ph-7018', 73],
          ['ph-7022', 74], ['ph-1852', 75], ['ph-7000', 76], ['ph-7001', 77],
          ['ph-7002', 78], ['ph-7003', 79], ['ph-7004', 80], ['ph-7006', 81],
          ['ph-7007', 82], ['ph-7008', 83], ['ph-7009', 84], ['ph-7010', 85],
          ['ph-7011', 86], ['ph-7012', 87], ['ph-7013', 88], ['ph-7014', 89],
          ['ph-7015', 90], ['ph-7016', 91], ['ph-7019', 92], ['ph-6456', 93],
          ['ph-zs', 94], ['ph-nd', 95], ['ph-zn', 96], ['ph-md', 97],
          ['ph-ab', 98], ['ph-2658', 99], ['ph-ap', 100], ['ph-au', 101],
          ['ph-ib', 102], ['ph-if', 103], ['ph-mt', 104], ['ph-qr', 105],
          ['ph-ne', 106], ['ph-pm', 107], ['ph-ba', 108], ['ph-bg', 109],
          ['ph-zm', 110], ['ph-cv', 111], ['ph-bu', 112], ['ph-mr', 113],
          ['ph-sq', 114], ['ph-gu', 115], ['ph-ct', 116], ['ph-mb', 117],
          ['ph-mq', 118], ['ph-bi', 119], ['ph-sl', 120], ['ph-nr', 121],
          ['ph-ak', 122], ['ph-cp', 123], ['ph-cn', 124], ['ph-sr', 125],
          ['ph-in', [126]], ['ph-is', 127], ['ph-tr', 128], ['ph-lu', 129]
      ];

      // Create the chart
      Highcharts.mapChart('container3', {
          chart: {
              map: topology
          },

          title: {
              text: 'Philippine Map'
          },

          subtitle: {
              text: 'Source map: <a href="https://code.highcharts.com/mapdata/countries/ph/ph-all.topo.json">Philippines</a>'
          },

          mapNavigation: {
              enabled: true,
              buttonOptions: {
                  verticalAlign: 'bottom'
              }
          },

          colorAxis: {
              min: 0
          },

          series: [{
              data: data,
              name: 'Branches',
              states: {
                  hover: {
                      color: '#BADA55'
                  }
              },
              dataLabels: {
                  enabled: true,
                  format: '{point.name.age}'
              }
          }]
      });

      })();
    </script>

    <script type="text/javascript">

      $(function(){
        var table = $("#excelCollectionTable").DataTable({
          processing: true,
          serverSide: true,
          paging: true,
          lengthChange: true,
          searching: true,
          ordering: true,
          info: true,
          autoWidth: false,
          responsive: true,
          ajax: "excel-collection/retrieve",
          columns: [
            {data: "id", name: "id"},
            {data: "timestamp", name: "timestamp"},
            {data: "branch", name: "branch"},
            {data: "marketting_agent", name: "marketting_agent"},
            {data: "status", name: "status"},
            {data: "phmember", name: "phmember"},
            {data: "or_number", name: "or_number"},
            {data: "or_date", name: "or_date"},
            {data: "amount_collected", name: "amount_collected"},
            {data: "month_of", name: "month_of"},
            {data: "nop", name: "nop"},
            {data: "date_remitted", name: "date_remitted"},
            {data: "dayong_program", name: "dayong_program"},
            {data: "reactivation", name: "reactivation"},
            {data: "transferred", name: "transferred"},
            {data: "isImported", name: "isImported"},
            {data: "created_at", name: "created_at"},
            {data: "updated_at", name: "updated_at"},
          ]
        });
      });

      $(function(){
        var table = $("#excelNewSalesTable").DataTable({
          processing: true,
          serverSide: true,
          paging: true,
          lengthChange: true,
          searching: true,
          ordering: true,
          info: true,
          autoWidth: false,
          responsive: true,
          ajax: "excel-new-sales/retrieve",
          columns: [
            {data: "id", name: "id"},
            {data: "timestamp", name: "timestamp"},
            {data: "branch", name: "branch"},
            {data: "marketting_agent", name: "marketting_agent"},
            {data: "status", name: "status"},
            {data: "phmember", name: "phmember"},
            {data: "address", name: "address"},
            {data: "civil_status", name: "civil_status"},
            {data: "birthdate", name: "birthdate"},
            {data: "name", name: "name"},
            {data: "contact_num", name: "contact_num"},
            {data: "type_of_transaction", name: "type_of_transaction"},
            {data: "with_registration_fee", name: "with_registration_fee"},
            {data: "registration_amount", name: "registration_amount"},
            {data: "dayong_program", name: "dayong_program"},
            {data: "application_no", name: "application_no"},
            {data: "or_number", name: "or_number"},
            {data: "or_date", name: "or_date"},
            {data: "amount_collected", name: "amount_collected"},
            {data: "name1", name: "name1"},
            {data: "age1", name: "age1"},
            {data: "relationship1", name: "relationship1"},
            {data: "name2", name: "name2"},
            {data: "age2", name: "age2"},
            {data: "relationship2", name: "relationship2"},
            {data: "name3", name: "name3"},
            {data: "age3", name: "age3"},
            {data: "relationship3", name: "relationship3"},
            {data: "name4", name: "name4"},
            {data: "age4", name: "age4"},
            {data: "relationship4", name: "relationship4"},
            {data: "name5", name: "name5"},
            {data: "age5", name: "age5"},
            {data: "relationship5", name: "relationship5"},
            {data: "sheetName", name: "sheetName"},
            {data: "remarks", name: "remarks"},
            {data: "isImported", name: "isImported"},
            {data: "created_at", name: "created_at"},
            {data: "updated_at", name: "updated_at"},
          ]
        });
      });

    </script>

    @if(session()->has('error_msg'))
      <script>
          toastr.options.preventDuplicates = true;
          toastr.error("{{ session('error_msg') }}");
      </script>
    @endif

    @error('code')
      <script>
        toastr.options.preventDuplicates = true;
        toastr.error('Code already exists');
      </script>
    @enderror

    @if(session()->has('success_msg'))
      <script>
          toastr.options.preventDuplicates = true;
          toastr.success("{{ session('success_msg') }}");
      </script>
    @endif

    @if(session()->has('download_file'))
      <script>
          $("#download_filename").val("{{ session('download_file') }}");
          $("#downloadForm").submit();
      </script>
    @endif

  <script>
    function showErrorToast(val){
      toastr.options.preventDuplicates = true;
      toastr.error(val);
    }
  </script>

  </body>
</html>
