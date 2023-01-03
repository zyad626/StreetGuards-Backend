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
            'image_url',
            'seller_id',
        ];
	}
    public function rules(){
        return [
            "id" => 'required',
            "title"=> 'required',
            "description"=> 'required',
            "price"=> 'required',
            "image_url"=> 'required',
            "seller_id"=> 'required',
        ];

    }
}