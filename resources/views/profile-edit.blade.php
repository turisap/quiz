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
                <form class="form-horizontal" id="profileForm" action="/profile/{{$profile->id}}" method="post">
                    {{csrf_field()}}
                    {{ method_field('PATCH') }}
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">School</label>
                        <div class="col-md-10">
                            <select class="form-control" name="school">
                                <option value="Economic and Mathematical Gymnasium N1">Economic and Mathematical Gymnasium N1</option>
                                <option value="State School №23">State School №23</option>
                                <option value="State School №100 named after N.D.Girvadze">State School №100 named after N.D.Girvadze</option>
                                <option value="City School №12">City School №12</option>
                                <option value="City School №33">City School №33</option>
                                <option value="City School №35">City School №35</option>
                                <option value="Lyceum №2">Lyceum №2</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Grade</label>
                        <div class="col-md-10">
                            <select name="grade" class="form-control">
                                <option value="1st">1st</option>
                                <option value="2st">2nd</option>
                                <option value="3st">3rd</option>
                                <option value="4st">4th</option>
                                <option value="5st">5th</option>
                                <option value="6st">6th</option>
                                <option value="7st">7th</option>
                                <option value="8st">8th</option>
                                <option value="9st">9th</option>
                                <option value="10st">10th</option>
                                <option value="11st">11th</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Age</label>
                        <div class="col-md-10">
                            <select name="gender" class="form-control">
                                <option value="0">female</option>
                                <option value="1">male</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Age</label>
                        <div class="col-md-10">
                           <input name="age" type="text" class="form-control" value="{{old('age')}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Favorite subject(s)</label>
                        <div class="col-md-10">
                            <input name="favorite_subject" type="text" class="form-control" value="{{old('favorite_subject')}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Notes</label>
                        <div class="col-md-10">
                            <textarea name="notes" rows="5" class="form-control">{{old('notes')}}</textarea>
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