@extends('template.default')


@section('content')
    <div class="row">
        <div class="col-lg-6 ">
            @include('user.partials.userblock')
            <hr>

            @if(!$statuses->count())
                <p>{{$user->getFirstNameOrUsername()}} hasn't posted anything yet.</p>
            @else
                @foreach($statuses as $status)
                    @include('user.partials.status')
                            @foreach($status->replies as $reply)
                        @include('user.partials.reply')
                            @endforeach


                           @if($authUserIsFriend || Auth::user()->id===$status->user->id)
                                <form action="{{route('status.reply',['statusId'=>$status->id])}}" role="form" method="post">
                                    <div class="form-group{{$errors->has("reply-{$status->id}")? ' has-error':''}}">
                                        <textarea name="reply-{{ $status->id }}" class="form-control" placeholder="Reply to this status" rows="3"></textarea>
                                        @if($errors->has("reply-{$status->id}"))
                                            <span class="help-block">
                                                {{ $errors->first("reply-{$status->id}")}}
                                            </span>
                                        @endif

                                    </div>
                                    <input type="submit" value="Reply" class="btn btn-primary btn-sm">
                                    {{csrf_field()}}
                                </form>
                            @endif
                        </div>
                    </div>
                @endforeach

            @endif



        </div>
        <div class="col-lg-6  ">
            @if(Auth::user()->hasFriendRequestPending($user))
                <p>Waiting for {{$user->getNameOrUsername()}} to accept your request.</p>
            @elseif(Auth::user()->hasFriendRequestReceived($user))
                <a href="{{route('friends.accept',['username'=>$user->username])}}" class="btn btn-primary">Accept Friend Request</a>
            @elseif(Auth::user()->isFriendsWith($user))
                <p>You and {{$user->getNameOrUsername()}} are now friends.</p>
                <form action="{{route('friends.delete',['username'=> $user->username])}}" method="post">
                    {{csrf_field()}}
                    <input type="submit" class="btn btn-primary" value="Delete Friend">
                </form>
            @elseif(Auth::user()->id !==$user->id)
                <a href="{{route('friends.add',['username'=>$user->username])}}"class="btn btn-primary">Add as Friends</a>
            @endif
                 <h4>{{$user->getFirstNameOrUsername()}}'s friends</h4>

                @if(!$user->friends()->count())
                  <p>{{$user->getFirstNameOrUsername()}} has no friends.</p>
                @else
                    @foreach($user->friends() as $user)
                        @include('user/partials/userblock')
                    @endforeach
                @endif
        </div>
    </div>

@endsection