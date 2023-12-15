@extends('layouts.index')

@section('container')

<h1 class="text-center m-4">Update User</h1>

@if(session()->Has('error'))
    <div class="alert alert-success alert dismissible fade show
        d-flex justify-content-between align-items-center" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<form method="POST" action="{{ route('updateUser', ['id' => $id]) }}">
    @csrf
    @method('PUT')
    <div class="mb-3 row">
        <label for="nama_admin" class="col-sm-2 col-form-label">Nama Admin</label>
        <div class="col-sm-4">
            <input type="text" class="form-control @error('nama_admin') is-invalid @enderror" id="nama_admin"
                name="nama_admin" placeholder="Nama Baru" value="{{ old('nama_admin') }}" required>
            @error('nama_admin')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <div class="mb-3 row">
        <label for="username" class="col-sm-2 col-form-label">Username</label>
        <div class="col-sm-4">
            <input type="text" class="form-control @error('username') is-invalid @enderror" id="username"
                    name="username" placeholder="New Username" value="{{ old('username') }}" required>
            @error('username')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <div class="mb-3 row">
        <div class="col-sm-7 offset-sm-2">
            <button class="btn btn-primary m-1" type="submit">Update User</button>
        </div>
    </div>
</form>
@endsection
