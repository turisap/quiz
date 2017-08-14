@extends('baseviews.base')

@section('content')
    <div class="container-fluid">
        <div class="row">
            @if($payment_status)
            <div class="col-md-5 col-md-offset-2">
                <h3>Congratulations! You just became a premium user!</h3>
                <h4>Now you can enjoy all quizzes</h4>
            </div>
            <div class="col-md-3">
                <img src="/images/static/checked.png">
            </div>
            @else
                <div class="col-md-8 col-md-offset-2">
                    <h2>There was a problem processing your payment</h2>
                    <h3>Please try again</h3>
                    <p>If you are sure that transaction was made please contact us at quizland{{'@'}}gmail.com</p>
                </div>
            @endif
        </div>
    </div>
@endsection