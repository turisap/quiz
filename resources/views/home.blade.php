@extends('baseviews/base')

@section('home')
    <div class="animated fadeIn">
    <section id="homelanding" style="">
        <form class="form-wrapper">
            <input type="text" placeholder="Find your quiz.." required id="mainSearch">
        </form>
    </section>
    </div>
@endsection

@section('content')
    <section id="howItWorks">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2>How it works</h2>
                </div>
            </div>
            <div class="row step">
                <div class="col-sm-6">
                    <div class="wow slideInLeft">
                        <img src="/images/static/desktop.png" class="img-responsive">
                    </div>
                </div>
                <div class="col-sm-6 text-center">
                    <div class="wow slideInRight">
                        <h3>Find!</h3>
                        <p class="lead">Search for topics you want to explore</p>
                    </div>
                </div>
            </div>
            <div class="row step">
                <div class="col-sm-6 text-center">
                    <div class="wow slideInLeft">
                        <h3>Play!</h3>
                        <p class="lead">Play a quiz, answer questions, improve your knowledge</p>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="wow slideInRight">
                        <img src="/images/static/pokeball.png" class="img-responsive">
                    </div>
                </div>
            </div>
            <div class="row step1">
                <div class="col-sm-6">
                    <div class="wow slideInLeft">
                        <img src="/images/static/think.png" class="img-responsive">
                    </div>
                </div>
                <div class="wow slideInRight">
                    <div class="col-sm-6">
                        <h3>Think!</h3>
                        <p class="lead">Think about your answers and try to improve your results</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="mostPopular">
        <div class="row">
            <div class="col-md-12 text-center">
                <h2>The most popular quizzes</h2>
            </div>
        </div>
        <div class="container-fluid">
            <div class="wow fadeIn">
                @foreach($chunks as $chunk)
                    <div class="row">
                        @foreach($chunk as $quiz)
                            @include('baseviews.panel')
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection

@section('footer')
    <script>
        new WOW().init();
    </script>
@endsection