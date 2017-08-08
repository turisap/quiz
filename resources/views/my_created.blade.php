@extends('baseviews.base')

@section('content')
    <section id="myCreated">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @foreach($created_quizzes as $chunk)
                        <div class="row">
                            @foreach($chunk as $quiz)
                                @include('baseviews.panel')
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <section id="newQuizButton">
        <a href="/author/create" class="btn btn-default">Create a new Quiz</a>
    </section>
@endsection