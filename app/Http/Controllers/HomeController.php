<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Unit;
use App\Models\Reply;
use App\Models\Comment;

use Illuminate\Http\Request;

class HomeController extends Controller {

    public function showPostsUnit($id) {

        $unit = Unit::findOrFail($id);
        $posts = Post::where('unit_id', $unit->id_unit)->get();

        return view('home.postUnit', [
            'unit' => $unit,
            'posts' => $posts
        ]);
    }

    public function show($unit_id, $id) {

        $post = Post::where('unit_id', $unit_id)->findOrFail($id);
    //    $base64ImageData = $post->isi_post;
        $comments = Comment::where('post_id', $post->id)->get();
        $relatedPosts = Post::where('tag',  $post->tag)
            ->where('id', '!=', $post->id)->get();

        $reply = Reply::whereIn('comment_id', $comments->pluck('id')->toArray())->get();

        return view('home.detailPost', [
            'post'=> $post,
            'comments' => $comments,
            'reply' => $reply,
            'relatedPosts' => $relatedPosts,
    //        'base64ImageData' => $base64ImageData
    //        dd($relatedPosts, $post)
        ]);
    }

    public function search(Request $request) {

        $keyword = $request->input('keyword');
        $searchResults = [];

        if($keyword) {
            $searchResults = Post::where('judul_post', 'like', "%$keyword%")
                ->orWhere('isi_post', 'like', "%$keyword%")
                ->orWhere('tag', 'like', "%$keyword%")
                ->get();
        }

        if($request->ajax()) {
            return response()->json($searchResults);
        }

        return view('home.welcome', [
            'searchResults' => $searchResults,
            'keyword' => $keyword
        ]);
    }
}
