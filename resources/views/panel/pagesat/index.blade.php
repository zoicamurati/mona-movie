@extends('layouts.adminLayout')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-danger card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">person</i>
                            </div>
                            <p class="card-category">Users</p>
                            <h3 class="card-title">{{$users}}
                                {{-- <small>GB</small>--}}
                            </h3>
                        </div>
                          <div class="card-footer">
                              <div class="stats">
                                  <i class="material-icons text-danger">person</i>Total users
                              </div>
                          </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-success card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">euro</i>
                            </div>
                            <p class="card-category">Total</p>
                            <h3 class="card-title">€ {{$total}}</h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="material-icons">euro</i> Total incomes
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer">
        <div class="container-fluid">
            <div class="copyright float-right" id="date">
                <p>©{{ now()->year }} <a href="https://digitalmoon.al/"> Digital Moon Agency </a> All Rights Reserved. </p>
            </div>
        </div>
    </footer>
@endsection