<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\ModelNotFoundException;
class SocialController extends Controller
{
    public function redirect($service) {
        return Socialite::driver($service)->redirect(); 
    }

    public function callback($service) {
       $facebookDate = Socialite::with($service) -> user();
       try{
        $user = User::where('email', $facebookDate->email)->firstOrFail();
    } catch (ModelNotFoundException $e) {
        $user = new User();
        $user->create([
            "username" => $user->name,
            "name" => $user->name,
            "avatar" => $user->avatar,
            "email" => $user->email,
            'password' => Hash::make($user->name.$user->email),
            'remember_token' => $user->token
        ]);
        // dd($create);
    }
        Auth::login($user);

        return view("tweets.index");

    }
}
