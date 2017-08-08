@extends('baseviews.base')

@section('content')

    <section id="newQuestions">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <form id="questionsForm">
                        <div class="row questions" id="question-1">
                            <div class="col-md-12">
                                @include('baseviews.panel_question')
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection