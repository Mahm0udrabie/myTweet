<?php

namespace App\Models;

use App\Likable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\like;

class Tweet extends Model
{
    use HasFactory;
    use Likable;
    protected $fillable  = ['user_id', 'body','media'];
    public function user() {
        return $this-> belongsTo(User::class);
    }
    public function getMediaAttribute($value) {
        return asset($value ? "storage/".$value : '');
    }
}
