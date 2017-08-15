@extends('baseviews/base')

@section('home')
    <div class="animated fadeIn">
    <section id="homelanding" style="">
        <form class="form-wrapper" action="/home/search" method="post">
            {{csrf_field()}}
            <input type="text" placeholder="Find your quiz.." required id="mainSearch" name="search_terms">
        </form>
    </section>
    </div>
@endsection

@section('content')
    <section id="mostPopular">
        <div class="row">
            <div class="col-md-12 text-center">
                <h2 class="page-header">Search Results</h2>
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