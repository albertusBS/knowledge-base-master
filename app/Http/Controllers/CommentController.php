<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;

use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    //Fungsi untuk menampilkan halaman pertanyaan
    public function indexManageComment() {

        $userUnitId = auth()->user()->unit_id;

        if($userUnitId === 'admin') {
            $comments = $this->getAllComments();
        }
        else {
            $comments = $this->getCommentsByUnit($userUnitId);
        }

        return view('pertanyaan.index', [
            'comments' => $comments
        ]);
    }

    // Fungsi untuk untuk menyimpan komentar dari user publik
    public function storePublicUserComment(Request $request, $unit_id, $id_post) {

        $post = Post::findOrFail($id_post);

        $request->validate([
            'nama' => 'required',
            'email' => 'required|regex:/^.+@(students\.)?uajy\.ac\.id$/i',
            'comment' => 'required'
        ]);

        $comment = new Comment();
        $comment->post_id = $post->id;
        $comment->nama = $request->nama;
        $comment->email = $request->email;
        $comment->isi_comment = $request->comment;
        $comment->save();

        return redirect()->route('showPost', ['id_post' => $post->id, 'unit_id' => $unit_id])
            ->with('success', 'Terima kasih, silahkan menunggu respon.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id) {

        $comment = Comment::findOrFail($id);

        $comment->load('post.unit');
        $reply = Reply::where('comment_id', $comment->id)->first();

        return view('pertanyaan.detailPertanyaan', [
            'comment' => $comment,
            'reply' => $reply
        ]);
    }

    // Fungsi untuk menghapus komentar dari user publik
    public function destroy($id) {

        $comment = Comment::findOrFail($id);

        $comment->delete();

        return redirect()->route('managePertanyaan')->with('success', 'Pertanyaan berhasil dihapus');
    }

    public function changeStatusTampil($id) {

        $comment = Comment::findOrFail($id);

        if($comment->status == 1) {
            $comment->update([
                $comment->status = 0
            ]);

            return redirect()->route('managePertanyaan')->with('success', 'Status pertanyaan berhasil diubah.');
        }
        else {
            $comment->update([
                $comment->status = 1
            ]);

            return redirect()->route('managePertanyaan')->with('success', 'Status pertanyaan berhasil diubah');
        }
    }

    protected function getAllComments() {

        return Comment::all();
    }

    protected function getCommentsByUnit($unitId) {

        return Comment::whereHas('post.unit',
            function($query) use ($unitId) {
                $query->where('id_unit', $unitId);
        })->get();
    }
}
