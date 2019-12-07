<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateIncidentRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'date' => 'required',
            'location' => 'required',
            'type' => 'required'
            
        ];
    }

    public function requestFields()
    {
        return [
            'date',
            'location',
            'type',
            
            //Accident
            'number_of_vehicles',
            'number_of_bikes',
            'number_of_pedesterians',
            'type_of_collision',
            'number_of_injuries',
            'number_of_fatalities',
            'purpose_of_trip',
            'reporter_involved',

            //Hazard
            'collision_type',
            'type_of_collider',

            //General
            'road_type',
            'road_surface_condition',
            'weather',
            'description',
        ];
    }
}
