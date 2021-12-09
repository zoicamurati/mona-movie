@extends('layouts.adminLayout')
@section('content')

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1 style="text-align: center; color: #7e0809; text-transform: uppercase"> Welcome {{Auth::user()->name}}</h1>
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
