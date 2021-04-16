@extends('layouts.admin')
@section('content')
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">List post</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                <li class="breadcrumb-item active">List post</li>
            </ol>
            <div class="row float-right mr-1 mb-4">
                <a class="btn btn-primary" href="{{route('post.add')}}">Add new</a>
                <a class="btn btn-secondary ml-1" target="_blank" href="{{route('post.exportAll')}}">Export all</a>
                <a class="btn btn-secondary ml-1" data-toggle="modal" data-target="#importModal">Import</a>
            </div>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Content</th>
                    <th scope="col">Image</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($listPost as $listPost)
                <tr data-id="{{$listPost->id}}">
                    <td scope="row" class="">{{$listPost->id}}</td>
                    <td>{{$listPost->title}}</td>
                    <td>{{$listPost->content}}</td>
                    <td class="text-center">
                        <img src="{{$listPost->image}}" style="max-width: 200px; max-height: 100px">
                    </td>
                    <td class="w-25 text-center">
                        <button class="btn btn-secondary btn-edit mr-2" data-toggle="modal" data-target="#editModal" data-id="{{$listPost->id}}">Edit</button>
                        <button class="btn btn-danger btn-delete" data-id="{{$listPost->id}}">Delete</button>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{route('post.update')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputName">Title</label>
                                        <input class="form-control py-4" id="title" type="text" name="title" />
                                        <input class="form-control py-4" id="id" type="number" name="id" hidden/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputImage">Image</label>
                                        <input class="form-control py-4" type="file" id="image" name="image" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputContent">Content</label>
                                        <textarea class="form-control py-4" id="content" name="content"></textarea>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Import</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{route('post.import')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputImage">File</label>
                                        <input class="form-control py-4" type="file" id="import-file" name="import-file" />
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Import</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="{{asset('assets/js/postlist.js')}}"></script>
@stop
