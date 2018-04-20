@extends('layouts.app')

@section('title', 'Nauka słówek')

@section('sidebar')
    @parent

    <h2 class="page__title"><strong>SYSTEM NAUKI SŁÓWEK</strong></h2>

@endsection

@section('content')

    <div class="action action--back action--main">
        <a href="{{ url('/learning_mode?words_list='.$words_list) }}"><i class="fas fa-angle-double-left"></i> Wybierz inny tryb nauki</a>
    </div>

    @if($learning_mode == 'nauka')
        <table class="table table-bordered">
            <tr>
                <th>Polski</th>
                <th>Angielski</th>
            </tr>
            @foreach($words as $w)
                @php
                    $word = explode(";",$w->word);
                @endphp
                <tr>
                    <td>{{ $word[0] }}</td>
                    <td>{{ $word[1] }}</td>
                </tr>
            @endforeach
        </table>
    @endif

    <div class="row mt-5">
        <div class="section section__learn col-sm-6 col-md-4">
            <a href="{{ url('/learn?words_list='.$words_list.'&learning_mode='.$learning_mode.'&mode=pl-en&algorithm=1') }}" class="section__inner section__learn__inner">
                <h5>Nauka słówek(1)<br/>polski -> angielski</h5>
            </a>
        </div>
        <div class="section section__learn col-sm-6 col-md-4">
            <a href="{{ url('/learn?words_list='.$words_list.'&learning_mode='.$learning_mode.'&mode=en-pl&algorithm=1') }}" class="section__inner section__learn__inner">
                <h5>Nauka słówek(1)<br/>angielski -> polski</h5>
            </a>
        </div>
        @if($learning_mode == 'nauka')
            <div class="section section__learn col-sm-6 col-md-4">
                <a href="{{ url('/learn?words_list='.$words_list.'&learning_mode='.$learning_mode.'&mode=pl-en&algorithm=2') }}" class="section__inner section__learn__inner">
                    <h5>Nauka słówek(2)<br/>polski -> angielski</h5>
                </a>
            </div>
            <div class="section section__learn col-sm-6 col-md-4">
                <a href="{{ url('/learn?words_list='.$words_list.'&learning_mode='.$learning_mode.'&mode=en-pl&algorithm=2') }}" class="section__inner section__learn__inner">
                    <h5>Nauka słówek(2)<br/>angielski -> polski</h5>
                </a>
            </div>
            <div class="section section__learn col-sm-6 col-md-4">
                <a href="{{ url('/learn?words_list='.$words_list.'&learning_mode='.$learning_mode.'&mode=pl-en&algorithm=3') }}" class="section__inner section__learn__inner">
                    <h5>Nauka słówek(3)<br/>polski -> angielski</h5>
                </a>
            </div>
            <div class="section section__learn col-sm-6 col-md-4">
                <a href="{{ url('/learn?words_list='.$words_list.'&learning_mode='.$learning_mode.'&mode=en-pl&algorithm=3') }}" class="section__inner section__learn__inner">
                    <h5>Nauka słówek(3)<br/>angielski -> polski</h5>
                </a>
            </div>
        @endif
    </div>

@endsection
