@extends('layouts.app')

@section('title', 'Profil użytkownika')

@section('sidebar')
    @parent

    <h2 class="page__title"><strong>Profil Użytkownika</strong></h2>
@endsection


@section('content')

    <div class="action action--back">
        <a href="{{ route('users.index') }}"><i class="fas fa-angle-double-left"></i> Cofnij</a>
    </div>

    <div class="row align-items-center">
        <p class="col-md-6 text-md-right"><strong>Nazwa uzytkownika: </strong></p>
        <div class="col-md-6">
            <p class="text-md-left">{{ $user->name }}</p>
        </div>
    </div>
    <div class="row align-items-center mt-3">
        <p class="col-md-6 text-md-right"><strong>E-mail uzytkownika: </strong></p>
        <div class="col-md-6">
            <p class="text-md-left">{{ $user->email }}</p>
        </div>
    </div>
    <div class="row align-items-center mt-3">
        <p class="col-md-6 text-md-right"><strong>Rola uzytkownika: </strong></p>
        <div class="col-md-6">
            <p class="text-md-left">{{ $user->roles()->first()->name }}</p>
        </div>
    </div>
    <div class="row align-items-center mt-3">
        <p class="col-md-6 text-md-right"><strong>Wyniki uzytkownika: </strong></p>
        <div class="col-md-6">
            @foreach($results as $result)
            <p class="text-md-left">{{ $result->result }} => Zestaw: {{ $words_lists->find($result->words_list_id)->name }}</p>
            @endforeach
        </div>
    </div>
    <div class="row">
        <canvas id="canvas" width="400" height="300"></canvas>
    </div>




@endsection

@section('scripts')
    <script>
        var color = Chart.helpers.color;

            var ctx = document.getElementById('canvas').getContext('2d');
            window.myHorizontalBar = new Chart(ctx, {
                type: 'horizontalBar',
                data: {
                    labels: [
                    ],
                    datasets: [

                            @foreach($results as $result)

                            @php
                                $c1 = rand(1,255);
                                $c2 = rand(1,255);
                                $c3 = rand(1,255);
                            @endphp

                        {
                            label: '{{ $words_lists->find($result->words_list_id)->name }}',
                            backgroundColor: color('rgb({{$c1}},{{$c2}},{{$c3}})').alpha(0.5).rgbString(),
                            borderColor: 'rgb({{$c1}},{{$c2}},{{$c3}})',
                            borderWidth: 1,
                            data: [
                                {{ $result->result }},
                            ]
                        },
                        @endforeach
                    ]

                },
                options: {
                    elements: {
                        rectangle: {
                            borderWidth: 2,
                        }
                    },
                    responsive: true,
                    title: {
                        display: true,
                        text: 'Wyniki'
                    },
                    scales: {
                        xAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }
            });
    </script>
@endsection