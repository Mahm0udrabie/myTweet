<?php

namespace App\Models;
use App\Models\Tweet;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = ['tweet_id', 'user_id', 'comment'];
    // public $guard = [];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tweets(){
        return $this->belongsTo(Tweet::class);
    }
}
