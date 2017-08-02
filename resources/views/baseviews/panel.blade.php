<div class="col-md-2">
    <div class="panel panel-default quiz-panel">
        <div class="panel-heading quiz-photo">PHOTO</div>
        <div class="panel-body">
            <h4>{{str_limit($quiz->title, 20)}}</h4>
            <p>{{$quiz->author->first_name}} {{$quiz->author->last_name}}</p>
            <div class="row">
                <div class="col-md-6">
                    <p>{{$quiz->views}} views</p>
                </div>
                @can('ableUnlike', $quiz->id)
                    <div class="col-md-6">
                        <a href="/quizzes/unlike/{{$quiz->id}}">Unlike</a>
                    </div>
                @endcan
                @can('ableLike', $quiz->id)
                    <div class="col-md-6">
                        <a href="/quizzes/like/{{$quiz->id}}">Like</a>
                    </div>
                @endcan
            </div>
        </div>
    </div>
</div>