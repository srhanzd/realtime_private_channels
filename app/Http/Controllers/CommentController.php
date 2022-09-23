<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Events\NewComment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class CommentController extends Controller
{
//    public function index(Post $post){
//
//        $comments=$post->comments()->with('user')->latest()->get();
//
//        return view('posts.show')->with(['comments'=>$comments,'post'=>$post]);
//
//    }
    public function store(Request $request,Post $post){
        try {
            $this->validate($request, [
                'body' => 'required',
            ]);
        } catch (ValidationException $e) {
            return 'body is required';
        }
        $comment=$post->comments()->create([
            'body'=>$request->body,
            'user_id'=>Auth::id()
        ]);
        $comments=$post->comments()->with('user')->latest()->get();
//        return $comment->toJson();
        $data=[
            'post_id'=>$post->id,
            'user_id'=>Auth::id(),
            'user_name'=>Auth::user()->name,
            'comment'=>$comment
        ]
        ;
//        return $data;
        event(new NewComment($data));
        return redirect()->back()->with(['comments'=>$comments,'post'=>$post]);

    }
}
