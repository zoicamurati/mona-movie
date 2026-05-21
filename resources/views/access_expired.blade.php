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

            <form method="POST" action="{{ route('rebuyProcess') }}" style="display:flex;flex-direction:column;align-items:center;">
                @csrf

                <div style="display:flex;align-items:flex-start;gap:10px;margin-bottom:12px;text-align:left;">
                    <input id="terms" type="checkbox" name="terms" required style="margin-top:3px;cursor:pointer;">
                    <label for="terms" style="font-size:14px;cursor:pointer;color:#fff;">
                        Unë pranoj <a href="{{ route('terms') }}" target="_blank" style="color:#fff;text-decoration:underline;">Kushtet dhe Termat e Shërbimit</a>
                    </label>
                </div>
                <div class="book-btn contact-item" style="width:200px;margin-top:8px;">
                    <button type="submit" style="background:none;border:none;outline:none;cursor:pointer;width:100%;color:#fff;">
                        BLI PERSERI
                    </button>
                </div>
            </form>

        </div>
    </div>
@endsection
