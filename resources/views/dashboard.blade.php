<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if(\Session::has('error'))
                        <div class="alert alert-danger" style="margin: 20px">{{ \Session::get('error') }}</div>
                        {{ \Session::forget('error') }}
                    @endif
                    @if(\Session::has('success'))
                        <div class="alert alert-success" style="margin: 20px">{{ \Session::get('success') }}</div>
                        {{ \Session::forget('success') }}
                    @endif

                    @if(!empty($response['code']))
                        <div class="alert alert-{{$response['code']}}" style="margin: 20px">
                            {{$response['message']}}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
