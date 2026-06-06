<!DOCTYPE HTML>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('panel/css/bootstrap.min.css') }}">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}"/>
    <link rel="stylesheet" href="{{ asset('panel/css/typography.css') }}">

    <title>Movie ME FAT</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/css/lightbox.min.css">

    <link href="{{ asset('panel/css/style.css') }}" rel="stylesheet" media="screen">

    <script src="{{ asset('/js/jwplayer.js') }}"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body style="overflow: hidden;">
<div id="container">
    <div id="myModal" class="modal fade" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Termat & Kushtet e Perdorimit</h3>
                    {{--<button type="button" class="close" data-dismiss="modal">&times;</button>--}}
                </div>
                <div class="modal-body text-center">
                    <div>
                        <div><h5>Nëpermjet pranimit të kushteve dhe termave të pronës intelektuale ju dakortësoheni se
                                për secilën
                                nga pikat e mëposhtme do të aplikohen sanksionet e ligjeve ne fuqi: </h5>
                            <ul>
                                <li><h6>Shpërndarja e cdo sekuence ose e filmit të plotë pa autorizim nga pronari
                                        legjitim</h6></li>
                                <li><h6>Thyerja e sistemeve të sigurisë me qëllim për të shkarkuar filmin në mënyrë te
                                        jashtëligjshme</h6></li>
                                <li><h6>Rregjistrimi i filmit gjatë transmetimit me "Screen-Recording Software" ose me
                                        pajisje video
                                        rregjistruese kamera, smartphone etj...</h6></li>
                                <li><h6>Cdo akt i cili bie ne kundërshtim me termat dhe kushtet e pronës intelektuale (
                                        shpërndarja
                                        e cdo sekuence ose e filmit të plotë,shkarkimi i tij etj..) do të jetë
                                        përgjegjësi e
                                        cila bie mbi zotëruesin e kësaj llogarie </h6></li>
                            </ul>

                            <h5>Emri dhe Mbiemri i zotëruesit të llogarisë do të shfaqen mbi film gjatë gjithë
                                transmetimit të tij
                                me qëllim për të identifikuar shkelësin në mënyrë të drejtpërdrejtë. </h5>


                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn bg-primary" data-dismiss="modal"><span
                                    class="glyphicon glyphicon-success"></span> Pranoj kushtet e perdorimit
                            </button>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="video-block">

        <div class="overlay">
            <h1>{{Auth::user()->email}}</h1>
        </div>

        <div id="player"></div>
    </div>
</div>

</body>


<script src="{{ asset('/js/jwplayer.js') }}"></script>
<script src="https://cdn.jwplayer.com/libraries/bTQA57Q3.js"></script>
<script type='text/javascript'>

    $(document).ready(function () {
        $("#myModal").modal('show');
    });

    window.onload = function () {
        video = document.querySelector('video');
        if (video) {
            video.setAttribute("controlsList", "nodownload");
        }
    };
    const playerInstance = jwplayer('player').setup({
        "playlist": "https://cdn.jwplayer.com/v2/playlists/2TNu2F7p?format=mrss"
    })
    jwplayer().setConfig({ allowFullscreen: false })

    playerInstance.on('fullscreen', function(e) {
        var overlay = document.querySelector('.overlay');
        var videoBlock = document.querySelector('.video-block');
        if (e.fullscreen) {
            document.getElementById('player').appendChild(overlay);
            overlay.classList.add('in-fullscreen');
        } else {
            videoBlock.appendChild(overlay);
            overlay.classList.remove('in-fullscreen');
        }
    });

    document.addEventListener('fullscreenchange', function() {
        var overlay = document.querySelector('.overlay');
        var videoBlock = document.querySelector('.video-block');
        if (document.fullscreenElement) {
            document.fullscreenElement.appendChild(overlay);
            overlay.classList.add('in-fullscreen');
        } else {
            videoBlock.appendChild(overlay);
            overlay.classList.remove('in-fullscreen');
        }
    });

    var fs = document.getElementById('btnFS');

    fs.addEventListener('click', goFullScreen);


</script>
<style>
    .jw-icon .jw-icon-inline .jw-button-color .jw-reset .jw-icon-fullscreen {
        display: none !important;
    }
</style>

<script>
    $('#myModal').modal({backdrop: 'static', keyboard: false})


    document.onkeydown = function (e) {
        if (e.ctrlKey &&
            (e.keyCode === 85)) {
            return false;
        }
    };

    document.onkeydown = function (e) {
        if (e.keyCode == 123) {
            return false;
        }
        if (e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) {
            return false;
        }
        if (e.ctrlKey && e.shiftKey && e.keyCode == 'C'.charCodeAt(0)) {
            return false;
        }
        if (e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) {
            return false;
        }
        if (e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) {
            return false;
        }
    }
    $(document).bind("contextmenu", function (e) {
        e.preventDefault();
    })
</script>

</html>


