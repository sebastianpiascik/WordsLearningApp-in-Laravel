@extends('layouts.app')

@section('title', 'System nauki słówek')

@section('sidebar')
    @parent

    <h2 class="page__title"><strong>SYSTEM NAUKI SŁÓWEK</strong></h2>

@endsection

@section('content')

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="row">

        @if(Auth::check())
            @foreach($categories as $cat)
                <div class="section section__category col-md-12">
                    <a class="section__inner" href="{{ url('/subcategory?category='.$cat->id) }}">
                        <h5>{{ $cat->name }}</h5>
                    </a>
                </div>
            @endforeach
        @else
            @foreach($categories as $cat)
                @if($cat->name != 'Własne zestawy')
                    <div class="section section__category col-md-12">
                        <a class="section__inner" href="{{ url('/subcategory?category='.$cat->id) }}">
                            <h5>{{ $cat->name }}</h5>
                        </a>
                    </div>
                @endif
            @endforeach

        @endif
    </div>

@endsection
