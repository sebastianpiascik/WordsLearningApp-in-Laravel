@extends('layouts.app')

@section('title', 'Wybierz tryb nauki')

@section('sidebar')
    @parent

    <h2 class="page__title"><strong>SYSTEM NAUKI SŁÓWEK</strong></h2>

@endsection

@section('content')

    <div class="action action--back action--main">
        <a href="{{ url('/words_list?subcategory='.$subcategory) }}"><i class="fas fa-angle-double-left"></i> Wybierz inny zestaw</a>
    </div>

    <div class="row">
            <div class="section section__category col-md-12">
                <a class="section__inner" href="{{ url('/mode?words_list='.$words_list.'&learning_mode=nauka') }}">
                    <h5>Tryb nauki</h5>
                </a>
            </div>
        <div class="section section__category col-md-12">
            <a class="section__inner" href="{{ url('/mode?words_list='.$words_list.'&learning_mode=sprawdzanie_wiedzy') }}">
                <h5>Tryb sprawdzania wiedzy</h5>
            </a>
        </div>
    </div>

@endsection
