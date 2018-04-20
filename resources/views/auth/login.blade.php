@extends('layouts.app')

@section('title', 'Logowanie')

@section('sidebar')
    @parent

    <h2 class="page__title"><strong>LOGOWANIE</strong></h2>
@endsection

@section('content')
    <form method="POST" action="{{ route('login') }}">
        @csrf



        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Adres E-mail') }}</label>

            <div class="col-md-6">
                <input id="email" type="email" class="{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                @if ($errors->has('email'))
                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">

            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Hasło') }}</label>
            <div class="col-md-6">
                <input id="password" type="password"
                       class="{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                @if ($errors->has('password'))
                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-12 offset-md-4">
                <div class="checkbox">
                    <label>
                        <input type="checkbox"
                               name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Zapamiętaj mnie') }}
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group row mb-0 mt-3">
            <div class="col-md-10 text-right">
                <button type="submit" class="button button--submit">Zaloguj</button>

                <a class="form__info" href="{{ route('password.request') }}">
                    {{ __('Zapomniałeś hasła?') }}
                </a>
            </div>
        </div>
    </form>
@endsection
