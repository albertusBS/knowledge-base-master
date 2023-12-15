@extends('layouts.index')

@section('container')

<div class="shadow p-3 text-center my-3">
    <div class="container-fluid py-5">
        <img class="mb-2" src="..\image\Logo.png" width="10%" alt="">
        <h1 class="mb-2">Knowledge Base</h1>
        <p class="col-lg-8 mx-auto lead mb-3">Apa yang dapat kami bantu?</p>
        <form class="input-group mb-3" id="searchForm" action="{{ route('search') }}" method="GET">
            <input class="form-control" type="text" id="searchInput" name="keyword" placeholder="Search">
            <button class="btn btn-outline-secondary" type="submit">
                <i class="bi bi-search"></i>
            </button>
        </form>
    </div>
</div>

<h2 class="text-center my-4">FAQs dari {{ $unit->nama_unit }}</h2>

<div class="container-fluid">
    <div class="justify-content-center row">
        @foreach ($posts as $post)
        <div class="col-md-2 mx-1">
            <div class="mb-4">
                <div class="card" style="min-width: 200px;">
                    <img class="m-3 img-thumbnail"
                        src="{{ url('../storage/thumbnails/'. $post->image) }}" alt="Post Image">
                    <div class="card-body">
                        <h5 class="card-title text-center">{{ $post->judul_post }}</h5>
                        <p class="card-text">{!! $post->excerpt !!}</p>
                        <a href="{{ route('showPost', ['id_post' => $post->id, 'unit_id' => $post->unit_id]) }}""
                            class="text-body-primary mb-2"">
                            Lihat selengkapnya
                        </a>
                        <p class="card-text">
                            <small class="text-body-secondary">{{ $post->created_at->diffForHumans() }}</small>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div>
        <a class="btn btn-outline-primary mb-3" href="{{ route ('home') }}">
            <i class="bi-arrow-left"> Kembali</i>
        </a>
    </div>
</div>

@endsection
