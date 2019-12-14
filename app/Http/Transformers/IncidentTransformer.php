<?php
namespace App\Http\Transformers;

use App\Models\Incident;

class IncidentTransformer extends AbstractTransformer
{
    public function transform(Incident $incident)
    {
        return [
            'location' => $incident->location,
            'date' => $incident->date,
            'type' => $incident->type,
            'description' => $incident->description,
            'type_of_collision' => $incident->type_of_collision,
            'number_of_vehicles' => $incident->number_of_vehicles,
            'number_of_bikes' => $incident->number_of_bikes,
            'number_of_pedesterians' => $incident->number_of_pedesterians,
            'number_of_injuries' => $incident->number_of_injuries,
            'number_of_fatalities' => $incident->number_of_fatalities,
            'hazard_type' => $incident->hazard_type
        ];
    }
}
