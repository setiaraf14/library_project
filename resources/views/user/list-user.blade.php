@extends('layout-admin.master-admin')

@section('member', 'active')
@section('title', '| List-Member')

@section('judul')
    <h1>Data Member</h1>
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
                        <h3 class="card-title">Data Member</h3>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                            Insert Member
                        </button>
                    </div>
                    <!-- /.card-header -->

                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Create Member</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                                <form class="form-group" method="POST" action="{{url('/profile/store')}}">
                                    @csrf
                                    <div class="form-group">
                                      <label for="exampleFormControlInput1">Name</label>
                                      <input type="title" name="name" class="form-control" id="exampleFormControlInput1" placeholder="Name here ...">
                                    </div>
                                    <div class="form-group">
                                      <label for="exampleFormControlSelect1">Email</label>
                                      <input type="text" name="email" class="form-control" id="exampleFormControlInput1" placeholder="email here ...">
                                    </div>
                                    <div class="form-group">
                                      <label for="exampleFormControlTextarea1">Password</label>
                                      <input type="password" name="password" class="form-control" id="exampleFormControlInput1" placeholder="password here ...">
                                      <small id="emailHelp" class="form-text text-muted">Password must more the 8 character!.</small>
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
                        <div class="table-responsive">
                            <table id="tabel-data" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Nomor</th>
                                        <th>Nama member</th>
                                        <th>Email Member</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($member as $members)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $members->name}}</td>
                                            <td>{{ $members->email }}</td>
                                            <td><a href="{{url('/profile/delete/'.$members->id)}}" class="btn btn-danger">Delete</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

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
