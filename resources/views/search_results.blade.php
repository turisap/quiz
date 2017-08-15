@extends('baseviews/base')

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