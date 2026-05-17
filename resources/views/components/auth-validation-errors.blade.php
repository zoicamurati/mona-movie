@props(['errors'])

@if ($errors->any())
    <div {{ $attributes }}>
        <div class="font-medium text-red-600 text-center">
            {{ __('Whoops! Something went wrong.') }}
        </div>

        <ul class="mt-3 list-none text-sm text-red-600 text-center" style="list-style:none;padding:0;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
