
@extends('layouts.main')
@section('content')


{{--    <div class="social-list social-list-bottom boxed">--}}
{{--        <div class="social-icons">--}}
{{--            <a target="_blank" href="https://www.youtube.com/c/">   <div class="social-icon"><img alt="" class="img-fluid" src="/assets/images/project/ytwhite.png"></div></a>--}}
{{--            <a target="_blank" href="https://www.facebook.com/">   <div class="social-icon"><img alt=""  class="img-fluid"  src="/assets/images/project/fbwhite.png"></div></a>--}}
{{--            <a target="_blank" href="https://www.instagram.com/">   <div class="social-icon"><img alt=""  class="img-fluid" src="/assets/images/project/igwhite.png"></div></a>--}}
{{--        </div>--}}

{{--    </div>--}}
    <div class="pagepiling">
        <div data-anchor="page1" class="pp-scrollable text-white section section-1">
            <div class="scroll-wrap">
                <div class="section-bg mobile-bg" style="background-image:url('assets/images/project/banertest.png') "></div>
                <div class="scrollable-content">
                    <div class="vertical-centred">
                        <div class="intro">
                            <div class="intro-block">


                            <div class="row">
                                <div class="col-md-12 col-lg-12">
{{--                                    <h1 class="display-2 text-white  wow fadeIn" style="font-size: 5.54rem;" data-wow-delay="0.1s">Perfitojeni vetem per <s> 10€ </s><span class="text-primary" style="font-size: 7rem; "> 10€</span></h1>--}}
                                    <h1 class="display-2 text-white  wow fadeIn" style="font-size: 5.54rem;" data-wow-delay="0.1s">Perfitojeni vetem per <span class="text-primary" style="font-size: 7rem; "> 10€</span></h1>
                              
                                       <h5 class=" text-white  wow fadeIn" data-wow-delay="0.1s">Filmi do të jetë i disponueshëm <span class="text-primary" style="text-transform: uppercase;" >Vetëm për 3 ditë </span> nga momenti i blerjes </h5>
                                 <div class="main-text">
{{--                                     <h6 class=" text-white  wow fadeIn" style="font-size: 16px;" >--}}
{{--                                         Mefo ëndërron të bëhet kampion boksi, por rruga drejt ringut e çon larg familjes dhe e përfshin në një realitet të ashpër, ku rreziku dhe e kaluara e tij e errët e ndjekin në çdo hap. Teksa përpiqet të shkëputet nga hija e gabimeve dhe të përqendrohet vetëm te ëndrra e tij, ai përballet me një zgjedhje që do t’i ndryshojë jetën: lavdia në ring apo dashuria për Inën. Në një botë ku çdo goditje ka pasoja, Mefo duhet të vendosë çfarë është gati të humbasë për të fituar gjithçka.</h6>--}}
{{--                               --}}
                                     <h6 class=" text-white  wow fadeIn" style="font-size: 16px;" >
                                         Mefo ëndërron të bëhet kampion boksi, por rruga drejt ringut e çon larg familjes dhe e përfshin në një realitet të ashpër, ku rreziku dhe e kaluara e tij e errët e ndjekin në çdo hap
                                         <span id="extra" style="display:none;"> Teksa përpiqet të shkëputet nga hija e gabimeve dhe të përqendrohet vetëm te ëndrra e tij, ai përballet me një zgjedhje që do t’i ndryshojë jetën: lavdia në ring apo dashuria për Inën. Në një botë ku çdo goditje ka pasoja, Mefo duhet të vendosë çfarë është gati të humbasë për të fituar gjithçka.</span>
                                         <a class="caption-more-btn1" id="btn" onclick="toggleCaption()">...</a>
                                     </h6>
                                 </div>

                                    <div style="display: flex; gap: 16px; margin-top: 20px; align-items: center; flex-wrap: wrap;">
                                        @if(Auth::check() && Auth::user()->invoices()->where('status', 1)->where('created_at', '>=', now()->subDays(3))->exists())
                                            <div class="book-btn contact-item" style="width: 200px;">
                                                <a href="{{route('accept_agreement')}}" style="color: #fff">WATCH NOW</a>
                                            </div>
                                        @elseif(Auth::check() && Auth::user()->invoices()->where('status', 1)->exists())
                                            <div class="book-btn contact-item" style="width: 200px;">
                                                <form method="POST" action="{{ route('rebuyProcess') }}" style="display:inline;">
                                                    @csrf
                                                    <button type="submit" style="background:none;border:none;outline:none;cursor:pointer;padding:0;color:#fff;font:inherit;letter-spacing:inherit;">BUY NOW</button>
                                                </form>
                                            </div>
                                        @else
                                            <div class="book-btn contact-item" style="width: 200px;">
                                                <a href="{{route('register')}}" style="color: #fff">BUY NOW</a>
                                            </div>
                                            <div class="book-btn contact-item" style="width: 200px;">
                                                <a href="{{route('login')}}" style="color: #fff">LOGIN</a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            </div>

                        </div>
                                <div class="container">
                                    <div class="intro">
                                        <div class="row">
                                            <div class="col-md-12 col-lg-12">
                                                    <a class="popup-youtube"  href="https://www.youtube.com/watch?v=msYpUTpNxHY"><span class="icon ion-ios-play"></span>ME FAT - Official Trailer 2026</a>
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
        function toggleCaption() {
            const extra = document.getElementById('extra');
            const btn = document.getElementById('btn');
            if (extra.style.display === 'none') {
                extra.style.display = 'inline';
                btn.textContent = '';
            } else {
                extra.style.display = 'none';
                btn.textContent = '...';
            }
        }
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
