@extends('template.default')

@section('content')
    <div class="row">
        <div class="col-lg-6 ">
            <h3>Your Friends</h3>
            @if(!$friends->count())
                <p>You have no friends.</p>
            @else
                @foreach($friends as $user)
                    @include('user/partials/userblock')
                @endforeach
            @endif

        </div>
        <div class="col-lg-6">
            <h4>Friends Requests</h4>
            @if(!$requests->count())
                <p>You have no friend request.</p>
            @else
                @foreach($requests as $user)
                    @include('user/partials/userblock')
                @endforeach
            @endif

        </div>
    </div>
@endsection