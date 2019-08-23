@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <h6>Judul Post</h6>
                    <p>{{$post->title}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h6>Dibuat Oleh</h6>
                    <p>{{$post->users->name}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h6>Terakhir Diubah</h6>
                    <p>{{$post->updated_at}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h6>Isi Post</h6>
                    <p>{{$post->content}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
