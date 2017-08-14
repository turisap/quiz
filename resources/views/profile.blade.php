@extends('baseviews.base')

@section('content')
        <section id="profileInfo">
            <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <img src="/images/static/settings.png" id="img2">
                </div>
                <div class="col-md-4 panel panel-default">
                    <div class="row panel-heading">
                        <div class="col-md-12" id="profilePicture">
                            <img class="img-rounded" @if(!$url) src="/images/static/images.png" @else src="{{$url}}" @endif >
                        </div>
                    </div>
                    <div class="row panel-body">
                        <div class="col-md-6">
                            <dl class="list-group">
                                <dt>Student:</dt>
                                <dd>{{$profile->first_name}} {{$profile->last_name}}</dd>
                                <dt>School:</dt>
                                <dd>{{$profile->school}}</dd>
                                <dt>Grade:</dt>
                                <dd>{{$profile->grade}}</dd>
                                <dt>Age:</dt>
                                <dd>{{$profile->age}}</dd>
                            </dl>
                        </div>
                        <div class="col-md-6">
                            <dl class="list-group">
                                <dt>Gender:</dt>
                                <dd>@if($profile->gender == 0) male @else female @endif</dd>
                                <dt>Favorite Subject:</dt>
                                <dd>{{$profile->favorite_subject}}</dd>
                                <dt>Shortly about:</dt>
                                <dd>{{$profile->notes}}</dd>
                            </dl>
                        </div>
                        <a class="btn btn-default pull-right" href="/profile/{{$profile->id}}/edit">Update</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <img src="/images/static/settings1.png" id="img4">
                </div>
            </div>
            </div>
        </section>




@endsection