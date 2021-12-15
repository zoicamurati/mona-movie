@extends('layouts.main')
@section('content')
    <div style="width:100%">
    <input type="file" name="file" id="fileItem" onchange="onChange()" >
       {{-- {{Storage::disk('public')->get('The.Prestige.2006.m720p.x264.mkv')}}--}}
        {{--{{phpinfo()}}--}}
    <video></video>
    </div>
    <script>
        var URL = window.URL || window.webkitURL;
        var video = document.getElementsByTagName('video')[0];z
     /*   var video = "{{Storage::disk('public')->get('The.Prestige.2006.m720p.x264.mkv')}}";*/
        function onChange() {
            var fileItem = document.getElementById('fileItem');
            var files = fileItem.files;
            var file = files[0];
            var url = URL.createObjectURL(file);
           /* console.log(file);
            console.log(url);*/
            video.src = url;
            video.load();
            video.onloadeddata = function() {
                video.play();
            }
        }
    </script>
@endsection

