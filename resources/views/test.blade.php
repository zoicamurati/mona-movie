@extends('layouts.main')
@section('content')
    <div style="width:100%;margin-top:150px">

   {{-- <input type="file" name="file" id="fileItem" onchange="onChange()" >--}}
        {{--{{phpinfo()}}--}}

     <video width="100%"  height="auto" controls="controls" controlsList="nodownload"></video>
    </div>
    <script>
       $( document ).ready(function() {
            console.log( "ready!" );

            var URL = window.URL || window.webkitURL;


           /* var fileItem = document.getElementById('fileItem');
            var files = fileItem.files;
            var file = files[0];*/

          var file=' {!! storage_path() .'/Orbit2.mp4'!!}'

            if (file) {
                console.log('pse')
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
                r.readAsArrayBuffer(file);
            }
        });
      /*  var URL = window.URL || window.webkitURL;
        var video = document.getElementsByTagName('video')[0];
       /!* var video = '{{Storage::disk('public')->get('Orbit2.mp4')}}';*!/

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
            }*/
          /*  console.log({{Storage::disk('public')->get('Orbit2.mp4')}})
            var fileItem = document.getElementById('fileItem');
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

