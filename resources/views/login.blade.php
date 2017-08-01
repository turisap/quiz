@extends('baseviews.base')

@section('content')

    <section id="login">
    <div class="container-fluid">
        <div class="col-md-6 col-md-offset-3">
            <form method="post" action="/login" class="form-horizontal">
                {{csrf_field()}}
                <div class="form-group">
                    <label>Email</label>
                    <input class="form-control" name="email">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input class="form-control" name="password" type="password">
                </div>
                <button class="btn btn-default" type="submit">Login</button>
            </form>
        </div>
    </div>
    </section>

@endsection