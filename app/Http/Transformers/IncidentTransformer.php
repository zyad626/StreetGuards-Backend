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
            'crash_data' => $incident->crash_data,
            'hazard_data' => $incident->hazard_data,
            'threatening_data' => $incident->threatening_data,
        ];
    }
}
