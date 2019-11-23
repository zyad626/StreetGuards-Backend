<?php
namespace App\Http\Transformers;

use App\Models\Accident;

class AccidentTransformer extends AbstractTransformer
{
    public function transform(Accident $accident)
    {
        return [
            'nmber_of_bikes' => $accident->number_of_bikes
        ];
    }
}
