<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Followable;
use App\Models\Tweet;
use Illuminate\Support\Facades\Hash;
use App\Models\Comment;
use App\Models\Message;


class User extends Authenticatable
{
    use HasFactory, Notifiable, Followable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'name',
        'avatar',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function getAvatarAttribute($value)
    {
        // return asset($value); 
        return asset($value ? "storage/".$value : '/images/default-avatar.jpg');
        // return "https://i.pravatar.cc/200?u=". $this->email;        
    }
   
    // public function setPasswordAttribute($value) {
    //     return $this->attributes['password'] = becrypt($value);
    //Hash::make($value);
    // }
    public function timeline() {
        // return Tweet::where('user_id', $this->id)->latest()->get();
        // include all of the user's tweets 
        // as well as the tweets of everyone 
        // they follow.. in descending order by date.
        $friends = $this->follows()->pluck('id');
        return Tweet::with(['comments' => function($q) {
            $q->select('id', 'tweet_id', 'user_id','comment');
        }])->whereIn('user_id', $friends)
            ->orWhere('user_id', $this->id)
            // ->withLikes()
            ->orderByDesc('id')
            ->paginate(10);
    }
    public function tweets() {
        return $this->hasMany(Tweet::class)->latest();
    }
    public function path($append = "") {
        $path = route('profile', $this->username);
        return $append ? "{$path}/{$append}" : $path;
    }
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class,'user_id');   
    }
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
