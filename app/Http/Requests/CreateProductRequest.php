<?php

namespace App\Http\Requests;

class CreateProductRequest extends BaseRequest
{
    
	/**
	 * @return array
	 */
	protected function requestFields() {
        return [
            'id',
            'title',
            'description',
            'price',
            'image',
            'seller',
            'email'
        ];
	}
    public function rules(){
        return [
            "id" => 'required',
            "title"=> 'required',
            "description"=> 'required',
            "price"=> 'required',
            "image"=> 'required',
            "seller"=> 'required',
            "email"=> 'required'
        ];

    }
}