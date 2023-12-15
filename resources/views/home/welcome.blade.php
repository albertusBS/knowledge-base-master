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

<div>
    @if(isset($searchResults))
        @if (count($searchResults) > 0)
        <div class="row justify-content-center my-4">
            <h3 class="my-3 text-center">Hasil pencarian: {{ $keyword }}</h3>
            @foreach ($searchResults as $result)
            <div class="col-3 mb-4">
                <div class="card mx-1">
                    <img class="m-3" src="{{ url('storage/app/public/thumbnails/'. $result->image) }}" alt="Post image">
                    <div class="card-body">
                        <h5 class="card-title text-center mb-2">{{ $result->judul_post }}</h5>
                        <p class="card-text">{{ $result->excerpt }}</p>
                        <a class="text-body-secondary mb-2 fw-medium"
                            href="{{ route('showPost', ['id_post' => $result->id, 'unit_id' => $result->unit_id]) }}">
                            Baca Selengkapnya
                        </a>
                        <p class="card-text">
                            <small class="text-body-secondary">{{ $result->created_at->diffForHumans() }}</small>
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="justify-content-center">
                <a class="btn btn-secondary" href="{{ route('home') }}"><i class="bi-arrow-left"></i> Kembali</a>
            </div>
        </div>
        @else
        <div class="text-center fw-semibold">
            <h3 class="">Hasil pencarian dari "{{ $keyword }}" tidak ditemukan</h3>
            <a class="btn btn-secondary" href="{{ route('home') }}"><i class="bi-arrow-left"></i> Kembali</a>
        </div>
        @endif
    @else
        <div class="row justify-content-center my-4">
            <h3 class="my-3 text-center">Informasi dari Fakultas atau Unit</h3>
            @foreach ($units as $unit)
            @if ($unit->id_unit != 'admin')
            <div class="card col-3 m-2  align-middle">
                <div class="card-body">
                    <p class="fs-4 text-decoration-none text-center fw-semibold">
                        {{ $unit->nama_unit }}
                    </p>
                    <ul class="my-3">
                        @foreach($posts->where('unit_id', $unit->id_unit)->take(5) as $post)
                            <li class="text-start">
                                <a href={{ route('showPost', ['id_post' => $post->id, 'unit_id' => $post->unit_id]) }}
                                    class="text-decoration-none">
                                    {{ $post->judul_post }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    <a href="{{ route('postUnit', ['id' => $unit->id_unit]) }}">
                        <small>
                            Lihat Semua <i class="bi-arrow-right"></i>
                        </small>
                    </a>
                </div>
            </div>
            @endif
            @endforeach
        </div>
    @endif
</div>

@endsection
