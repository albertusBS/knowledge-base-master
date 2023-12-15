@extends('layouts.index')

@section('container')

<a class="btn btn-secondary btn-sm mt-3 fw-semibold" href="{{ route('managePertanyaan') }}">
    <i class="bi-arrow-left-circle"></i> Kembali
</a>

<div class="row justify-content-center">
    <div class="col-md-10 col-lg-8 col-xl-8 mt-3">
        <h3 class="text-center mb-3">Detail Pertanyaan</h3>
        <div class="card-body">
            <div>
                <h6 class="text-primary fw-bold mb-2">{{ $comment->nama }} - {{ $comment->email }}</h6>
                <p class="text-muted small mb-3">{{ $comment->created_at->diffForHumans() }}</p>
            </div>

            <div class="border mb-3" style="border-radius: 10px; width: fit-content; background-color: #dbdbdb">
                <div class="px-2 py-2">
                    {{ $comment->isi_comment }}
                </div>
            </div>
        </div>

        @if($reply != null)
        <div class="ps-5 mb-3">
            <h6><i class="bi-reply"></i> Balasan</h6>
            <div>
                <h6 class="text-primary fw-bold mb-2">{{ $reply->nama }}</h6>
                <p class="text-muted small mb-3">{{ $reply->created_at->diffForHumans() }}</p>
            </div>
            <div class="border mb-3" style="border-radius: 10px; width: fit-content; background-color: #dbdbdb">
                <div class="px-2 py-2">
                    {!! strip_tags($reply->isi_balasan) !!}
                </div>
            </div>
        </div>
        @endif

        <div class="justify-content-center">
            <form action="{{ route('postCommentReply', ['id' => $comment->id]) }}" method="POST">
                @csrf
                @method('POST')
                <div class="form-group mt-2">
                    <label class="mb-2 fw-bold" for="isi_balasan">Balas Pertanyaan</label>
                    <textarea class="form-control @error('isi_balasan') is_invalid @enderror"
                        type="text" name="isi_balasan" id="editor">
                    </textarea>
                        @error('isi-balasan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                </div>
                <button class="float-start mt-3 btn btn-primary btn-sm fw-semibold" type="submit">Kirim Balasan</button>
            </form>
        </div>
    </div>
</div>

<script src="{{ asset('../vendor/ckeditor5/build/ckeditor.js') }}"></script>

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
