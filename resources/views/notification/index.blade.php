@extends('layouts.default')
@section('content')

<div id="layoutAuthentication_content">
    <main>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="card shadow-lg border-0 rounded-lg mt-5">
                        <div class="card-header"><h3 class="text-center font-weight-light my-4">Notification</h3></div>
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form>
                                @csrf
                                <div class="form-group">
                                    <input class="form-control py-4" id="content" name="content" placeholder="Type content here..." />
                                </div>
                                <div class="form-group text-center">
                                    <input id="btn-send" type="button" class="btn btn-primary" value="Send">
                                </div>
                            </form>
                        </div>
                        <div class="card-footer text-center" id="noti-panel">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <input value="{{$pusherKey}}" hidden id="pusher-key">
        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
    </main>
</div>
<script src="{{asset('assets/js/pusher.js')}}"></script>
@stop
