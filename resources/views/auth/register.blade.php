@extends('layouts.app')

@section('title', 'REJESTRACJA')

@section('sidebar')
    @parent

    <h2 class="page__title"><strong>REJESTRACJA</strong></h2>
@endsection

@section('content')
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nazwa') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

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
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Hasło') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Potwierdź Hasło') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-10 text-right p-0 mt-3">
                            <button type="submit" class="button button--submit">{{ __('Rejestracja') }}</button>
                        </div>
                    </form>
@endsection
