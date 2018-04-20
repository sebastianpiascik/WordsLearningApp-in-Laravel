@extends('layouts.app')

@section('title', 'Wybierz podkategorię')

@section('sidebar')
    @parent

    <h2 class="page__title"><strong>SYSTEM NAUKI SŁÓWEK</strong></h2>

@endsection

@section('content')

    <div class="action action--back action--main">
        <a href="{{ url('/') }}"><i class="fas fa-angle-double-left"></i> Wybierz inną kategorię</a>
    </div>

    <div class="row">
        @foreach($subcategories as $scat)
            <div class="section section__category col-md-12">
                <a class="section__inner" href="{{ url('/words_list?subcategory='.$scat->id) }}">
                    <h5>{{ $scat->name }}</h5>
                </a>
            </div>
        @endforeach
    </div>

@endsection
