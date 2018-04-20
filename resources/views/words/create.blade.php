@extends('layouts.app')

@section('title', 'CRUD - Słówka')

@section('sidebar')
    @parent

    <h2 class="page__title"><strong>CRUD</strong> - Słówka</h2>
@endsection

@section('content')

    <div class="action action--back">
        <a href="{{ route('words.index') }}"><i class="fas fa-angle-double-left"></i> Cofnij</a>
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


    <form action="{{ route('words.store') }}" method="POST">
        @csrf


        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">Podaj słówko</label>

            <div class="col-md-6">
                <input type="text" name="word">
            </div>
        </div>
        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">Wybierz zestaw</label>

            <div class="col-md-6">
                <select name="words_list_id">
                    @foreach($words_lists as $wlist)
                        <option value="{{ $wlist->id }}">{{ $wlist->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-10 text-right">
                <button type="submit" class="button button--submit">Zatwierdź</button>
            </div>
        </div>


    </form>


@endsection