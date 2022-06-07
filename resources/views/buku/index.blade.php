@extends('layout-admin.master-admin')

@section('book', 'active')
@section('title', '| List-Book')

@section('judul')
    <h1>Data Buku</h1>
@endsection

@section('ckeditor')
<script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h3 class="card-title">Data Book</h3>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                            Insert Book
                        </button>

                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                    <form class="form-group" method="POST" action="{{url('/book/store-book')}}">
                                        @csrf
                                        <div class="form-group">
                                          <label for="exampleFormControlInput1">Title</label>
                                          <input type="title" name="title" class="form-control" id="exampleFormControlInput1" placeholder="title here ...">
                                        </div>
                                        <div class="form-group">
                                          <label for="exampleFormControlSelect1">Author</label>
                                          <input type="publisher" name="publisher" class="form-control" id="exampleFormControlInput1" placeholder="publisher here ...">
                                        </div>
                                        <div class="form-group">
                                          <label for="exampleFormControlTextarea1">Description</label>
                                          <textarea class="form-control" name="desc" id="exampleFormControlTextarea1" rows="3"></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                              </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->

                    <div class="card-body">
                        @if(session('message'))
                            <div class="alert alert-{{ session('style') }}" id="alert-notification">
                                <div class="row">
                                    <div class="col-md-11">
                                        <h5>{{ session('message') }}</h5>
                                    </div>
                                    <div class="col-md-1 text-right">
                                        <span id="close-notification">&times;</span>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <form action="{{ url('/book') }}" method="GET">
                            <div class="row text-center m-3">

                                    <div class="col-md-3">
                                        <input type="text" name="publisher" class="form-control"
                                        value="{{ isset($filters['publisher']) ? $filters['publisher'] : "" }}" placeholder="Search By Author">
                                    </div>

                                    <div class="col-md-2">
                                        <div class="input-group">
                                            <button class="btn btn-outline-info btn-xs" type="submit"><i class="fa fa-search"
                                                aria-hidden="true"></i>
                                            Search</button>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="input-group">
                                            <a href="{{ url('/book') }}" class="btn btn-warning">Clear Filter</a>
                                        </div>
                                    </div>
                            </div>
                        </form>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Title</th>
                                        <th>Author</th>
                                        <th>Desc Book</th>
                                        <th>Satuses</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($buku as $bukus)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $bukus->title}}</td>
                                            <td>{{ $bukus->publisher }}</td>
                                            <td>{{ Illuminate\Support\Str::of($bukus->desc)->limit(20) }}</td>
                                            <td>{{ $bukus->status }}</td>
                                            <td class="d-flex justify-content-between">
                                                <a href="{{url('/book/detail/'.$bukus->id)}}" class="btn btn-info">Detail</a>
                                                @if(Auth::user()->level == 'admin')
                                                    <a href="{{ url('/book/delete/'.$bukus->id) }}" class="btn btn-danger">Hapus</a>
                                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{$loop->iteration}}">
                                                    Edit
                                                    </button>
                                                @endif

                                                <div class="modal fade" id="exampleModal{{$loop->iteration}}" tabindex="-1" aria-labelledby="exampleModalLabel{{$loop->iteration}}" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                      <div class="modal-content">
                                                        <div class="modal-header">
                                                          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                          </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form class="form-group" method="POST" action="{{url('/book/store-book/'.$bukus->id)}}">
                                                                @csrf
                                                                <div class="form-group">
                                                                  <label for="exampleFormControlInput1">Title</label>
                                                                  <input type="title" name="title" class="form-control" value="{{ $bukus->title}}" id="exampleFormControlInput1" placeholder="title here ...">
                                                                </div>
                                                                <div class="form-group">
                                                                  <label for="exampleFormControlSelect1">Author</label>
                                                                  <input type="publisher" name="publisher" class="form-control" value="{{ $bukus->publisher }}" id="exampleFormControlInput1" placeholder="publisher here ...">
                                                                </div>
                                                                <div class="form-group">
                                                                  <label for="exampleFormControlTextarea1">Description</label>
                                                                  <textarea class="form-control" name="desc" id="exampleFormControlTextarea1" rows="3">{{ $bukus->desc }}</textarea>
                                                                </div>
                                                                <button type="submit" class="btn btn-primary">Save</button>
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        </div>
                                                      </div>
                                                    </div>
                                                </div>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @if(isset($bukus))
                            {{ $buku->links() }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @section('data-table')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            $(document).ready(function(){
                $('#tabel-data').DataTable();
            });
        </script>
    @endsection
@endsection
