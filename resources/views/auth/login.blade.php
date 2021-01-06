@extends('layouts.app')

@section('content')
<div class="login">

    <div class="content container">
        <div>
            <h2>Prihlásiť sa</h2>
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group row">

                        <input id="email" type="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>

                <div class="form-group row">
                    <label for="password">{{ __('Password') }}</label>

                        <input id="password" type="password" placeholder="Heslo" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>

                {{-- <div class="form-group row">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                </div> --}}

                <div class="form-group row mb-0">
                        <button type="submit" class="btn btn-block btn-full">
                            {{ __('Login') }}
                        </button>

                        {{-- @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif --}}
                </div>
            </form>
        </div>
        <div class="register-link">
            <a href="{{ @route( 'register' ) }}">Ešte nemáte účet? Registrujte sa</a>
        </div>

        {{-- <div class="row justify-content-center">
            <div class="col-md-6">
                    <h2 class="text-center">{{ __('Login') }}</h2>
    
                    <div>
                        <div class="text-center">
    
                            <img src="{{ URL('images/logo.png') }}" alt="">
                        </div>
    
    
    
                        
    
    
                        <div class="text-center">
    
                            <p>Don't have an account yet? <a href="/register">Register</a> </p>
                        </div>
                    </div> <!--  -->
            </div>
        </div> --}}
    </div>
</div>
@endsection
