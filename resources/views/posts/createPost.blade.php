@extends('layouts.index')

@section('container')

<h1 class="text-center m-4">Buat Post</h1>

@if(session()->Has('error'))
    <div class="alert alert-danger alert dismissible fade show
        d-flex justify-content-between align-items-center" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<form class="col" method="POST" action="{{ route('storePost') }}" enctype="multipart/form-data">
    @csrf
    <div class="col-sm-6 mb-3">
        <label for="judul_post" class="form-label">Judul Post</label>
        <input type="text" class="form-control col-5 @error('judul_post') is-invalid @enderror" id="judul_post"
            name="judul_post" placeholder="Judul Post"></input>
        @error('judul_post')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="col-sm-6 mb-3">
        <label for="image" class="form-label">Thumbnail</label>
        <input class="form-control @error('image') is-invalid @enderror"
            accept="image/*" type="file" id="image" name="image" onchange="showPreview(event)">
        @error('image')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="mb-3">
        <img id="imagePreview" alt="Image"
            style="max-width: 50%; height: auto;">
    </div>

    <div class="col-sm-6 mb-3">
        <label class="form-label" for="isi_post">Isi Post</label>
        <textarea class="form-control @error('isi_post') is-invalid @enderror"
            type="text" name="isi_post" id="editor"></textarea>
        @error('isi_post')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="col-sm-6 mb-3">
        <label for="tags" class="form-label">Tags</label>
        <input class="form-control @error('tags') is-invalid @enderror"
            type="text" id="tags" name="tags">
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
                    <option value="" selected disabled>Pilih parent unit atau fakultas</option>
                    @foreach ($units as $unit)
                    @if($unit->id_unit != 'admin')
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

    <a class="btn btn-danger mb-4 me-2" href="{{ route('dashboardUnit') }}">
        <i class="bi-arrow-left"> Kembali</i>
    </a>
    <button class="btn btn-primary mb-4" type="submit">
        <i class="bi-check2"> Buat Post</i>
    </button>
</form>

<script src="{{ url('vendor/ckeditor5/build/ckeditor.js')}}"></script>

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

<script>
    const fileInput = document.getElementById('image');
    const previewImage = document.getElementById('imagePreview');

    fileInput.addEventListener('change', event => {
        if(event.target.files.length > 0) {
            previewImage.src = URL.createObjectURL(event.target.files[0]);
            previewImage.style.display = 'block';
        }
    });
    // function showPreview(event) {
    //     if(event.target.files.length > 0) {
    //         var src = URL.createObjectURL(event.target.files[0]);
    //         var preview = document.getElementById('imagePreview');
    //         preview.src = src;
    // //        preview.style.display = "block";
    //     }
    // }
</script>
@endsection
