@extends('baseviews.base')

@section('content')
        <section id="category">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <h2>{{$category->name}} <small> {{count($quizzes[0])}} @if(count($quizzes) == 1) quiz @else quizzes @endif</small></h2>
                    </div>
                </div>
            </div>
        </section>

        <section id="banner">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="row banner">
                            <div class="col-md-12">
                                <div class="row banner">
                                    <div class="col-md-8">
                                        <h3>{{$main_quiz->title}}</h3>
                                        <h4>{{$main_quiz->description}}</h4>
                                        <p>By {{$main_quiz->author->first_name}} {{$main_quiz->author->last_name}}</p>
                                        <a href="/quizzes/play/{{$main_quiz->id}}" class="quiz-link btn btn-default">PLAY THIS QUIZ</a>
                                    </div>
                                    <div class="col-md-4" id="image">
                                        @if($main_quiz->url)
                                            <img class="img-responsive img-circle main-quiz" src="{{$main_quiz->url}}">
                                        @else
                                            <img class="img-responsive img-circle" src="/images/static/images.png">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="categoryQuizzes">
            <div class="container-fluid">
                @foreach($quizzes as $chunk)
                    <div class="row">
                        @foreach($chunk as $quiz)
                            @include('baseviews.panel')
                        @endforeach
                    </div>
                @endforeach
            </div>
        </section>
@endsection