@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Inbox') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

              

                    @if (count($messages) > 0)
                    <ul class="list-group">
                        @foreach ($messages as $message)
                       <a href="read/{{$message->id}}" style="text-decoration: none">
                        <li class="list-group-item">
                            User From: <strong> {{$message->user_id_from->name}}</strong>    Subject: <strong>{{$message->subject}}</strong>
                            @if($message->read == 1)
                            <span class="badge badge-success float-end" style="color: green">Read</span>
                            @endif

                        </li>
                    </a>
                        @endforeach
                    </ul>
                    @else
                        <p>You have no messages.</p>
                    @endif
                </div>

            </div>
            </div>
            </div>
            </div>
   
@endsection
