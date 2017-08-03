@extends('baseviews.base')

@section('content')
    <section id="quizHead">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="page-header">{{$quiz->title}} <small>{{count($questions)}} questions</small></h1>
                    <p>{{$quiz->description}}</p>
                </div>
            </div>
        </div>
    </section>
    <section id="quizPlay">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 col-md-offset-3" style="background: gainsboro;">
                    <h3 id="currentQuestion">Question {{$current_question}}</h3>
                    <p class="lead" id="questionName">{{$question['question']}}?</p>
                    <hr>
                    @if($question['answer1'])
                        <div class="answer row">
                            <div class="col-md-2">
                                <input class="answer" type="radio" name="answer" id="1">
                            </div>
                            <div class="col-md-10">
                                <label id="label1">{{$question['answer1']}}</label>
                            </div>
                        </div>
                    @endif
                    @if($question['answer2'])
                        <div class="answer row">
                            <div class="col-md-2">
                                <input class="answer" type="radio" name="answer" id="2">
                            </div>
                            <div class="col-md-10">
                                <label id="label2">{{$question['answer2']}}</label>
                            </div>
                        </div>
                    @endif
                    @if($question['answer3'])
                        <div class="answer row">
                            <div class="col-md-2">
                                <input class="answer" type="radio" name="answer" id="3">
                            </div>
                            <div class="col-md-10">
                                <label id="label3">{{$question['answer3']}}</label>
                            </div>
                        </div>
                    @endif
                    @if($question['answer4'])
                        <div class="answer row">
                            <div class="col-md-2">
                                <input class="answer" type="radio" name="answer" id="4">
                            </div>
                            <div class="col-md-10">
                                <label id="label4">{{$question['answer4']}}</label>
                            </div>
                        </div>
                    @endif
                    <a class="btn btn default pull-right" href="" id="checkAnswer" disabled>Check Answer</a>
                </div>
            </div>

        </div>
    </section>
@endsection

@section('footer')
    <script>

        var json = {!! $question_json !!};
        var answer = json.answer;
        var quizId = json.quiz_id
        var nextQuestion = parseInt({{$current_question}}) + 1;

        // enable button on radio check
        $('.answer').on('change', function () {
            $('#checkAnswer').removeAttr('disabled');
        });

        $(document).ready(function(){
            //console.log(answer);

            $('#checkAnswer').on('click', function (e) {


                  if(checkAnswer()){
                      $.ajax({
                           url : '/quizzes/ajax/' + quizId,
                           type : "GET",
                           data : {
                             question : nextQuestion
                           },
                           success : function (question) {
                           if(!question.error) {
                               //console.log(JSON.parse(question));
                               fillNewQuestion(JSON.parse(question));
                           }
                           },
                           error : function (question) {
                               console.log("Error", question);
                           }
                       });
                  } else {
                      console.log('wrong answer');
                  }

                  e.preventDefault();
            })

        });


        function checkAnswer() {
            var valid;
            $('.answer').each(function(){
                if($(this).is(':checked')){
                    var id = $(this).prop('id');
                    if(id != ''){
                        valid = (id == answer);
                    }
                }
            });
            return valid;
        }

        function fillNewQuestion(question){
            $('#currentQuestion').html('Question ' + question.currentQuestion);
            $('#questionName').html(question.question);
            $('#label1').html(question.answer1);
            $('#label2').html(question.answer2);
            $('#label3').html(question.answer3);
            $('#label4').html(question.answer4);
            answer = question.answer;
            nextQuestion ++;
        }







    </script>
@endsection