@extends('baseviews.base')

@section('content')
    <div class="container-fluid">
        <div class="row">
            @if($payment_status)
            <div class="col-md-8 col-md-offset-2">
                <h2>Congratulations! You just became a premium user!</h2>
                <h3>Now you can enjoy all quizzes</h3>
            </div>
            @else
                <div class="col-md-8 col-md-offset-2">
                    <h2>There was a problem processing your payment</h2>
                    <h3>Please try again</h3>
                    <p>If you are sure that transaction was made please contact us at quizland{{'@'}}gmail.com</p>
                    <a href="/premium/quizzes">Check out new quizzes</a>
                </div>
            @endif
        </div>
    </div>
@endsection