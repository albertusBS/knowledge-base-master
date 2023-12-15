@extends('layouts.index')

@section('container')

<div class="row justify-content-center mt-3">
    <div class="col-lg-8">
        <h1 class="text-center mb-3"><strong>{{ $post->judul_post }}</strong></h1>
        <p class="text-center text-muted mb-3">{{ $post->created_at->diffForHumans() }}</p>
        <p class="mb-4">{!! $post->isi_post !!}</p>
        <p class="mb-4">
            <strong>Tag:    </strong>
            {{ $post->tag }}</p>
        <a class="btn btn-secondary my-4" href="{{ route('dashboardUnit') }}"><i class="bi-arrow-left"></i> Kembali</a>
    </div>
</div>

@endsection
