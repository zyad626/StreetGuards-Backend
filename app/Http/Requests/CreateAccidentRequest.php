<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAccidentRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            
        ];
    }

    public function requestFields()
    {
        return [
            'date',
            'location',
            'type',
            'road_type',
            'road_surface_condition',
            'weather',
            'description',
            'files',
            'number_of_veicles',
            'number_of_bikes',
            'number_of_pedesterians',
            'purpose_of_trip',
            'type_of_collision',
            'number_of_injuries',
            'number_of_fatalities',
            'purpose_of_trip',
            'reporter',
        ];
    }
}
