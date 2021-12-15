@extends('layouts.main')
@section('content')
    <div class="section-bg mobile-bg" style="background-image:url('assets/images/drilon/banertest.png') "></div>
    <div class="alert alert payment-msg">
        @if(\Session::has('error'))
            <h1 class="" style="margin: 20px">{{ \Session::get('error') }}</h1>
            {{ \Session::forget('error') }}
        @endif
        @if(\Session::has('success'))
            <h1 class="" style="margin: 20px">{{ \Session::get('success') }}</h1>
            {{ \Session::forget('success') }}
        @endif

        @if(!empty($response['code']))
            <h1 class="" style="margin: 20px">
                {{$response['message']}}
            </h1>
        @endif

            <h2 style="color: #fff;text-align: center; text-transform: uppercase">Filmi do te shfaqet me date 25 Dhjetor  </h2>
            <h6>Do të mund ta shikoni pasi të jeni loguar me Emailin dhe Passwordin e vendosur nga ju,<br> gjithashtu do të merrni në email link-un e filmit. </h6>
    </div>
    </div>
@endsection

