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
            <label for="email" class="col-md-4 col-form-label text-md-right">Słówka</label>

            <div class="col-md-6">
                <div class="words__container">
                    @foreach($words as $word)
                        <div class="row">
                            <input type="text" name="word_name[]" placeholder="słowo;word" value="{{ $word->word }}">
                            <div class="words__delete">
                                <span class="bar bar-1"></span>
                                <span class="bar bar-2"></span>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="row">
                    <p class="words__add">+ Dodaj nowe słówko</p>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-10 text-right">
                <button type="submit" class="button button--submit">Zatwierdź</button>
            </div>
        </div>


    </form>


@endsection


@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            var wordsContainer = $('.words__container');
            var wordInput = $('.words__container .row').first().html().toString();
            var wordInputContainer = '<div class="row">'+wordInput+'</div>';
            console.log(wordInputContainer);

            $(document).on( "click", '.words__add', function() {
                console.log('tak');
                wordsContainer.append(wordInputContainer);
                $('.words__container .row').last().find('input').val('');
            });

            $(document).on( "click", '.words__delete', function() {
                console.log('delete');
                $(this).parent().remove();
            });
        });
    </script>
@endsection