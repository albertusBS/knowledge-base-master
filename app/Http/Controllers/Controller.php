<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Post;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController {

    use AuthorizesRequests, ValidatesRequests;

    public function index() {

        $units = Unit::all();
        $posts = Post::all();

        return view('home.welcome', [
            'units' => $units,
            'posts' => $posts
        ]);
    }

}
