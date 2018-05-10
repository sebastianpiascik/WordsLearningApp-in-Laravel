@extends('layouts.app')

@section('title', 'CRUD - Podkategorie')

@section('sidebar')
    @parent

    <h2 class="page__title"><strong>CRUD</strong> - Podkategorie</h2>
@endsection


@section('content')

    <div class="action action--create">
        <a href="{{ route('subcategories.create') }}"><i class="fas fa-plus"></i> Utwórz podkategorię</a>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


    <table class="table table-bordered">
        <tr>
            <th>Nr</th>
            <th>Nazwa podkategorii</th>
            <th>Nazwa kategorii</th>
            <th width="150px">Akcja</th>
        </tr>
        @php $i=1 @endphp
        @foreach ($subcategories as $subcategory)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $subcategory->name }}</td>
                <td>{{ $categories->find($subcategory->category_id)->name }}</td>
                <td>
                    <form class="form--actions" action="{{ route('subcategories.destroy',$subcategory->id) }}" method="POST">
                        <a class="" href="{{ route('subcategories.show',$subcategory->id) }}"><i class="fas fa-eye"></i></a>
                        <a class="" href="{{ route('subcategories.edit',$subcategory->id) }}"><i class="fas fa-edit"></i></a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class=""><i class="far fa-trash-alt"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>




@endsection