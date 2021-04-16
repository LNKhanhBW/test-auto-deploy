@extends('layouts.admin')
@section('content')
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Add new post</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                <li class="breadcrumb-item active">Add new post</li>
            </ol>
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-body">
                    <form method="post" action="{{route('post.add')}}" enctype="multipart/form-data">
                        @csrf
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="inputName">Title</label>
                                    <input class="form-control py-4" id="inputTitle" type="text" name="title" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="inputImage">Image</label>
                                    <input class="form-control py-4" type="file" name="image" />
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="small mb-1" for="inputContent">Content</label>
                                    <textarea class="form-control py-4" name="content"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-4 mb-0 col-3">
                            <input class="btn btn-primary btn-block" type="submit" value="Create post">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@stop
