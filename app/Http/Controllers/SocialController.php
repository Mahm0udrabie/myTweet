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
       $data = Socialite::with($service)->user();
    //    dd($data);
       try{
         $user = User::where('email', $data->email)
         ->orWhere('social_id', $data->id)
         ->orWhere('email',$data->name ? $data->name : $data->nickname."@tweety.com")
         ->firstOrFail();
    } catch (ModelNotFoundException $e) {
     
       $user = User::create([
            "username" => $data->name ? $data->name : $data->nickname,
            "name" => $data->name ? $data->name : $data->nickname,
            "avatar" => $data->avatar,
            "email" => $data->email ? $data->email : ($data->name ? $data->name : $data->nickname."@tweety.com"),
            'password' => Hash::make($data->name? $data->name.$data->email: $data->nickname.$data->email),
            'socialToken' => $data->token,
            // 'remember_token' => $data->token
        ]);
        // dd($create);
    }
        Auth::login($user);
        return redirect("/tweets");
    }
}
