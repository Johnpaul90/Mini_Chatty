@extends('template.default')

@section('content')
    <h2>Sign in</h2>
    <div class="row">
        <div class="col-md-5 col-md-offset-3">
            <form class="form-vertical" role="form" method="post" action="{{route('auth.signin')}}">
                {{csrf_field()}}
                <div class="form-group{{$errors->has('email')? ' has-error':''}}">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" name="email" id="email" autofocus>
                    @if($errors->has('email'))
                        <span class="help-block">
                        {{ $errors->first('email')}}
                    </span>
                    @endif

                </div>
                 <div class="form-group{{$errors->has('password')? ' has-error':''}}">
                     <label for="password">Password</label>
                     <input type="password" class="form-control" name="password" id="password">
                     @if($errors->has('password'))
                         <span class="help-block">
                        {{ $errors->first('password')}}
                    </span>
                     @endif

                 </div>
                <div class="checkbox">
                    <label for="">
                        <input type="checkbox" name="remember"> Remember Me
                    </label>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Sign In</button>
                </div>
            </form>
        </div>
    </div>

@endsection