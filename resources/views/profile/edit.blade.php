@extends('template.default')

@section('content')
    <h2>Update your profile</h2>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <form action="{{route('profile.edit')}}" class="form-vertical" role="form" method="post">
                {{csrf_field()}}
                <div class="row">
                <div class="col-md-6">
                    <div class="form-group{{$errors->has('first_name')? ' has-error':''}}">
                        <label for="first_name" class="control-label">First Name</label>
                        <input type="text" class="form-control" name="first_name" id="first_name" value="{{Request::old('first_name') ? :Auth::user()->first_name}}">
                    </div>
                    @if($errors->has('first_name'))
                        <span class="help-block">
                        {{ $errors->first('first_name')}}
                    </span>
                    @endif

                </div>

                <div class="col-md-6">
                    <div class="form-group{{$errors->has('last_name')? ' has-error':''}}">
                        <label for="last_name" class="control-label">Last Name</label>
                        <input type="text" class="form-control" name="last_name" id="last_name" value="{{Request::old('last_name') ?:Auth::user()->last_name }}">
                    </div>
                    @if($errors->has('last_name'))
                        <span class="help-block">
                        {{ $errors->first('last_name')}}
                    </span>
                    @endif

                </div>
                </div>
                    <div class="form-group{{$errors->has('location')? ' has-error':''}}">
                        <label for="location" class="control-label">Location</label>
                        <input type="text" class="form-control" name="location" id="location" value="{{Request::old('location') ?:Auth::user()->location }}">
                        @if($errors->has('location'))
                            <span class="help-block">
                        {{ $errors->first('location')}}
                    </span>
                        @endif

                    </div>
                <div class="form-group">
                    <button class="btn btn-primary" type="submit">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection