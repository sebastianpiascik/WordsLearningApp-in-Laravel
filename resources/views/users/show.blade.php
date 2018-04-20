@extends('layouts.app')

@section('title', 'Profil użytkownika')

@section('sidebar')
    @parent

    <h2 class="page__title"><strong>Profil Użytkownika</strong></h2>
@endsection


@section('content')

    <div class="action action--back">
        <a href="{{ route('users.index') }}"><i class="fas fa-angle-double-left"></i> Cofnij</a>
    </div>

    <div class="row align-items-center">
        <p class="col-md-6 text-md-right"><strong>Nazwa uzytkownika: </strong></p>
        <div class="col-md-6">
            <p class="text-md-left">{{ $user->name }}</p>
        </div>
    </div>
    <div class="row align-items-center mt-3">
        <p class="col-md-6 text-md-right"><strong>E-mail uzytkownika: </strong></p>
        <div class="col-md-6">
            <p class="text-md-left">{{ $user->email }}</p>
        </div>
    </div>
    <div class="row align-items-center mt-3">
        <p class="col-md-6 text-md-right"><strong>Rola uzytkownika: </strong></p>
        <div class="col-md-6">
            <p class="text-md-left">{{ $user->roles()->first()->name }}</p>
        </div>
    </div>
    <div class="row align-items-center mt-3">
        <p class="col-md-6 text-md-right"><strong>Wyniki uzytkownika: </strong></p>
        <div class="col-md-6">
            @foreach($results as $result)
            <p class="text-md-left">{{ $result->result }} => Zestaw: {{ $words_lists->find($result->words_list_id)->name }}</p>
            @endforeach
        </div>
    </div>




@endsection