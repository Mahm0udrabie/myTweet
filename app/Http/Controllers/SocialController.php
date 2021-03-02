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
    //    return response() -> json($facebookDate);
    try{
         $user = User::where('email', $facebookDate->email)
         ->orWhere('email',$facebookDate->name."@tweety.com")
         ->firstOrFail();
    } catch (ModelNotFoundException $e) {
     
       $user = User::create([
            "username" => $facebookDate->name,
            "name" => $facebookDate->name,
            "email" => $facebookDate->email ? $facebookDate->email : $facebookDate->name."@tweety.com",
            'password' => Hash::make($facebookDate->name.$facebookDate->email),
            'remember_token' => $facebookDate->token
        ]);
        // dd($create);
    }
        Auth::login($user);
        return redirect("/tweets");
    }
    public function redirectToGitHub() {
        return Socialite::driver('github')->redirect();
    }
    public function handleProviderCallbackGitHub() {
        $data = Socialite::with('github') -> user();
        // dd([$data, $data->user]);
        try{
        $user = User::where('social_id', $data->id)
            ->orWhere('email', $data->email)
            ->orWhere('email',$data->nickname."@tweety.com")
            ->firstOrFail();
       } catch (ModelNotFoundException $e) {
        // dd($data);
          $user = User::create([
              'social_id' => $data->id,
               "username" => $data->nickname,
               "name" => $data->nickname,
               "avatar" => $data->avatar,
               "email" => $data->email ? $data->email : $data->nickname."@tweety.com",
               'password' => Hash::make($data->nickname.$data->email),
               'socialToken' => $data->token,
               'remember_token' => $data->token
           ]);
           // dd($create);
       }
    //    dd($user);
           Auth::login($user);
           return redirect("/tweets");
    }
}
