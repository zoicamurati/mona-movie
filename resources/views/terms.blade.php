@extends('layouts.main')
@section('content')
    <div class="container">
        <div style="width:100%;margin-top:150px;padding-bottom:80px;">

            <h2 style="margin-bottom:16px;">Kushtet dhe Termat e Shërbimit</h2>

            <h5 style="margin-bottom:4px;">1. Pranimi i Kushteve</h5>
            <p style="color:#ccc;margin-top:0;text-align:justify;">Duke blerë aksesin, ju konfirmoni që i keni lexuar dhe pranuar këto kushte. Nëse nuk jeni dakord, mos vazhdoni me blerjen.</p>

            <h5 style="margin-top:20px;margin-bottom:4px;">2. Aksesi në Film</h5>
            <p style="color:#ccc;margin-top:0;text-align:justify;">Pas pagesës do të keni akses për të parë filmin për <strong>3 ditë</strong> nga momenti i blerjes. Pas kësaj periudhe aksesi çaktivizohet automatikisht, por mund ta ripërtërini.</p>

            <h5 style="margin-top:20px;margin-bottom:4px;">3. Çmimi dhe Pagesa</h5>
            <p style="color:#ccc;margin-top:0;text-align:justify;">Çmimi është <strong>{{ config('app.price') }}€</strong> dhe processohet nëpërmjet PayPal. Pagesa është e menjëhershme dhe <strong>nuk rimbursohet</strong> pasi aksesi të jetë aktivizuar.</p>

            <h5 style="margin-top:20px;margin-bottom:4px;">4. Kufizime të Përdorimit</h5>
            <p style="color:#ccc;margin-top:0;text-align:justify;">Ndalohet rreptësisht regjistrimi, kopjimi, shpërndarja ose transmetimi i filmit në çfarëdo forme. Aksesi është personal dhe nuk mund të transferohet tek persona të tjerë.</p>

            <h5 style="margin-top:20px;margin-bottom:4px;">5. Të Dhënat Personale</h5>
            <p style="color:#ccc;margin-top:0;text-align:justify;">Emri dhe emaili juaj ruhen vetëm për administrimin e llogarisë dhe dërgimin e emailit konfirmues. Nuk i ndajmë të dhënat tuaja me palë të treta.</p>

            <p style="margin-top:36px;color:#888;font-size:13px;">Për çdo pyetje ose problem teknik, na kontaktoni përmes formës së kontaktit.</p>

        </div>
    </div>
@endsection
