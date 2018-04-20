@extends('layouts.app')

@section('title', 'CRUD - Uzytkownicy')

@section('sidebar')
    @parent

    <h2 class="page__title"><strong>CRUD</strong> - Uzytkownicy</h2>
@endsection

@section('content')

    <div class="action action--back">
        <a href="{{ route('users.index') }}"><i class="fas fa-angle-double-left"></i> Cofnij</a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Pojawiły się niespodziewane problemy.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form action="{{ route('users.update',$user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nazwa') }}</label>

            <div class="col-md-6">
                <input id="name" type="text" class="{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name"
                       value="{{ $user->name }}" required autofocus>

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
                <input id="email" type="email" class="{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                       value="{{ $user->email }}" required>

                @if ($errors->has('email'))
                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="role_id" class="col-md-4 col-form-label text-md-right">{{ __('Rola') }}</label>

            <div class="col-md-6">
                <select name="role_id">
                    @foreach($roles as $role)
                        @if( $role->name == $user->roles()->first()->name)
                            <option value="{{ $role->id }}" selected>{{ $role->name }}</option>
                        @else
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="subcategory_id"
                   class="col-md-4 col-form-label text-md-right">{{ __('Daj pozwolenie') }}</label>

            <div class="col-md-6">
                @php
                    $permissionsArray = [];
                @endphp
                @foreach($permissions as $per)
                    @php
                        array_push($permissionsArray, $per->name);
                    @endphp
                @endforeach
                <select name="subcategory_id">
                    <option value="0" selected hidden>Wybierz podkategorię</option>
                    @foreach($subcategories as $subcat)
                        @if(in_array($subcat->name, $permissionsArray))

                        @else
                            <option value="{{ $subcat->id }}">{{ $subcat->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="remove_subcategory_id"
                   class="col-md-4 col-form-label text-md-right">{{ __('Odbierz pozwolenie') }}</label>

            <div class="col-md-6">
                <select name="remove_subcategory_id">
                    <option value="0" selected hidden disabled>Wybierz podkategorię</option>
                    @foreach($subcategories as $subcat)
                        @if(in_array($subcat->name, $permissionsArray))
                            <option value="{{ $subcat->id }}">{{ $subcat->name }}</option>
                        @else

                        @endif
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row mt-2">
            <p class="col-md-4 text-md-right">Dozwolone podkategorie</p>

            <div class="col-md-6 text-md-left">
                <p>
                    @foreach($permissions as $per)
                        @if($loop->index == 0)
                            {{ $per->name }}
                        @else
                            , {{ $per->name }}
                        @endif
                    @endforeach
                </p>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-10 text-right">
                <button type="submit" class="button button--submit">Zatwierdź</button>
            </div>
        </div>


    </form>


@endsection