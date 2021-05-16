@extends('front.layout')

@section('main')
    <div class="row row-x-right s-styles">
	<div class="column large-6 tab-12" id="login-column" >
	</div>
        <div class="column large-6 tab-12">

            <!-- Session Status -->
            <x-auth.session-status :status="session('status')" />

            <!-- Validation Errors -->
            <x-auth.validation-errors :errors="$errors" />

            <h3 class="h-add-bottom">@lang('Login')</h3>
            <form class="h-add-bottom" method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <x-auth.input-email />

                <!-- Password -->
                <x-auth.input-password />

                <!-- Remember Me -->
                <label class="h-add-bottom">
                    <input
                        id="remember_me"
                        type="checkbox"
                        name="remember_me"
                        {{ old('remember_me') ? 'checked' : '' }}>
                    <span class="label-text" id="login-span">@lang('Remember me')</span>
                </label>

                <x-auth.submit title="Login" class="rounded-sm" />

                <label class="h-add-bottom">
                  <a href="{{ route('password.request') }}">
                      @lang('Forgot Your Password?')
                  </a>
                  <a href="{{ route('register') }}" id="login-a">
                      @lang('Not registered?')
                  </a>
                </label>

            </form>
        </div>
    </div>

@endsection
