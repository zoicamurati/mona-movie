@extends('layouts.main')
@section('content')
    <div class="container">
        <div style="width:100%;max-width:600px;margin:150px auto;text-align:center;">

            <h2 style="margin-bottom:16px;">Aksesi juaj ka skaduar</h2>

            <p style="font-size:17px;margin-bottom:8px;">
                Periudha 3-ditore e shikimit të filmit ka mbaruar.
            </p>
            <p style="color:#888;font-size:15px;margin-bottom:32px;">
                Mund ta blini përsëri aksesin për të shikuar filmin edhe 3 ditë të tjera.
            </p>

            <form method="POST" action="{{ route('rebuyProcess') }}" style="display:flex;justify-content:center;">
                @csrf
                <div class="book-btn contact-item" style="width:200px;margin-top:20px;">
                    <button type="submit" style="background:none;border:none;outline:none;cursor:pointer;width:100%;color:#fff;">
                        BLI PERSERI
                    </button>
                </div>
            </form>

        </div>
    </div>
@endsection
