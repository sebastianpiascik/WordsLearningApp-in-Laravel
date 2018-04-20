@extends('layouts.app')

@section('title', 'Nauka słówek')

@section('sidebar')
    @parent

    <h2 class="page__title"><strong>SYSTEM NAUKI SŁÓWEK</strong></h2>

@endsection

@section('content')

    {{--<div class="action action--back">--}}
    {{--<a href="{{ url('/mode?words_list='. $words_list .'&learning_mode='. $learning_mode) }}"><i class="fas fa-angle-double-left"></i> Cofnij</a>--}}
    {{--</div>--}}

    <div class="app__learn__words">
        <div class="row align-items-center">
            <p class="col-md-4 text-md-right">Polski => </p>
            <div class="col-md-6">
                <p class="app__word text-md-left">Poniedziałek</p>
            </div>
        </div>

        <div class="row align-items-center mt-3">
            <p class="col-md-4 text-md-right">Angielski => </p>

            <div class="col-md-6">
                <input type="text" name="word" class="app__word__insert">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-10 text-right">
                <button class="button button--submit">Następne</button>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // Vars

            var index = 0;
            var learningMode = '@php echo $learning_mode  @endphp'
            var language = '@php echo $mode  @endphp';
            language = language.substring(0, 2);
            var algorithm = @php echo $algorithm  @endphp;
            var startTime = new Date().getTime();

            // Arrays
            var wordsLang1 = [];
            var wordsLang2 = [];
            var results = [];

            // Objects

            var wordParagraph = document.querySelector('.app__word');
            var wordInput = document.querySelector('.app__word__insert');
            var wordButton = document.querySelector('.button');

            var appContainer = $('.app__learn__words');
            var buttonReturn = "<a class='app__button__return' href='{{ url('/mode?words_list='. $words_list .'&learning_mode='. $learning_mode) }}'><i class=\"fas fa-angle-double-left\"></i>Wróc do wyboru metody nauczania</a>"


            // Functions

            function sendData() {
                var url = "{{ url('/store_results') }}";
                window.location = url;
            }

            function sendDataAjax(resultPercent) {
                var tokenContent = "{{csrf_token()}}";
                $.ajax({
                    method: 'POST',
                    url: '{{ url('/store_results') }}',
                    data: {
                        'words_list_id': @php echo $words_list @endphp,
                        'result':resultPercent
                    },
                    success: function (response) { // What to do if we succeed
                        console.log(response);
                    },
                    error: function (jqXHR, textStatus, errorThrown) { // What to do if we fail
                        console.log(JSON.stringify(jqXHR));
                        console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                    }
                });
            }

            function checkResults() {
                for (var i = 0; i < results.length; i++) {
                    if (results[i] == 0)
                        return false;
                }
                return true;
            }

            function zamienPolskieZnaki(slowo) {
                return slowo.replace(/ą/g, 'a').replace(/Ą/g, 'A')
                    .replace(/ć/g, 'c').replace(/Ć/g, 'C')
                    .replace(/ę/g, 'e').replace(/Ę/g, 'E')
                    .replace(/ł/g, 'l').replace(/Ł/g, 'L')
                    .replace(/ń/g, 'n').replace(/Ń/g, 'N')
                    .replace(/ó/g, 'o').replace(/Ó/g, 'O')
                    .replace(/ś/g, 's').replace(/Ś/g, 'S')
                    .replace(/ż/g, 'z').replace(/Ż/g, 'Z')
                    .replace(/ź/g, 'z').replace(/Ź/g, 'Z');
            }

            function randomize(a, b) {
                return Math.random() - 0.5;
            }

            // Make arrays with words
            function readWords() {
                var wordsJson = @json($words);
                wordsJson.sort(randomize);
                var words = [];
                for (var i = 0; i < wordsJson.length; i++) {
                    words.push(wordsJson[i].word);
                }
                var wordsSplit = [];
                for (var i = 0; i < words.length; i++) {
                    wordsSplit = words[i].split(";");
                    if (language == 'pl') {
                        wordsLang1.push(wordsSplit[0]);
                        wordsLang2.push(wordsSplit[1]);
                    } else {
                        wordsLang2.push(wordsSplit[0]);
                        wordsLang1.push(wordsSplit[1]);
                    }

                    results.push(0);
                }
                console.log(wordsLang1);
                console.log(wordsLang2);

                wordParagraph.innerHTML = wordsLang1[index];
            }

            // Prevent default behaviour on button click
            wordButton.onmousedown = function (event) {
                event.preventDefault();
            }

            function endLearning() {
                var time = new Date().getTime() - startTime;
                var amountCorrectAnswears = 0;
                var amountAnswears = results.length;

                for (var i = 0; i < results.length; i++) {
                    if (results[i] == 1)
                        amountCorrectAnswears++;
                }
                var resultPercent = parseInt(amountCorrectAnswears / amountAnswears * 100);

                appContainer.html('');
                appContainer.append($('<p class="mb-3">Czas nauki: ' + parseInt(time / 1000) + ' sekund</p>'));
                appContainer.append($('<p class="mb-3">Nauczonych: ' + amountCorrectAnswears + '/' + amountAnswears + '</p>'));
                appContainer.append($('<p class="mb-5">Procentowo: ' + resultPercent + '%</p>'));
                appContainer.append($(buttonReturn));

                console.log(results);
                if (learningMode == 'sprawdzanie_wiedzy') {
                    sendDataAjax(resultPercent);
                }

            }


            readWords();

            if (algorithm == 1) {
                wordButton.addEventListener("click", function () {
                    var inputValue = wordInput.value.toLowerCase();

                    if (inputValue == wordsLang2[index]) {
                        results[index]++;
                    }

                    wordInput.value = "";
                    if (index + 1 == wordsLang1.length) {
                        endLearning();
                    } else {
                        index++;
                    }
                    wordParagraph.innerHTML = wordsLang1[index];
                });
            } else if (algorithm == 2) {
                wordButton.addEventListener("click", function () {
                    var inputValue = wordInput.value.toLowerCase();

                    if (inputValue == wordsLang2[index]) {
                        results[index]++;
                    }

                    wordInput.value = "";
                    if (checkResults() == true) {
                        endLearning();
                    } else {
                        if (index + 1 == wordsLang1.length) {
                            for (var i = 0; i < results.length; i++) {
                                if (results[i] == 0) {
                                    index = i;
                                    break;
                                }
                            }
                        } else {
                            var loopIndex = 0;
                            index++;
                            while (results[index] == 1) {
                                index++;
                                loopIndex++;
                                if (loopIndex > wordsLang1.length) break;
                                if (index == wordsLang1.length) index = 0;
                            }
                        }
                    }
                    wordParagraph.innerHTML = wordsLang1[index];
                    console.log(results);
                    console.log(index);
                });
            } else {

            }
        });
    </script>
@endsection
