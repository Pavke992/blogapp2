<?php

namespace App\Http\Controllers;

use App\Mail\CreatePostMail;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::paginate(3);
        return view('pages.posts', compact('posts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect('createpost')->withErrors('Only authenticated users can create post');
        }

        $user = Auth::user();

        $request->validate([
            'title' => 'required|string|min:5|max:255',
            'body' => 'required|string|min:10|max:5000',
        ]);

        $post = Post::create([
            'title' => $request->title,
            'body' => $request->body,
            'body' => $request->body,
            'user_id' => $user->id,
        ]);
        $mailData = $post->only('title', 'body');
        Mail::to($user->email)->send(new CreatePostMail($mailData));

        return redirect('createpost')->with('status', 'Post successfully created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::where('id', $id)
            ->with('user')
            ->first();
        $post->comments = Comment::paginate(2);
        return view('pages.post', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function createPost()
    {
        if (Auth::check() && Auth::user()->isAdmin) {
            return view('pages.createpost');
        }
        return redirect('/');
    }
}
