@component('mail::message')

<h5>Faleminderit për blerjen!</h5>

<p>Mund ta shikoni filmin <strong>ME FAT</strong> për <strong>3 ditë</strong>, deri më: <strong>{{ $expiresAt }}</strong>.</p>

<h5>Nëpërmjet pranimit të kushteve dhe termave të pronës intelektuale ju dakordësoheni se për secilën nga pikat e mëposhtme do të aplikohen sanksionet e ligjeve në fuqi:</h5>

<ul>
    <li>Shpërndarja e çdo sekuence ose e filmit të plotë pa autorizim nga pronari legjitim</li>
    <li>Thyerja e sistemeve të sigurisë me qëllim për të shkarkuar filmin në mënyrë të jashtëligjshme</li>
    <li>Regjistrimi i filmit gjatë transmetimit me "Screen-Recording Software" ose me pajisje video regjistrese (kamera, smartphone etj...)</li>
    <li>Çdo akt i cili bie në kundërshtim me termat dhe kushtet e pronës intelektuale do të jetë përgjegjësi e cila bie mbi zotëruesin e kësaj llogarie</li>
</ul>

<p>Emri dhe Mbiemri i zotëruesit të llogarisë do të shfaqen mbi film gjatë gjithë transmetimit me qëllim identifikimi.</p>

@component('mail::button', ['url' => $actionUrl])
{{ $actionText }}
@endcomponent

{{ $salutation }}

@endcomponent
