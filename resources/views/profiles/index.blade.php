@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row bg-secondary rounded shadow-lg">
        <div class="col-3 p-4">
            <img src="{{asset('/storage/images/'.Auth::user()->profile->image)}}" alt="Profile Image"
            class="rounded-circle" height="200" width="200">
        </div>
        <div class="col-9 text-light pt-5">
            <div class="d-flex justify-content-between">
                <div><h1>{{Auth::user()->name}}</h1></div>
                <div><a class="btn btn-primary" href="/profile/{{Auth::user()->id}}/edit" role="button">Edit Profile</a></div>
            </div>
            <div>{{Auth::user()->profile->address?? ''}}</div>
            <div>{{Auth::user()->profile->contact1?? ''}}</div>
            <div>{{Auth::user()->profile->contact2 ?? ''}}</div>
            <div><a href="#" class="text-white font-weight-bold">{{Auth::user()->email}}</a></div>
        </div>
    </div>
</div>
<div>
    @if(Auth::user()->type == 'customer')
        @include('profiles.customer-index')
    @else
        @include('profiles.tailor-index')
    @endif
</div>
@endsection




