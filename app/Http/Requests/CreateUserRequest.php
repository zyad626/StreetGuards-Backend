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
            'password' => ['required', 'min:8', 'max:50', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[_@$!%*?&])[A-Za-z\d_@$!%*?&]+$/'],
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
    public function messages()
{
    return [
        'password.regex' => 'The password must include at least one uppercase letter, one lowercase letter, one number, and one special character.'
    ];
}
}