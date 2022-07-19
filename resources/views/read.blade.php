@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
               
                <div class="card-body">
From: {{$message->user_id_from->name}}
<br>
Email: {{$message->user_id_from->email}}
<br>
Subject: {{$message->subject}}
<hr>
Message: {{$message->body}}
<hr>
<a href="{{route('create',[$message->user_id_from->id, $message->subject])}}" >Reply</a>
<a href="{{route('delete',$message->id)}}" class="btn btn-dnager float-end" style="background-color: red">Delete</a>


</div>
</div>
</div>
</div>
@endsection