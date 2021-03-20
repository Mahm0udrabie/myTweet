<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use App\Models\User;
use App\Models\Like;

trait Likable
{
    public function scopeWithLikes(Builder $query)
    {
        // if(env('app_env','local')) {
        #########################################################
            ###############****************###########
            ###############* LOCALHOST   *##########
            ###############*****************##########
            ###############****************##########
        ########################################################

            // $query->leftJoinSub(
            //     'select tweet_id, sum(liked) likes, sum(!liked) dislikes from likes group by tweet_id',
            //     'likes',
            //     'likes.tweet_id',
            //     'tweets.id'
            // );   

        // } else {
        // #########################################################
        //     ###############****************###########
        //     ###############* PRODUCTION   *##########
        //     ###############*****************##########
        //     ###############****************##########
        // ########################################################
          $query->leftJoinSub(
            'select
              tweet_id,
              count(liked) filter (where liked = true) as likes,
              count(liked) filter (where liked = false) as dislikes
            from likes
            group by tweet_id',
            'likes',
            'likes.tweet_id',
            'tweets.id'
          );
        // }
    }

    public function isLikedBy(User $user)
    {

        return (bool) $user->likes
            ->where('tweet_id', $this->id)
            ->where('liked', true)
            ->count();
    }

    public function isDislikedBy(User $user)
    {
        return (bool) $user->likes
            ->where('tweet_id', $this->id)
            ->where('liked', false)
            ->count();
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function dislike($user = null)
    {
        return $this->like($user, false);
    }

    public function like($user = null, $liked = true)
    {
        $this->likes()->updateOrCreate(
            [
                'user_id' => $user ? $user->id : auth()->id(),
            ],
            [
                'liked' => $liked,
            ]
        );
    }
}
