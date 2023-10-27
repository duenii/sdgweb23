<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <!-- Required meta tags -->
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>@yield('tatle')</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css')}}">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <!-- endinject -->
  <!-- Layout styles -->
  <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}">
  <!-- End layout styles -->
  <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico')}}">

  <!-- include libraries(jQuery, bootstrap) -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet"> 
  <!-- include summernote css/js -->
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


  @yield('style')
</head>

<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href="/dashboard"><img
            src="{{ asset('assets/themeweb/images/logo-auth3.png')}}" alt="logo" class="w-75" /></a>
        <a class="navbar-brand brand-logo-mini" href="/dashboard"><img src="{{ asset('assets/images/logo-mini.svg')}}"
            alt="logo" /></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-stretch">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="mdi mdi-menu"></span>
        </button>
        {{-- <div class="search-field d-none d-md-block">
          <form class="d-flex align-items-center h-100" action="#">
            <div class="input-group">
              <div class="input-group-prepend bg-transparent">
                <i class="input-group-text border-0 mdi mdi-magnify"></i>
              </div>
              <input type="text" class="form-control bg-transparent border-0" placeholder="Search projects">
            </div>
          </form>
        </div> --}}
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item nav-profile ">

            <div class="nav-link" data-bs-toggle="dropdown" aria-expanded="false">
              <div class="nav-profile-img">
                {{-- <img src="{{ asset('assets/images/faces/face1.jpg')}}" alt="image"> --}}

              </div>
              <div class="nav-profile-text">
                <p class="mb-1 text-black"> <i class="mdi mdi-account text-primary"></i> {{ Auth::user()->name }}</p>
              </div>
            </div>
          </li>
          <li class="nav-item d-none d-lg-block full-screen-link">
            <a class="nav-link">
              <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
            </a>
          </li>

          <li class="nav-item d-none d-lg-block nav-logout">
            <form id="logout-form" action="{{ route('logout')}}" method="post">
              @csrf
              <a id="logout-button" class="nav-link" href="#">
                <i class="mdi mdi-power"></i>
              </a>
            </form>
          </li>

        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
          data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>

    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">



          <li class="nav-item">
            <a class="nav-link" href="/dashboard">
              <span class="menu-title">หน้าหลัก</span>
              <i class="mdi mdi-home menu-icon"></i>
            </a>
          </li>

          
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/auth/banner' )}}">
              <span class="menu-title">แบนเนอร์</span>
              <i class="mdi mdi-file-presentation-box menu-icon"></i>
            </a>
          </li> 

          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false"
              aria-controls="ui-basic">
              <span class="menu-title">จัดการข้อมูลเมนู</span>
              <i class="menu-arrow"></i>
              <i class="mdi mdi-package menu-icon"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{ url('/auth/postabouts') }}">เมนูหลัก</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ url('/auth/subabouts') }}">เมนูย่อย</a></li>
              </ul>
            </div>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="{{ url('/auth/category') }}">
              <span class="menu-title">ประเภทข้อมูล</span>
              <i class="mdi mdi-apps menu-icon"></i>
            </a>
          </li>


          <li class="nav-item">
            <a class="nav-link" href="{{ url('/auth/posts') }}">
              <span class="menu-title">จัดการข้อมูลข่าว SDG</span>
              <i class="mdi mdi-newspaper menu-icon"></i>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="{{ url('/auth/news') }}">
              <span class="menu-title">ข่าวประชาสัมพันธ์</span>
              <i class="mdi mdi-newspaper menu-icon"></i>
            </a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/auth/files' )}}">
              <span class="menu-title">อัพโหลดไฟล์</span>
              <i class="mdi mdi-folder-upload menu-icon"></i>
            </a>
          </li> 


        
          {{-- <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false"
              aria-controls="ui-basic">
              <span class="menu-title">จัดการข้อมูลเมนู</span>
              <i class="menu-arrow"></i>
              <i class="mdi mdi-package menu-icon"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{ url('/auth/postabouts') }}">เมนูหลัก</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ url('/auth/subabouts') }}">เมนูย่อย</a></li>
              </ul>
            </div>
          </li> --}}

          {{-- <li class="nav-item">
            <a class="nav-link" href="{{ url('/auth/services') }}">
              <span class="menu-title">จัดการเมนูบริการอื่นๆ</span>
              <i class="mdi mdi-apps menu-icon"></i>
            </a>
          </li>

          

          {{-- <li class="nav-item">
            <a class="nav-link" href="{{ url('/auth/newsletter' )}}">
              <span class="menu-title">จดหมายข่าว</span>
              <i class="mdi mdi-file-presentation-box menu-icon"></i>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="{{ url('/auth/files' )}}">
              <span class="menu-title">อัพโหลดไฟล์</span>
              <i class="mdi mdi-folder-upload menu-icon"></i>
            </a>
          </li> --}}

          {{-- <li class="nav-item">
            <a class="nav-link" href="{{ url('/auth/adminweb' )}}">
              <span class="menu-title">จัดการผู้ใช้</span>
              <i class="mdi mdi-account-box menu-icon"></i>
            </a>
          </li> --}}

        </ul>
      </nav>
      @yield('content')

    </div>
    <!-- main-panel ends -->
  </div>
  <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js')}}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="{{ asset('assets/vendors/chart.js/Chart.min.js')}}"></script>
  <script src="{{ asset('assets/js/jquery.cookie.js')}}" type="text/javascript"></script>
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="{{ asset('assets/js/off-canvas.js')}}"></script>
  <script src="{{ asset('assets/js/hoverable-collapse.js')}}"></script>
  <script src="{{ asset('assets/js/misc.js')}}"></script>
  <!-- endinject -->
  <!-- Custom js for this page -->
  <script src="{{ asset('assets/js/dashboard.js')}}"></script>
  <script src="{{ asset('assets/js/todolist.js')}}"></script>

  <!-- End custom js for this page -->
  <!-- include summernote css/js -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script> 

   <!-- include ckeditor -->



    <style type="text/css">
    .ck-editor__editable {
         min-height: 250px;
    }
    </style>
 
  @yield('scripts')

  <script>
    
    $(document).ready(function(){
      $('#logout-button').click(function(){
        $('#logout-form').submit();
      });
    });
  </script>

  <!-- <script>
    @if(Session::has('alert-success'))
      swal("Good job!", {{ Seesion::get('alert-seccess')}}}, "success");
    @endif
  </script> -->

</body>

</html>