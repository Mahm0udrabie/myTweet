<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rule;
class ProfilesController extends Controller
{
    public function show(User $user)
     {
        return view("profiles.show",[
            'user' => $user,
            'tweets' => $user->tweets()->withLikes()->paginate(2)
        ]);
    }
    public function edit(User $user) {
        // if($user->isNot(current_user())) {
        //     abort(404);
        // }
        // $this->authorize('edit', $user);
        return view("profiles.edit", compact('user'));
}
    public function update(User $user) {
        $attributes = request()->validate([
            "username" => [
                "string",
                "required",
                "max:255",
                "alpha_dash",
                Rule::unique('users')->ignore($user)
            ],
            "name" => ["string","required","max:255"],
            "avatar" => ['file'],
            "email" => [
                'string',
                "required",
                "email",
                'max:255',
                Rule::unique('users')->ignore($user)
            ],
            "password" => ['required',"string","min:8","max:255", "confirmed"]
        ]);
        // dd(request('avatar')->store('avatars'));
        if(request('avatar')) {
            $attributes['avatar'] = request('avatar')->store('avatars');
            $attributes['avatar'] = "storage/".$attributes['avatar'];
        }

    $user->update($attributes);
    return redirect($user->path());
    }
}