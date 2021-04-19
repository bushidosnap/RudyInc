@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row bg-secondary rounded shadow-lg">
        <div class="col-3 p-4">
            <img src="https://scontent.fmnl2-1.fna.fbcdn.net/v/t1.0-9/134640093_3943728705639401_7097507374767165361_n.jpg?_nc_cat=107&ccb=2&_nc_sid=09cbfe&_nc_eui2=AeHvLQ7jVmpZcAWAnVA6iCV0lNFlTNE33myU0WVM0TfebApnyPamrIXr6GT3TbHPfyHbAnB9jZJvjRI-lVEhL6Wn&_nc_ohc=sWPWhk2dqhwAX-bqxy2&_nc_ht=scontent.fmnl2-1.fna&oh=318c97cbf338ac7d5ab984a59eaab9b2&oe=602CAFC3" 
            alt="" class="rounded-circle" height="200" width="200">
        </div>
        <div class="col-9 text-light pt-5">
            <div><h1>{{$user->name}}</h1></div>
            <div>{{$user->profile->address?? ''}}</div>
            <div>{{$user->profile->contact1?? ''}}</div>
            <div>{{$user->profile->contact2 ?? ''}}</div>
            <div><a href="#" class="text-white font-weight-bold">{{$user->email}}</a></div>
        </div>
    </div>

    <div class="row bg-secondary rounded mt-4" style="height: 400px">
        <div class="col-12">
            
        </div>
    </div>
</div>
@endsection
