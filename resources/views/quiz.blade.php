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
                    @if($question['answer_1'])
                        <div class="answer row">
                            <div class="col-md-2">
                                <input class="form-control" type="radio" name="answer">
                            </div>
                            <div class="col-md-10">
                                <label>{{$question['answer_1']}}</label>
                            </div>
                        </div>
                    @endif
                    @if($question['answer_2'])
                        <div class="answer row">
                            <div class="col-md-2">
                                <input class="form-control" type="radio" name="answer">
                            </div>
                            <div class="col-md-10">
                                <label>{{$question['answer_2']}}</label>
                            </div>
                        </div>
                    @endif
                    @if($question['answer_3'])
                        <div class="answer row">
                            <div class="col-md-2">
                                <input class="form-control" type="radio" name="answer">
                            </div>
                            <div class="col-md-10">
                                <label>{{$question['answer_3']}}</label>
                            </div>
                        </div>
                    @endif
                    @if($question['answer_4'])
                        <div class="answer row">
                            <div class="col-md-2">
                                <input class="form-control" type="radio" name="answer">
                            </div>
                            <div class="col-md-10">
                                <label>{{$question['answer_4']}}</label>
                            </div>
                        </div>
                    @endif
                    <a class="btn btn default pull-right" href="" id="checkAnswer">Check Anser</a>
                </div>
            </div>

        </div>
    </section>
@endsection

@section('footer')
    <script>
        var question = {!! $json !!};
        $(document).ready(function(){

            $('#checkAnswer').on('click', function (e) {
                e.preventDefault();

                $.ajax({
                    url : '/quizzes/unlike/' + quiz_id,
                    type : "GET",
                    success : function (data) {
                        if(!data.error) {
                            makeQuizUnliked(quiz_id);
                        }
                    },
                    /*error : function (data) {
                     console.log("Error", data);
                     }*/
                })
            })

        })
    </script>
@endsection