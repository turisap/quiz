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
                    <h3>Question {{$current_question}}</h3>
                    <p class="lead">{{$question['question']}}?</p>
                    <hr>
                    @if($question['answer1'])
                        <div class="answer row">
                            <div class="col-md-2">
                                <input class="answer" type="radio" name="answer" id="1">
                            </div>
                            <div class="col-md-10">
                                <label>{{$question['answer1']}}</label>
                            </div>
                        </div>
                    @endif
                    @if($question['answer2'])
                        <div class="answer row">
                            <div class="col-md-2">
                                <input class="answer" type="radio" name="answer" id="2">
                            </div>
                            <div class="col-md-10">
                                <label>{{$question['answer2']}}</label>
                            </div>
                        </div>
                    @endif
                    @if($question['answer3'])
                        <div class="answer row">
                            <div class="col-md-2">
                                <input class="answer" type="radio" name="answer" id="3">
                            </div>
                            <div class="col-md-10">
                                <label>{{$question['answer3']}}</label>
                            </div>
                        </div>
                    @endif
                    @if($question['answer4'])
                        <div class="answer row">
                            <div class="col-md-2">
                                <input class="answer" type="radio" name="answer" id="4">
                            </div>
                            <div class="col-md-10">
                                <label>{{$question['answer4']}}</label>
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

        var question = {!! $question_json !!};
        var nextQuestion = parseInt({{$current_question}}) + 1;



        $(document).ready(function(){

            // enable button on radio check
            $('.answer').on('change', function () {
                $('#checkAnswer').removeAttr('disabled');
            });

            $('#checkAnswer').on('click', function (e) {


                  if(checkAnswer()){
                      $.ajax({
                           url : '/quizzes/ajax/' + question.quiz_id,
                           type : "GET",
                           data : {
                             question : nextQuestion
                           },
                           success : function (data) {
                           if(!data.error) {
                               console.log(data);
                           }
                           },
                           error : function (data) {
                               console.log("Error", data);
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
                        valid = (id == question.answer);

                    }
                }
            });
            return valid;
        }







    </script>
@endsection