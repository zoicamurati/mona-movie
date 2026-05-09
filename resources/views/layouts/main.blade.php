<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Favicons -->

    <link rel="shortcut icon" href="">
    <link rel="shortcut icon" href="{{ asset('assets/images/project/favicon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/images/project/favicon.png') }}" sizes="32x32"/>
    <link rel="icon" type="image/png" href="{{ asset('assets/images/project/favicon.png') }}" sizes="200x200"/>

    <title>ME FAT Movie</title>

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:500,600,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,400i&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/css/lightbox.min.css">

    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" media="screen">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">
</head>
<body>
<div class="animsition">
    <div class="loader">
        <div class="spinner">
            <div class="double-bounce1"></div>
            <div class="double-bounce2"></div>
        </div>
    </div>

    <!-- Content CLick Capture-->

    <div class="click-capture"></div>

<!-- Navbar -->

    <header class="navbar navbar-fullpage boxed">
        <div class="navbar-bg"></div>
        @if(!Route::is('movie')  && !Route::is('createTransaction') )
            <a class="brand" href="#page1">
                <img alt="" src="/assets/images/project/logo.png" class="img-fluid">

            </a>
        @else
            <a class="brand" href="{{route('home')}}">
                <img alt="" src="/assets/images/project/logo.png" class="img-fluid">

            </a>
        @endif

        @if((Route::is('movie') || Route::is('accept_agreement') || Route::is('createTransaction')) && Auth::check() && Auth::user()->role == 1)
            <div class="navbar-toggle book-btn contact-item">
                <a href="{{route('panel')}}" class="text-white">Shko ne Panel</a>
            </div>
        @endif

        @if((Route::is('movie') || Route::is('accept_agreement')) && Auth::check())
            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit" class="navbar-toggle book-btn contact-item" style="background:none;border:none;cursor:pointer;">
                    <span class="text-white">Dil</span>
                </button>
            </form>
        @endif

        <div class="contacts d-none d-md-block">
            @if(!Route::is('movie')  && !Route::is('createTransaction') )

                <div class="book-btn contact-item">
                    <a href="{{route('register')}}">BUY NOW</a>
                </div>

                <div class="contact-item spacer">
                    /
                </div>
            @endif

            <div class="contact-item">
                <a href="mailto:contact@mefat-film.com">contact@mefat-film.com</a>
            </div>
        </div>
    </header>
    <div class="copy-bottom white boxed"> ©2026<a href="https://digitalmoon.al/" target="_blank"> Digital Moon
            Agency </a></div>

    @yield('content')


    <script src="{{ asset('/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('/assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('/assets/js/smoothscroll.js') }}"></script>
    <script src="{{ asset('/assets/js/animsition.js') }}"></script>
    <script src="{{ asset('/assets/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('/assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('/assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('/assets/js/jquery.pagepiling.min.js') }}"></script>
  {{--  <script>
        document.onkeydown = function(e) {
            if (e.ctrlKey &&
                (e.keyCode === 85 )) {
                return false;
            }
        };

        document.onkeydown = function(e) {
            if(e.keyCode == 123) {
                return false;
            }
            if(e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) {
                return false;
            }
            if(e.ctrlKey && e.shiftKey && e.keyCode == 'C'.charCodeAt(0)) {
                return false;
            }
            if(e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) {
                return false;
            }
            if(e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) {
                return false;
            }
        }
        $(document).bind("contextmenu",function(e) {
            e.preventDefault();
        })
    </script>--}}

    <script src="{{ asset('/assets/js/scripts.js') }}"></script>


</div>
</body>
</html>


