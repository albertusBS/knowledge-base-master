@extends('layouts.index')

@section('container')
{{-- @include('sweetalert::alert') --}}

<h1 class="text-center mt-4 mb-5"> Knowledge Base</h1>

@if(session()->Has('success'))
    <div class="alert alert-success alert dismissible fade show
        d-flex justify-content-between align-items-center" role="alert">
        <strong>{{ session('success') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session()->Has('warning'))
    <div class="alert alert-warning alert dismissible fade show
        d-flex justify-content-between align-items-center" role="alert">
        <strong>{{ session('warning') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session()->Has('error'))
    <div class="alert alert-danger alert dismissible fade show
        d-flex justify-content-between align-items-center" role="alert">
        <strong>{{ session('error') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="row justify-content-center">
    <div class="col-sm-3">
        <div class="container my-3">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <img class="d-block img-thumbnail border-0 p-3"
                    src="../image/Logo.png" alt="Logo">

                <h4 class="mb-3 text-center">
                    Universitas
                    <br>Atma Jaya Yogyakarta</br>
                </h4>

                <div class="mb-3">
                    <label class="form-label" for="username">Username</label>
                    <input class="form-control col-5" type="email" name="username"
                        id="username" @error('username') is-invalid @enderror
                        pattern=".+@uajy.ac.id" oninput="setCustomValidity('')"
                        oninput="this.setCustomValidity('Username yang anda masukkan tidak sesuai')"
                        placeholder="name@uajy.ac.id" value="{{ old('username') }}" autofocus required>
                        @error('username')
                            <div class="invalid-message">
                                {{ $message }}
                            </div>
                        @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="password">Password</label>
                    <input class="form-control col-5 @error('password') is-invalid @enderror" type="password"
                        name="password" id="password" placeholder="Password" required>
                    @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="d-grid">
                    <button class="btn btn-primary my-3 fw-semibold" type="submit">
                        <i class="bi-box-arrow-in-right"></i> Login
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
