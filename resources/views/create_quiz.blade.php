@extends('baseviews.base')

@section('content')

    <section id="newQuestions">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <form id="questionsForm" method="post" action="/author">
                        {{csrf_field()}}
                        <div class="row questions" id="question-0">
                            <div class="col-md-12">
                                @include('baseviews.panel_question')
                            </div>
                        </div>
                    </form>
                    <button type="submit" id="saveQuiz" class="btn btn-primary">Save</button>
                    <a href="#" class="btn btn-default" id="addQuestionBtn">Add a question</a>
                </div>
            </div>
        </div>
    </section>
    <div class="row questions" id="stub" style="visibility: hidden;">
        <div class="col-md-12">
            @include('baseviews.panel_question')
        </div>
    </div>


@endsection

@section('footer')
    <script>
        $(document).ready(function(){

            var i = 2;
            var form = $('#questionsForm');
            var stub = $('#stub');

            $('#saveQuiz').on('click', function(){
                form.submit();
            });


            $('#addQuestionBtn').on('click', function (e) {
                e.preventDefault();

                var extraQuestion = stub.clone();
                extraQuestion.css('visibility', 'visible');

                renameQuestions(extraQuestion);

                form.append(extraQuestion);

                i++;
            });

            function renameQuestions(extraQuestion){

                var question = extraQuestion.find('#question1');
                var answer1 = extraQuestion.find('#answer1-1');
                var answer2 = extraQuestion.find('#answer1-2');
                var answer3 = extraQuestion.find('#answer1-3');
                var answer4 = extraQuestion.find('#answer1-4');

                var rightAnswer1 = extraQuestion.find('#rightAnswer1-1');
                var rightAnswer2 = extraQuestion.find('#rightAnswer1-2');
                var rightAnswer3 = extraQuestion.find('#rightAnswer1-3');
                var rightAnswer4 = extraQuestion.find('#rightAnswer1-4');

                question.attr('name', 'question' + i);
                answer1.attr('name', 'answer' + i + '-1');
                answer2.attr('name', 'answer' + i + '-2');
                answer3.attr('name', 'answer' + i + '-3');
                answer4.attr('name', 'answer' + i + '-4');
                rightAnswer1.attr('name', 'rightAnswer' + i + '-1');
                rightAnswer2.attr('name', 'rightAnswer' + i + '-2');
                rightAnswer3.attr('name', 'rightAnswer' + i + '-3');
                rightAnswer4.attr('name', 'rightAnswer' + i + '-4');

            }
        });
    </script>
@endsection