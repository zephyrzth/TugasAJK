@extends('layouts.app')

@section('content')
<br>
<div class="container">
    <div class="card">
        <div class="card-header">Profil</div>
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif
    </div>
    <br><br>
    <div class="row justify-content-center">
        @if ($user->foto_gabung)
            <div class="col-md-6">
                <h6>Foto Profil</h6>
                <img style="max-height:270px; width:auto;" src="{{ asset('storage/public/foto_gabung/'.$user->foto_gabung) }}" alt="Foto Profil">
            </div>
        @else
            <div class="col-md-6">
                <h6>Foto Profil</h6>
                <img style="max-height:270px; width:auto;" src="{{ asset('storage/public/foto/'.$user->foto) }}" alt="Foto Profil">
            </div>
        @endif
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
                    <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary btn-sm rounded-pill mt-5">Edit User</a>
                </div>
            </div>
            <br><br><br><br>
            @if ($user->foto_gabung)
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{ route('twibbon.lepas') }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="hidden" name="id-user" value="{{$user->id}}">
                            <button type="submit" class="btn btn-primary btn-sm rounded-pill mt-5">Lepas Twibbon</button>
                        </form>
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{ route('twibbon.pasang', $user->id) }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group row">
                                <label for="twibbon">Upload Twibbon</label>
                                <input type="file" name="twibbon" id="twibbon" class="form-control" required>
                                <button type="submit" class="btn btn-primary btn-sm rounded-pill mt-5">Pasang</button>
                            </div>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
