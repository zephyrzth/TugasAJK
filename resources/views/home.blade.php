@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
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

                    <a href="{{ route('post.create') }}"><button type="button" class="btn btn-sm btn-success mb-2" data-toggle="tooltip" title="Tambah Post">
                        Tambah Pengumuman
                    </button></a>
                    <br><br>
                    <h5 class="text-center">Daftar Pengumuman yang Dibuat</h5>
                    <div class="table-responsive">
                        <table class="stripe table table-striped table-bordered table-vcenter">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Judul</th>
                                    <th>Terakhir Diubah</th>
                                    <th>Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($posts) > 0)
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($posts as $post)
                                        <tr>
                                            <td>{{$no++}}</td>
                                            <td>{{$post->title}}</td>
                                            <td>{{$post->updated_at}}</td>
                                            <td>
                                                <form action="{{ route('post.destroy', $post->id) }}" method="post" enctype="multipart/form-data">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <a href="{{ route('post.show', $post->id) }}"><button type="button" class="btn btn-sm btn-secondary mb-2" data-toggle="tooltip" title="Edit Post">
                                                        Detail
                                                    </button></a>
                                                    <a href="{{ route('post.edit', $post->id) }}"><button type="button" class="btn btn-sm btn-primary mb-2" data-toggle="tooltip" title="Edit Post">
                                                        Edit
                                                    </button></a>
                                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4" class="text-center">Tidak ada data</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
