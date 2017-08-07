@extends('baseviews.base')

@section('content')
         <section id="profileHeading">
             <div class="container-fluid">
                 <div class="row">
                     <div class="col-md-12">
                         <h2 class="page-header">Your info</h2>
                     </div>
                 </div>
             </div>
         </section>

        <section class="profileInfo">
            <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="row">
                        <div class="col-md-4">
                            <img class="img-responsive pull-right" @if(!$url) src="/images/static/images.png" @else src="{{$url}}" @endif >
                        </div>
                        <div class="col-md-8">
                            <dl class="list-group left-bordered">
                                <dt>Student:</dt>
                                <dd>{{$profile->first_name}} {{$profile->last_name}}</dd>
                                <dt>School:</dt>
                                <dd>{{$profile->school}}</dd>
                                <dt>Grade:</dt>
                                <dd>{{$profile->grade}}</dd>
                                <dt>Age:</dt>
                                <dd>{{$profile->age}}</dd>
                                <dt>Gender:</dt>
                                <dd>{{$profile->gender}}</dd>
                                <dt>Favorite Subject:</dt>
                                <dd>{{$profile->favorite_subject}}</dd>
                                <dt>Shortly about:</dt>
                                <dd>{{$profile->notes}}</dd>
                            </dl>
                            <a class="btn btn-default" href="/profile/{{$profile->id}}/edit">Update</a>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </section>




@endsection