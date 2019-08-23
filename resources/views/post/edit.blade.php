@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Ubah Pengumuman') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('post.update', $post->id) }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">

                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Judul Pengumuman') }}</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" value="{{$post->title}}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="content" class="col-md-4 col-form-label text-md-right">{{ __('content') }}</label>

                            <div class="col-md-6">
                                <textarea name="content" class="form-control" id="content" cols="30" rows="10" required>{{$post->content}}</textarea>
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
