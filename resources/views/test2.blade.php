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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/css/lightbox.min.css">

    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" media="screen">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">
    <style>
        .jw-icon .jw-icon-inline .jw-button-color .jw-reset .jw-icon-fullscreen{
            display: none !important;
        }</style>
</head>

<div id="container">
    <div class="video-block">

        <div class="overlay">
            <h1>{{Auth::user()->real_name}}</h1>
        </div>

        <div class="main-video">
            <div class="btn-fs" id="btnFS">
                Fullscreen
            </div>


            <div id="player"></div>

        </div>

    </div>
</div>
    <script src="{{ asset('/js/jwplayer.js') }}"></script>
    <script type='text/javascript'>



        window.onload = function () {
            video = document.querySelector('video');
            if (video) {
                video.setAttribute("controlsList", "nodownload");
            }
        };
        const playerInstance = jwplayer('player').setup({
            "playlist": "https://cdn.jwplayer.com/v2/playlists/YWwr2dYj?format=mrss"
        })
        jwplayer().setConfig({ allowFullscreen: false })




        var fs = document.getElementById('btnFS');


        fs.addEventListener('click', goFullScreen);

        function goFullScreen() {
            var fullscreenElement = document.fullscreenElement || document.mozFullScreenElement ||
                document.webkitFullscreenElement || document.msFullscreenElement;
            if (fullscreenElement) {
                exitFullscreen();
            } else {
                launchIntoFullscreen(document.getElementById('container'));
            }

        }

        // From https://davidwalsh.name/fullscreen
        // Find the right method, call on correct element
        function launchIntoFullscreen(element) {
            if (element.requestFullscreen) {
                element.requestFullscreen();
            } else if (element.mozRequestFullScreen) {
                element.mozRequestFullScreen();
            } else if (element.webkitRequestFullscreen) {
                element.webkitRequestFullscreen();
            } else if (element.msRequestFullscreen) {
                element.msRequestFullscreen();
            }
        }

        // Whack fullscreen
        function exitFullscreen() {
            if (document.exitFullscreen) {
                document.exitFullscreen();
            } else if (document.mozCancelFullScreen) {
                document.mozCancelFullScreen();
            } else if (document.webkitExitFullscreen) {
                document.webkitExitFullscreen();
            }
        }


    </script>
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

