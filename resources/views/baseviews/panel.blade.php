<div class="col-md-2">
    <div class="panel panel-default quiz-panel">
        <div class="panel-heading quiz-photo">PHOTO</div>
        <div class="panel-body">
            <a href="/quizzes/play/{{$quiz->id}}" class="quiz-link">
            <h4>{{str_limit($quiz->title, 20)}}</h4>
            <p>{{$quiz->author->first_name}} {{$quiz->author->last_name}}</p>
            <div class="row" >
                <div class="col-md-6">
                    <p>{{$quiz->views}} views</p>
                </div>
                <div class="col-md-6" id="row-{{$quiz->id}}">
                    @can('ableUnlike', $quiz->id)
                        <a href="#" class="unlike-quiz-btn" data-content="{{$quiz->id}}" id="{{$quiz->id}}-unlike">Unlike</a>
                    @endcan
                    @can('ableLike', $quiz->id)
                        <a href="#" class="like-quiz-btn" data-content="{{$quiz->id}}" id="{{$quiz->id}}-like">Like</a>
                    @endcan
                </div>
            </div>
                @if($quiz->premium == 1)
                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="premium">Premium</h5>
                        </div>
                    </div>
                @endif
            </a>
        </div>
    </div>
</div>