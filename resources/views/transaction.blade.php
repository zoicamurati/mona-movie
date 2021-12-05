
    @if(\Session::has('error'))
        <div class="alert alert-danger" style="margin: 20px">{{ \Session::get('error') }}</div>
        {{ \Session::forget('error') }}
    @endif
    @if(\Session::has('success'))
        <div class="alert alert-success" style="margin: 20px">{{ \Session::get('success') }}</div>
        {{ \Session::forget('success') }}
    @endif

    @if(!empty($response['code']))
        <div class="alert alert-{{$response['code']}}" style="margin: 20px">
            {{$response['message']}}
        </div>
    @endif

