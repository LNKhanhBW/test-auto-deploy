<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\Noti;
class NotificationController extends Controller
{
    public function index() {
        $pusherKey = env('PUSHER_APP_KEY' );
        return view('notification.index', compact('pusherKey'));
    }

    public function send(Request $request){
        $content = $request->input('content');
        event(new Noti($content));
        return response()->json(['status' => 'success']);
    }
}
