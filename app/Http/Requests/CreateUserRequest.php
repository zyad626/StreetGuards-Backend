<?php

namespace App\Http\Requests;

class CreateUserRequest extends BaseRequest
{
    
	/**
	 * @return array
	 */
	protected function requestFields() {
        return [
            'userId',
            'userName',
            'email',
            'password',
            'rank',
            'rating',
            'points',
            'badges',
            'reports',
            'avatar',
            'products'
        ];
	}
    public function rules(){
        return [
            'userId'=> 'required',
            'password'=>'required',
            'name'=> 'required',
            'email'=> 'required|email',
            'gender'=> 'required',
            'isExpert'=> 'required',
            'isTransportationExpert'=> 'required',
            // 'date'=> 'required',
            'birthDate'=> 'required',
            'profession'=> 'required',
            'carOwnership'=> 'required',
            'drivingExperience'=> 'required',
            'avatar'=> 'required',
            'badges'=> 'required',
            'rank'=> 'required',
            'rating'=> 'required',
            'points'=> 'required',
            'products'=> 'sometimes',
            'favProductsList'=> 'sometimes',
        ];

    }
}