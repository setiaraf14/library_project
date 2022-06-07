@extends('layout-admin.master-admin')

@section('dashboard', 'active')
@section('title', '| Dashboard')

@section('judul')
    <h1>Dashboard</h1>
@endsection

@section('ckeditor')
<script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="title-page text-center">
                <h1>Data Utama</h1>
            </div>
        </div>
    </div>
    <br><br>
        <div class="info ">
            <div class="col-lg-3">
                <div class="small-box bg-primary">
                    <div class="inner">
                    <h3>{{ $buku }}</h3>
                    <p>Buku</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users fa-3x"></i>
                </div>

                </div>

                <div class="small-box bg-warning">
                    <div class="inner">
                    <h3>{{ $user }}</h3>
                    <p>Member</p>
                </div>
                <div class="icon">
                    <i class="fas fa-id-card fa-3x"></i>
                </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
