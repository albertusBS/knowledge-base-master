@extends('layouts.index')

@section('container')

{{-- Toast untuk menampilkan pesan sukses dalam mengajukan pertanyaan --}}
@if(session('success'))
    <div class="position-fixed top-0 start-50 translate-middle-x p-3" style="z-index: 5">
        <div class="toast align-items-center bg-info border-1" id="toast" role="alert"
            aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="text-center">
                    <i class="bi-check2"></i>&nbsp;Pertanyaan Berhasil Disimpan
                </strong>
                <button class="btn-close btn-close me-2 m-auto" type="button"
                    data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                <p class="fw-semibold">
                    {{ session('success') }}
                </p>
            </div>
        </div>
    </div>
@endif

{{-- Tombol Kembali ke Halaman Post Unit --}}
<div class="row mt-3">
    <div class="col-lg-8">
        <a class="btn btn-outline-secondary btn-sm" href="{{ route('postUnit', ['id' => $post->unit_id]) }}">
            <i class="bi-arrow-left"></i> Kembali</a>
    </div>
</div>

{{-- Isi Post --}}
<div class="row justify-content-center mt-3">
    <div class="col-lg-8">
        <h1 class="text-center mb-3">
            <strong>
                {{ $post->judul_post }}
            </strong>
        </h1>
        <p class="text-center text-muted mb-3">{{ $post->created_at->diffForHumans() }}</p>
        <div id="container">
            {!! $post->isi_post !!}
        </div>
        <p class="mb-4">
            <strong>Tag:    </strong>
            <a class="fw-semibold text-decoration-none" href="{{ route('search') }}" id="tagLink"
                data-tag="{{ $post->tag }}">
                &nbsp; {{ $post->tag }}
            </a>
        </p>

        {{-- Carousel Related Post berdasarkan tag post --}}
        <div id="relatedPostsCarousel" class="carousel slide my-4" data-bs-ride="carousel">
            <h4 class="mb-4">Topik Terkait:</h4>
            <div class="carousel-inner">
                @foreach($relatedPosts->chunk(3) as $chunk)
                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                        <div class="row">
                            @foreach($chunk as $relatedPost)
                                <div class="col-md-4">
                                    <img src="{{ url('../storage/thumbnails/'. $relatedPost->image) }}"
                                        class="card-img-top m-2" alt="Post Image">
                                    <div class="card-body">
                                        <h5 class="card-title mb-2">{{ $relatedPost->judul_post }}</h5>
                                        <p class="card-text mb-2">{{ $relatedPost->excerpt }}</p>
                                        <a href="{{ route('detailPost', ['id' => $relatedPost->id]) }}">
                                            Lihat Selengkapnya
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#relatedPostsCarousel"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="false"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#relatedPostsCarousel"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="false"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</div>

{{-- Bagian untuk menampilkan pertanyaan --}}
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8 col-xl-8 mt-3">
        @if ($comments != null)
        <h5 class="mb-3">Pertanyaan</h5>
        @foreach ($comments as $comment)
            @if($comment->status != 0)
            <div class="card-footer">
                <div class="card-body d-flex flex-fill">
                    <div class="d-flex flex-start align-items-center">
                        <div>
                            <h6 class="fw-bold text-primary mb-2">{{ $comment->nama}} - {{ $comment->email }}</h6>
                            <p class="text-muted small mb-2">
                                {{ $comment->created_at->diffForHumans() }}
                            </p>

                            <div class="border mb-3" style="border-radius: 5px; background-color: #dbdbdb;">
                                <div class="px-2 py-2">
                                        {{ $comment->isi_comment}}
                                </div>
                            </div>

                            {{-- Bagian untuk menampilkan balasan pertanyaan --}}
                            @foreach ($reply as $rep)
                            <div class="mt-2" style="padding-left: 3em; bg-dark">
                                <h5 class="fw-bold mb-3"><i class="bi-reply"></i> Balasan</h5>
                                <h6 class="text-primary fw-bold mb-2" class="fw-bold mb-1">{{ $rep->nama }}</h6>
                                <p class="text-muted small mb-2">
                                    {{ $rep->created_at->diffForHumans() }}
                                </p>
                                <div class="border" style="border-radius: 5px; background-color: #dbdbdb;">
                                    <div class="px-2 py-2">
                                        {!! strip_tags($rep->isi_balasan) !!}
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @endif
        @endforeach
        @endif

        {{-- Form Pertanyaan --}}
        <div class="card-footer py-3 border-0 mt-3" style="background-color: #f8f9fa;">
            <div>
            <h5 class="mb-3">Tinggalkan Pertanyaan</h5>
                <form action="{{ route('postPertanyaan', ['unit_id' => $post->unit_id, 'id_post' => $post->id]) }}"
                    method="POST" class="row justify-content-center">
                    @csrf
                    <div class="form-group mb-2 col-6">
                        <label class="mb-2" for="nama">Nama</label>
                        <input class="form-control @error('nama') is-invalid @enderror" type="text"
                            name="nama" id="nama" placeholder="Nama" value="{{ old('nama') }}" required>
                        @error('nama')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group mb-2 col-6">
                        <label class="mb-2" for="email">Email</label>
                        <input class="form-control @error('email') is-invalid @enderror" type="email"
                            pattern=".+@(students.uajy.ac.id|uajy.ac.id)"
                            oninput="setCustomValidity('')"
                            oninvalid="this.setCustomValidity('Hanya dapat menggunakan email institusi UAJY!')"
                            name="email" id="email" placeholder="Email institusi UAJY"
                            value="{{ old('email') }}" required>
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group mb-2">
                        <label class="mb-2" for="comment">Pertanyaan</label>
                        <textarea class="form-control @error('comment') is-invalid @enderror" id="comment"
                            name="comment" placeholder="Pertanyaan" oninput="setCustomValidity('')"
                            oninvalid="this.setCustomValidity('Pertanyaan wajib diisi')"
                            value="{{ old('comment') }}" required></textarea>
                        @error('comment')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group mt-3 mb-5">
                        <button class="btn btn-primary btn-sm" type="submit">Ajukan Pertanyaan</button>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>
</div>

{{-- Script untuk membuat tag dapat digunakan untuk search sesuai tag --}}
<script>
    document.getElementById('tagLink').addEventListener('click', function(event) {
        event.preventDefault();
        var tag = this.getAttribute('data-tag');
        document.getElementById('searchInput').value = tag;
        document.getElementById('searchForm').submit();
    });
</script>

@endsection
