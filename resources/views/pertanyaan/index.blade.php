@extends('layouts.index')

@section('container')

<h1 class="text-center m-4">Daftar Pertanyaan</h1>
<table class="table mt-4 border border-2 border-dark-subtle" style="text-align: center">
    <thead class="bg-info">
        <th scope="col">Nomor</th>
        <th scope="col">Nama</th>
        <th scope="col">Pertanyaan</th>
        <th scope="col">Tanggal</th>
        <th scope="col">Status Tampil</th>
        <th scope="col">Actions</th>
    </thead>
    <tbody>
        @foreach($comments as $comment)
            <tr class="align-middle">
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $comment->nama }}</td>
                <td>{{ $comment->isi_comment }}</td>
                <td>{{ $comment->created_at->diffForHumans() }}</td>
                <td>
                    <form action="{{ route('changeStatusPertanyaan', $comment->id) }}">
                        @csrf
                            @if ($comment->status == 1)
                                <button class="btn btn-success btn-sm fw-semibold col-6">
                                    <i class="bi-check-square"></i> Tampil
                                </button>
                            @else
                                <button class="btn btn-danger btn-sm fw-semibold col-6">
                                    <i class="bi-x-square"></i> Tidak Tampil
                                </button>
                        @endif
                    </form>
                </td>
                <td>
                    <a class="btn btn-secondary btn-sm fw-semibold m-1"
                        href="{{ route('detailPertanyaan', ['id' => $comment->id]) }}">
                        <i class="bi-info-square"></i> Detail
                    </a>
                    <form action="{{ route('hapusPertanyaan', ['id' => $comment->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm fw-semibold m-1">
                            <i class="bi-trash"></i> Hapus
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
