@extends('layout-admin.master-admin')

@section('profile', 'active')
@section('title', '| Profile User')

@section('judul')
    <h1>Profile</h1>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h3 class="card-title">Data Profile</h3>
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
                        <div class="d-flex justify-content-center">
                            <img src="https://thumbs.dreamstime.com/b/young-man-face-cartoon-vector-illustration-graphic-design-man-face-cartoon-144449592.jpg" class="img-thumbnail" width="200">
                        </div>
                        <br>
                        <div class="d-flex justify-content-center">
                            <div class="form-group m-2">
                                <label for="exampleInputPassword1">Name</label>
                                <input type="text" class="form-control" id="exampleInputPassword1" value="{{Auth::user()->name}}" disabled>
                                </div>
                            <div class="form-group m-2">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{Auth::user()->email}}" disabled>
                                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                            </div>
                            <div class="form-group m-3">
                                <br>
                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editProfile">
                                    Edit Profile
                                </button>

                                <div class="modal fade" id="editProfile" tabindex="-1" aria-labelledby="editProfileLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLabel">Edit Profile Here</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                            <form class="form" method="POST" action="{{ url('/profile/edit/'. Auth::user()->id ) }}">
                                                {{ csrf_field() }}

                                                <div class="form-group">
                                                    <label for="name" class="control-label">Name</label>
                                                    <input id="name" type="text" class="form-control" value="{{Auth::user()->name}}" name="name" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="email" class="control-label">Email</label>
                                                    <input id="email" type="email" class="form-control" value="{{Auth::user()->email}}" name="email" required>
                                                </div>

                                                <div class="col-md-6 col-md-offset-4">
                                                    <button type="submit" class="btn btn-primary">
                                                        Change Profile
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                      </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            Did you want to change password ?
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                Change Password
                            </button>
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">Change Password Here</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                        <form class="form" method="POST" action="{{url('/profile/change-password')}}">
                                            {{ csrf_field() }}

                                            <div class="form-group">
                                                <label for="new-password" class="control-label">Current Password</label>
                                                <input id="current-password" type="password" class="form-control" name="current_password" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="new-password" class="control-label">New Password</label>
                                                <input id="new-password" type="password" class="form-control" name="new_password" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="password_confirmation" class="control-label">Confirmation New Password</label>
                                                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
                                            </div>
                                            <div class="col-md-6 col-md-offset-4">
                                                <button type="submit" class="btn btn-primary">
                                                    Change Password
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                      <button type="button" class="btn btn-primary">Save changes</button>
                                    </div>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js-select-2')
    <script>
        $(document).ready(function () {
            $("#index-surat").select2({
                theme: 'bootstrap4',
                placeholder: "Please Select"
            });
        });
    </script>
@endsection

