@extends('layouts.adminLayout')
@section('content')

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2> Welcome {{Auth::user()->name}}</h2>
                </div>

            </div>
        </div>
    </div>
    <footer class="footer">
        <div class="container-fluid">
            <div class="copyright float-right" id="date">
                <p>©{{ now()->year }}<a href="https://digitalmoon.al/"> Digital Moon Agency </a> All Rights Reserved. </p>
            </div>
        </div>
    </footer>

    </div>


@endsection
