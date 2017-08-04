@extends('baseviews.base')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <form class="form-horizontal" method="post" action="/premium/pay">
                    <h3>GO Premium just for 3$</h3>
                    <p>You can discover all and the most interestin quizzes</p>
                </form>

                <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                    <input type="hidden" name="cmd" value="_s-xclick">
                    <input type="hidden" name="hosted_button_id" value="MZSVAZCXUH4MN">
                    <input type="image" src="https://www.paypalobjects.com/webstatic/en_US/i/btn/png/silver-pill-paypal-60px.png" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                    <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                </form>

            </div>
        </div>
    </div>

@endsection