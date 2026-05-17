@extends('layouts.main')
@section('content')
    <div class="login-bg">
        <x-auth-card>
            <x-slot name="logo">
                <div class="logo-login">
{{--                    <a  href="/">--}}
{{--                        <img alt="" src="/assets/images/project/logo.png" class="img-fluid">--}}
{{--                    </a>--}}
                </div>
        </x-slot>

        <div class="mb-4 text-center text-gray-600">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
            <div class="form">
        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="flex items-center book-btn justify-end mt-4">
                <x-button class="book-btn ">
                    {{ __('Email Password Reset Link') }}
                </x-button>
            </div>
        </form>
            </div>
    </x-auth-card>
    </div>
@endsection
