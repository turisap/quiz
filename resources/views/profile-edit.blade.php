@extends('baseviews.base')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2 class="page-header">Your profile information</h2>
                <p class="lead">Please fill all fields to provide us with relevant information</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-lg-offset-3">
                @if(count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form class="form-horizontal" id="profileForm" action="/profile/{{$profile->id}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    {{ method_field('PATCH') }}
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">School</label>
                        <div class="col-md-10">
                            <select class="form-control" name="school">
                                <option @if($profile->school == "Economic and Mathematical Gymnasium N1") selected @endif value="Economic and Mathematical Gymnasium N1">Economic and Mathematical Gymnasium N1</option>
                                <option @if($profile->school == "State School №23") selected @endif value="State School №23">State School №23</option>
                                <option @if($profile->school == "State School №100 named after N.D.Girvadze") selected @endif value="State School №100 named after N.D.Girvadze">State School №100 named after N.D.Girvadze</option>
                                <option @if($profile->school == "City School №12") selected @endif value="City School №12">City School №12</option>
                                <option @if($profile->school == "City School №33") selected @endif value="City School №33">City School №33</option>
                                <option @if($profile->school == "City School №35") selected @endif value="City School №35">City School №35</option>
                                <option @if($profile->school == "Lyceum №2") selected @endif value="Lyceum №2">Lyceum №2</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Grade</label>
                        <div class="col-md-10">
                            <select name="grade" class="form-control">
                                <option value="1st" @if($profile->grade == "1st") selected @endif>1st</option>
                                <option value="2st" @if($profile->grade == "2nd") selected @endif>2nd</option>
                                <option value="3st" @if($profile->grade == "3rd") selected @endif>3rd</option>
                                <option value="4st" @if($profile->grade == "4st") selected @endif>4th</option>
                                <option value="5st" @if($profile->grade == "5st") selected @endif>5th</option>
                                <option value="6st" @if($profile->grade == "6st") selected @endif>6th</option>
                                <option value="7st" @if($profile->grade == "7st") selected @endif>7th</option>
                                <option value="8st" @if($profile->grade == "8st") selected @endif>8th</option>
                                <option value="9st" @if($profile->grade == "9st") selected @endif>9th</option>
                                <option value="10st" @if($profile->grade == "10st") selected @endif>10th</option>
                                <option value="11st" @if($profile->grade == "11st") selected @endif>11th</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Age</label>
                        <div class="col-md-10">
                            <select name="gender" class="form-control">
                                <option value="0" @if($profile->gender == 0) selected @endif>female</option>
                                <option value="1" @if($profile->gender == 1) selected @endif>male</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Age</label>
                        <div class="col-md-10">
                           <input name="age" type="text" class="form-control" value="{{old('age')}}{{$profile->age}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Favorite subject(s)</label>
                        <div class="col-md-10">
                            <input name="favorite_subject" type="text" class="form-control" value="{{old('favorite_subject')}}{{$profile->favorite_subject}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Notes</label>
                        <div class="col-md-10">
                            <textarea name="notes" rows="5" class="form-control">{{old('notes')}}{{$profile->notes}}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 col-form-label">Profile Photo</label>
                        <div class="col-md-10">
                            <input type="file" name="profile_picture" title="Browse" data-filename-placement="inside">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-default">Update Info</button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <p>All information will be used for control of academic performance purposes only.</p>
            </div>
        </div>
    </div>

@endsection

@section('footer')
    <script>
        $(document).ready(function () {
            $('#profileForm').validate({
                rules : {
                    age : {
                        required : true,
                        number   : true
                    },
                    favorite_subject : {
                        required : true,
                        minlength : 4
                    }
                },
                messages : {
                    age : {
                        required : 'We need your age',
                        number    : 'Age should be a number'
                    },
                    favorite_subject : {
                        required :  'Please specify your favorite subject',
                        minlength : 'Subject should be at least 4 characters long'
                    }
                }
            })
        })

        $('input[type=file]').bootstrapFileInput();

    </script>
@endsection()