@extends('layouts.main')
@section('content')
    <div style="width:100%;margin-top:150px">
        <video width="100%" height="auto" controls="controls" controlsList="nodownload"></video>
    </div>

    <script type='text/javascript'>

        $(document).ready(function () {

            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'Orbit2.mp4', true);
            xhr.responseType = 'blob';
            xhr.onload = function (e) {
                var blob = this.response;
                var vid = document.getElementsByTagName('video')[0];
                vid.src = URL.createObjectURL(blob);
                vid.load();
                vid.onloadeddata = function () {
                    vid.play();
                }
            };
            xhr.send();
        });

    </script>
@endsection
