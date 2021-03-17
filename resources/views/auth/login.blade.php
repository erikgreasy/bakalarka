@extends('layouts.app')

@section('content')
<div class="login login-register">

    <div class="content container">
        <div class="content-wrapper">
            <h2>Prihlásiť sa</h2>
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <input id="email" type="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <input id="password" type="password" placeholder="Heslo" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group mb-0">
                    <button type="submit" class="btn btn-block btn-full">
                        {{ __('Login') }}
                    </button>
                </div>
            </form>
        </div>

        <div class="other-link">
            <a href="{{ @route( 'register' ) }}">Ešte nemáte účet? Registrujte sa</a>
        </div>

    </div>
</div> <!-- END LOGIN -->
@endsection
