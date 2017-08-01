@extends('baseviews.base')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                @foreach($liked as $chunk)
                    <div class="row">
                        @foreach($chunk as $quiz)
                            @include('baseviews.panel')
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection