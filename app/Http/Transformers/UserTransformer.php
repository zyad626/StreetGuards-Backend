<?php
namespace App\Http\Transformers;

use App\Models\User_new;

class UserTransformer extends AbstractTransformer
{
    public function transform(User_new $user)
    {
        return [
            'userId' => $user->userId,
            'userName' => $user->userName,
            'email' => $user->email,
            'password' => $user->password,
            'rank' => $user->rank,
            'rating' => $user->rating,
            'points' => $user->points,
            'badges'=> $user->badges,
            'reports'=> $user->reports,
            'avatar'=>$user->avatar
        ];
    }
}
