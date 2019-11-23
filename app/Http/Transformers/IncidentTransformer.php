<?php
namespace App\Http\Transformers;

use App\Models\Incident;

class IncidentTransformer extends AbstractTransformer
{
    public function transform(Incident $incident)
    {
        return [
            'location' => $incident->location,
            'type' => $incident->type
        ];
    }
}
