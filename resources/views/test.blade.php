@extends('layouts.main')
@section('content')
    <div style="width:100%;margin-top:150px">

        {{-- <input type="file" name="file" id="fileItem" onchange="onChange()">--}}
        {{--
                <input style="display: none" type="file" value={{route('getVideo')}}name="file" id="fileItem" onchange="onChange()">
        --}}
        <div id="player"></div>
        {{-- <video width="100%" height="auto"  controls="controls"
                controlsList="nodownload"></video>--}}
    </div>
    <script src='../js/jwplayer.js' type='text/javascript'></script>
    <script  type='text/javascript'>
        jwplayer('player').setup({
            "playlist": "https://cdn.jwplayer.com/v2/playlists/kChiIzVB",
            'file': 'test.mp4',

        })




        /*   $( document ).ready(function() {

           var URL = window.URL || window.webkitURL;

                var fileItem = document.getElementById('fileItem');
                var files = fileItem.files;
                var file = files[0];*/
        // var file = '{{\App\Helper\get_video()}}'


        //  var url = '{{route('getVideo')}}'




        /*  if (file) {*/
        /* console.log('pse')
         var r = new FileReader();
         console.log(r)
             r.onload = function (e) {
             var contents = e.target.result;

             var uint8Array = new Uint8Array(contents);

             var arrayBuffer = uint8Array.buffer;
             var blob = new Blob([arrayBuffer]);
             console.log(uint8Array)

             video.src = URL.createObjectURL(blob);



         }
         r.readAsArrayBuffer(file);*/
        /*   }*/
        /*    });*/
        /*   var URL = window.URL || window.webkitURL;
           var video = document.getElementsByTagName('video')[0];


           function onChange() {
               var fileItem = document.getElementById('fileItem');
               var files = fileItem.files;
               var file = files[0];

               if (file) {
                   var r = new FileReader();
                   r.onload = function (e) {
                       var contents = e.target.result;

                       var uint8Array = new Uint8Array(contents);

                       var arrayBuffer = uint8Array.buffer;
                       var blob = new Blob([arrayBuffer]);
                       console.log(uint8Array)

                       video.src = URL.createObjectURL(blob);


                       console.log(contents)
                       /!*   video.src=contents *!/
                   }
                   r.readAsArrayBuffer(file);
               }
         }*/
        /* var fileItem = document.getElementById('fileItem');
        var files = fileItem.files;
        var file = files[0];
        console.log(file)

        var uint8Array  = new Uint8Array(file);

        var arrayBuffer = uint8Array.buffer;
        var blob        = new Blob([arrayBuffer]);

        var url = URL.createObjectURL(blob);
        video.src = url;
        video.load();
        video.onloadeddata = function() {
            video.play();*/
        /*  }*/
        /*}*/


    </script>
@endsection

