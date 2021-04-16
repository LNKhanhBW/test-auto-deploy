<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\Chat;
class ChatController extends Controller
{
    public function index() {
        $pusherKey = env('PUSHER_APP_KEY' );
        return view('chat.index', compact('pusherKey'));
    }

    public function send(Request $request){
        $sessionID = $request->input('sessionID');
        $message = $request->input('message');
        event(new Chat($sessionID, $message));
        return response()->json(['status' => 'success']);
    }
}
