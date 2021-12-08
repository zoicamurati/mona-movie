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
    <link rel="icon" type="image/png"  href="{{ asset('assets/images/drilon/favicon.png') }}" sizes="32x32" />
    <link rel="icon" type="image/png"  href="{{ asset('assets/images/drilon/favicon.png') }}" sizes="200x200" />

    <title>Drilon Hoxha Production</title>

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:500,600,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,400i&display=swap" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}"  rel="stylesheet" media="screen">
</head>
<body>

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
</body>
</html>


