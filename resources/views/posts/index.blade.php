@extends('layouts.index')

@section('container')

<h2 class="text-center mt-4 mb-5">Daftar Post</h2>

@if(session()->Has('success'))
    <div class="alert alert-success alert dismissible fade show
        d-flex justify-content-between align-items-center" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="mt-3 mb-3">
    <a class="btn btn-secondary text-nowrap fw-semibold" type="button"
        href="{{ route('indexCreatePost') }}">
        <i class="bi-plus-square"></i> Tambah Post
    </a>
</div>

<table class="table table-striped-columns mt-4" style="text-align: center">
    <thead class="bg-info">
        <th class="col-1 border border-light-dark" scope="col">Nomor</th>
        <th class="col-2 border border-light-dark" scope="col">Judul</th>
        <th class="col-2 border border-light-dark" scope="col">Tanggal Pembuatan</th>
        <th class="col-1 border border-light-dark" scope="col">Aksi</th>
    </thead>
    <tbody>
    @foreach ($posts as $post)
        <tr class="align-middle">
            <th class="border border-light-subtle" scope="row"> {{ $loop->iteration }} </th>
            <td class="border border-light-dark"> {{ $post->judul_post }} </td>
            <td class="border border-light-dark"> {{ $post->created_at }} </td>
            <td class="border border-light-dark">
                <div class="btn-group">
                    <a class="btn btn-sm btn-info text-light fw-semibold m-1"
                        href="{{ route('detailPost', ['id' => $post->id]) }}">
                        <i class="bi-info-square"></i> Detail
                    </a>
                    <a class="btn btn-sm btn-primary text-light fw-semibold m-1"
                        href="{{ route('indexEditPost', ['id' => $post->id]) }}">
                        <i class="bi-pencil-square"></i> Update
                    </a>
                    <form method="POST" action="{{ route('destroyPost', ['id' => $post->id]) }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm text-light fw-semibold m-1">
                            <i class="bi-trash"></i> Delete
                        </button>
                    </form>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

@endsection
