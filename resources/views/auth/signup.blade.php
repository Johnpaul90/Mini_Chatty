@extends ('template.default')

@section('content')
    <h2>Sign Up Here:</h2>
    <div class="row">
        <div class="col-md-5 col-md-offset-3">
            <form action="{{route('auth.signup')}}" role="form" class="form-vertical" method="post">
                {{csrf_field()}}
            <div class="form-group{{$errors->has('email')? ' has-error':''}}">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" class="form-control" value="{{Request::old('email')? :''}}">
                @if($errors->has('email'))
                    <span class="help-block">
                        {{ $errors->first('email')}}
                    </span>
                @endif
            </div>

            <div class="form-group{{$errors->has('username')? ' has-error':''}}">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" class="form-control" value="{{Request::old('username')? :''}}">
                @if($errors->has('username'))
                    <span class="help-block">
                        {{ $errors->first('username')}}
                    </span>
                @endif

            </div>

            <div class="form-group{{$errors->has('password')? ' has-error':''}}">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" >
                @if($errors->has('password'))
                    <span class="help-block">
                        {{ $errors->first('password')}}
                    </span>
                @endif

            </div>

            <div class="form-group">
                <button class="btn btn-primary" type="submit">Sign Up</button>
            </div>
            </form>
        </div>
    </div>
@endsection
