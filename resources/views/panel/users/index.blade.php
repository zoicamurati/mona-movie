@extends('layouts.adminLayout')
@section('content')

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">Users</h4>
                            <p class="card-category">Lista e users</p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class=" text-primary">
                                    <th>
                                        Emri
                                    </th>
                                    <th>
                                        Email
                                    </th>
                                    <th>
                                        Emri ne Paypal
                                    </th>
                                    <th>
                                        Email ne Paypal
                                    </th>
                                    <th>
                                        Data
                                    </th>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td>
                                                {{$user->name}}
                                            </td>
                                            <td>
                                                {{$user->email}}
                                            </td>
                                            <td>
                                                {{$user->real_name}}
                                            </td>
                                            <td>
                                                {{$user->real_email}}
                                            </td>
                                            <td>
                                                {{ date('d-m-Y', strtotime($user->created_at))}}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
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

    </div>


@endsection
