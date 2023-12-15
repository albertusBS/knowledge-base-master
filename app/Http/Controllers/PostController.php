<?php

namespace App\Http\Controllers;

use App\Models\Post;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {

        $user = auth()->user();

        if($user->unit_id === 'admin') {

            $posts = Post::all();
        }
        else {
            $posts = DB::table('posts')->where('unit_id', $user->unit->id_unit)->get();
        }

        return view('posts.index', [
            'posts' => $posts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {

        $units = DB::table('units')->get();

        return view('posts.createPost', [
            'units' => $units
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {

        if(auth()->user()->unit_id != 'admin') {
            $unit_id = auth()->user()->unit_id;
        }
        else {
            $unit_id = $request->unit_id;
        }

        $request->validate([
            'judul_post' => 'required',
            'image' => 'required|max:1024|image|mimes:jpg,png,jpeg',
            'isi_post' => 'required',
            'tags' => 'required|string'
        ]);

        $excerpt = $this->generateExcerpt($request->isi_post);

        $imageName = time() . '_' . $request->image->getClientOriginalName();
        $request->file('image')->storeAs('thumbnails', $imageName, 'public');

        $post = new Post();
        $post->judul_post = $request->judul_post;
        $post->image = $imageName;
        $post->excerpt = $excerpt;
        $post->isi_post = $request->isi_post;
        $post->tag = $request->tags;
        $post->unit_id = $unit_id;
        $post->save();

        return redirect()->route('dashboardUnit')
            ->with('success', 'Post Berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show($id) {

        $post = Post::findOrFail($id);

        return view('posts.detailPost', [
            'post' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id) {

        $post = Post::with('unit')->findOrFail($id);
        $units = DB::table('units')->get();

        return view('posts.editPost', [
            'post' => $post,
            'units' => $units
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {

        $post = Post::findOrFail($id);

        $request->validate([
            'judul_post' => 'required',
            'isi_post' => 'required',
            'tags' => 'required'
        ]);

        $excerpt = $this->generateExcerpt($request->isi_post);

        $post->update([
            'judul_post' => $request->judul_post,
            'excerpt' => $excerpt,
            'isi_post' => $request->isi_post,
            'tag' => $request->tags
        ]);

        return redirect()->route('dashboardUnit')
            ->with('success', 'Post berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {

        $post = Post::findOrFail($id);

        $post->delete();

        return redirect()->route('dashboardUnit')->with('success', 'Post berhasil dihapus');
    }

    // Fungsi untuk generate excerpt
    public function generateExcerpt($content, $limit = 50, $end = '...') {

        return Str::limit(strip_tags($content), $limit, $end);
    }

}
