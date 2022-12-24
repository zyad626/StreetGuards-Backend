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
            'avatar'
        ];
	}
    public function rules(){
        return [
            "userId" => 'required',
            "userName"=> 'required',
            "email"=> 'required',
            "password"=> 'required',
            "rank"=> 'required',
            "points"=> 'required',
            "badges"=> 'required',
            "reports"=> 'required',
            "avatar"=> 'required'
        ];

    }
}