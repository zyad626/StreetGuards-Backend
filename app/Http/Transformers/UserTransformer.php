<?php
namespace App\Http\Transformers;

use App\Models\User_new;

class UserTransformer extends AbstractTransformer
{
    public function transform(User_new $user)
    {
        return [
            'userId' => $user->userId,
            'name' => $user->name,
            'email' => $user->email,
            'password' => $user->password,
            'rank' => $user->rank,
            'rating' => $user->rating,
            'points' => $user->points,
            'badges'=> $user->badges,
            'reports'=> $user->reports,
            'avatar'=>$user->avatar,
            'products' => $user->products,
            'gender'=> $user->gender,
            'isExpert'=> $user->isExpert,
            'isTransportationExpert'=> $user->isTransportationExpert,
            'date'=> $user->date,
            'birthDate'=> $user->birthDate,
            'profession'=> $user->profession,
            'carOwnership'=> $user->carOwnership,
            'drivingExperience'=> $user->drivingExperience,
            'favProductsList'=> $user->favProductsList
        ];
    }
}
