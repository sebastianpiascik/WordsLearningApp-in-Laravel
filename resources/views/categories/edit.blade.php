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


    <form action="{{ route('categories.update',$category->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">Nazwa kategorii</label>

            <div class="col-md-6">
                <input type="text" name="name" value="{{ $category->name }}">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-10 text-right">
                <button type="submit" class="button button--submit">Zatwierdź</button>
            </div>
        </div>


    </form>


@endsection