@extends('layouts.index')

@section('container')

<h1 class="text-center m-5">Tambah User</h1>

@if(session()->Has('error'))
    <div class="alert alert-danger alert dismissible fade show
        d-flex justify-content-between align-items-center" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<form method="POST" action="{{ route('storeUser') }}">
@csrf
    <div class="mb-3 row">
        <label for="nama_admin" class="col-sm-3 col-form-label">Nama Admin</label>
        <div class="col-sm-4">
            <input type="text" class="form-control @error('nama_admin') is-invalid @enderror" id="nama_admin"
                name="nama_admin" value="{{ old('nama_admin') }}" required>
            @error('nama_admin')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div class="mb-3 row">
        <label for="username" class="col-sm-3 col-form-label">Username</label>
        <div class="col-sm-4">
            <input type="text" class="form-control @error('username') is-invalid @enderror" id="username"
                name="username" value="{{ old('username') }}" pattern=".+@uajy.ac.id"
                oninput="setCustomValidity('')"
                oninvalid="this.setCustomValidity('Hanya dapat menggunakan @uajy.ac.id')"
                placeholder="username@uajy.ac.id" required>
            @error('username')
            <div class="invalid-feedback">
                {{ $message}}
            </div>
            @enderror
        </div>
    </div>
    <div class="mb-3 row">
        <label for="password" class="col-sm-3 col-form-label">Password</label>
        <div class="col-sm-4">
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                name="password" required>
            @error('password')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div class="mb-3 row">
        <label for="password_confirmation" class="col-sm-3 col-form-label">Confirm Password</label>
        <div class="col-sm-4">
            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                id="password_confirmation" name="password_confirmation" required>
            @error('password_confirmation')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <div class="mb-3 row">
        <label for="unit_id" class="col-sm-3 col-form-label">Pilih Parent Unit atau Fakultas</label>
        <div class="col-sm-4">
            <select class="form-select @error('unit_id') is-invalid @enderror"
                id="unit_id" name="unit_id" required>
                <option value="{{ old('unit_id') }}" selected disabled>Pilih parent unit atau fakultas</option>
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
    <div class="mb-3 row">
        <div class="col-sm-7 offset-sm-3">
            <button class="btn btn-primary col-2 m-1" type="submit">Buat User</button>
            <a class="btn btn-danger col-2 m-1" href="{{ route('dashboardAdmin') }}">Batal</a>
        </div>
    </div>
</form>

@endsection
