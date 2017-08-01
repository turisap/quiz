@extends('baseviews/base')

@section('home')
    <section id="homelanding" style="background: url('/images/static/books.jpg')">
    </section>
@endsection

@section('content')
    <div class="container-fluid">
        <section id="mostPopular">
            @foreach($chunks as $chunk)
                <div class="row">
                    @foreach($chunk as $quiz)
                        @include('baseviews.panel')
                    @endforeach
                </div>
            @endforeach
        </section>
    </div>
@endsection