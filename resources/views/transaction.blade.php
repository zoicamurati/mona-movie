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
        {{-- <div class="alert alert-danger" style="margin: 20px">{{ "pse" }}</div>
         <div class="alert alert-success" style="margin: 20px">{{"po "}}</div>

            <h1>hahahhaha hahahhaha
                hahahhaha</h1>--}}
        <p>hahhahah</p>
    </div>
@endsection

