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
            <form method="post" action="/signup" class="form-horizontal" id="signupForm">
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
                    <input class="form-control" name="password" type="password" id="password">
                </div>
                <div class="form-group">
                    <label>Password Confirmation</label>
                    <input class="form-control" type="password" name="password_confirmation">
                </div>
                <button class="btn btn-default" type="submit">Sign UP</button>
            </form>
        </div>
    </div>
    </section>

@endsection

@section('footer')
    <script>
        $(document).ready(function () {
            $('#signupForm').validate({
                rules : {
                    email : {
                        required : true,
                        email    : true
                    },
                    first_name : {
                        required : true,
                        minlength : 2
                    },
                    last_name : {
                        required : true,
                        minlength : 2
                    },
                    password : {
                        required : true,
                        minlength: 6
                    },
                    password_confirmation : {
                        required  : true,
                        minlength : 6,
                        equalTo   : '#password'
                    }
                },
                messages : {
                    email : {
                        required : 'We need your email',
                        email    : 'Please give us a valid email'
                    },
                    first_name : {
                        required : 'We need your name',
                        minLength : 'Name should be at least 2 characters'
                    },
                    last_name : {
                        required : 'We need your last name',
                        minLength : 'Last name should be at least 2 characters long'
                    },
                    password : {
                        required : 'Please enter your password',
                        minLength : 'Password should be at least 6 characters long'
                    },
                    password_confirmation : {
                        required : 'Please enter your password',
                        minLength : 'Password should be at least 6 characters long',
                        equalTo   : 'Password should be equal to conirmation'
                    }
                }
            })
        })

    </script>
@endsection()