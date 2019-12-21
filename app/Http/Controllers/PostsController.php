<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PostsController extends Controller {
    /**
     * protect all routes defined in $this 
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * get //
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * save a post to the posts table
     */
    public function store() {
        $data = request()->validate([
            'caption' => 'required',
            'image' => ['required', 'image']
        ]);
        
        //save to uploads directly to ('folder', 'driver')
        $imagePath = request('image')->store('uploads', 'public');
        
        //fit image with intervention package
        $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200, 1200);
        $image -> save();

        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imagePath
        ]);

        return redirect('/profile/'.auth()->user()->id);
    }

    /**
     * display a particular post
     */
     public function show(\App\Post $post) {
        // return view('posts.show', [
        //     'post'=> $post
        // ]);

        return view('posts.show', compact('post'));
        dd($post);
     }

     /**
      * display all posts by users
      */
     public function index() {
        $users = auth()->user()->following()->pluck('profiles.user_id');
        // $post = Post::whereIn('user_id', $users)->orderBy('created_at', 'DESC')->get();
        // with('user') => load the user models too without limiting
        $posts = Post::whereIn('user_id', $users)->with('user')->latest()->paginate(5);
        
        return view('posts.indexposts', compact('posts'));
     } 
}
