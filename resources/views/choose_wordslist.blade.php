@extends('layouts.app')

@section('title', 'Wybierz zestaw')

@section('sidebar')
    @parent

    <h2 class="page__title"><strong>SYSTEM NAUKI SŁÓWEK</strong></h2>

@endsection

@section('content')

    <div class="action action--back action--main">
        <a href="{{ url('/subcategory?category='.$category) }}"><i class="fas fa-angle-double-left"></i> Wybierz inną podkategorię</a>
    </div>

    <div class="row">
        @foreach($words_lists as $wlist)
            @if($wlist->subcategory_id == 1)
                @if(Auth::check())
                    @if($wlist->user_id == Auth::user()->id)
                        <div class="section section__category col-md-12">
                            <a class="section__inner" href="{{ url('/learning_mode?words_list='.$wlist->id) }}">
                                <h5>{{ $wlist->name }}</h5>
                            </a>
                        </div>
                    @endif
                @endif
            @else
                <div class="section section__category col-md-12">
                    <a class="section__inner" href="{{ url('/learning_mode?words_list='.$wlist->id) }}">
                        <h5>{{ $wlist->name }}</h5>
                    </a>
                </div>
            @endif
        @endforeach
    </div>

@endsection
