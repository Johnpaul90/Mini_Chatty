@extends('template.default')

@section('content')
<h3>Your search for "{{Request::input('query')}}"</h3>
    @if(!$users->count())
        No result found for your search. Try another search!
     @else
        <div class="row">
            <div class="col-md-6">
                @foreach($users as $user)
                    @include('user/partials/userblock')
                @endforeach

            </div>
        </div>
    @endif
@endsection