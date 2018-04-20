@extends('layouts.app')

@section('title', 'CRUD - Zestawy słówek')

@section('sidebar')
    @parent

    <h2 class="page__title"><strong>CRUD</strong> - Zestawy słówek</h2>
@endsection

@section('content')

    <div class="action action--back">
        <a href="{{ route('words_lists.index') }}"><i class="fas fa-angle-double-left"></i> Cofnij</a>
    </div>


    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nazwa zestawu:</strong>
                {{ $words_list->name }}
            </div>
        </div>
    </div>
@endsection