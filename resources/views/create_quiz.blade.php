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
            // var divider = '<hr>';

            $('#saveQuiz').on('click', function(){

                form.validate();

                $('.answer').each(function(){
                   $(this).rules('add', {
                       required: true
                   })
                });

                if(form.validate().form()) {
                    console.log('valid');
                } else {
                    console.log('invalid');
                }

                //form.submit();
            });

            // delete a new question
            $('body').on('click','.remove-question', function () {
                var question = $(this).parents('.questions');
                //var d = question.next();
                question.remove();
                //d.remove();
                scrollOnAdding();
            });


            // adding extra fields for questions on click
            $('#addQuestionBtn').on('click', function (e) {
                e.preventDefault();

                var extraQuestion = stub.clone();
                extraQuestion.css('visibility', 'visible');

                renameQuestions(extraQuestion);
                scrollOnAdding();
                i++;
            });

            //uncheck other radio boxes onchange
            $('body').on('change', '.radio', function () {

                var parent = $(this).parents('.radio-row');
                var secondRow = parent.siblings('.radio-row');

                secondRow.find('input[type=radio]').prop('checked', false);
                parent.find('input[type=radio]').not(this).prop('checked', false);

                //console.log(parent.attr('class'));

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

                var labelAnswer1 = extraQuestion.find('#labelAnswer1-1');
                var labelAnswer2 = extraQuestion.find('#labelAnswer1-2');
                var labelAnswer3 = extraQuestion.find('#labelAnswer1-3');
                var labelAnswer4 = extraQuestion.find('#labelAnswer1-4');

                extraQuestion.attr('id', 'question' + i);
                question.attr('name', 'question' + i);
                question.attr('placeholder', 'Question #' + i);
                answer1.attr('name', 'answer' + i + '-1');
                answer2.attr('name', 'answer' + i + '-2');
                answer3.attr('name', 'answer' + i + '-3');
                answer4.attr('name', 'answer' + i + '-4');
                rightAnswer1.attr('name', 'rightAnswer' + i + '-1');
                rightAnswer2.attr('name', 'rightAnswer' + i + '-2');
                rightAnswer3.attr('name', 'rightAnswer' + i + '-3');
                rightAnswer4.attr('name', 'rightAnswer' + i + '-4');

                labelAnswer1.attr('for', 'answer' + i + '-1').attr('id', 'answer' + i + '-1');
                labelAnswer2.attr('for', 'answer' + i + '-2').attr('id', 'answer' + i + '-2');
                labelAnswer3.attr('for', 'answer' + i + '-3').attr('id', 'answer' + i + '-3');
                labelAnswer4.attr('for', 'answer' + i + '-4').attr('id', 'answer' + i + '-4');

                form.append(extraQuestion);
                //form.append(divider);

            }


            function scrollOnAdding(){
                if (i > 2) {
                    var target = $('footer');
                    $('html, body').animate({
                        scrollTop: $(target).offset().top
                    }, 500);
                }
            }
        });
    </script>
@endsection