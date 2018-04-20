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


    <form action="{{ route('words_lists.update',$words_list->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">Nazwa zestawu</label>

            <div class="col-md-6">
                <input type="text" name="name" value="{{ $words_list->name }}">
            </div>
        </div>
        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">Wybierz podkategorię</label>

            <div class="col-md-6">
                <select name="subcategory_id">
                    @if(Auth::user()->name == 'admin')
                        @foreach($subcategories as $scat)
                            @if($scat->id == $words_list->subcategory_id)
                                <option value="{{ $scat->id }}" selected>{{ $scat->name }}</option>
                            @else
                                <option value="{{ $scat->id }}">{{ $scat->name }}</option>
                            @endif
                        @endforeach
                    @else
                        @foreach($permissions as $scat)
                            @if($scat->id == $words_list->subcategory_id)
                                <option value="{{ $scat->id }}" selected>{{ $scat->name }}</option>
                            @else
                                <option value="{{ $scat->id }}">{{ $scat->name }}</option>
                            @endif
                        @endforeach
                    @endif
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">Typ zestawu</label>
            <div class="col-md-6">
                <select name="type">
                    @if(Auth::user()->name == 'admin')
                        @if($words_list->type == 'publiczny')
                            <option value="publiczny" selected>Publiczny</option>
                            <option value="prywatny">Prywatny</option>
                        @else
                            <option value="publiczny">Publiczny</option>
                            <option value="prywatny" selected>Prywatny</option>
                        @endif
                    @else
                        @if($permissions == null)
                            <option value="prywatny" selected>Prywatny</option>
                        @else
                            @if($words_list->type == 'publiczny')
                                <option value="publiczny" selected>Publiczny</option>
                                <option value="prywatny">Prywatny</option>
                            @else
                                <option value="publiczny">Publiczny</option>
                                <option value="prywatny" selected>Prywatny</option>
                            @endif
                        @endif
                    @endif
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