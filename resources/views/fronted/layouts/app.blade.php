<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Job Finder</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.27.3/ui/trumbowyg.min.css" integrity="sha512-Fm8kRNVGCBZn0sPmwJbVXlqfJmPC13zRsMElZenX6v721g/H7OukJd8XzDEBRQ2FSATK8xNF9UYvzsCtUpfeJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href=" {{ asset('assets/css/bootstrap.min.css') }} ">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/slick.css') }}">

</head>
<body>
{{--     
  <header>
    @yield('header')
  <header> --}}
  <header>
    <div class="container">
      <div class="header_wrapper">
      <!-- Navbar Start -->
        <nav class="navbar navbar-expand-lg navbar-light bg-white">
          <a class="navbar-brand text-lg-center" href="#">
            <img src="{{ asset('assets/images/logo.png') }}" alt="JobNest" class="img-fluid w-75">
          </a>

          <button class="navbar-toggler shadow-none border-0 fs-3" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="navbar-toggler-icon"></i>
          </button  >

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-md-5 mx-lg-auto">
              <li class="nav-item active">
                <a href="{{ route('Home') }}" class="nav-link">Home</a>
              </li>
              
              <li class="nav-item">
                  <a href="{{ route('Show.findJob') }}" class="nav-link">Find a Job</a>
              </li>
              
              <li class="nav-item">
                <a href="{{ route('AboutUs') }}" class="nav-link">About us</a>
              </li>
              
              <li class="nav-item">
                <a href="{{ route('Contact') }}" class="nav-link">Contact</a>
              </li>
            </ul>
            
            <ul class="navbar-nav ms-auto">
              @if(!Auth::check())
              <li class="nav-item">
                  <a href="{{ route('Account.register') }}" class="btn-style head-btn1 py-4">Register</a>
                  <a href="{{ route('Account.login') }}" class="btn-style head-btn2">Login</a>
              </li>
              @else
              <li class="nav-item">
                @if(Auth::user()->role == "admin")
                  <a href="{{ route('dashboard_content') }}" class="btn-style head-btn1 py-4">Admin</a>  
                @endif
                  <a href="{{ route('Account.login') }}" class="btn-style head-btn2">Account</a>
                @endif
              </li>
            </ul>
          </div>
        </nav>
      </div>
    </div>
   <!-- Navbar End -->
  </header>

  <main>
     @yield('main-section')
  </main>
  
  @include('fronted.layouts.footer')
  

     <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
     <script src="{{ asset('assets/js/bootstrap.bundle.5.1.3.min.js') }}"></script>
     <script src="{{ asset('assets/admin-panel/js/bootstrap.min.js') }}"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.27.3/trumbowyg.min.js" integrity="sha512-YJgZG+6o3xSc0k5wv774GS+W1gx0vuSI/kr0E0UylL/Qg/noNspPtYwHPN9q6n59CTR/uhgXfjDXLTRI+uIryg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
     <script src="{{ asset('assets/js/slick.min.js') }}"></script>
     <script src="{{ asset('assets/js/instantpages.5.1.0.min.js') }}"></script>
     <script src="{{ asset('assets/js/lazyload.17.6.0.min.js') }}"></script>
     <script src="{{ asset('assets/js/custom.js') }}"></script>
     <script src="{{ asset('assets/js/jquery.nice-select.min.js') }}"></script>
     
     <script>

     //* Trumbowyg library Text Editor
      // $('.textarea').trumbowyg();

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
      }); 

      //* Nice Select 
      $(document).ready(function() {
        $('select').niceSelect();
      }); 
      
    
      $(document).ready(function(){
    var navbar = $('.navbar');
    // var offset = navbar.offset().top;

    $(window).scroll(function(){
        if($(window).scrollTop() >= 100){
            navbar.addClass('header-scrolled');
        }else{
            navbar.removeClass('header-scrolled');
        }
    });

    console.log(navbar);
});
     </script>

     @yield('custom-ajax')
  </footer>
</body>
</html>