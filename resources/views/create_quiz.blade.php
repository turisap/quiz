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
            <a href="#" class="btn btn-danger remove-question"><i class="fa fa-times" aria-hidden="true"></i></a>
        </div>
    </div>


@endsection

@section('footer')
    <script>
        $(document).ready(function(){

            var i = 2;
            var form = $('#questionsForm');
            var stub = $('#stub');


            form.validate({
                rules : {
                    'question[0]' : {
                        required : true
                    },
                    'answer1[0]' : {
                        required : true
                    },
                    'answer2[0]' : {
                        required : true
                    },
                    'answer3[0]' : {
                        required : true
                    },
                    'answer4[0]' : {
                        required : true
                    }
                }
            });


            $('#saveQuiz').on('click', function(){
                form.submit();
            });

            // delete a new question
            $('body').on('click','.remove-question', function () {
                var question = $(this).parents('.questions');

                question.remove();

                scrollOnAdding();
            });


            // adding extra fields for questions on click
            $('#addQuestionBtn').on('click', function (e) {
                e.preventDefault();

                var extraQuestion = stub.clone();
                extraQuestion.css('visibility', 'visible');

                renameQuestions(extraQuestion);
                scrollOnAdding();
                addRulesToNewInputs();

                i++;
            });

            //uncheck other radio boxes onchange
            $('body').on('change', '.radio', function () {

                var parent = $(this).parents('.radio-row');
                var secondRow = parent.siblings('.radio-row');

                secondRow.find('input[type=radio]').prop('checked', false);
                parent.find('input[type=radio]').not(this).prop('checked', false);


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

                extraQuestion.attr('id', 'question' + i);
                question.attr('id', 'question' + i);
                question.attr('name', 'question[' + i + ']');
                question.attr('placeholder', 'Question #' + i);

                answer1.attr('name', 'answer1[' + i + ']').attr('id', 'answer1[' + i + ']');
                answer2.attr('name', 'answer2[' + i + ']').attr('id', 'answer2[' + i + ']');
                answer3.attr('name', 'answer3[' + i + ']').attr('id', 'answer3[' + i + ']');
                answer4.attr('name', 'answer4[' + i + ']').attr('id', 'answer4[' + i + ']');

                rightAnswer1.attr('name', 'rightAnswer' + i + '-1');
                rightAnswer2.attr('name', 'rightAnswer' + i + '-2');
                rightAnswer3.attr('name', 'rightAnswer' + i + '-3');
                rightAnswer4.attr('name', 'rightAnswer' + i + '-4');

                form.append(extraQuestion);

            }


            function scrollOnAdding(){
                if (i > 2) {
                    var target = $('footer');
                    $('html, body').animate({
                        scrollTop: $(target).offset().top
                    }, 500);
                }
            }


            function addRulesToNewInputs(){
                $('.question').each(function () {
                    $(this).rules("add", {
                        required: true
                    });
                });
                $('.answer').each(function () {
                    $(this).rules("add", {
                        required: true
                    });
                });
            }
        });
    </script>
@endsection