<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class SocialController extends Controller
{
    public function redirect($service) {
        return Socialite::driver($service)->redirect(); 
    }

    public function callback($service) {
       $user = Socialite::with($service) -> user();
    //    $user =
    //    [
    //    "name"=>"Mahmoud",
    //    "avatar"=>"https:\/\/graph.facebook.com\/v3.3\/3582631791835701\/picture?type=normal",
    //    "name"=>"Mahmoud",
    //    "email"=>"mahmoudrabie401@yahoo.com",
    //    "avatar_original"=>"https:\/\/graph.facebook.com\/v3.3\/3582631791835701\/picture?width=1920",
    //     "profileUrl"=>null];
        $create = User::create([
            "username" => $user->name,
            "name" => $user->name,
            "avatar" => $user->avatar,
            "email" => $user->email,
            'password' => Hash::make($user->name.$user->email),
            'remember_token' => $user->token
        ]);
        // dd($create);

       return response()->json($create);

    }
}
