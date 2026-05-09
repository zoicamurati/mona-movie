@component('mail::message')
    <h5>Nëpermjet pranimit të kushteve dhe termave të pronës intelektuale ju dakortësoheni se për secilën
        nga pikat e mëposhtme do të aplikohen sanksionet e ligjeve ne fuqi: </h5>
    <ul>
        <li><h6>Shpërndarja e cdo sekuence ose e filmit të plotë pa autorizim nga pronari legjitim</h6></li>
        <li><h6>Thyerja e sistemeve të sigurisë me qëllim për të shkarkuar filmin në mënyrë te
                jashtëligjshme</h6></li>
        <li><h6>Rregjistrimi i filmit gjatë transmetimit me "Screen-Recording Software" ose me pajisje video
                rregjistruese kamera, smartphone etj...</h6></li>
        <li><h6>Cdo akt i cili bie ne kundërshtim me termat dhe kushtet e pronës intelektuale ( shpërndarja
                e cdo sekuence ose e filmit të plotë,shkarkimi i tij etj..) do të jetë përgjegjësi e
                cila bie mbi zotëruesin e kësaj llogarie </h6></li></ul>
    <h5>Emri dhe Mbiemri i zotëruesit të llogarisë do të shfaqen mbi film gjatë gjithë transmetimit të tij
        me qëllim për të identifikuar shkelësin në mënyrë të drejtpërdrejtë. </h5>
    <h5>Me poshtë keni linkun e filmit</h5>
@component('mail::button', ['url' => config('app.url').'/shiko-filmin'])
Shiko Filmin
@endcomponent

Kalofshi mire,<br>

@endcomponent
