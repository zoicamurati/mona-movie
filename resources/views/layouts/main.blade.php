<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Favicons -->

    <link rel="shortcut icon" href="">
    <link rel="shortcut icon" href="{{ asset('assets/images/drilon/favicon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/images/drilon/favicon.png') }}" sizes="32x32"/>
    <link rel="icon" type="image/png" href="{{ asset('assets/images/drilon/favicon.png') }}" sizes="200x200"/>

    <title>Drilon Hoxha Production</title>

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:500,600,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,400i&display=swap" rel="stylesheet">
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

    <!-- Sidebar Menu-->
    @if(!Route::is('movie')  && !Route::is('createTransaction') )
        <div class="menu">
            <span class="close-menu icon-cross2 right-boxed"></span>
            <ul class="menu-list right-boxed">
                <li data-menuanchor="page1">
                    <a href="#page1">Home</a>
                </li>
                <li data-menuanchor="page2">
                    <a href="#page2">Shkembimi</a>
                </li>
                <li data-menuanchor="page3">
                    <a href="#page3">About</a>
                </li>
                <li data-menuanchor="page4">
                    <a href="#page4">Production</a>
                </li>
                <li data-menuanchor="page5">
                    <a href="#page5">Partners</a>
                </li>
                <li data-menuanchor="page6">
                    <a href="#page6">Contact</a>
                </li>
                <li class="book-now" data-menuanchor="">
                    <a href="">BOOK NOW </a>
                </li>
            </ul>
            <div class="menu-footer right-boxed">
                <div class="social-list">
                    <div class="social-icons">
                        <a target="_blank" href="https://www.youtube.com/c/DrilonHoxhaOfficial">
                            <div class="social-icon"><img alt="" class="img-fluid" src="images/drilon/ytwhite.png">
                            </div>
                        </a>
                        <a target="_blank" href="https://www.facebook.com/Official.Drilon.Hoxha">
                            <div class="social-icon"><img alt="" class="img-fluid" src="images/drilon/fbwhite.png">
                            </div>
                        </a>
                        <a target="_blank" href="https://www.instagram.com/drilonhoxha/">
                            <div class="social-icon"><img alt="" class="img-fluid" src="images/drilon/igwhite.png">
                            </div>
                        </a>
                    </div>
                </div>
                <div class="copy"> ©2021<a href="https://digitalmoon.al/" target="_blank"> Digital Moon Agency </a> All
                    Rights Reserved
                </div>
            </div>
        </div>
    @endif
<!-- Navbar -->

    <header class="navbar navbar-fullpage boxed">
        <div class="navbar-bg"></div>
        @if(!Route::is('movie')  && !Route::is('createTransaction') )
            <a class="brand" href="#page1">
                <img alt="" src="/assets/images/drilon/logo.png" class="img-fluid">

            </a>
        @else
            <a class="brand" href="{{route('home')}}">
                <img alt="" src="/assets/images/drilon/logo.png" class="img-fluid">

            </a>
        @endif
        @if(!Route::is('movie')  && !Route::is('createTransaction') )
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse"
                    aria-expanded="false">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        @endif

        @if((Route::is('movie')  ||  Route::is('createTransaction'))  && Auth::check() && Auth::user()->role ==1 )
            <div class="navbar-toggle book-btn contact-item">
                <a href="{{route('panel')}}" class="text-white">Shko ne Panel</a>
            </div>
        @endif

        <div class="contacts d-none d-md-block">
            @if(!Route::is('movie')  && !Route::is('createTransaction') )

                <div class="book-btn contact-item">
                    <a href="{{route('register')}}">BOOK NOW</a>
                </div>

                <div class="contact-item spacer">
                    /
                </div>
            @endif

            <div class="contact-item">
                <a href="mailto:contact@drilonhoxha.com">contact@drilonhoxha.com</a>
            </div>
        </div>
    </header>
    <div class="copy-bottom white boxed"> ©2021<a href="https://digitalmoon.al/" target="_blank"> Digital Moon
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
    {{--<script>--}}
    {{--    document.onkeydown = function(e) {--}}
    {{--        if (e.ctrlKey &&--}}
    {{--            (e.keyCode === 85 )) {--}}
    {{--            return false;--}}
    {{--        }--}}
    {{--    };--}}

    {{--    document.onkeydown = function(e) {--}}
    {{--        if(e.keyCode == 123) {--}}
    {{--            return false;--}}
    {{--        }--}}
    {{--        if(e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) {--}}
    {{--            return false;--}}
    {{--        }--}}
    {{--        if(e.ctrlKey && e.shiftKey && e.keyCode == 'C'.charCodeAt(0)) {--}}
    {{--            return false;--}}
    {{--        }--}}
    {{--        if(e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) {--}}
    {{--            return false;--}}
    {{--        }--}}
    {{--        if(e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) {--}}
    {{--            return false;--}}
    {{--        }--}}
    {{--    }--}}
    {{--    $(document).bind("contextmenu",function(e) {--}}
    {{--        e.preventDefault();--}}
    {{--    })--}}
    {{--</script>--}}

    <script src="{{ asset('/assets/js/scripts.js') }}"></script>


</div>
</body>
</html>


