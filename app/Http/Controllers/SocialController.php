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
       dd($data);
       try{
         $user = User::where('email', $data->email)
         ->orWhere('email',$data->name."@tweety.com")
         ->firstOrFail();
    } catch (ModelNotFoundException $e) {
     
       $user = User::create([
            "username" => $data->name,
            "name" => $data->name,
            "email" => $data->email ? $data->email : $data->name."@tweety.com",
            'password' => Hash::make($data->name.$data->email),
            'remember_token' => $data->token
        ]);
        // dd($create);
    }
        Auth::login($user);
        return redirect("/tweets");
    }
}
