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


    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Słówko:</strong>
                {{ $word->word }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Zestaw:</strong>
                @foreach($words_lists as $wlist)
                    @if($wlist->id == $word->words_list_id)
                        {{ $wlist->name }}
                    @endif
                @endforeach
            </div>
        </div>



    </div>
@endsection