@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Sent') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

              

                    @if (count($messages) > 0)
                    <ul>
                        @foreach ($messages as $message)
                        <li class="list-group-item">

                            User to: <strong> {{$message->user_id_from->name}}</strong>    Subject: <strong>{{$message->subject}}</strong>
                        </li>
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
