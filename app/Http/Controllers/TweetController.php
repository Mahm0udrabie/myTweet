<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\Request;
class TweetController extends Controller
{
    public function index()
    {
        // $tweets = Tweet::latest()->get();
        return view('tweets.index', [
            'tweets' => auth() ->user() ->timeline()
        ]);
    }
    public function store() {
        // dd(request()->all());
        $attributes = request() -> validate([
            'body'  => "required|max:255",
            'media' => 'file'
        ]);
        
        Tweet::create([
                'user_id' => auth() -> user()-> id,
                'body'    => $attributes['body'],
                'media'   => request('media') ? request('media')->store('media') : NULL,
        ]);
        return redirect("/tweets");
    }
}
