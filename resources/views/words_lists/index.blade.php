@extends('layouts.app')

@section('title', 'CRUD - Zestawy słówek')

@section('sidebar')
    @parent

    <h2 class="page__title"><strong>CRUD</strong> - Zestawy słówek</h2>
@endsection


@section('content')

    <div class="action action--create">
        <a href="{{ route('words_lists.create') }}"><i class="fas fa-plus"></i> Utwórz zestaw słówek</a>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


    <table class="table table-bordered">
        <tr>
            <th>Nr</th>
            <th>Nazwa zestawu</th>
            <th>Nazwa podkategorii</th>
            <th>Autor</th>
            <th width="150px">Akcja</th>
        </tr>
        @php $i=1 @endphp
        @foreach ($words_lists as $words_list)
            @if($words_list->subcategory_id == 1)
                @if($words_list->user_id == Auth::user()->id)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $words_list->name }}</td>
                        <td>{{ $subcategories->find($words_list->subcategory_id)->name }}</td>
                        @if($words_list->user_id != null)
                            <td>{{ $users->find($words_list->user_id)->name }}</td>
                        @else
                            <td>-</td>
                        @endif
                        <td>
                            <form class="form--actions" action="{{ route('words_lists.destroy',$words_list->id) }}"
                                  method="POST">
                                <a class="" href="{{ route('words_lists.show',$words_list->id) }}"><i
                                            class="fas fa-eye"></i></a>
                                <a class="" href="{{ route('words_lists.edit',$words_list->id) }}"><i
                                            class="fas fa-edit"></i></a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class=""><i class="far fa-trash-alt"></i></button>
                            </form>
                        </td>
                    </tr>
                @endif
            @else
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $words_list->name }}</td>
                    <td>{{ $subcategories->find($words_list->subcategory_id)->name }}</td>
                    @if($words_list->user_id != null)
                        <td>{{ $users->find($words_list->user_id)->name }}</td>
                    @else
                        <td>-</td>
                    @endif
                    <td>
                        <form class="form--actions" action="{{ route('words_lists.destroy',$words_list->id) }}"
                              method="POST">
                            <a class="" href="{{ route('words_lists.show',$words_list->id) }}"><i
                                        class="fas fa-eye"></i></a>
                            <a class="" href="{{ route('words_lists.edit',$words_list->id) }}"><i
                                        class="fas fa-edit"></i></a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class=""><i class="far fa-trash-alt"></i></button>
                        </form>
                    </td>
                </tr>
            @endif
        @endforeach
    </table>




@endsection