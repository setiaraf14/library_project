@extends('layout-admin.master-admin')

@section('book', 'active')
@section('Detail', '| Profile User')

@section('judul')
    <h1>Profile</h1>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h3 class="card-title">Detail Book</h3>
                    </div>
                    <!-- /.card-header -->

                    <div class="card-body">
                        <div class="d-flex justify-content-center">
                            <img src="https://www.jing.fm/clipimg/full/71-716621_transparent-clip-art-open-book-frame-line-art.png" class="img-thumbnail" width="200">
                        </div>
                        <br>
                        <div class="d-flex justify-content-center">
                            <div class="form-group m-2">
                                <label for="exampleInputPassword1">Title</label>
                                <input type="text" class="form-control" id="exampleInputPassword1" value="{{$book->title}}" disabled>
                                </div>
                            <div class="form-group m-2">
                                <label for="exampleInputEmail1">Author</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$book->publisher}}" disabled>
                            </div>
                        </div>
                        <br><br>
                        <div class="flex justify-content-center">
                            <label for="exampleInputEmail1">Description Book</label>
                            <div class="form-group m-2">
                                <textarea name="" id="" cols="30" rows="10" disabled class="form-control">{{ $book->desc }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

