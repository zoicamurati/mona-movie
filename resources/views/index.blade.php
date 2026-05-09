
@extends('layouts.main')
@section('content')


    <div class="social-list social-list-bottom boxed">
        <div class="social-icons">
            <a target="_blank" href="https://www.youtube.com/c/DrilonHoxhaOfficial">   <div class="social-icon"><img alt="" class="img-fluid" src="/assets/images/drilon/ytwhite.png"></div></a>
            <a target="_blank" href="https://www.facebook.com/Official.Drilon.Hoxha">   <div class="social-icon"><img alt=""  class="img-fluid"  src="/assets/images/drilon/fbwhite.png"></div></a>
            <a target="_blank" href="https://www.instagram.com/drilonhoxha/">   <div class="social-icon"><img alt=""  class="img-fluid" src="/assets/images/drilon/igwhite.png"></div></a>
        </div>

    </div>
    <div class="pagepiling">
        <div data-anchor="page1" class="pp-scrollable text-white section section-1">
            <div class="scroll-wrap">
                <div class="section-bg mobile-bg" style="background-image:url('assets/images/drilon/banertest.png') "></div>
                <div class="scrollable-content">
                    <div class="vertical-centred">
                        <div class="boxed boxed-inner">
                            <div class="boxed">
                                <div class="container">
                                    <div class="intro">
                                        <div class="row">
                                            <div class="col-md-8 col-lg-6">
                                                <h1 class="display-2 text-white  wow fadeIn" style="font-size: 5.54rem;" data-wow-delay="0.1s">Perfitojeni vetem per <s> 15€ </s><span class="text-primary" style="font-size: 7rem; "> 8€</span></h1>
                                                <h6 class=" text-white  wow fadeIn" style="text-transform: uppercase">Per te gjithe rezervimet deri me date  <span class="text-primary"> 24 DHJETOR </span> mund te perfitoni filmin me 50% ulje i cili do te jete i disponueshem   <span class="text-primary"> VETEM NE 25 DHJETOR </span>
                                                    <div class="book-btn contact-item" style="width: 200px; margin-top: 20px">
                                                        <a href="{{route('register')}}" style="color: #fff">BOOK NOW</a>
                                                    </div>
                                                    <a class="popup-youtube"  href="https://www.youtube.com/watch?v=J_Yms2JjufU"><span class="icon ion-ios-play"></span>Shkembimi - Official Trailer 2026</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    </div>
    </div>
    <script>
      @if(Session::has('message'))
            console.log('pse')
        var type = "{{ Session::get('alert-type') }}";
        switch (type) {
            case 'success':
                toastr.success("{{ Session::get('message') }}");
                break;

            case 'error':
                toastr.error("{{ Session::get('message') }}");
                break;
        }
             {{--   {{Session::forget('message')}}--}}
        @endif
    </script>
@endsection
