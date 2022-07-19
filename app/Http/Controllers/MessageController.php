<?php

namespace App\Http\Controllers;

use App\Models\Massage;
use App\Models\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd("MessageController@index");
        //authenticate user
        $user = auth()->user();
       
        if($user){
            //get all messages for user
        $messages = Massage::all()->where('user_id_to', $user->id)->where('deleted', false);

        // get all user users details for message list (user_id_from)
        $users = $user->users;
        
        // for each messages and get all messages for user (user_id_from)
        foreach ($messages as $message) {
            //dd($message->user_id_from);
            $message->user_id_from = User::where('id', $message->user_id_from)->first();
           // $message->user_id_to = $users->where('id', $message->user_id_to)->first();
        }
        
        // add user details to message list based on user_id_from
      

        //return view with messages
        //dd($messages);
        return view('home', compact('messages'));

           
        }
        else{
            return redirect('/login');
            }
    }

    public function sent(){
        //dd("MessageController@sent");
        //authenticate user
        $user = auth()->user();
       
        if($user){
            //get all messages for user
        $messages = Massage::all()->where('user_id_from', $user->id);

        // get all user users details for message list (user_id_from)
        $users = $user->users;
        
        // for each messages and get all messages for user (user_id_from)
        foreach ($messages as $message) {
            //dd($message->user_id_from);
            $message->user_id_from = User::where('id', $message->user_id_to)->orderby('created_at', 'desc')->first();
           // $message->user_id_to = $users->where('id', $message->user_id_to)->first();
        }
        
        // add user details to message list based on user_id_from
      

        //return view with messages
       // dd($messages);
        return view('sent', compact('messages'));

           
        }
        else{
            return redirect('/login');
            }
    }

    public function read($id){
        //dd("MessageController@read");
        //authenticate user
        $user = auth()->user();
        if($user){
            //get all messages for user
        $message = Massage::find($id);
        $message->read = true;
        $message->save();
       // dd($message);
        $user_id_from= $message->user_id_from;
        $message->user_id_from = User::where('id', $message->user_id_from)->first();
        $message->user_id_to = User::where('id', $message->user_id_to)->first();

        
        return view('read', compact('message'));

           
        }
        else{
            return redirect('/login');
            }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(int $id, string $subject)
    {
        if($id===0 OR $id === null){
            $user = auth()->user();
        if($user){
            // get all users expect current user
            $users = User::all()->where('id', '!=', $user->id);

            //dd($users);
            // return view with users
            return view('create', compact('users'));
        }
        else{
            return redirect('/login');
            }
        }
        else{
            $user = auth()->user();
        if($user){
            // get all users expect current user
            $users = User::all()->where('id', $id);
            if($subject !== null OR $subject !== ""){
                $subject = 'Re: '.$subject;
            }
            
            //dd($users);
            // return view with users
            return view('create', compact('users', 'subject'));
        }
        else{
            return redirect('/login');
            }
        }
        
    }

    public function send()
    {
        
        
        $user = auth()->user();
        if($user){
            // get all users expect current user
            $users = User::all()->where('id', '!=', $user->id);

            //dd($users);
            // return view with users
            return view('send', compact('users'));
        }
        else{
            return redirect('/login');
            }
        
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'to' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);
        $message = new Massage;
        $message->user_id_from = auth()->user()->id;
        $message->user_id_to = $request->to;
        $message->subject = $request->subject;
        $message->body = $request->message;
        $message->save();
        return redirect('/')->with('success', 'Message Sent');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function delete($id){
        $user = auth()->user();
        if($user){
            $message = Massage::find($id);
            $message->deleted = true;
            $message->save();
            return redirect('/')->with('success', 'Message Deleted');
        }
        else{
            return redirect('/login');
            }
    }
    public function deleted(){
        $user = auth()->user();
        if($user){
            // get all messages for user
        $messages = Massage::all()->where('user_id_to', $user->id)->where('deleted', true);
        // get all user users details for message list (user_id_from)
        $users = $user->users;
        
        // for each messages and get all messages for user (user_id_from)
        foreach ($messages as $message) {
            //dd($message->user_id_from);
            $message->user_id_from = User::where('id', $message->user_id_from)->orderby('created_at', 'desc')->first();
           // $message->user_id_to = $users->where('id', $message->user_id_to)->first();
        }
        
        // add user details to message list based on user_id_from
      

        //return view with messages
       // dd($messages);
        return view('delete', compact('messages'));

           
        }
        else{
            return redirect('/login');
            }
    }
    public function return($id){

        $user = auth()->user();
        if($user){
            $message = Massage::find($id);
            $message->deleted = false;
            $message->save();
            return redirect('/')->with('success', 'Message Returned');
        }
        else{
            return redirect('/login');
            }
    }
}
