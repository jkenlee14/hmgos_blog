<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;

class PagesController extends Controller
{
    public function index(){
    	$carousels = Post::orderByRaw('RAND()')->take(3)->get();
    	$posts = Post::orderBy('created_at', 'desc')->paginate(6);
    	return view('pages.index')->with('posts', $posts)->with('carousels', $carousels);
    }

    public function about(){
    	return view('pages.aboutus');
    }
}
