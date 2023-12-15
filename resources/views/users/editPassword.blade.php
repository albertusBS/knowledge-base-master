@extends('layouts.index')

@section('container')

<h1 class="text-center m-4">Update Password</h1>

@if(session()->Has('error'))
    <div class="alert alert-danger alert dismissible fade show
        d-flex justify-content-between align-items-center" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<form method="POST" action="{{ route('updatePassword', ['id' => $id]) }}">
@csrf
@method('PUT')
    <div class="mb-3 row">
        <label for="new_password" class="col-sm-2 col-form-label">New Password</label>
        <div class="col-sm-4">
            <input type="password" class="form-control @error('new_password') is-invalid @enderror" id="new_password"
                name="new_password" placeholder="New Password" required>
            @error('new_password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <div class="mb-3 row">
        <label for="new_password_confirmation" class="col-sm-2 col-form-label">Confirm Password</label>
        <div class="col-sm-4">
            <input type="password" class="form-control @error('new_password_confirmation') is-invalid @enderror"
                id="new_password_confirmation" name="new_password_confirmation"
                placeholder="Confirm Password" required>
            @error('new_password_confirmation')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <div class="mb-3 row">
        <div class="col-sm-7 offset-sm-2">
            <button class="btn btn-primary m-1" type="submit">Update Password</button>
        </div>
    </div>
</form>

@endsection
