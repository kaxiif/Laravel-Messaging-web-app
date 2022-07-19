@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"></div>

                <div class="card-body">
                    
                  
                    <h2 class="text-center">Send Message</h2>
                    <form method="POST" action="/">
                        @csrf

                        <div class="form-group rowm2">
                            <label for="to" class="col-md-4 col-form-label text-md-right">To</label>
                            <div class="col-md-12">
                                <select class="form-control" name="to" id="to">
                                    @if($users)
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            
                        </div>
                        <div class="form-group rowm2">
                            <label for="subject" class="col-md-4 col-form-label text-md-right">Subject</label>

                            <div class="col-md-12">
                                <input id="subject" type="text" class="form-control @error('subject') is-invalid @enderror" value="{{$subject}}" name="subject" value="{{ old('subject') }}" required autocomplete="subject" autofocus>

                               
                            </div>
                        </div>
                        <div class="form-group rowm2">
                            <label for="message" class="col-md-4 col-form-label text-md-right">Message</label>

                            <div class="col-md-12">
                                <input id="message" type="textarea" class="form-control @error('message') is-invalid @enderror" name="message" value="{{ old('message') }}" required autocomplete="message" autofocus>
                            </div>
                        </div>
                       
                    
                        

<br>

                        <div class="form-group rowm2  text-center">
                           
                            <div class="col-md-4 offset-md-4 m2">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection