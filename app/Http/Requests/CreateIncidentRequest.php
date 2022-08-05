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
            'contact' => 'string',
            'file_ids' => 'array|max:10',
            'file_ids.*' => 'string|exists:files,_id',

            //Accident
            'crash_data.type' => "required_if:type,crash_near_miss|string|nullable",
            'crash_data.number_involved_vehicles' => "required_if:type,crash_near_miss|integer|nullable",
            'crash_data.number_involved_bikes' => "required_if:type,crash_near_miss|integer|nullable",
            'crash_data.number_involved_pedesterians' => "required_if:type,crash_near_miss|integer|nullable",
            'crash_data.type_of_collision' => "string|nullable",
            'crash_data.type_of_collision_explain' => "string|nullable",
            'crash_data.number_of_injuries' => "required_if:type,crash_near_miss|integer|nullable",
            'crash_data.number_of_fatalities' => "required_if:type,crash_near_miss|integer|nullable",
            'crash_data.reporter_involved' => "required_if:type,crash_near_miss|boolean|nullable",
            'crash_data.reporter_type' => "required_if:type,crash_near_miss|string|nullable",

            //Hazard
            'hazard_data.type' => "required_if:type,hazard|string|nullable",

            //Threatening incident
            'threatening_data.type' => "required_if:type,threatening|string|nullable",

            //General
            'description' => "string|nullable"
        ];
    }

    public function requestFields()
    {
        return [
            'date',
            'location',
            'type',
            'contact',
            'files',
            
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
