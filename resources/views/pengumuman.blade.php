@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="table-responsive">
            <table class="stripe table table-vcenter">
                <thead>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Terakhir Diubah</th>
                    <th>Ditulis Oleh</th>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($posts as $post)
                        <tr>
                            <td>{{$no++}}</td>
                            <td>
                                <a href="{{ route('post.show', $post->id) }}" style="color:blue">{{$post->title}}</a>
                            </td>
                            <td>{{$post->updated_at}}</td>
                            <td>{{$post->users->name}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
