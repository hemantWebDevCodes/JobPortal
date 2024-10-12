
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Dashboaed | JobFinder</title>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('assets/admin-panel/css/all.min.css') }}">
  
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('assets/admin-panel/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('assets/admin-panel/css/OverlayScrollbars.min.css') }}">
  {{-- Bootstrap Css --}}
  <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
  {{-- Nice Select css --}}
   <link rel="stylesheet" href="{{ asset('assets/css/nice-select.css') }}">
  {{-- My Css --}}
  <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">

</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="content-wrapper bg-white">
  
    <nav class="main-header fixed-top navbar navbar-expand navbar-light py-3 navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item"> 
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
          <li class="nav-item d-none d-sm-inline-block ms-3">
            <a href="{{ route('Home') }}" class="nav-link fw-bold">Home</a>
          </li>
        </ul>
    </nav>

    
    @include('admin.includes.sidebar')
    
    @yield('dashboard-main-content')
  
  </div>


  <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
  <script src="{{ asset('assets/admin-panel/js/bootstrap.bundle.min.js') }}"></script>

  <!-- Bootstrap Javascript js -->
  <script src="{{ asset('assets/js/bootstrap.bundle.5.1.3.min.js') }}"></script>
  <script src="{{ asset('assets/admin-panel/js/adminlte.min.js') }}"></script>

  {{-- Nice Select Js --}}
   <script src="{{ asset('assets/js/jquery.nice-select.min.js') }}"></script>
  
  <script>
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
      }); 

    //* Nice Select 
      $(document).ready(function() {
         $('select').niceSelect();
      }); 
  </script>

  @yield('custom-js-jquery')
</body>
 </html>