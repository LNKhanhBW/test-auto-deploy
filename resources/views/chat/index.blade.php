@extends('layouts.default')
@section('body')
<head>
    <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css'><link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.2/css/font-awesome.min.css'>
    <link href="{{asset('assets/css/chat.css')}}" rel="stylesheet" />
</head>
<div id="frame">
    <div class="content">
        <div class="contact-profile">
            <img src="http://hathix.com/images/elephant.png" alt="" />
            <p>Room chat</p>
        </div>
        <div class="messages">
            <ul>
            </ul>
        </div>
        <div class="message-input">
            <div class="wrap">
                <input type="text" id="message" placeholder="Write your message..." />
                <button class="button" id="btn-send"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
            </div>
        </div>
    </div>
    <input value="{{$pusherKey}}" hidden id="pusher-key">
    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
</div>
<script src="{{asset('assets/js/pusher-chat.js')}}"></script>
@stop
