@extends('template.default')

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <form action="{{route('status.post')}}" method="post"role="form">
                {{csrf_field()}}
                <div class="form-group{{$errors->has('status')? ' has-error':''}}">
                    <textarea name="status" id="status" class="form-control" rows="3" placeholder="What's up {{Auth::user()->getFirstNameOrUsername()}} ?"></textarea>
                    @if($errors->has('status'))
                        <span class="help-block">
                        {{ $errors->first('status')}}
                    </span>
                    @endif

                </div>
                <button class="btn btn-group-xs btn-primary" type="submit">Update Status</button>
            </form>
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5 col-md-offset-3">
            @if(!$statuses->count())
                <p>There's nothing to display in your timeline!</p>
            @else
                @foreach($statuses as $status)
                    @include('user.partials.status')
                            @foreach($status->replies as $reply)
                                @include('user.partials.reply')
                            @endforeach
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
                            </div>
                        </div>
                @endforeach
                {!! $statuses->render() !!}
            @endif

        </div>
    </div>
@endsection