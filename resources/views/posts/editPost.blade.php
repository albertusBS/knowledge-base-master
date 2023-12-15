@extends('layouts.index')

@section('container')

<h1 class="text-center m-4">Edit Post</h1>

@if(session()->Has('error'))
    <div class="alert alert-danger alert dismissible fade show
        d-flex justify-content-between align-items-center" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<form class="col" method="POST" action="{{ route('updatePost', ['id' => $post->id]) }}">
    @csrf
    @method('PUT')
    <div class="col-sm-6 mb-3">
        <label for="judul_post" class="form-label">Judul Post</label>
        <input type="text" class="form-control col-5 @error('judul_post') is-invalid @enderror"
            id="judul_post" name="judul_post" placeholder="Judul Post" value="{{ $post->judul_post }}">
        </input>

        @error('judul_post')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    {{-- <input type="hidden" name="slug" id="slug"></input> --}}

    <div class="col-sm-6 mb-3">
        <label class="form-label" for="isi_post">Isi Post</label>
        <textarea class="form-control @error('isi_post') is-invalid @enderror"
        type="text" name="isi_post" id="editor">{!! $post->isi_post !!}
    </textarea>
        @error('isi_post')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="col-sm-6 mb-3">
        <label for="tags" class="form-label">Tags</label>
        <input class="form-control @error('tags') is-invalid @enderror"
            type="text" id="tags" name="tags" value="{{ $post->tag }}">
        @error('tags')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    @can('isAdminKSI')
    <div class="col-sm-6 mb-3">
        <label class="form-label" for="unit_id">Pilih Unit atau Fakultas</label>
        <div>
            <select class="form-select @error('unit_id') is-invalid @enderror" name="unit_id" id="unit_id">
                <option value="{{ $post->unit_id }}">{{ $post->unit->nama_unit }}</option>
                @foreach ($units as $unit)
                @if($unit->id_unit != 'admin' && $unit->id_unit != $post->unit_id)
                    <option value="{{ $unit->id_unit }}">{{ $unit->nama_unit }}</option>
                @endif
                @endforeach
            </select>
            @error('unit_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    @endcan

    <button class="btn btn-primary mb-4">Buat Post</button>
</form>

<script src="{{ url('../vendor/ckeditor5/build/ckeditor.js') }}"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        ClassicEditor
            .create(document.querySelector('#editor'))
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });
    });
</script>

@endsection
