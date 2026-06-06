@extends('layouts.main')
@section('content')
    <div class="container">
        <div style="width:100%;margin-top:150px">
            <div><h5>Nëpermjet pranimit të kushteve dhe termave të pronës intelektuale ju dakortësoheni se për secilën
                    nga pikat e mëposhtme do të aplikohen sanksionet e ligjeve ne fuqi: </h5>
                <ul>
                    <li><h6>Shpërndarja e cdo sekuence ose e filmit të plotë pa autorizim nga pronari legjitim</h6></li>
                    <li><h6>Thyerja e sistemeve të sigurisë me qëllim për të shkarkuar filmin në mënyrë te
                            jashtëligjshme</h6></li>
                    <li><h6>Rregjistrimi i filmit gjatë transmetimit me "Screen-Recording Software" ose me pajisje video
                            rregjistruese kamera, smartphone etj...</h6></li>
                    <li><h6>Cdo akt i cili bie ne kundërshtim me termat dhe kushtet e pronës intelektuale ( shpërndarja
                            e cdo sekuence ose e filmit të plotë,shkarkimi i tij etj..) do të jetë përgjegjësi e
                            cila bie mbi zotëruesin e kësaj llogarie </h6></li>
                </ul>

                <h5>Emri dhe Mbiemri i zotëruesit të llogarisë do të shfaqen mbi film gjatë gjithë transmetimit të tij
                    me qëllim për të identifikuar shkelësin në mënyrë të drejtpërdrejtë. </h5>


            </div>

            @php
                $invoice = Auth::user()->invoices()->where('status', 1)->latest()->first();
                $expiresAt = $invoice ? $invoice->created_at->addDays(3)->format('d/m/Y H:i') : null;
            @endphp
            @if($expiresAt)
                <div style="background:#fff3cd;border:1px solid #ffc107;border-radius:6px;padding:12px 16px;margin:20px 0;color:#856404;">
                    <strong>⚠ Kujdes:</strong> Filmin mund ta shikoni vetëm 3 ditë nga momenti i pagimit.
                    Aksesi juaj skadon më: <strong>{{ $expiresAt }}</strong>.
                </div>
            @endif

            <input required type="checkbox" id="checkbox">
            <label>Pranoj kushtet e perdorimit</label>

        </div>
    </div>
<script>
        document.getElementById("checkbox").addEventListener("click", function () {
            window.location.href = '/shiko-filmin';
        });
    </script>
@endsection
