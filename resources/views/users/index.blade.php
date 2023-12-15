@extends('layouts.index')

@section('container')

<h2 class="text-center mt-3">Daftar User</h2>

@if(session()->Has('success'))
    <div class="alert alert-success alert dismissible fade show
        d-flex justify-content-between align-items-center" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="mt-3 mb-3">
    <a class="btn btn-secondary" type="button" href="{{ route('indexCreateUser') }}">
        <i class="bi-person-plus"></i> Tambah user
    </a>
</div>

<div class="mt-3 mb-3 col-sm-2">
    <form class="input-group mb-3" action="{{ route('searchUser') }}" method="GET">
        <input class="form-control" type="text" name="search" id="search" placeholder="Search User">
        <button class="input-group-text">
            <i class="bi bi-search"></i>
        </button>
    </form>
</div>

<table class="table table-striped-columns mt-4 border-dark-subtle" style="text-align: center">
    <thead class="bg-info">
        <th class="col-1" scope="col">Nomor</th>
        <th class="col-2" scope="col">Nama Admin</th>
        <th class="col-1" scope="col">Username</th>
        <th class="col-2" scope="col">Unit atau Fakultas</th>
        <th class="col-1" scope="col">Status</th>
        <th class="col-2" scope="col">Actions</th>
    </thead>
    <tbody>
        @if(isset($searchResults))
            @if(count($searchResults) > 0)
            @foreach ($searchResults as $result)
            <tr class="align-middle">
                <th scope="row"> {{ $loop->iteration }} </th>
                <td> {{ $result->nama_admin }} </td>
                <td> {{ $result->username }} </td>
                <td> {{ optional($result->unit)->nama_unit}} </td>
                <td>
                    <form>
                    @csrf
                        @if ($result->status == 1)
                            <a class="btn btn-sm btn-success fw-semibold col-11 m-2"
                                href="{{ route('changeUserStatus', $result->id) }}">
                                <i class="bi-person-check"></i> Aktif
                            </a>
                        @else
                            <a class="btn btn-sm btn-danger fw-semibold col-11 m-2"
                                href="{{ route('changeUserStatus', $result->id) }}">
                                <i class="bi-person-lock"></i> Nonaktif
                            </a>
                        @endif
                    </form>
                </td>
                <td>
                    <a class="btn btn-sm text-light fw-semibold" style="background-color: darkorange"
                        href="{{ route('indexEditUser', ['id' => $result->id]) }}">
                        <i class="bi-pencil-square"></i> Edit User
                    </a>
                    <a class="btn btn-sm text-light fw-semibold" style="background-color:dodgerblue"
                        href="{{ route('indexEditPassword', ['id' => $result->id]) }}">
                        <i class="bi-pencil-square"></i> Edit Password
                    </a>
                </td>
            </tr>
            @endforeach
            @else
            <div class="justify-content-center mt-3">
                <h3 class="text-center fw-semibold">User tidak ditemukan</h3>
            </div>
            @endif
        @else
            @foreach ($users as $user)
            @if($user != 'admin KSI')
                <tr class="align-middle">
                    <th scope="row"> {{ $loop->iteration }} </th>
                    <td> {{ $user->nama_admin }} </td>
                    <td> {{ $user->username }} </td>
                    <td> {{ optional($user->unit)->nama_unit}} </td>
                    <td>
                        <form>
                        @csrf
                            @if ($user->status == 1)
                                <a class="btn btn-sm btn-success fw-semibold col-11 m-2"
                                    href="{{ route('changeUserStatus', $user->id) }}">
                                <i class="bi-person-check"></i> Aktif
                            </a>
                            @else
                                <a class="btn btn-sm btn-danger fw-semibold col-11 m-2"
                                    href="{{ route('changeUserStatus', $user->id) }}">
                                <i class="bi-person-lock"></i> Nonaktif
                            </a>
                            @endif
                        </form>
                    </td>
                    <td>
                        <a class="btn btn-sm text-light fw-semibold m-1" style="background-color: darkorange"
                            href="{{ route('indexEditUser', ['id' => $user->id]) }}">
                            <i class="bi-pencil-square"></i> Edit User
                        </a>
                        <a class="btn btn-sm text-light fw-semibold m-1" style="background-color:dodgerblue"
                            href="{{ route('indexEditPassword', ['id' => $user->id]) }}">
                            <i class="bi-pencil-square"></i> Edit Password
                        </a>
                    </td>
                </tr>
            @endif
            @endforeach
        @endif
    </tbody>
</table>

@endsection
