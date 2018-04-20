@extends('layouts.app')

@section('title', 'CRUD - Kategorie')

@section('sidebar')
    @parent

    <h2 class="page__title"><strong>CRUD</strong> - Kategorie</h2>
@endsection


@section('content')

    <div class="action action--create">
        <a href="{{ route('categories.create') }}"><i class="fas fa-plus"></i> Utwórz kategorię</a>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


    <table class="table table-bordered">
        <tr>
            <th>Id</th>
            <th>Nazwa kategorii</th>
            <th width="150px">Akcja</th>
        </tr>
        @foreach ($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->name }}</td>
                <td>
                    <form class="form--actions" action="{{ route('categories.destroy',$category->id) }}" method="POST">
                        <a class="" href="{{ route('categories.show',$category->id) }}"><i class="fas fa-eye"></i></a>
                        <a class="" href="{{ route('categories.edit',$category->id) }}"><i class="fas fa-edit"></i></a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class=""><i class="far fa-trash-alt"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>




@endsection