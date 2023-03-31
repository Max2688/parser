<?php

namespace App\Http\Controllers;

use App\Post;

class PostController extends Controller
{
    public function index(){
        return view('items',[
            'news' => Post::all()
        ]);
    }

}
