<div class="media">
    <a href="{{route('profile.index',['username'=>$status->user->username])}}" class="pull-left"><img
                src="{{$status->user->getAvatarUrl()}}" alt="{{$status->user->getFirstNameOrUsername()}}"
                class="media-object"></a>
    <div class="media-body">
        <h4 class="media-heading"><a href="{{route('profile.index',['username'=>$status->user->username])}}">
                {{$status->user->getFirstNameOrUsername()}}</a></h4>
        <p>{{$status->body}}</p>
        <ul class="list-inline">
            <li>{{$status->created_at->diffForHumans()}}</li>
            @if($status->user->id !== Auth::user()->id)
                <li><a href="{{route('status.like',['statusId'=>$status->id])}}">Like</a></li>
            @endif
            <li>{{$status->likes->count()}} {{str_plural('like', $status->likes->count())}}</li>
        </ul>
