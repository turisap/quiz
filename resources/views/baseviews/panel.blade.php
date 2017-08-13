<div class="col-md-3">
    <div class="panel panel-default quiz-panel">
        @if(!isset($edit))
            <a href="/quizzes/play/{{$quiz->id}}" class="quiz-link">
        @else
            <a href="/author/{{$quiz->id}}/edit" class="quiz-link">
        @endif
        <div class="panel-heading quiz-photo">
            @if($quiz->premium == 1)
                <div class="row">
                    <div class="col-md-12">
                        <img src="/images/static/premium.png">
                    </div>
                </div>
            @endif
        </div>
        </a>
        <div class="panel-body">
            <h4>{{str_limit($quiz->title, 15)}}</h4>
            <p>By {{$quiz->author->first_name}} {{$quiz->author->last_name}}</p>
            <div class="row" >
                <div class="col-md-6">
                    <img src="/images/static/view.png" class="views">
                    <p class="number-views">{{$quiz->views}}</p>
                </div>
                <div class="col-md-6" id="row-{{$quiz->id}}">
                    @if(auth()->check())
                    @if(auth()->user()->student == 1)
                        @can('ableUnlike', $quiz->id)
                            <a href="#" class="unlike-quiz-btn pull-right" data-content="{{$quiz->id}}" id="{{$quiz->id}}-unlike"></a>
                        @endcan
                        @can('ableLike', $quiz->id)
                            <a href="#" class="like-quiz-btn" data-content="{{$quiz->id}}" id="{{$quiz->id}}-like"></a>
                        @endcan
                    @else
                        <a href="/quizzes/delete/{{$quiz->id}}"><i class="fa fa-times" aria-hidden="true"></i></a>
                    @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>