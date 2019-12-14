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
            'type' => 'required',
            
            //Accident
            'number_of_vehicles' => "required_if:type,accident|integer|nullable",
            'number_of_bikes' => "required_if:type,accident|integer|nullable",
            'number_of_pedesterians' => "required_if:type,accident|integer|nullable",
            'type_of_collision' => "required_if:type,accident|string|nullable",
            'number_of_injuries' => "required_if:type,accident|integer|nullable",
            'number_of_fatalities' => "required_if:type,accident|integer|nullable",
            'purpose_of_trip' => "required_if:type,accident|string|nullable",
            'reporter_involved' => "required_if:type,accident|integer|nullable",

            //Hazard
            'hazard_type' => "required_if:type,hazard|string|nullable",

            //Threatening incident
            'threatening_type' => "required_if:type,threatening|string|nullable",

            //General
            'road_type' => "required_if:type,hazard,accident|string|nullable",
            'road_surface_condition' => "required_if:type,hazard,accident|string|nullable",
            'weather' => "required_if:type,hazard,accident|string|nullable",
            'description' => "string|nullable"
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

            //Threatening incident
            'threatening_type',

            //General
            'road_type',
            'road_surface_condition',
            'weather',
            'description',
        ];
    }
}
