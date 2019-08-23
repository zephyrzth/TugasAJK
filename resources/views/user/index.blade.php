@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h6>Foto Profil</h6>
            <img style="max-height:270px; width:auto;" src="{{ asset('storage/public/foto/'.$user->foto) }}" alt="Foto Profil">
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12">
                    <h6>Nama</h6>
                    <p>{{$user->name}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h6>Email</h6>
                    <p>{{$user->email}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary btn-xl rounded-pill mt-5">Edit User</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
