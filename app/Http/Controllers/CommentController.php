<?php

namespace App\Http\Controllers;

use App\Events\NewNotification;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(CommentRequest $request) {
        // $data = array_merge($request->all(), ["user_id",Auth::id]);
        // dd(request()->all());
        // dd(Auth::user()->name);


        Comment::create([
            "tweet_id" => $request->tweetId,
            "user_id"  => Auth::user()->id,
            "comment"  => $request->comment
        ]);
        

        $data = [
            "user_id"  => Auth::user()->id,
            "user_name" => Auth::user()->name,
            "comment" => $request->comment,
            "tweet_id" =>  $request->tweetId,
        ];
        event(new NewNotification($data));

    //    $comment->create([
    //         'tweet_id' =>$request->tweetId,
    //         'user_id'  => Auth::user()->id,
    //         'comment'  =>$request->comment
    //     ]);
        return back()->with(['success' => 'comment added']);
    } 
}
