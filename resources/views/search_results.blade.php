@extends('baseviews/base')

@section('content')
    <section id="searchResults">
        <div class="row">
            <div class="col-md-12 text-center">
                <h2 class="page-header">Search Results</h2>
            </div>
        </div>
        <div class="container-fluid">
            <div class="wow fadeIn text-center">
                @foreach($chunks as $chunk)
                    <div class="row">
                        @foreach($chunk as $quiz)
                            @include('baseviews.panel')
                        @endforeach
                    </div>
                @endforeach
                @if(!$chunks->first())
                    <h3>There is nothing found according to your search</h3>
                @endif
            </div>
        </div>
    </section>
@endsection

@section('footer')
    <script>
        new WOW().init();
    </script>
@endsection