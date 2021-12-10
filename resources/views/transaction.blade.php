@extends('layouts.main')
@section('content')
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
            <h6 style="color: #fff;text-align: center">Faqja e vetme zyrtare ku filmi do te shfaqet online VETEM PER 24 ORE NE 25 DHJETOR nxitoni te rezervoni dhe perfitoni nga cmimi ne oferte NGA 15€ VETEM 5€</h6>
    </div>
@endsection

