@component('mail::message')
# Introduction shkruaj dicka

Pershendetje me posht keni linkun e filmit<br>
Nëpermjet pranimit të kushteve dhe termave të pronës intelektuale ju dakortësoheni se për secilën
nga pikat e mëposhtme do të aplikohen sanksionet e ligjeve ne fuqi:<br>
Shpërndarja e cdo sekuence ose e filmit të plotë pa autorizim nga pronari legjitim<br>
@component('mail::button', ['url' => config('app.url').'/shiko-filmin'])
Shiko Filmin
@endcomponent

Kalofshi mire,<br>
Drilon Hoxha
@endcomponent
