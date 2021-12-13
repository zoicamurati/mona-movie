@component('mail::message')
# Introduction shkruaj dicka

Pershendetje me posht keni linkun e filmit

@component('mail::button', ['url' => config('app.url').'/shiko-filmin'])
Shiko Filmin
@endcomponent

Kalofshi mire,<br>
Drilon Hoxha
@endcomponent
