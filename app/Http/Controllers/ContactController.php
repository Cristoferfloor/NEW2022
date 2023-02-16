<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Models\User;
use App\Notifications\MessageNotification;
use Illuminate\Console\View\Components\Alert;

class ContactController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::where('id','!=', auth()->id())->get();
        return view('contact', compact('users'));
    }

    public function store(Request $request)
    {
        // return $request->all();
        $message = Message::create([
            'sender_id' => auth()->id(),
            'recipient_id' => $request->recipient_id,
            'body' => $request->body_message,
        ]);

        // auth()->user()->notify(new MessageNotification($message));
        $user = User::where('id','=',$message->recipient_id)->get()
                ->each(function(User $user) use ($message){
                    $user->notify(new MessageNotification($message));                    
                });
        
        
        
        return back()->with('flash', 'Tu mensaje fue enviado');
    }

    public function mostrar ($id) {
        $message = Message::findOrFail($id);
        $user = User::findOrFail($message->sender_id);
        $userR = User::findOrFail($message->recipient_id);
        $data = [$message, $user];

        foreach ($userR->notifications as $notification){
            if($notification->data['message'] == $message->id){
                $notification->markAsRead();
                return view('mostrar', compact('data'));
            }
        }
    }
}
