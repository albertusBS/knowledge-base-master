<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use App\Models\Comment;

use Illuminate\Http\Request;

class ReplyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeCommentReply(Request $request, $id) {

        $comment = Comment::findOrFail($id);

        $request->validate([
            'isi_balasan' => 'required'
        ]);

        $replies = new Reply();
        $replies->comment_id = $comment->id;
        $replies->nama = auth()->user()->nama_admin;
        $replies->isi_balasan = $request->isi_balasan;
        $replies->save();

        return redirect()->route('detailPertanyaan', ['id' => $comment->id])
            ->with('success', 'Balasan telah dikirim.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Reply $reply)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reply $reply)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reply $reply)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reply $reply)
    {
        //
    }
}
