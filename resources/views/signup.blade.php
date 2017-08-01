@extends('baseviews.base')

@section('content')

    <section id="login">
    <div class="container-fluid">
        <div class="col-md-6 col-md-offset-3">
            <div style="margin-bottom: 20px">
            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            </div>
            <form method="post" action="/signup" class="form-horizontal">
                {{csrf_field()}}
                <div class="form-group">
                    <label>Email</label>
                    <input class="form-control" name="email" value="{{old('email')}}">
                </div>
                <div class="form-group">
                    <label>First Name</label>
                    <input class="form-control" name="first_name" value="{{old('first_name')}}">
                </div>
                <div class="form-group">
                    <label>Last Name</label>
                    <input class="form-control" name="last_name" value="{{old('last_name')}}">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input class="form-control" name="password" type="password">
                </div>
                <div class="form-group">
                    <label>Password Confirmation</label>
                    <input class="form-control" type="password" name="password_confirmation">
                </div>
                <button class="btn btn-default" type="submit">Login</button>
            </form>
        </div>
    </div>
    </section>

@endsection