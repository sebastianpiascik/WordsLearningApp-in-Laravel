@extends('layouts.app')

@section('title', 'CRUD - Słówka')

@section('sidebar')
    @parent

    <h2 class="page__title"><strong>CRUD</strong> - Słówka</h2>
@endsection

@section('content')

    <div class="action action--create">
        <a href="{{ route('words.create') }}"><i class="fas fa-plus"></i> Dodaj nowe słówko</a>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


    <table class="table table-bordered">
        <tr>
            <th>Id</th>
            <th>Słówko</th>
            <th>Nazwa zestawu słówek</th>
            <th width="150px">Akcja</th>
        </tr>
        @foreach ($words as $word)
            <tr>
                <td>{{ $word->id }}</td>
                <td>{{ $word->word }}</td>
                <td>{{ $words_lists->find($word->words_list_id)->name }}</td>
                <td>
                    <form class="form--actions" action="{{ route('words.destroy',$word->id) }}" method="POST">
                        <a class="" href="{{ route('words.show',$word->id) }}"><i class="fas fa-eye"></i></a>
                        <a class="" href="{{ route('words.edit',$word->id) }}"><i class="fas fa-edit"></i></a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class=""><i class="far fa-trash-alt"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>




@endsection