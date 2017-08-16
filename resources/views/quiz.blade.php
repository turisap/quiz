@extends('baseviews.base')

@section('content')
    <section id="quizHead">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 panel">
                    <h3 class="page-header">{{$quiz->title}} <small>{{count($questions)}} questions</small></h3>
                    <p>{{$quiz->description}}</p>
                </div>
            </div>
        </div>
    </section>
    <section id="quizPlay">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 col-md-offset-3 panel text-center" id="wrapper">
                    <h4 id="currentQuestion">Question {{$current_question + 1}}</h4>
                    <p class="lead" id="questionName">{{$question['question']}}</p>
                    <hr>
                    <div class="text-left">
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
                    </div>
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
        var quizId = json.quiz_id;
        var nextQuestion = parseInt({{$current_question}}) + 1;
        var wrapper  = $('#wrapper');
        var currentQuestion = $('#currentQuestion');
        var questionName    = $('#questionName');
        var label1          = $('#label1');
        var label2          = $('#label2');
        var label3          = $('#label3');
        var label4          = $('#label4');

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
                               var respond = JSON.parse(question);
                               if(respond) { //if respond isn't false
                                   queuedAnimationAndNewQuestion(respond);
                               } else {
                                   finishQuiz();
                               }
                           }
                           },
                           error : function (question) {
                               console.log("ERROR", question);
                           }
                       });
                  } else {
                      wrongAnswer();
                  }

                  e.preventDefault();
            })

        });


        /**
         * Checks whether an answer was right
         */
        function checkAnswer() {
            var valid;
            $('.answer').each(function(){
                if($(this).is(':checked')){
                    var id = $(this).prop('id');
                    if(id != ''){
                        valid = (id == answer);
                        if(valid){
                            wrapper.addClass('right-answer').delay(1000).queue(function () {
                                wrapper.removeClass('right-answer');
                            });
                        }
                        setTimeout(function() {
                            $(wrapper).dequeue()
                        }, 1000)
                    }
                }
            });
            return valid;
        }

        /**
         * Adds some styling in case of wrong answer
         */

        function wrongAnswer(){
            wrapper.dequeue();
            if(wrapper.hasClass('right-answer')){
                wrapper.removeClass('right-answer');
            }
            //console.log(wrapper.hasClass('wrong-answer'));
            if(!wrapper.hasClass('wrong-answer')){
                wrapper.addClass('wrong-answer').delay(1000).queue(function(){
                    wrapper.removeClass('wrong-answer');
                });
            }
        }


        /**
         * Fills new question
         *
         * @param question
         */

        function fillNewQuestion(question){

            currentQuestion.html('Question ' + Math.abs(parseInt(question.currentQuestion) + 1));
            questionName.html(question.question);
            label1.html(question.answer1);
            label2.html(question.answer2);
            label3.html(question.answer3);
            label4.html(question.answer4);
            answer = question.answer;
            nextQuestion ++;

        }



        /**
         * Finishes quiz (shows the final page)
         */
        function finishQuiz() {
            currentQuestion.html('You just finished this quiz! Congratulations!');
            questionName.html('Congratulations!');
            label1.remove();
            label2.remove();
            label3.remove();
            label4.remove();
            $('#1').remove();
            $('#2').remove();
            $('#3').remove();
            $('#4').remove();
            $('#checkAnswer').remove();
        }

        function queuedAnimationAndNewQuestion(respond){
            var wrap = $('#wrapper');

            wrap.queue('new_question', function(){
                var self = this;
                $(this).animate({opacity : 0});
                setTimeout(function() {
                    $(self).dequeue('new_question')
                }, 1500)
            });

            wrap.queue('new_question', function () {
                var self = this;
                fillNewQuestion(respond);
                setTimeout(function () {
                    $(self).dequeue('new_question')
                }, 100)
            });

            wrap.queue('new_question', function(){
                var self = this;
                $(this).animate({opacity : 1});
                setTimeout(function() {
                    $(self).dequeue('new_question')
                }, 100)
            });

            wrap.dequeue('new_question');
        }



    </script>
@endsection