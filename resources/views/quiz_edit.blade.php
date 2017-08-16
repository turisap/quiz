@extends('baseviews.base')

@section('content')

    <section id="newQuestions">
        <div class="container-fluid">
            <div class="row head">
                <div class="row text-center">
                    <div class="col-md-12">
                        <h4 class="page-header">Fill the form to save the quiz</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <form id="questionsForm" method="post" action="/author/{{$quiz->id}}" enctype="multipart/form-data">
                        {{csrf_field()}}
                        {{method_field('PATCH')}}
                        <div class="row quiz-info panel">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label">Title</label>
                                    <div class="col-md-10">
                                        <input type="text" name="title" class="form-control" value="{{$quiz->title}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label">Description</label>
                                    <div class="col-md-10">
                                        <input type="text" name="description" class="form-control" value="{{$quiz->description}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label">Category</label>
                                    <div class="col-md-10">
                                        <select name="category" class="form-control">
                                            @if(count($categories) > 0)
                                                @foreach($categories as $category)
                                                    <option value="{{$category->id}}" @if($quiz->category_id == $category->id) selected @endif>{{$category->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label>Premium</label>
                                        <input type="checkbox" name="premium" @if($quiz->premium != NULL) checked @endif>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="file" name="picture" class="form-control" title="picture" id="quizPicture">
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($questions)
                            @for($i = 0; $i < count($questions); $i++)
                                <div class="row questions panel" id="question-{{$i}}">
                                    <div class="col-md-12">
                                        @include('baseviews.panel_edit_question')
                                        <a href="/remove-question/{{$questions[$i]->id}}" id="{{$questions[$i]->id}}" class="question-remove">

                                        </a>
                                    </div>
                                </div>
                            @endfor
                        @endif
                        <input type="hidden" name="all-right-answers" id="allRightAnswers">
                    </form>
                    <div class="row panel buttons">
                        <div class="col-md-12">
                            <button type="submit" id="saveQuiz" class="btn btn-primary">Save</button>
                            <label style="visibility: hidden;" id="radioButtonsError"></label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="row questions panel" id="stub" style="visibility: hidden;">
        <div class="col-md-12">
            @include('baseviews.panel_question')
            <a href="#" class="btn btn-danger remove-question"><i class="fa fa-times" aria-hidden="true"></i></a>
        </div>
    </div>


@endsection

@section('footer')
    <script>

        $('input[type=file]').bootstrapFileInput();

        $(document).ready(function(){

            var i = 2;
            var form = $('#questionsForm');
            var stub = $('#stub');
            var rightAnswers = '{{ $right_answers }}';
            console.log(rightAnswers);


            form.validate({
             rules : {
                 'title' : {
                      required : true
                 },
                 'description' : {
                      required : true
                 },
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

            $('#saveQuiz').on('click', function() {
               $(form).submit();
            });

            $(form).submit(function(e) {
                e.preventDefault();
                // check first whether radio buttons in all sets were checked
                if(!checkRadioButtons()) {
                    $('#radioButtonsError').html('Please check right answers in all questions').css('visibility', 'visible');
                } else {
                    var rightAnswers = assemblyRightAnswersArray();
                    $('#allRightAnswers').val(rightAnswers);
                    $(this).unbind('submit').submit()
                }
            });



            // delete a question
            $('.question-remove').on('click', function (e) {
                e.preventDefault();

                var questionId = $(this).attr('id');

                $.ajax({
                    url : '/remove-question/' + questionId,
                    type : "GET",
                    success : function (data) {
                        if(!data.error) {
                            removeQuestionViaAjax(questionId);
                        }
                    },
                    error : function (data) {
                        //console.log("Error", data);
                    }
                })
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
            $('.radio').on('change', function () {
                var parent = $(this).parents('.radio-row');
                var closestParent = parent.siblings('.radio-row');

                closestParent.find('.radio').prop('checked', false);
                parent.find('.radio').not(this).prop('checked', false);
            });




            function renameQuestions(extraQuestion)
            {

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

                rightAnswer1.attr('name', 'rightAnswer1[' + i + ']');
                rightAnswer2.attr('name', 'rightAnswer2[' + i + ']');
                rightAnswer3.attr('name', 'rightAnswer3[' + i + ']');
                rightAnswer4.attr('name', 'rightAnswer4[' + i + ']');


                form.append(extraQuestion);
            }


            function scrollOnAdding()
            {
                if (i > 2) {
                    var target = $('footer');
                    $('html, body').animate({
                        scrollTop: $(target).offset().top
                    }, 500);
                }
            }



            // checks whether all sets of questions have one radio button checked
            function checkRadioButtons()
            {
                var questions = [];
                var checkboxes = [];
                var validQuestions = [];

                // THIS IS HOW TO FIND ELEMENTS WHICH WERE APPENDED TO THE DOM
                $(form).find('.questions').each(function () {//get all the questions from the form
                    var set = $(this).find('.radio');

                    set.each(function () {
                        checkboxes.push($(this).is(':checked'))
                    });
                    questions.push(checkboxes);
                    checkboxes = [];

                });
                //console.log(questions);
                for(var c = 0; c < questions.length; c++){
                    validQuestions.push($.inArray(true, questions[c]));
                }
                return ($.inArray(-1, validQuestions) == -1);
            }


            // returns an array with the number of right answer for each question
            function assemblyRightAnswersArray()
            {
                var rightAnswers = [];
                var rightNumbers = [];
                // THIS IS HOW TO FIND ELEMENTS WHICH WERE APPENDED TO THE DOM
                $(form).find('.questions').each(function () {//get all the questions from the form
                    var set = $(this).find('.radio');

                    set.each(function () {
                        if($(this).is(':checked')){
                            rightAnswers.push($(this).attr('id'));
                        }
                    });
                });

                for(var c = 0; c < rightAnswers.length; c++){
                    rightNumbers.push(rightAnswers[c].split('-').pop());
                }
                return rightNumbers;
            }


            // remove a question markup after getting a positive response from the server about deleting the respective record from the database
            function removeQuestionViaAjax(id){
                $('#' + id).parents('.questions').remove();
            }

        });
    </script>
@endsection