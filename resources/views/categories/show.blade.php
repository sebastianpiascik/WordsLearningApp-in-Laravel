@extends('layouts.app')

@section('title', 'CRUD - Kategorie')

@section('sidebar')
    @parent

    <h2 class="page__title"><strong>CRUD</strong> - Kategorie</h2>
@endsection

@section('content')

    <div class="action action--back">
        <a href="{{ route('categories.index') }}"><i class="fas fa-angle-double-left"></i> Cofnij</a>
    </div>


    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nazwa kategorii:</strong>
                {{ $category->name }}
            </div>
        </div>
    </div>
@endsection